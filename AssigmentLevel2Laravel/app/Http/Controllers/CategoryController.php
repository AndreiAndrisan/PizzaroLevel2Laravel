<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('/index');
    }

    public function showCategory($category)
    {   
        $found = false;
        $categories = Category::get()->all();
        foreach ($categories as $DBcategory) {
            if($category == $DBcategory->nume) {
                $found = true;
                break;
            }
        }
        if($found == false) {
            return redirect()->back();
        }
        return view('/index',['category'=>$category,]);
    }


    // Admin***********************************************************
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function indexAdmin()
    {
        return view('/admin/index');
    }

    /**
     * Show the form for creting the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('/admin/edit-category')->with('category', null);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('/admin/edit-category',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateCategory($request);
        Category::create($attributes);
        return redirect('/admin')->with('successful', 'Successful! Category '.$request->nume.' was created.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $attributes = $this->validateCategory($request,$category->id);
        $category->update($attributes);
        return redirect('/admin')->with('successful', 'Successful! Category '.$request->nume.' was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('successful', 'Successful! Category '.$category->nume.' was deleted.');
    }
    
    public function validateCategory(Request $request, $id = null)
    {
        return $request->validate([
            'nume' => 'required|max:30|unique:categorie,nume,'.$id,
            'clasa' => 'required|max:50', 
        ]);
    }
}
