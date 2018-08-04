<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Call the DB instance
use App\Article;

class ArticlesController extends Controller
{
    public function index(){
        $articles = Article::all();
      return view('articles.index')->with('articles', $articles);
    }

    public function show($id){
        $article = Article::find($id);
            if($article){
                return view('articles.show')->with('article', $article);
            }else{
                abort(404);
            } 
    }

    public function create(){
        return 'hey';
    }



}
