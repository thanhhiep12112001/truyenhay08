<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Story;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Chapter = Chapter::with('Story')->orderBy('id','DESC')->get();
        return view('adminnn.chapter.index')->with(compact("Chapter"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Story = Story::orderBy('id','DESC')->get();
        return view('adminnn.chapter.create')->with(compact("Story"));
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
            'chapter_name' =>'required|unique:Chapter|max:255',
            'slug_chapter' =>'required|unique:Chapter|max:255',
            'story_id'=> 'required',
            'mo_ta'=> 'required',
            'chapter_content'=> 'required',
            'status'=>'required',
        ],
        [
            'chapter_name.unique'=>'Tên chapter đã có xin điền tên khác',
            'slug_chapter.unique'=>'Slug chapter đã có xin điền slug khác',
            'chapter_name.required'=>'Phải điền tên chapter',
            'mo_ta.required'=>'Phải điền mô tả chapter',
            'chapter_content.required'=>'Phải điền nội dung',
            'slug_chapter.required'=>'Phải điền slug chapter',
        ]
    );
            $chapter= new Chapter ();
            $chapter->chapter_name=$data['chapter_name'];
            $chapter->slug_chapter=$data['slug_chapter'];
            $chapter->mo_ta=$data['mo_ta'];
            $chapter->chapter_content=$data['chapter_content'];
            $chapter->story_id=$data['story_id'];
            $chapter->status=$data['status'];
            
            $chapter->save();
            return redirect()->back()->with('status','Thêm chapter thành công');
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
        $Chapter = Chapter::find($id);
        $Story = Story::orderBy('id','DESC')->get();
        return view('adminnn.chapter.edit')->with(compact('Story','Chapter'));
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
            'chapter_name' =>'required|unique:Chapter|max:255',
            'slug_chapter' =>'required|unique:Chapter|max:255',
            'story_id'=> 'required',
            'mo_ta'=> 'required',
            'chapter_content'=> 'required',
            'status'=>'required',
        ],
        [
            'chapter_name.unique'=>'Tên chapter đã có xin điền tên khác',
            'slug_chapter.unique'=>'Slug chapter đã có xin điền slug khác',
            'chapter_name.required'=>'Phải điền tên chapter',
            'mo_ta.required'=>'Phải điền mô tả chapter',
            'chapter_content.required'=>'Phải điền nội dung',
            'slug_chapter.required'=>'Phải điền slug chapter',
        ]
    );
            $chapter= Chapter::find($id);
            $chapter->chapter_name=$data['chapter_name'];
            $chapter->slug_chapter=$data['slug_chapter'];
            $chapter->mo_ta=$data['mo_ta'];
            $chapter->chapter_content=$data['chapter_content'];
            $chapter->story_id=$data['story_id'];
            $chapter->status=$data['status'];
            
            $chapter->save();
            return redirect()->back()->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }
}
