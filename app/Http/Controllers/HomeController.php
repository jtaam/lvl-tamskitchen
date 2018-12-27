<?php

namespace App\Http\Controllers;

use App\Category;
use App\GoogleMap;
use App\Item;
use Illuminate\Http\Request;
use App\Slider;

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
        $sliders = Slider::all();
        $categories = Category::all();
        $items = Item::all();
        $map = GoogleMap::all()->first();
        return view('welcome', compact('sliders','categories','items','map'));
    }
}
