<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Contact;
use App\Item;
use App\Reservation;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $categoryCount = Category::count();
        $itemsCount = Item::count();
        $slidersCount = Slider::count();
        $reservations = Reservation::where('status',false)->get();
        $contactsCount = Contact::count();
        return view('admin.dashboard',compact('categoryCount','itemsCount','slidersCount','reservations','contactsCount'));
    }
}
