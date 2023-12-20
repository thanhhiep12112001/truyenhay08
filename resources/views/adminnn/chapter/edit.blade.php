@extends('layouts.app')
@section('content')


@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> UPDATE CHAPTER TRUYỆN </div>
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

                        <form method="POST" action="{{route('Chapter.update',[$Chapter->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tên chapter</label>
                          <input type="text" class="form-control" value="{{$Chapter ->chapter_name}}" onkeyup="ChangeToSlug();" name="chapter_name" id="slug" aria-describedby="emailHelp" placeholder="Tên chapter">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug chapter</label>
                            <input type="text" class="form-control" value="{{$Chapter ->slug_chapter}}" name="slug_chapter" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug chapter">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" class="form-control" value="{{$Chapter->mo_ta}}" name="mo_ta" aria-describedby="emailHelp" placeholder="mo_ta">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung</label>
                            <textarea class="form-control" id="noidung_chuong" name="chapter_content" rows="5" style="resize: none">{{$Chapter->chapter_content}}</textarea>
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Danh mục truyện</label>
                            <select name="story_id" class="custom-select">
                            @foreach ($Story as $key => $sto)
                            <option {{$Chapter->story_id==$sto->id ? 'selected' : ''}} value="{{$sto->id}}">{{$sto->story_name}}</option>
                            @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select name="Status" class="form-control">
                                @if($Chapter->Status==1)
                              <option selected value="1">Kích hoạt</option>
                              <option value="0">Không kích hoạt</option>
                              @else
                              <option value="1">Kích hoạt</option>
                              <option selected value="0">Không kích hoạt</option>
                              @endif
                            </select>
                          </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Update</button>   
                      </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
