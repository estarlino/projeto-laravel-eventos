@extends('layouts.main')

@section('title','Agenda')

@section('content')
<section class="section-principal">
    <div class="grade-formulario">
        <div class="block-formulario">
            <h1>Criação de Evento</h1>
            <div class="formulario-evento">
                <form action="/events" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label class="image">Imagem do Evento:</label>
                        <input type="file" class="form-control-file" id="image" name="image" placeholder="Imagem">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento">
                    </div>
                    <div class="form-group">
                        <label class="image">Data do Evento:</label>
                        <input type="date" class="form-control" id="date" name="date" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade">
                    </div>
                    <div class="form-group">
                        <label>O evento é privado?</label>
                        <select name="private" id="private" class="form-control">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="Oque irá acontecer no evento?"></textarea>
                    </div>

                    <input type="submit" btn btn-primary value="Criar Evento">
                </form>
            </div>
        </div>
        <div class="block-imagem">
            <img src="/img/formulario.svg">
        </div>

    </div>
</section>
@endsection
