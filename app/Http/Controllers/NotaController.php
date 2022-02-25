<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nota;

class NotaController extends Controller
{
    public function list(){
        return nota::where('delete',true)->get();
    }

    public function save(Request $request){
        nota::insert($request->all());
    }

    public function update(Request $request, $id){
        nota::where('id','=',$id)->update($request->all());
    }

    public function delete(Request $request){
        $docent = nota::findOrFail($request->id);
        $docent->delete=0;
        $docent->update();
    } 
}
