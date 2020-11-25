<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\MultiPicture;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $brand = new Brand;

        request()->validate([
             'brand_name' => ['required', 'max:255', 'unique:brands'],
             'brand_image' => ['required', 'image', 'mimes:png,jpg,jpeg'] 
        ]);

       $brand->brand_name = request('brand_name');
       $brand->brand_image = request('brand_image')->store('/images/brand images', 'public');

       $brand->save();

       $image = Image::make(public_path('storage/' . $brand->brand_image))->fit(300,200);
       $image->save();
        
       return redirect()->back()->with('success', 'Brand added successfully');
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
        return redirect()->back();
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit')->with('brand', $brand);
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
        $brand = Brand::findOrFail($id);
        
        request()->validate([
            'brand_name' => ['required', 'string', 'unique:brands', 'max:255'],
            // 'brand_image' => ['required', 'image', 'max:5000'],      
        ]);
        // $brand = new Brand;
        if(request()->has('brand_image')){
            request()->validate([
                'brand_image' => ['image', 'max:5000'],      
            ]);
            $brand->brand_image = request('brand_image')->store('/images/brand images', 'public');
        }
        $brand->brand_name = request('brand_name');
        $brand->save();
        // to retrieve the file asset('storage/' . $imagePath)
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully!');
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
        $brand = Brand::findOrFail($id);

        $old_image = $brand->brand_image;
        $brand->delete();

        return redirect()->back()->with('success', 'Brand removed!');

    }
}
