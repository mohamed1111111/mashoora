<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use  App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['status' => 'Success', 'data' => $categories],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category=new Category();
        $file_extension=$request->image->getClientOriginalExtension();
        $file_name=time().''.rand().'.'.$file_extension;
        $path='images/categories';
        $request->image->move($path,$file_name);
        $category->color=$request->get('color');
        $category->name_ar=$request->get('name_ar');
        $category->name_en=$request->get('name_en');
        $category->parent_id=$request->get('parent_id');
        $category->state=$request->get('state');
        $category->image=$file_name;
        $category->save();
        return response()->json(['status' => 'Success', 'data' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json(['status' => 'Success', 'data' => $category]);
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
    public function update(CategoryRequest $request, $id)
    {

        $category = Category::find($id);
        if($request->hasFile('image')){
        $file_extension=$request->image->getClientOriginalExtension();
        $file_name=time().''.rand().'.'.$file_extension;
        $path='images/categories';
        $request->image->move($path,$file_name);
        $category->image=$file_name;

        }
        $category->color=$request->get('color');
        $category->name_ar=$request->get('name_ar');
        $category->name_en=$request->get('name_en');
        $category->state=$request->get('state');
        $category->save();

        return response()->json(['status' => 'Success', 'data' => $category]);

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
