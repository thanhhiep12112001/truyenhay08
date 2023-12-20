@extends('layouts.app')
@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> LIST STORY </div>
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
                            <th scope="col">Tên truyện</th>
                            <th scope="col">Slug truyện</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Danh mục truyện</th>
                            <th scope="col">Thể loại truyện</th>
                            <th scope="col">Từ khóa</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Trạng thái</th>
                            
                            {{-- <th scope="col">Thao tác</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($Story as $key => $Sto)
                          <tr>
                            <th scope="row">{{$Sto-> id}}</th>
                            <td>{{$Sto-> story_name}}</td>
                            <td>{{$Sto-> slug_story}}</td>
                            <td>{{$Sto-> author}}</td>
                            <td>{{$Sto-> summary}}</td>
                            <td>{{$Sto-> Category->Category_name}}</td>
                            
                            
                            <td>
                              @foreach($Sto->genres as $Genre)
                                  {{$Genre->genre_name}}
                                  @unless($loop->last)
                                      ,
                                  @endunless
                              @endforeach
                          </td>
                          <td>{{$Sto-> tu_khoa}}</td>
                            <td>
                                <img class="image-hover" src="{{asset('public/uploads/story/'.$Sto->photo)}}" height="150" width="130">
                            </td>
                            <td>
                                @if($Sto->Status==0)
                                <span class="text text-success">Kích hoạt</span>
                                @else
                                <span class="text text-danger">Không kích hoạt</span>
                                @endif
                            </td>
                            <td>
                              <div class="d-flex">
                              <a href="{{route('Story.edit',[$Sto->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                              <form action="{{route('Story.destroy',[$Sto->id])}}"method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa truyện này không');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
