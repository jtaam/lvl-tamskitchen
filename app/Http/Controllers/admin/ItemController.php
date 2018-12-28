<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Settings\CloudinarySettings;
use App\Category;
use App\Item;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
  public function __construct()
  {
    $settings = new CloudinarySettings;
    $settings->setup_cloudinary();

  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $items = Item::all();
    return view('admin.item.index',compact('items'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $categories = Category::all();
    return view('admin.item.create', compact('categories'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //        dd($request->all());
    $this->validate($request,[
      'category'=>'required',
      'name'=>'required',
      'description'=>'required',
      'price'=>'required',
      'image'=>'mimes:jpeg,png,bmp,jpg',
    ]);
    $image = $request->file('image');
    $slug = str_slug($request->name);
    if (isset($image)){
      $currentDate = Carbon::now()->toDateString();

      // LOCAL ENV
      // if (config('app.env') == 'production') {
      if (config('app.env') == 'local') {
        $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if (!file_exists('uploads/items')){
          mkdir('uploads/items',0777,true);
        }
        $image->move('uploads/items',$imagename);
      }
      // PRODUCTION ENV
      // if (config('app.env') == 'local') {
      if (config('app.env') == 'production'){
        $imagename = $slug . '-' . $currentDate . '-' . uniqid();

        $cloudinary_data = null;
        $cloudinary_data = Cloudinary\Uploader::upload($request->image,
        array(
          "folder" => "laravel/tamskitchen/items/",
          "public_id" => $imagename,
          "width" => 369,
          "height" => 300,
          "overwrite" => TRUE,
          "resource_type" => "image")
        );
      }
    }
    else{
      $imagename = 'default.png';
    }

    $item = new Item();
    $item->category_id = $request->category;
    $item->name=$request->name;
    $item->description=$request->description;
    $item->price=$request->price;
    // LOCAL ENV
    // if (config('app.env') == 'production') {
    if (config('app.env') == 'local') {
      $item->image = $imagename;
    }
    // PRODUCTION ENV
    // if (config('app.env') == 'local') {
    if (config('app.env') == 'production') {
      $item->image = $cloudinary_data['secure_url'];
      $item->public_id = $cloudinary_data['public_id'];
    }
    $item->save();
    return redirect()->route('item.index')->with('successMsg','Item added successfully!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $item = Item::findOrFail($id);
    $categories = Category::all();
    return view('admin.item.edit',compact('item','categories'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'category'=>'required',
      'name'=>'required',
      'description'=>'required',
      'price'=>'required',
      'image'=>'mimes:jpeg,png,bmp,jpg',
    ]);

    $item = Item::findOrFail($id);

    $image = $request->file('image');
    $slug = str_slug($request->name);
    if (isset($image)){
      $currentDate = Carbon::now()->toDateString();
      // LOCAL ENV
      if (config('app.env') == 'local') {
        $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if (!file_exists('uploads/items')){
          mkdir('uploads/items',0777,true);
          unlink('uploads/items/'.$item->image); // remove old image
        }

        $image->move('uploads/items',$imagename);
      }
      // PRODUCTION ENV
      if (config('app.env') == 'production') {
        $imagename = $slug . '-' . $currentDate . '-' . uniqid();
        // cloudinary
        if (Cloudinary\Uploader::destroy($item->public_id)) {
          $cloudinary_data = null;
          $cloudinary_data = Cloudinary\Uploader::upload($request->image,
          array(
            "folder" => "laravel/tamskitchen/items/",
            "public_id" => $imagename,
            "width" => 369,
            "height" => 300,
            "overwrite" => TRUE,
            "resource_type" => "image"
          )
        );
      }
    }

  }else{
    $imagename = $item->image;
  }
  $item->category_id = $request->category;
  $item->name=$request->name;
  $item->description=$request->description;
  $item->price=$request->price;
  // LOCAL ENV
  // if (config('app.env') == 'production') {
  if (config('app.env') == 'local') {
    $item->image = $imagename;
  }
  // PRODUCTION ENV
  // if (config('app.env') == 'local') {
  if (config('app.env') == 'production') {
    $item->image = $cloudinary_data['secure_url'];
    $item->public_id = $cloudinary_data['public_id'];
  }

  $item->update();
  return redirect()->route('item.index')->with('successMsg','Item updated successfully!');
}


/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
  $item = Item::findOrFail($id);
  // LOCAL ENV
  if (config('app.env') == 'local') {
    if (file_exists('uploads/items/'.$item->image)){
      unlink('uploads/items/'.$item->image); // remove old image
    }
  }
  // PRODUCTION ENV
  if (config('app.env') == 'production') {
    // cloudinary
    Cloudinary\Uploader::destroy($item->public_id);
  }
  $item->delete();
  return redirect()->back()->with('successMsg','Item deleted successfully!');
}
}
