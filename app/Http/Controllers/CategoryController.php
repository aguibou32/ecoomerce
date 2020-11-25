<?php

namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::latest()->get();
        $categories = Category::latest()->paginate(5);
        $trashedCategoryFiles = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index')->with('categories', $categories)
                                           ->with('trashedCategoryFiles', $trashedCategoryFiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $validatedData = $request->validate([
            'category_name' => ['required', 'max:255', 'unique:categories'],
        ]);

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->category_name = $request->category_name;

        $category->save();

        return redirect()->back()->with('success', 'Category added successfully');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $category = Category::findOrFail($id);

        // return $category;
        return view('admin.category.edit')->with('category', $category);
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
        $validatedData = $request->validate([
            'category_name' => ['required', 'max:255', 'unique:categories'],
        ]);

        $category = Category::findOrFail($id);

        // return $category;

        $category->user_id = Auth::user()->id;
        $category->category_name = $request->category_name;

        $category->update();

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
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
        $category = Category::findOrFail($id);

        $category->delete();
        return redirect()->back()->with('success', 'category moved to trash !');

    }

    public function moveAllCategoriesToBin(){

        $categories =  Category::all();

        foreach($categories as $category){
            $category->delete();
        }
        return redirect()->back();
    }


    public function restoreCategory($id){
        
        $category = Category::withTrashed()->findOrFail($id);

        $category->deleted_at = null;

        $category->save();
        return redirect()->back()->with('success', 'category restored !');

    }

    

    public function deleteCategoryPermanently($id){

        $category = Category::onlyTrashed()->findOrFail($id);
        // return $category;

        $category->forceDelete();

        return redirect()->back()->with('success', 'category permanently deleted !');

    }

    public function deleteAllCategoryPermanently(){

        $categories =  Category::onlyTrashed()->get();

        foreach($categories as $category){
            $category->forceDelete();
        }
        return redirect()->back();
    }

    public function restoreAllCategories(){

        $categories =  Category::onlyTrashed()->get();

        foreach($categories as $category){
            $category->deleted_at = null;

            $category->save();
        }
        return redirect()->back();
    }
}
