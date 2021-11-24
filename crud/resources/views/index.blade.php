@extends('layout')

@section('content')

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<div class="row">
    <div class="col-md-6">
        <h1>PROYECTO CRUD (LARAVEL 8)</h1>
    </div>
    <div class="col-md">
        <form action="{{ action('\App\Http\Controllers\PostController@search') }}" method="get">
            <div class="input-group">
            <input type="search" name="buscar" class="form-control">
            <span class="form-group-prepend">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </span>
            </div>
        </form>
    </div>
</div>
<form method="post">
<a href="{{ action('\App\Http\Controllers\PostController@create') }}" class="btn btn-primary float-end">Agregar</a>
    @csrf
    @method('DELETE')
    <button formaction="{{ action('\App\Http\Controllers\PostController@deleteAll') }}" type="submit" class="btn btn-danger mb-3">Eliminar los seleccionados</button>
<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Sueldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $post->id }}"></td>
            <td>{{ $post->nombre }}</td>
            <td>{{ $post->email }}</td>
            <td>{{ $post->direccion }}</td>
            <td>{{ $post->telefono }}</td>
            <td>{{ $post->sueldo }}</td>
            <td>
                <form method="post">
                    <a href="{{ action('\App\Http\Controllers\PostController@edit', $post->id) }}" class="btn btn-warning">Editar</a>
                    <button formaction="{{ action('\App\Http\Controllers\PostController@destroy', $post->id) }}" type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</form>
{{ $posts->links('pagination::bootstrap-4') }}

@endsection