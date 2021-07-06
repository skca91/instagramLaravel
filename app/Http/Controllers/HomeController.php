<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $images = Image::orderBy('id','desc')->paginate(1);

        return view('dashboard', ['images'=> $images]);
    }

  
}
