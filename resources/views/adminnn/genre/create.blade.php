@extends('layouts.app')
@section('content')


@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> THÊM THỂ LOẠI TRUYỆN </div>
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

                        <form method="POST" action="{{route('Genre.store')}}">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tên thể loại</label>
                          <input type="text" class="form-control" value="{{old('genre_name')}}" onkeyup="ChangeToSlug();" name="genre_name" id="slug" aria-describedby="emailHelp" placeholder="Tên thể loại">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug thể loại</label>
                            <input type="text" class="form-control" value="{{old('slug_genre')}}" name="slug_genre" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug thể loại">
                          </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" class="form-control" value="{{old('mo_ta')}}"  name="mo_ta" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mô tả">
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">status</label>
                            <select name="status" class="form-control">
                              <option value="1">Kích hoạt</option>
                              <option value="0">Không kích hoạt</option>
                            </select>
                          </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Thêm</button>   
                      </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
