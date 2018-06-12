<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller{


    public function __construct(){
        $this->middleware('guest', ['except' => 'destroy']);
    }


    public function create(){
        return view('index');
    }

    public function store(){

        if(auth()->attempt(request(['email', 'password', 'isAdmin']))){
            return redirect('/home');
        }
        else{
            return redirect('/')->withErrors([
                'Login' => 'Las datos ingresados no coinciden con una cuenta o no tenes permiso para ingresar.'
            ]);
        }
    }

    public function destroy(){     
        auth()->logout();
        return redirect('/');
    }
}
