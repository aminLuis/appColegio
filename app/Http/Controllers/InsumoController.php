<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\insumo;

class InsumoController extends Controller
{
    public function listInsumos(){
        return insumo::get();
    }

    public function insertInsumo(Request $request){
        insumo::insert($request->all());
    }

    public function updateInsumo(Request $request, $id){
        insumo::where('id','=',$id)->update($request->all());
    }

    public function deleteInsumo(){
        
    }

}
