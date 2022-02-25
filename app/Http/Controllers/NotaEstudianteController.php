<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nota_estudiante;

class NotaEstudianteController extends Controller
{
    public function list(){
        return nota_estudiante::where('delete',true)->get();
    }

    public function save(Request $request){
        nota_estudiante::insert($request->all());
    }

    public function update(Request $request, $id){
        nota_estudiante::where('id','=',$id)->update($request->all());
    }

    public function delete(Request $request){
        $docent = nota_estudiante::findOrFail($request->id);
        $docent->delete=0;
        $docent->update();
    } 
}
