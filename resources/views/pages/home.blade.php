@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
    <!-- TRUYỆN MỚI CẬP NHẬT -->
    <!-- Link đến Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link đến Font Awesome (nếu bạn sử dụng thư viện này) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Link đến Bootstrap JavaScript (bao gồm Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container">
        <div style="margin-top: 30px">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px">
              <h6 style="font-weight: bold">TRUYỆN MỚI CẬP NHẬT <i class="fa fa-star" aria-hidden="true" style="margin-left: 10px"></i>
              </h6>
            </div>
        <div class="row">
            @foreach ($story as $key => $sto)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="image-container">
                            {{-- <img class="card-img-top story-image" --}}
                            <img class="image-hover"
                                src="{{ asset('public/uploads/story/' . $sto->photo) }}" alt="Story Image">
                            <div class="overlay">
                                <a href="{{ url('story/' . $sto->slug_story) }}" class="btn btn-sm btn-outline-light">Đọc
                                    ngay</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $sto->story_name }}</h5>
                            <div class="genres">
                                @foreach ($sto->genres as $genre)
                                    <span class="badge badge-primary">{{ $genre->genre_name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a class="btn btn-success" href="#">Xem thêm</a>
        </div>
    </div>

    <style>
.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: box-shadow 0.3s ease-in-out;
    overflow: hidden;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.image-container {
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.card:hover .overlay {
    opacity: 1;
}

.genres {
    margin-top: 10px;
}

.badge {
    margin-right: 5px;
    font-size: 0.8rem;
}


    </style>
@endsection
