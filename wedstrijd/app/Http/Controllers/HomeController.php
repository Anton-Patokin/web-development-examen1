<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if($partisepants= Participant::inRandomOrder()->take(10)->get()){

        }
        return view('welcome',['partisipants'=>$partisepants]);
    }
}
