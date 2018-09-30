<?php

namespace App\Http\Controllers\admin;

use App\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }

    public function show($id){
        $contact = Contact::findOrFail($id);
        return view('admin.contact.show',compact('contact'));
    }

    public function destroy($id){
        Contact::findOrFail($id)->delete();
        Toastr::success('The message has been deleted successfully','Done',["positionClass"=>"toast-top-right"]);
        return redirect()->back();
    }
}
