@extends('layout')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @foreach($posts as $post)
            <form action="{{ action('\App\Http\Controllers\PostController@update', $post->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $post->nombre }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $post->email }}">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <textarea class="form-control" name="direccion">{{ $post->direccion }}</textarea>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $post->telefono }}">
                </div>
                <div class="form-group">
                    <label for="sueldo">Sueldo</label>
                    <input type="text" name="sueldo" class="form-control" value="{{ $post->sueldo }}">
                </div>
                <br><button type="submit" class="btn btn-warning">Actualizar</button>
                <a href="{{ action('\App\Http\Controllers\PostController@index') }}" class="btn btn-secondary">Regresar</a>
            </form>
        @endforeach
    </div>
</div>