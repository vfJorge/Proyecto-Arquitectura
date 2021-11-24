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
        $posts = DB::table('posts')->paginate(4);
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

    public function search(Request $request){
        $search = $request->get('buscar');
        $posts = DB::table('posts')->where('nombre', 'like', '%'.$search.'%')->orwhere('email', 'like', '%'.$search.'%')->orwhere('direccion', 'like', '%'.$search.'%')->orwhere('telefono', 'like', '%'.$search.'%')->orwhere('sueldo', 'like', '%'.$search.'%')->paginate(5);
        return view('index',['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'sueldo' => 'required'
        ]);
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
        $request->validate([
            'nombre' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'sueldo' => 'required'
        ]);
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

    public function deleteAll(Request $request){
        $ids = $request->get('ids');
        $dbs = DB::delete('delete from posts where id in ('.implode(",",$ids).')');
        return redirect('posts');
    }
}
