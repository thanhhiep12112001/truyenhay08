@extends('../layout')
@section('content')

<div class="container">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url('category/' . $story->category->Slug_Cate) }}">{{ $story->category->Category_name }}</a></li>
        <li class="breadcrumb-item active"aria-current="page">{{$story->story_name}}</li>
    </ol>
</nav>
</div>
<div class="container mt-4">
 <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="row g-0">
                  <div class="col-md-3">
                      <img src="{{ asset('public/uploads/story/' . $story->photo) }}" class="img-fluid rounded-start" alt="Comic Image" style="max-width: 100%; height: 300px;object-fit: cover;">
                  </div>
                  <div class="col-md-6">
                      <div class="card-body">
                          <h1 class="card-title display-4">{!! $story->story_name !!}
                          <h2>Mô tả:</h2>
                          <p class="card-text">{!! $story->summary !!}</p>
                          <h2>Thông tin truyện:</h2>
                          <ul class="list-unstyled">
                              <li><strong>Tác giả:</strong> {{ $story->author }}</li>
                              <li><strong>Danh mục truyện:</strong> <a href="{{ url('category/' . $story->category->Slug_Cate) }}">{{ $story->category->Category_name }}</a></li>
                              <li><strong>Thể loại truyện:</strong>
                                @foreach ($story->genres as $genre)
                                    <a href="{{ url('genre/' . $genre->slug_genre) }}">{{ $genre->genre_name }}</a>
                                    @if (!$loop->last), @endif
                                @endforeach
                            </li>
                            
                              <li><strong>Năm phát hành:</strong> Năm</li>
                              <li>Số lượt xem: {{$story->views}}</li>
                              <div class="col-md-auto">
                                @php
                                    if (\Illuminate\Support\Facades\Auth::check())
                                        {
                                            $theodoi=\Illuminate\Support\Facades\DB::table('likes')->where('id_user','=',\Illuminate\Support\Facades\Auth::user()->id)
                                            ->where('story_id','=',$story->id)->get();
                                            $count=$theodoi->count();

                                        }
                                    $likes=\Illuminate\Support\Facades\DB::table('likes')->where('story_id',$story->id)->get();
                                    $countlikes=$likes->count();
                                @endphp
                                @guest
                                    <form action="{{route('theodoi',$story->id)}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">
                                            <i class="far fa-heart"></i></i> Lượt yêu thích {{$countlikes}}
                                        </button>
                                    </form>
                                @else
                                    @if($count>0)
                                        <form action="{{route('botheodoi',$story->id)}}" method="post"
                                              enctype="multipart/form-data">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success">
                                                <i class="fas fa-heart"></i> Bỏ yêu thích</i></button>
                                        </form>

                                    @else
                                        <form action="{{route('theodoi',$story->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-success"><i
                                                    class="bi bi-bookmark-heart"></i> Lượt yêu thích {{$countlikes}}
                                            </button>
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                              @if($chapter_dau)
                              <li><a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Xem ngay</a></li>
                                @else
                                <li><a class="btn btn-danger">Chưa cập nhật chương</a></li>
                                @endif
                                <li><a href="{{url('xem-chapter/'.$chapter_moi->slug_chapter)}}" class="btn btn-success">Xem Chương mới nhất</a></li>
                            </ul>
                          <!-- Đưa "Mục lục" vào card-body -->
                          <h4>Mục lục</h4>
                          <ul class="muc_luc_truyen">
                            @php
                                $mucluc = count($chapter);
                            @endphp
                            @if($mucluc>0)
                              @foreach ($chapter as $chap)
                                  <li><a href="{{ url('xem-chapter/'. $chap->slug_chapter) }}">{{ $chap->chapter_name }}</a></li>
                              @endforeach
                                  
                              @else
                                  <li>Đang cập nhật...</li>
                              @endif
                          </ul>
                          <div class="fb-comments" data-href="http://localhost/laravel/truyenhay08/story/dau-la-dai-luc" data-width="" data-numposts="5"></div>
                          <h6 style="margin-top: 10px">Từ khóa tìm kiếm: </h6>
                          @php
                          $tu_khoa = explode(",", $story->tu_khoa);
                          @endphp
                          <div class="tagcloud05">
                            <ul>
                              @foreach($tu_khoa as $key => $tu)
                              <li><a href="{{url('tag/'.\Str::slug($tu))}}"><span>{{$tu}}</span></a></li>
                              @endforeach
                            </ul>
                          <h4>Truyện cùng danh mục</h4>
                          <div class="row">

                            @foreach ($sto_in_cate as $key => $story)
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top story-image" src="{{ asset('public/uploads/story/' . $story->photo) }}" alt="Story Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $story->story_name }}</h5>
                                            <p class="card-text">{{ $story->summary }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ url('story/' . $story->slug_story) }}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                                    <a class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>{{ $story->views }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <h4>Truyện yêu thích</h4>
                          <div class="row">

                            @foreach($favoriteStories as $sto)
                                <div class="col-md-4">
                                    <div class="card mb-4 box-shadow">
                                        <img class="card-img-top story-image" src="{{ asset('public/uploads/story/' . $sto->photo) }}" alt="Story Image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $sto->story_name }}</h5>
                                            <p class="card-text">{{ $sto->summary }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ url('story/' . $sto->slug_story) }}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                                    <a class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>{{ $sto->views }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div></div>
@endsection


<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
    }

    .comic-container {
        max-width: 800px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        display: flex;
        /* Sử dụng flexbox để chia cột */
    }

    .comic-image {
        max-width: 100%;
        display: block;
        border-radius: 8px 0 0 8px;
        /* Bo góc bên trái */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .comic-details {
        padding: 30px;
        box-sizing: border-box;
        flex: 1;
        /* Cột nội dung tự mở rộng */
    }

    h1 {
        color: #333;
        text-align: center;
    }

    h2 {
        color: #444;
        margin-bottom: 10px;
    }

    p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin-bottom: 20px;
    }

    li {
        margin-bottom: 8px;
    }
    .tagcloud05 ul {
	margin: 0;
	padding: 0;
	list-style: none;
}
.tagcloud05 ul li {
	display: inline-block;
	margin: 0 0 .3em 1em;
	padding: 0;
}
.tagcloud05 ul li a {
	position: relative;
	display: inline-block;
	height: 30px;
	line-height: 30px;
	padding: 0 1em;
	background-color: #3498db;
	border-radius: 0 3px 3px 0;
	color: #fff;
	font-size: 13px;
	text-decoration: none;
	-webkit-transition: .2s;
	transition: .2s;
}
.tagcloud05 ul li a::before {
	position: absolute;
	top: 0;
	left: -15px;
	content: '';
	width: 0;
	height: 0;
	border-color: transparent #3498db transparent transparent;
	border-style: solid;
	border-width: 15px 15px 15px 0;
	-webkit-transition: .2s;
	transition: .2s;
}
.tagcloud05 ul li a::after {
	position: absolute;
	top: 50%;
	left: 0;
	z-index: 2;
	display: block;
	content: '';
	width: 6px;
	height: 6px;
	margin-top: -3px;
	background-color: #fff;
	border-radius: 100%;
}
.tagcloud05 ul li span {
	display: block;
	max-width: 100px;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
}
.tagcloud05 ul li a:hover {
	background-color: #555;
	color: #fff;
}
.tagcloud05 ul li a:hover::before {
	border-right-color: #555;
}
.breadcrumb-item {
    font-size: 16px;
}
.breadcrumb-item a {
    text-decoration: none;
    color: #337ab7;
}
.breadcrumb-item.active {
    color: #555;
}
.card {
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.card-body {
    padding: 30px;
}
.card-title {
    font-size: 28px;
    font-weight: bold;
}
.card-text {
    font-size: 18px;
    color: #555;
}
.card-img-top {
    border-radius: 5px 0 0 5px;
    height: 100%;
    width: 100%;
}

/* Kiểu cho nút "Đọc ngay" */
.btn-outline-secondary {
    color: #337ab7;
    border-color: #337ab7;
}
.btn-outline-secondary:hover {
    color: #fff;
    background-color: #337ab7;
}

/* Điều chỉnh kích thước container */
.container {
    max-width: 1200px;
    margin: 0 auto;
}

/* Kiểu cho danh sách "Mục lục" */
.muc_luc_truyen {
    list-style: none;
    padding-left: 0;
}
.muc_luc_truyen li {
    margin-bottom: 8px;
}
.muc_luc_truyen a {
    color: #337ab7;
    text-decoration: none;
}
.muc_luc_truyen a:hover {
    text-decoration: underline;
}
.story-image {
    width: 100%;
    height: auto;
    object-fit: cover;
}
</style>
