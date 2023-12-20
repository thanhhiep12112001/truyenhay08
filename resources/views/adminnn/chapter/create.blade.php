@extends('layouts.app')
@section('content')


    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> THÊM CHAPTER TRUYỆN </div>
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

                        <form method="POST" action="{{ route('Chapter.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên chapter</label>
                                <input type="text" class="form-control" value="{{ old('chapter_name') }}"
                                    onkeyup="ChangeToSlug();" name="chapter_name" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên chapter">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug chapter</label>
                                <input type="text" class="form-control" value="{{ old('slug_chapter') }}"
                                    name="slug_chapter" id="convert_slug" aria-describedby="emailHelp"
                                    placeholder="Slug chapter">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả</label>
                                <input type="text" class="form-control" value="{{ old('mo_ta') }}" name="mo_ta"
                                    aria-describedby="emailHelp" placeholder="mo_ta">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nội dung</label>
                                <textarea name="chapter_content" id="noidung_chuong" class="form-control" value="{{old('chapter_content')}}"></textarea>
                              </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Danh sách truyện</label>
                                <select name="story_id" class="custom-select">
                                    @foreach ($Story as $key => $sto)
                                        @if(isset($sto->story_name))
                                            <option value="{{ $sto->id }}">{{ $sto->story_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
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
