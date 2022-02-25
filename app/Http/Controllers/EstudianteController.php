<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\estudiante;

class EstudianteController extends Controller
{
    public function list(){
        return estudiante::where('delete',true)->get();
    }

    public function save(Request $request){
        estudiante::insert($request->all());
    }

    public function update(Request $request, $id){
        estudiante::where('id','=',$id)->update($request->all());
    }

    public function delete(Request $request){
        $docent = estudiante::findOrFail($request->id);
        $docent->delete=0;
        $docent->update();
    } 
}
