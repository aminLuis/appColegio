<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clase;

class ClaseController extends Controller
{
    
    public function list(){
        return clase::where('delete',true)->get();
    }

    public function save(Request $request){
        clase::insert($request->all());
    }

    public function update(Request $request, $id){
        clase::where('id',$id)->update($request->all());
    }

    public function delete(Request $request){
        $class = clase::findOrFail($request->id);
        $class->delete = 0;
        $class->update();
    }

}
