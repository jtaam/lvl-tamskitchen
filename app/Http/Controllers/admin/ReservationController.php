<?php

namespace App\Http\Controllers\admin;

use App\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::all();
        return view('admin.reservation.index',compact('reservations'));
    }

    public function status($id){
        $reservation = Reservation::findOrFail($id);
        $reservation->status = true;
        $reservation->save();

        Toastr::success('Reservation confirmed succefully!','success',["positionClass"=>"toast-top-right"]);

        return redirect()->back();
    }

    public function destroy($id){
        $reservation = Reservation::findOrFail($id)->delete();

        Toastr::success('Reservation deleted succefully!','success',["positionClass"=>"toast-top-right"]);

        return redirect()->back();
    }
}
