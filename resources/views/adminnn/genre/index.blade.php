@extends('layouts.app')
@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> LIST THỂ LOẠI TRUYENHAY08 </div>
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
                            <th scope="col">Tên thể loại</th>
                            <th scope="col">Slug_thể loại</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Status</th>
                            <th scope="col">Thao tác</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($Genre as $key => $gen)
                          <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$gen->genre_name}}</td>
                            <td>{{$gen->slug_genre}}</td>
                            <td>{{$gen->mo_ta}}</td>
                            <td>
                                @if($gen->status==1)
                                <span class="text text-success">Kích hoạt</span>
                                @else
                                <span class="text text-danger">Không kích hoạt</span>
                                @endif
                            </td>
                            <td>
                              <div class="d-flex">
                              <a href="{{route('Genre.edit',[$gen->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i>
                                <i class="fa fa-pencil"></i>
                              </a>
                              <form action="{{route('Genre.destroy',[$gen->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa thể này không');" class="btn btn-danger"><i class="fas fa-trash"></i>
                                  <i class="fa fa-trash-o"></i>
                                </button>
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
