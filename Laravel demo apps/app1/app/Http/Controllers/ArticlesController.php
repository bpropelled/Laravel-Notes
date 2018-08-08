<?php

namespace App\Http\Controllers;

// use  Request;

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
        return view('articles.create');
    }

    public function store(\App\Http\Requests\createArticleRequest $request){



        $input = $request->all();
        // Article::create($input);
        // //or Article::create(['title' => $input['title']);

        Article::create($input);
        return redirect('articles');
}

public function latest(){
    $latest = Article::latest()->get();
    return view('articles.index')->with('articles', $latest);
}

public function api (){
    $request = new Request;
 return response()->json(['name' => 'brendon']);
}



}
