<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function yo(){
        return "Hey Hey this is an about page";
    }
//This is how you return a view inside a controller
    public function returnView(){
        return view('welcome');
    }
    
    public function about(){
        // $name = 'Brendon';

        // return view('pages.about')->with('name', $name);

        $data = [
            'name' => 'Brendon',
            'age' => '33'
        ];
        $data['sex'] = "yes please";

        return view('pages.about', $data);
    }

public function contact(){
    $data = [
        'name' => 'Brendon',
        'age' => '33'
    ];
$people = [
    'tom','jack','steve'
];

    return view('pages.contact', compact('people'));
}


}

