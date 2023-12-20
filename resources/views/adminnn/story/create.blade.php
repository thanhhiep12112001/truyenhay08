@extends('layouts.app')
@section('content')


@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> THÊM TRUYỆN  </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{route('Story.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tên truyện </label>
                          <input type="text" class="form-control" value="{{old('story_name')}}" onkeyup="ChangeToSlug();" name="story_name" id="slug" aria-describedby="emailHelp" placeholder="Tên truyện">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug truyện</label>
                            <input type="text" class="form-control" value="{{old('slug_story')}}" name="slug_story" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug truyện">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Tác giả </label>
                            <input type="text" class="form-control" value="{{old('author')}}" name="author" id="slug" aria-describedby="emailHelp" placeholder="Tên tác giả">
                          </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tóm tắt</label>
                            <textarea class="form-control" name="summary" rows="5" style="resize: none"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Từ khóa </label>
                            <input type="text" class="form-control" value="{{old('tu_khoa')}}" name="tu_khoa" id="slug" aria-describedby="emailHelp" placeholder="Từ khóa">
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Danh mục truyện</label>
                            <select name="Category" class="custom-select">
                            @foreach ($Category as $key => $cate)
                              <option value="{{$cate->id}}">{{$cate->Category_name}}</option>
                            @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Thể loại truyện</label><br>
                              @foreach ($Genre as $key => $gen)
                              <input class="form-check-input" type="checkbox" name="Genre[]" value="{{$gen->id}}" id="genre_{{$gen->id}}">
                              <label class="form-check-label" for="genre_{{$gen->id}}">
                                {{$gen->genre_name}}
                              </label>
                              @endforeach
                            </div>
                           
                        

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh truyện</label>
                            <input type="file" class="form-control-file" name="photo">
                          </div>      


                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select name="Status" class="form-control">
                              <option value="1">Kích hoạt</option>
                              <option value="0">Không kích hoạt</option>
                            </select>
                          </div>
                          
                            <hr>
                            <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>   
                      </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
