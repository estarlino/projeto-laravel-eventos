@extends('layouts.main')

@section('title','Agenda')

@section('content')
<section class="section-principal">

    @if( count($events) > 0 )
        <h1>Meus Eventos</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <th scropt="row">{{ $loop->index + 1 }}</th>
                    <th><a href="/events/{{$event->id}}"> {{$event->title}} </a></th>
                    <th> {{count($event->users)}} </th>
                    <th> {{ date('d/m/y',strtotime($event->date)) }} </th>
                    <th>
                        <a href="/events/edit/{{$event->id}}" class="btn btn-info edit-btn"><i class="fas fa-pen-square"></i> Alterar</a>
                        <form action="/events/{{$event->id}}" method="POST" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i> Deletar</button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    @else
        <p>Você não possui eventos</p> <a href="events/create">Criar Eventos</a>
    @endif
</section>


<section class="section-principal">

    @if( count($eventsAsParticipant) > 0 )
        <h1>Eventos Marcados</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventsAsParticipant as $event)
                <tr>
                    <th scropt="row">{{ $loop->index + 1 }}</th>
                    <th><a href="/events/{{$event->id}}"> {{$event->title}} </a></th>
                    <th> {{count($event->users)}} </th>
                    <th> {{ date('d/m/y',strtotime($event->date)) }} </th>
                    <th>
                        <form action="/events/leave/{{$event->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <i class="fas fa-sign-out-alt"> Sair do Evento</i>

                        </button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    @else
        <p>Você não está participando de nenhum evento</p> <a href="events/create">Criar Eventos</a>
    @endif
</section>

@endsection