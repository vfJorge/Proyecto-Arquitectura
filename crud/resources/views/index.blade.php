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
    <div class="col-md-4">
        <form action="{{ action('\App\Http\Controllers\PostController@search') }}" method="get">
            <div class="input-group">
            <input type="search" name="buscar" class="form-control">
            <span class="form-group-prepend">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </span>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ action('\App\Http\Controllers\PostController@create') }}" class="btn btn-primary">Agregar</a>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
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
            <td>{{ $post->id }}</td>
            <td>{{ $post->nombre }}</td>
            <td>{{ $post->email }}</td>
            <td>{{ $post->direccion }}</td>
            <td>{{ $post->telefono }}</td>
            <td>{{ $post->sueldo }}</td>
            <td>
                <form action="{{ action('\App\Http\Controllers\PostController@destroy', $post->id) }}" method="post">
                    <a href="{{ action('\App\Http\Controllers\PostController@edit', $post->id) }}" class="btn btn-warning">Editar</a>

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links('pagination::bootstrap-4') }}

@endsection