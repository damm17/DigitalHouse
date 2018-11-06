<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actor;

class ActorController extends Controller
{
    public function directory()
    {
        $actores = Actor::all()->toArray();
        
        return view('clase3/actores', ['resultado' => $actores]);
    }
    
    public function show($id)
    {
        $actor = Actor::find($id)->toArray();
        unset($actor["id"], $actor["created_at"], $actor["updated_at"]);
        return view('clase3/actor', ['resultado' => $actor]);
    }
    
    public function allInOne($id=null)
    {
        $actores = Actor::all()->toArray();
        
        $resultado = $actores;
        if( ($id == 0 || $id > count($actores)) && $id !== null) {
            $resultado = "El id no concuerda con ningún actor.";
        } elseif ($id) {
            foreach($actores as $actor){
                if ($id == $actor["id"]){
                    $resultado = $actor;
                    break;
                }
            }
        }
        
        return view('clase3/actors', ['resultado' => $resultado]);
    }
}
