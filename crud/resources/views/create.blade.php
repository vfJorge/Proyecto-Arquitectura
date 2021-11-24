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
        <form action="{{ action('\App\Http\Controllers\PostController@store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" placeholder="Introduce tu nombre">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Introduce tu correo">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" name="direccion" placeholder="Introduce tu direccion"></textarea>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input class="form-control" type="text" name="telefono" placeholder="Introduce tu teléfono">
            </div>
            <div class="form-group">
                <label for="sueldo">Sueldo</label>
                <input class="form-control" type="text" name="sueldo" placeholder="Introduce tu sueldo">
            </div>
            <br><button class="btn btn-primary" type="submit">Enviar</button>
        </form>
    </div>
</div>
@endsection