<?php

namespace App\Http\Controllers\admin;

use App\GoogleMap;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoogleMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = GoogleMap::all()->first();
        return view('admin.google-map.index', compact('map'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.google-map.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'api_key'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);

        $map = new GoogleMap();
        $map->title=$request->title;
        $map->api_key=$request->api_key;
        $map->latitude=$request->latitude;
        $map->longitude=$request->longitude;
        $map->save();

        Toastr::success('Map saved successfully','Done');

        return redirect()->route('map.index');
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
        $map = GoogleMap::findOrFail($id);
        return view('admin.google-map.edit',compact('map'));
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
            'title'=>'required',
            'api_key'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);

        $map = GoogleMap::findOrFail($id);
        $map->title=$request->title;
        $map->api_key=$request->api_key;
        $map->latitude=$request->latitude;
        $map->longitude=$request->longitude;
        $map->update();

        Toastr::success('Map updated successfully','Done');

        return redirect()->route('map.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $map = GoogleMap::findOrFail($id);
        $map->delete();

        Toastr::success('Map deleted successfully','Done');

        return redirect()->route('map.index');

    }
}
