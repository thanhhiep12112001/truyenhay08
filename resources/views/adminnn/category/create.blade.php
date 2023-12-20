@extends('layouts.app')
@section('content')


@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> THÊM DANH MỤC TRUYỆN </div>
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

                        <form method="POST" action="{{route('Category.store')}}">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Tên danh mục</label>
                          <input type="text" class="form-control" value="{{old('Category_name')}}" onkeyup="ChangeToSlug();" name="Category_name" id="slug" aria-describedby="emailHelp" placeholder="Tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" class="form-control" value="{{old('Slug_Cate')}}" name="Slug_cate" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug danh mục">
                          </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <input type="text" class="form-control" value="{{old('Desc_cate')}}"  name="Desc_cate" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mô tả">
                          </div>

                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select name="Status" class="form-control">
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
