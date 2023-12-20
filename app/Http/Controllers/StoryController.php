<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Story;
use App\Models\Genre;
use App\Models\story_genre;


class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Story = Story::with('Category', 'Genre')->orderBy('id', 'desc')->get();

        return view('adminnn.story.index')->with(compact('Story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Genre = Genre::orderBy('id', 'DESC')->get();

        $Category = Category::orderBy('id', 'DESC')->get();

        return view('adminnn.story.create')->with(compact('Category', 'Genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'story_name' => 'required|unique:Story|max:255',
                'slug_story' => 'required|unique:Story|max:255',
                'summary' => 'required',
                'tu_khoa'=>'required',
                'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,
            max_height=1000',
                'Category' => 'required',
                'Genre' => 'required',
                'Status' => 'required',
                'author' => 'required',
            ],
            [
                'story_name.unique' => 'Tên truyện đã có xin điền tên khác',
                'slug_story.unique' => 'Slug truyện đã có xin điền slug khác',
                'story_name.required' => 'Phải điền tên truyện',
                'author.required' => 'Phải điền tên tác giả',
                'photo.required' => 'Phải có hình ảnh',
                'summary.required' => 'Phải điền tóm tắt',
                'slug_story.required' => 'Phải điền slug truyện',
                'tu_khoa.required' => 'Phải điền từ khóa truyện',
            ]
        );
        $story = new Story();
        $story->story_name = $data['story_name'];
        $story->slug_story = $data['slug_story'];
        $story->author = $data['author'];
        $story->summary = $data['summary'];
        $story->tu_khoa = $data['tu_khoa'];
        $story->category_id = $data['Category'];
        $story->genre_id = $data['Genre'];
        foreach ($data['Genre'] as $key => $gen) {
            ($story->genre_id = $gen[0]);
        }
        //them anh
        $get_image = $request->photo;
        $path = 'public/uploads/story/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $story->photo = $new_image;
        $story->views = 0;
        $story->Status = $data['Status'];

        $story->save();

        $story->genres()->attach($data['Genre']);

        return redirect()->back()->with('status', 'Thêm truyện thành công');
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
        $Story = Story::find($id);
        $Genre = Genre::orderBy('id', 'DESC')->get();
        $genres = Genre::orderBy('id', 'DESC')->get();
        $Category = Category::orderBy('id', 'DESC')->get();
        return view('adminnn.story.edit')->with(compact('Story', 'Category', 'Genre', 'genres'));
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
        $data = $request->validate(
            [
                'story_name' => 'required|max:255',
                'slug_story' => 'required|max:255',
                'summary' => 'required',
                'tu_khoa'=>'required',
                // 'photo'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,
                // max_height=1000',
                'Category' => 'required',
                'Genre' => 'required|array',
                'Status' => 'required',
                'author' => 'required',
            ],
            [
                'story_name.required' => 'Phải điền tên truyện',
                'summary.required' => 'Phải điền tóm tắt',
                'slug_story.required' => 'Phải điền slug truyện',
                'author.required' => 'Phải điền tên tác giả',
                'tu_khoa.required' => 'Phải điền từ khóa truyện',
            ]
        );
        $story = Story::find($id);
        $story->story_name = $data['story_name'];
        $story->slug_story = $data['slug_story'];
        $story->author = $data['author'];
        $story->summary = $data['summary'];
        $story->tu_khoa = $data['tu_khoa'];
        $story->category_id = $data['Category'];
        $story->views = 0;
        $story->genre_id = $data['Genre'];

        foreach ($data['Genre'] as $key => $gen) {
            ($story->genre_id = $gen[0]);
        }
        //them anh
        $get_image = $request->photo;
        if ($get_image) {
            $path = 'public/uploads/story/' . $story->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/story/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $story->photo = $new_image;

            $story->Status = $data['Status'];
        }
        $story->save();
        $story->genres()->sync($data['Genre']); // Sử dụng sync để đồng bộ thể loại
        return redirect()->back()->with('status', 'Cập nhật  truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $story = Story::find($id);
            // Kiểm tra xem câu truyện có các chapter liên kết không
            if ($story->Chapter()->exists()) {
                // Nếu có chapter liên kết, không thực hiện việc xóa và thông báo lỗi hoặc thông báo cho người dùng
            return redirect()->back()->with('status', 'Truyện này có các chapter liên kết và không thể xóa.');
            }
            // Nếu không có chapter liên kết, thực hiện quá trình xóa
            $story->genres()->detach();
            $path = 'public/uploads/story/' . $story->photo;
            if (file_exists($path)) {
                unlink($path);
            }
            $story->delete();

            return redirect()->back()->with('status', 'Xóa truyện thành công');

    }
    
}
