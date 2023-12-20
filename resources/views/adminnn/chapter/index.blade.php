@extends('layouts.app')
@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> LIST CHAPTER TRUYENHAY08 </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif      
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên chapter</th>
                            <th scope="col">Slug_chapter</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Truyện</th>

                            <th scope="col">Status</th>
                            <th scope="col">Nội dung</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($Chapter as $key => $Chap)
                          <tr>
                            <th scope="row">{{$Chap-> id}}</th>
                            <td>{{$Chap-> chapter_name}}</td>
                            <td>{{$Chap-> slug_chapter}}</td>
                            <td>{{$Chap-> mo_ta}}</td>
                            <td>
                              @if($Chap->Story)
                                  {{$Chap->Story->story_name}}
                              @else
                                  Không có chapter...
                              @endif
                          </td>
                          
                            <td>
                                @if($Chap->status==1)
                                <span class="text text-success">Kích hoạt</span>
                                @else
                                <span class="text text-danger">Không kích hoạt</span>
                                @endif
                            </td>
                            <td>
                              <div class="d-flex">
                              <a href="{{route('Chapter.edit',[$Chap->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>

                              <form action="{{route('Chapter.destroy',[$Chap->id])}}"method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa chapter này không');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </form>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
