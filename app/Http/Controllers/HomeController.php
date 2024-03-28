<?php

namespace App\Http\Controllers;

use App\Models\follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = follow::where("userid" , $id)->get()->count();
        $Followers = follow::where("you_foloow" , $id)->get()->count();
 
   
        return view('home')->with(compact("data", "Followers"));
    }
}
