<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\docente;

class DocenteController extends Controller
{
    public function list(){
        return docente::where('delete',true)->get();
    }

    public function save(Request $request){
        docente::insert($request->all());
    }

    public function update(Request $request, $id){
        docente::where('id','=',$id)->update($request->all());
    }

    public function delete(Request $request){
        $docent = docente::findOrFail($request->id);
        $docent->delete=0;
        $docent->update();
    }
}
