<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use \App\User;

class TestController extends Controller{
    
    public function index(){
        $data = User::all();

        return view('pruebaIndex',compact('data'));
    }

    public function add(){
        $data = new User;
        $data->name= "userprueba2";
        $data->email = "prueba2@gmail.com";
        $data->password = bcrypt("12345");
        $data->save();

        return "Success";
    }
}
