@extends('layouts.main')

@section('title','Agenda')

@section('content')
<section class="section-principal">
    <div class="grade-formulario">
        <div class="block-formulario">
            <h1>Edição de Evento</h1>
            <div class="formulario-evento">
                <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                    <div class="form-group">
                        <label class="image">Imagem do Evento:</label>
                        <input type="file" class="form-control-file" id="image" name="image" placeholder="Imagem" value="{{$event->image}}">
                        <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">
                    </div>
                    <div class="form-group">
                        <label class="image">Data do Evento:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y,m,d') }}" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="{{$event->city}}">
                    </div>
                    <div class="form-group">
                        <label>O evento é privado?</label>
                        <select name="private" id="private" class="form-control">
                            <option value="0">Não</option>
                            <option value="1" {{$event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Oque irá acontecer no evento?"></textarea>
                    </div>

                    <input type="submit" btn btn-primary value="Editar Evento">
                </form>
            </div>
        </div>
        <div class="block-imagem">
            <img src="/img/formulario.svg">
        </div>

    </div>
</section>
@endsection
