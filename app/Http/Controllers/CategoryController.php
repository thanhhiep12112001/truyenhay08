<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category = Category::orderBy('id','DESC')->get(); 
        return view('adminnn.category.index')->with(compact('Category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminnn.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'Category_name' =>'required|unique:Category|max:255',
            'Slug_cate' =>'required|unique:Category|max:255',
            
            'Desc_cate' =>'required|max:255',
            'Status'=>'required',
        ],
        [
            'Category_name.unique'=>'Tên danh mục đã có xin điền tên khác',
            'Slug_cate.unique'=>'Slug danh mục đã có xin điền slug khác',
            'Category_name.required'=>'Phải điền tên danh mục',
            'Desc_cate.required'=>'Phải điền mô tả',
            'Slug_cate.required'=>'Phải điền slug danh mục',
        ]
    );
            $category= new Category ();
            $category->Category_name=$data['Category_name'];
            $category->Slug_cate=$data['Slug_cate'];
            $category->Desc_cate=$data['Desc_cate'];
            $category->Status=$data['Status'];
            
            $category->save();
            return redirect()->back()->with('status','Thêm danh mục thành công');
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
        $Category = Category::find($id); 
        return view('adminnn.category.edit')->with(compact('Category'));
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
        $data = $request->validate([
            'Category_name' =>'required|unique:Category|max:255',
            'Slug_cate' =>'required|unique:Category|max:255',
            'Desc_cate' =>'required|max:255',
            'Status'=>'required',
        ],
        [
            'Category_name.unique'=>'Tên danh mục đã có xin điền tên khác',
            'Slug_cate.unique'=>'Slug danh mục đã có xin điền slug khác',
            'Category_name.required'=>'Phải điền tên danh mục',
            'Desc_cate.required'=>'Phải điền mô tả',
            'Slug_cate.required'=>'Phải điền slug danh mục',
        ]
    );
            $category= Category::find($id);

            $category->Category_name=$data['Category_name'];
            $category->Slug_cate=$data['Slug_cate'];
            $category->Desc_cate=$data['Desc_cate'];
            $category->Status=$data['Status'];
            
            $category->save();
            return redirect()->back()->with('status','Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::find($id);
        $category->delete();
        return redirect()->back()->with('status','Xóa danh mục thành công');
    }
}
