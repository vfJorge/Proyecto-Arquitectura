<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::select('select * from posts');
        return view('index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre = $request->get('nombre');
        $email = $request->get('email');
        $direccion = $request->get('direccion');
        $telefono = $request->get('telefono');
        $sueldo = $request->get('sueldo');
        $posts = DB::insert('insert into posts (nombre,email,direccion,telefono,sueldo) value(?,?,?,?,?)', [$nombre, $email, $direccion, $telefono, $sueldo]);
        if($posts){
            $red = redirect('posts')->with('success', 'Los datos se han agregado a la base de datos.');
        }else{
            $red = redirect('posts/create')->with('danger', 'Error en los datos introducidos');
        }
        return $red;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = DB::select('select * from posts where id=?',[$id]);
        return view('edit', ['posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre = $request->get('nombre');
        $email = $request->get('email');
        $direccion = $request->get('direccion');
        $telefono = $request->get('telefono');
        $sueldo = $request->get('sueldo');
        $posts = DB::update('update posts set nombre=?, email=?, direccion=?, telefono=?, sueldo=? where id=?', [$nombre, $email, $direccion, $telefono, $sueldo, $id]);
        if($posts){
            $red = redirect('posts')->with('success', 'Se han actualizado los datos.');
        }else{
            $red = redirect('posts/edit/'.$id)->with('danger', 'Error al actualizar los datos.');
        }
        return $red;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = DB::delete('delete from posts where id=?', [$id]);
        $red = redirect('posts');
        return $red;
    }
}
