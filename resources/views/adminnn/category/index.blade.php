@extends('layouts.app')
@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> LIST DANH MUC TRUYENHAY08 </div>
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
                            <th scope="col">Category_name</th>
                            <th scope="col">Slug_cate</th>
                            <th scope="col">Desc_cate</th>
                            <th scope="col">Status</th>
                            <th scope="col">Thao tác</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($Category as $key => $Cate)
                          <tr>
                            <th scope="row">{{$Cate-> id}}</th>
                            <td>{{$Cate-> Category_name}}</td>
                            <td>{{$Cate-> Slug_cate}}</td>
                            <td>{{$Cate-> Desc_cate}}</td>
                            <td>
                                @if($Cate-> Status==1)
                                <span class="text text-success">Kích hoạt</span>
                                @else
                                <span class="text text-danger">Không kích hoạt</span>
                                @endif
                            </td>
                            <td>
                              <div class="d-flex">
                              <a href="{{route('Category.edit',[$Cate->id])}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i>
                              </a>
                              <form action="{{route('Category.destroy',[$Cate->id])}}"method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không');" class="btn btn-danger"><i class="fas fa-trash"></i>
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
