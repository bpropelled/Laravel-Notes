<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mfg;

class MfgController extends Controller
{
    public function all(){
        $mfgs =  Mfg::all();

        return view('mfgs.index')->with('mfgs', $mfgs);
     
    }

    public function cars(){
        $cars = Mfg::find(1)->cars;

        return view('mfgs.index')->with('cars', $cars);
    }

    public function show($id){
        $car = Mfg::find($id)->cars;
    
        return view('mfgs.car')->with('cars', $car);
        
            // if($article){
            //     return view('articles.show')->with('article', $article);
            // }else{
            //     abort(404);
            // } 

           
    }
}
