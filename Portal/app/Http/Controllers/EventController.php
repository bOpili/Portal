<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
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
        return Inertia::render('Events/Events', ['events' => $events, 'joinMessage'=> session('joinMessage')],);
    }

    public function join(Request $request){

        $event = Event::findOrFail($request->eventId);

        if($event->users->find(Auth::id())){
            return back()->with('message', 'Jesteś już członkiem tego wydarzenia');
        }
        if($event->users->count() >= $event->slots){
            return back()->with('message', 'Brak wolnych miejsc');
        }

        $event->users()->attach(Auth::id());

        return back()->with('message', 'Dołączono do wydarzenia');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/EventForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $fields = $request->validate([
            "title" => ['required', 'max:255'],
            "description" => ['required'],
            "tags" => ['nullable','string'],
            "slots" => ['required','int'],
            "game" => ['required'],
            "image" => ['nullable', 'file', 'max:3072', 'mimes:jpeg,jpg,png,webp'],
            "date" => ['required']
        ]);

        if ($request->hasFile('image')){
           $fields['image'] = Storage::disk('public')->put('Events',$request->image);
        }else{
           $fields['image'] = 'Events/DefaultEvent2.webp';
        }

        $request->user()->events()->create($fields);

        return redirect()->route('events');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('Events/EventDetails',
['event' => Event::withCount('users')->where('id',$event->id)->first(), 'users' => $event->users()->get()]);
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
