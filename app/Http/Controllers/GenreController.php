<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Genre = Genre::orderBy('id','DESC')->get(); 
        return view('adminnn.genre.index')->with(compact('Genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminnn.genre.create');
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
            'genre_name' =>'required|unique:Genre|max:255',
            'slug_genre' =>'required|unique:Genre|max:255',
            
            'mo_ta' =>'required|max:255',
            'status'=>'required',
        ],
        [
            'genre_name.unique'=>'Tên thể loại đã có xin điền tên khác',
            'slug_genre.unique'=>'Slug thể loại đã có xin điền slug khác',
            'genre_name.required'=>'Phải điền tên thể loại',
            'mo_ta.required'=>'Phải điền mô tả',
            'slug_genre.required'=>'Phải điền slug thể loại',
        ]
    );
            $genre= new Genre ();
            $genre->genre_name=$data['genre_name'];
            $genre->slug_genre=$data['slug_genre'];
            $genre->mo_ta=$data['mo_ta'];
            $genre->status=$data['status'];
            
            $genre->save();
            return redirect()->back()->with('status','Thêm thể loại thành công');
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
        $Genre = Genre::find($id); 
        return view('adminnn.genre.edit')->with(compact('Genre'));
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
            'genre_name' =>'required|unique:Genre|max:255',
            'slug_genre' =>'required|unique:Genre|max:255',
            
            'mo_ta' =>'required|max:255',
            'status'=>'required',
        ],
        [
            'genre_name.unique'=>'Tên thể loại đã có xin điền tên khác',
            'slug_genre.unique'=>'Slug thể loại đã có xin điền slug khác',
            'genre_name.required'=>'Phải điền tên thể loại',
            'mo_ta.required'=>'Phải điền mô tả',
            'slug_genre.required'=>'Phải điền slug thể loại',
        ]
    );
            $genre= Genre :: find($id);
            $genre->genre_name=$data['genre_name'];
            $genre->slug_genre=$data['slug_genre'];
            $genre->mo_ta=$data['mo_ta'];
            $genre->status=$data['status'];
            
            $genre->save();
            return redirect()->back()->with('status','Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back()->with('status','Xóa thể loại thành công');
    }
}
