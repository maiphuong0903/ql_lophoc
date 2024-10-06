<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClassAPIController extends Controller
{
    public function index(){
        $classes = ClassRoom::all();
        return $classes;
    }

    public function store(Request $request){
        $code = Str::random(6);

        while (ClassRoom::where('code', strtoupper($code))->exists()) {
            $code = Str::random(6);
        }

        $classRoom = ClassRoom::create([
            'code' => strtoupper($code),
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => '',
            'created_by' => 1,
        ]);
        
        return $classRoom;
    }

    public function edit($id){
        $classRoom = ClassRoom::find($id);
        return $classRoom;
    }

    public function update(Request $request, $id){
        $classRoom = ClassRoom::find($id);
        $classRoom->update($request->all());
        return $classRoom;
    }

    public function delete($id){
        $classRoom = ClassRoom::find($id);
        $classRoom->delete();
        return $classRoom;
    }
}