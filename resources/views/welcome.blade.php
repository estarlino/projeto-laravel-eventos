@extends('layouts.main')

@section('title','Agenda')

@section('content')

<section class="section-principal">

    <form action="/" method="GET">
        <div class="input-group">
            <div class="form-outline">
                <input id="search" type="search" name="search" id="form1" class="form-control" placeholder="Pesquisar evento" />
            </div>
            <input class="pesquisa-evento" type="submit" value="Pesquisar"></input>
        </div>
    </form>

    @if($search)
        <h5 class="text-busca"> Buscando por: {{$search}}...</h5>
    @endif

    <div class="blocks-agenda grade-blocks">
    @foreach($events as $event)
        <div class="block">
            <img class="img-block" src="/img/events/{{$event->image}}">
            <div class="conteudo">
                <h5 class="block-titulo">{{$event->title}}</h5>
                <p class ="block-participantes">{{count($event->users)}} Participantes</p>
                <a href="/events/{{$event->id}}"><button>Saiba mais</button></a>
                <p class ="block-data">{{ date('d/m/y',strtotime($event->date)) }}</p>
            </div>
        </div>
    @endforeach

    @if(count($events) == 0 && $search)
        <p>Não foi encontrado nenhum evento com o nome: {{$search}} <a href="/">Ver todos os eventos</a></p>
    @elseif(count($events) == 0)
        <p>Não há eventos disponíveis</p>
    @endif
    </div>


</section>

@endsection