<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Game;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $event = Event::findOrFail($request->eventId);

        if ($event->users->find(Auth::id())) {
            return back()->with('message', 'Jesteś już członkiem tego wydarzenia');
        }
        if ($event->users->count() >= $event->slots) {
            return back()->with('message', 'Brak wolnych miejsc');
        }

        $event->users()->attach(Auth::id());

        return back()->with('message', 'Dołączono do wydarzenia');
    }

    public function accept(Request $request)  {
        $event = Event::findOrFail($request->eventId);

        $event->users()->where('user_id',$request->userId)->update(['status' => 1]);

        return back()->with('message', 'Zaakceptowano użytkownika');
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
            "date" => ['required'],
            "game_id" => ['required'],
        ]);


        if ($request->hasFile('image')) {
            $fields['image'] = Storage::disk('public')->put('Events', $request->image);
        } else {
            $fields['image'] = 'Events/DefaultEvent2.webp';
        }


        $event = $request->user()->events()->create($fields);

        foreach($request->tags as $tag){

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

        $userStatus = $event->users()->withPivot('status')->find(Auth::id());


        $event = Event::withCount(
            [
                'users' => function ($query) {
                    $query->where('status', '>', 0); },
                'users as users_awaiting' => function ($query) {
                    $query->where('status', 0); }
            ]
        )->where('id', $event->id)->first();

        $event->load('game')->load('tags');



        return Inertia::render(
            'Events/EventDetails',
            [
                'event' => $event,
                'users' => $event->users()->where('status','>', 0)->get(),
                'userStatus' => $userStatus ? $userStatus->getOriginal('pivot_status') : -1,
                'pendingUsers' => $event->users()->where('status','=', 0)->get()
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
        //
    }
}
