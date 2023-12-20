@extends('../layout')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('category/' . $story_breadcrumb->category->Slug_Cate) }}">{{ $story_breadcrumb->category->Category_name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('genre/' . $story_breadcrumb->genre->slug_genre) }}">{{ $story_breadcrumb->genre->genre_name }}</a></li>
            <li class="breadcrumb-item active"aria-current="page">{{$story_breadcrumb->story_name}}</li>
        </ol>
    </nav>
    </div>
<div class="row">
    <div class="col-md-12">        
        <h4 style="text-align:center;">{{ $chapter->story->story_name }}</h4>
        <p style="text-align:center;">Chương hiện tại :{{$chapter->chapter_name}} </p>
        <div class="row p-3">
            <style type="text/css">
            .isDisabled {
                color: currentColor;
                pointer-events: none;
                opacity: 0.5;
                text-decoration: none;
            }
            </style>
            <div class="d-flex justify-content-evenly">
                <div>
                    <a href="{{url('xem-chapter/'.$pre_chapter)}}" class="btn btn-success {{$chapter->id==$min_id->id ? 'disabled' : ''}}">
                      <i class="fa fa-arrow-left" style="margin-right: 10px" aria-hidden="true"></i>Chương trước </a>
                  </div>
                <div>
                    <select class="form-select select-chuong" aria-label="Default select example">
                        <option selected>Chọn chương</option>
                    @foreach($all_chapter as $key =>$chap)
                    <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->chapter_name}}</option>
                    @endforeach
                </select>
                </div>
                <div>
                    <a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-success {{$chapter->id==$max_id->id ? 'disabled' : ''}}">Chương tiếp
                       <i class="fa fa-arrow-right" style="margin-left: 10px" aria-hidden="true"></i>
                    </a>
                  </div>
            </div>
        </div>
        <div class="content_chapter">
            {!!$chapter->chapter_content!!}
            <div class="d-flex justify-content-evenly">
                <div>
                    <a href="{{url('xem-chapter/'.$pre_chapter)}}" class="btn btn-success {{$chapter->id==$min_id->id ? 'disabled' : ''}}">
                      <i class="fa fa-arrow-left" style="margin-right: 10px" aria-hidden="true"></i>Chương trước </a>
                  </div>
                <div>
                    <select class="form-select select-chuong" aria-label="Default select example">
                        <option selected>Chọn chương</option>
                    @foreach($all_chapter as $key =>$chap)
                    <option value="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->chapter_name}}</option>
                    @endforeach
                </select>
                </div>
                <div>
                    <a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-success {{$chapter->id==$max_id->id ? 'disabled' : ''}}">Chương tiếp
                       <i class="fa fa-arrow-right" style="margin-left: 10px" aria-hidden="true"></i>
                    </a>
                  </div>
            </div>


@endsection