<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultiPicture;
use Image;

class MultiImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //  $images = MultiPicture::latest()->paginate(5);
         $images = MultiPicture::latest()->get();
        return view('admin.multi_images.index')->with('images', $images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach(request('image') as $image){

            $multi_image = new MultiPicture;

            $file_name = $image->getClientOriginalName();

            $multi_image->image = $image->store('/images/multi images', 'public');
            $multi_image->save();

            $image = Image::make(public_path('storage/' . $multi_image->image))->fit(300,200);
            $image->save();
        }

        return redirect()->back();

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
