@extends('../layout')
{{-- @section('slide')
    @include('pages.slide')
@endsection --}}
@section('content')
    <!-- TRUYỆN MỚI CẬP NHẬT -->
    <div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="pages">{{$tukhoa}}</li>
        </ol>
    </nav>
    </div>
    <div class="container">
        <div style="margin-top: 30px">
            <h6 style="font-weight: bold">Bạn tìm kiếm với từ khóa là : {{$tukhoa}}<i class="fa fa-star" aria-hidden="true"
                    style="margin-left: 10px"></i>
            </h6>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        @php
                            echo $count = count($story);    
                        @endphp
                        @if($count == 0)
                        <div class="col-md-12">
                        <div class="card mb-12 box-shadow">
                            <div class="card-body">
                            
                                <p>Truyện đang cập nhật...</p>
                            </div>
                        </div>
                        </div>
                        @else
                        @foreach ($story as $key => $sto)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="{{asset('public/uploads/story/'.$sto->photo)}}">
                                    <div class="card-body">
                                      <h5>{{$sto->story_name}}</h5>
                                        <p class="card-text">{{$sto->summary}}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{url('story/'.$sto->slug_story)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                                                <a class="btn btn-sm btn-outline-secondary"><i
                                                        class="fas fa-eye"></i>121121</a>
                                            </div>
                                            <small class="text-muted">9 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        <div>
                            <a class="btn btn-success" href=""> Xem thêm </a>
                      </div>
                    </div>
                </div>
            </div>
            <style>
                a {
                    text-decoration: none;
                }
            </style>
        @endsection
