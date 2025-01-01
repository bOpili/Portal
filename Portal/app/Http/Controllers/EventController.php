<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Game;
use App\Models\Invitation;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->withCount(['users'])->paginate(6);
        $events->load('game')->load('tags');
        return Inertia::render('Events/Events', ['events' => $events, 'joinMessage' => session('joinMessage')], );
    }

    public function join(Request $request)
    {
        $user = User::find(Auth::id());
        $event = Event::findOrFail($request->eventId);

        if ($event->users->find(Auth::id())) {
            return back()->with('message', 'Jesteś już członkiem tego wydarzenia');
        }
        if ($event->users->count() >= $event->slots) {
            return back()->with('message', 'Brak wolnych miejsc');
        }

        // Check if the user has overlapping events
        $overlappingEvent = $user->events()
            ->where(function ($query) use ($event) {
                $query->where('startDate', '<', $event->endDate)
                    ->where('endDate', '>', $event->startDate);
            })
            ->first();

        if ($overlappingEvent) {
            return back()->with('message', "You are already participating in \"" . $overlappingEvent->title . "\" during this time.");
        }

        $event->users()->attach(Auth::id());

        return back()->with('message', 'Dołączono do wydarzenia');
    }

    public function accept(Request $request)
    {
        $event = Event::findOrFail($request->eventId);

        if ($event->users()->withPivot('status')->where('status', '>', 0)->count() <= $event->slots) {
            $event->users()->where('user_id', $request->userId)->update(['status' => 1]);
            return back()->with('message', 'User accepted');
        } else {
            $event->users()->where('user_id', $request->userId)->update(['status' => -1]);
            return back()->with('message', 'No more empty slots for this user');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/EventForm', ['tags' => Tag::get(), 'games' => Game::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $fields = $request->validate([
            "title" => ['required', 'max:255'],
            "description" => ['required'],
            "slots" => ['required', 'int'],
            "image" => ['nullable', 'file', 'max:3072', 'mimes:jpeg,jpg,png,webp'],
            "startDate" => ['required'],
            "endDate" => ['required'],
            "game_id" => ['required'],
        ]);


        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put('Events', $request->image);
        } else {
            $fields['image'] = 'Events/DefaultEvent2.webp';
        }


        $event = $request->user()->events()->create($fields);

        foreach ($request->tags as $tag) {

            $event->tags()->attach($tag['id']);
        }



        $event->users()->where('user_id', Auth::id())->update(['status' => 2]);

        return redirect()->route('events');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $userStatus = $event->userStatus(Auth::id());

        $event = Event::withCount(
            [
                'users' => function ($query) {
                    $query->where('status', '>', 0);
                },
                'users as users_awaiting' => function ($query) {
                    $query->where('status', 0);
                }
            ]
        )->where('id', $event->id)->first();

        $event->load('game')->load('tags');



        return Inertia::render(
            'Events/EventDetails',
            [
                'event' => $event,
                'users' => $event->users()->where('status', '>', 0)->get(),
                'userStatus' => $userStatus !== null ? $userStatus : -1,
                'pendingUsers' => $event->users()->where('status', '=', 0)->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {

        $auth = Gate::inspect('delete', $event);

        if ($auth->allowed()) {
            Event::find($event->id)->delete();
            return redirect()->route('events');
        } else {
            return redirect()->back()->with(['message' => $auth->message()]);
        }

    }

    public function sendInvitations(Request $request, $eventId)
    {
        $user = User::findOrFail(Auth::id()); // Get the authenticated user
        $event = Event::findOrFail($eventId);

        // Ensure the user is the event creator
        $auth = Gate::inspect('invite', $event);

        if (!($auth->allowed())) {
            return back()->with(['message' => $auth->message()]);
        }

        // Get friend IDs to invite from the request
        //$friendIds = collect($request->input('friend_ids'));
        // $friendIds = $user->friends();

        // Validate that the invited users are friends of the current user
        // $friends = $user->friends()->whereIn('id', $friendIds)->get();
        $friends = $user->friends();

        // Prepare invitations using collections
        $invitations = $friends->map(function ($friend) use ($event, $user) {
            return [
                'event_id' => $event->id,
                'sender_id' => $user->id,
                'receiver_id' => $friend->id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        // Insert invitations into the database
        Invitation::insert($invitations->toArray());

        return back()->with('message','Invitations sent successfully.');
    }
}
