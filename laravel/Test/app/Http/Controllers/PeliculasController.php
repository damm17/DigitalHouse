<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    private $peliculas = [
        1 => "Toy Story",
        2 => "Buscando a Nemo",
        3 => "Avatar",
        4 => "Star Wars: Episodio V",
        5 => "Up",
        6 => "Mary and Max"
    ];
    
    /*public function showAll()
    {
        return view('peliculas', ['listado' => $this->peliculas]);
    }
    
    public function showById($id)
    {
        return view('peliculas', ['pelicula' => $this->peliculas[$id]]);
    }
    */
    public function show($id=null)
    {
        if(($id == 0 || $id > count($this->peliculas)) && $id !== null){
            $resultado = "No se encontraron películas";
        } elseif ($id) {
            $resultado = $this->peliculas[$id];
        } else {
            $resultado = $this->peliculas;
        }
        return view('peliculas', ['resultado' => $resultado]);
    }
    
    public function showForm()
    {
        return view('agregarPelicula');
    }
    public function addMovie()
    {
        unset($_POST["_token"], $_POST["submit"]);
        return view('nuevaPelicula', ['peliculas' => $_POST]);
    }
}
