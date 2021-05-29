@extends('layouts.main')

@section('title','Agenda')

@section('content')

<section class="section-principal">
    <div class="grade-evento">
        <div class="img-evento">
            <img class="img-evento" src="/img/events/{{$event->image}}">
        </div>
        <div class="conteudo-evento">
            <h1 class="titulo-evento">{{$event->title}}</h1>
            <p class="cidade-evento"><i class="fas fa-map-marker-alt"></i> {{$event->city}}</p>
            <p class="participantes-evento"><i class="fas fa-users"></i> {{count($event->users)}} Participantes</p>
            <p class="dono-evento"><i class="fas fa-star"></i> {{$event->owner}} </p>
            @if(!$hasUserJoined)
                <form action="/events/join/{{$event->id}}" method="POST">
                @csrf
                    <a href="/events/join/{{$event->id}}"
                    class="btn btn-primary" 
                    id="event-submit"
                    onclick="event.preventDefault();
                    this.closest('form').submit();">
                    Confirmar Presença
                    </a>
                </form>
            @else
                <p class="already-joined-msg">Você já está participando deste evento</p>
            @endif
        </div>
    </div>
    <div class="desc-evento">
        <p>{{$event->description}}</p>
    </div>
</section>

@endsection