<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



 
class IndexController extends Controller
{
    
    public function home(){
        $genres = Genre::all(); // Lấy tất cả các thể loại từ cơ sở dữ liệu
        $genre = Genre::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $story = Story::orderBy('id','DESC')->where('status',1)->get();
        return view('pages.home')->with(compact('category','story','genre','genres'));
    }
    public function category($slug){
        $genres = Genre::all();
        $genre = Genre::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $cate_id = Category::where('slug_cate',$slug)->first();    
        $category_name =$cate_id->Category_name;
        $story = Story::orderBy('id','DESC')->where('status',1)->where('category_id',$cate_id->id)->get();
        return view ('pages.category')->with(compact('category','story','category_name','genre','genres'));
    }
    public function genre($slug){
        $genres = Genre::all();
        $genre = Genre::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();
        $genre_id = Genre::where('slug_genre',$slug)->first();    
        $genre_name =$genre_id->genre_name;
        $story = Story::orderBy('id','DESC')->where('status',1)->where('genre_id',$genre_id->id)->get();
        return view ('pages.genre')->with(compact('category','story','genre_name','genre','genres'));
    }
    public function story($slug){
        $genres = Genre::all();
        $likes = User::all();
        $genre = Genre::orderBy('id','DESC')->get();
        
        $category = Category::orderBy('id','DESC')->get();
        $story = Story::with('category','genre')->where('slug_story',$slug)->where('status',1)->first();
        $story->views++;
        $story->save();

        $favoriteStories = auth()->user()->likes()->get();


        $chapter = Chapter::with('story')->orderBy('id','DESC')->where('story_id',$story->id)->get();
        //chapter dau tien
        $chapter_dau = Chapter::with('story')->orderBy('id','ASC')->where('story_id',$story->id)->first();
        //chapter moi
        $chapter_moi = Chapter::with('story')->orderBy('id','DESC')->where('story_id',$story->id)->first();
        //truyen cung danh muc
        $sto_in_cate = Story::with('category','genre')->where('category_id',$story->category->id)->whereNotIn('id',[$story->id])->get();

        return view ('pages.story')->with(compact('category','story','chapter','sto_in_cate','chapter_dau','genre','chapter_moi','genres','favoriteStories'));
    }
    public function xemchapter($slug){
        $genres = Genre::all();
        $genre = Genre::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();

        $story = Chapter::where('slug_chapter', $slug) ->first();
        //breadcrumb
        $story_breadcrumb = Story::with('category','genre')->where('id',$story->story_id)->first();

        $chapter = Chapter::with('story')->where('slug_chapter',$slug)->where('story_id',$story->story_id)->first();

        $all_chapter= Chapter::with('story')->orderBy('id','ASC')->where('story_id',$story->story_id)->get();

        $next_chapter = Chapter :: where('story_id',$story->story_id)->where('id','>',$chapter->id)->min('slug_chapter');

        $max_id = Chapter :: where('story_id',$story->story_id)->orderBy('id','DESC')->first();
        $min_id = Chapter :: where('story_id',$story->story_id)->orderBy('id','ASC')->first();

        $pre_chapter = Chapter :: where('story_id',$story->story_id)->where('id','<',$chapter->id)->max('slug_chapter');
        return view ('pages.chapter')->with(compact('category','chapter','story','all_chapter'
        ,'next_chapter','pre_chapter','max_id','min_id','genre','story_breadcrumb','genres'));
    }
    public function timkiem()
    {
        $genres = Genre::all();
        $genre = Genre::orderBy('id','DESC')->get();
        $category = Category::orderBy('id','DESC')->get();

        $tukhoa = $_GET['tukhoa'];
        $story = Story :: with('category','genre')->where('Story_name','LIKE','%'.$tukhoa.'%')->orWhere('author','LIKE','%'.$tukhoa.'%')->
        orWhere('summary','LIKE','%'.$tukhoa.'%')->get();
        return view ('pages.search')->with(compact('category','genre','story','tukhoa'));
    }
    //tim kiem vip pro
    public function timkiem_ajax(Request $request){
        $data = $request->all();
        if($data['keywords']){
            $story = Story::where('status',1)->where('Story_name','LIKE','%'.$data['keywords'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display:block;padding: 10px">';
            foreach($story as $key => $sto){
                $output .= '<li class="li_search_ajax" style="margin-top: 10px; margin-bottom: 10px">
                <a href="'.url('story/'.$sto->slug_story).'" style="color: #000; text-transform: uppercase">'.$sto->story_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function tag($tag){
        $category = Category::orderBy('id','DESC')->get();
        $genres = Genre::all();
        $genre = Genre::orderBy('id','DESC')->get();
        $tags = explode("-", $tag);
        $story = Story::where(
            function ($query) use($tags) {
                for ($i = 0; $i < count($tags); $i++) {
                    $query->orwhere('tu_khoa', 'LIKE', '%'. $tags[$i] .'%');
                }
            }
        )->paginate(10);
        return view('pages.tag')->with(compact('genre','story','tag','category'));
    }
    public function showFavoriteStories()
    {
        $user = auth()->user();

        if (!$user) {
            // Xử lý khi không có người dùng đăng nhập
        }

        $favoriteStories = $user->likes()->get();

        return view('pages.favorite_stories')->with(compact('favoriteStories'));
    }
    public function theodoi($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('status', 'Register or Login now !!');
        } else {
            $user = User::find(Auth::user()->id);
            $user->likes()->attach($id);
            return redirect()->back()->with('status', 'Followed books success !!');
        }
    }

    // Bo theo doi truyen sach
    public function botheodoi($id)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('status', 'Register or Login now !!');
        } else {
            $user = User::find(Auth::user()->id);
            $user->likes()->detach($id);
            return redirect()->back()->with('status', 'Unfollowed books success !!');
        }
    }
}
