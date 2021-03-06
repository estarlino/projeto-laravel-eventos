<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{

    public function index(){

        $search = request('search');

        if($search){
            $events = Event::where([
                ['title','like','%'.$search."%"]
            ])->get();
        }else{
            $events = Event::all();
        }

        
    
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $user = auth()->user();

        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->owner = $user->name;

        //imagem upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtoTime('now') . '.' . $extension);
            $requestImage->move(public_path('/img/events'),$imageName);

            $event->image = $imageName;
        }

        
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with("msg", "Evento criado com sucesso!");
    }


    public function show($id){

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        return view('events.show', ['event' => $event, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events()->get();

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', [
            'events' => $events,
            'eventsAsParticipant' => $eventsAsParticipant,
        ]);

    }

    public function destroy($id){
        $event = Event::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with("msg","Evento deletado com sucesso!");
    }

    public function edit($id){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request){
        $data = $request->all();

        //imagem upload
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtoTime('now') . '.' . $extension);
            $requestImage->move(public_path('/img/events'),$imageName);

            $data['image'] = $imageName;
        }

        $event = Event::findOrFail($request->id)->update($data);
        return redirect('/dashboard')->with("msg","Evento alterado com sucesso!");
    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect("/dashboard")->with("msg","Sua presen??a est?? confirmada para o evento: ".$event->title);
    }


    public function leaveEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect("/dashboard")->with("msg","Voc?? saiu do evento: ".$event->title);
    }
    
}
