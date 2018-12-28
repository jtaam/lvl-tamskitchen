<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\Settings\CloudinarySettings;
use App\Slider;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
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
        $sliders = Slider::all();
        return view('admin.slider.index')->with(compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'title' =>  'required',
            'sub_title' =>  'required',
            'image' =>  'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            // LOCAL ENV
            // if (config('app.env') == 'production') {
           if (config('app.env') == 'local') {

                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('uploads/slider')) {
                    mkdir('uploads/slider', 0777, true);
                }
                $image->move('uploads/slider', $imagename);
            }
            // PRODUCTION ENV
             // if (config('app.env') == 'local') {
           if (config('app.env') == 'production'){
                $imagename = $slug . '-' . $currentDate . '-' . uniqid();

                $cloudinary_data = null;
                $cloudinary_data = Cloudinary\Uploader::upload($request->image,
                    array(
                        "folder" => "laravel/tamskitchen/top-sliders/",
                        "public_id" => $imagename,
                        "width" => 1800,
                        "height" => 991,
                        "overwrite" => TRUE,
                        "resource_type" => "image")
                );
            }

        }else{
            $imagename = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;

        // if (config('app.env') == 'production') {
       if (config('app.env') == 'local') {
            $slider->image = $imagename;
        }
        // if (config('app.env') == 'local') {
       if (config('app.env') == 'production') {
            $slider->image = $cloudinary_data['secure_url'];
            $slider->public_id = $cloudinary_data['public_id'];
        }

        $slider->save();

        return redirect()->route('slider.index')->with('successMsg','Slider successfully uploaded.');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit')->with(compact('slider'));
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
            'title' =>  'required',
            'sub_title' =>  'required',
            'image' =>  'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $slider = Slider::findOrFail($id);
        if (isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'. uniqid() . '.' .$image->getClientOriginalExtension();
            if (!file_exists('uploads/slider')){
                mkdir('uploads/slider',0777,true);
            }
            $image->move('uploads/slider',$imagename);
        }else{
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->update();
        return redirect()->route('slider.index')->with('successMsg','Slider successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if (file_exists('uploads/slider'.$slider->image)){
            unlink('uploads/slider/'.$slider->image);
        }
        $slider->delete();
        return redirect()->back()->with('successMsg','Slider successfully deleted!');
    }
}
