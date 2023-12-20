<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Link to Font Awesome (if used) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style type="text/css">
        {
            .switch_color {
                background: #181818;
                color: #fff;
            }
        }
    </style>
    <title>Truyện hay 08</title>
</head>

<body style="background-color: #ddd; overflow-x: hidden;">
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand navbar-brand-custom" href="{{ url('/') }}"><i class="far fa-house"></i>Truyện
                Hay 08</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown menu Danh mục truyện -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDanhMuc" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-book"></i>
                            Danh mục truyện
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownDanhMuc">
                            @foreach ($category as $key => $cate)
                                <li><a class="dropdown-item"
                                        href="{{ url('category/' . $cate->Slug_cate) }}">{{ $cate->Category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Dropdown menu Thể loại truyện -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTheLoai" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-book"></i>
                            Thể loại truyện
                        </a>    
                        @if ($genres && !$genres->isEmpty())
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownDanhMuc">
                                @foreach ($genres as $genre)
                                    <li>
                                        <a class="dropdown-item" href="{{ url('genre/' . $genre->slug_genre) }}">
                                            {{ $genre->genre_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                </ul>

                <!-- Search form -->
                <form autocomplete="off" class="d-block" method="GET" action="{{ url('tim-kiem/') }}">
                    @csrf
                    <div class="d-flex">
                        <input class="form-control" id="keywords" name="tukhoa" type="search"
                            placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-warning text-light" style="margin-left: 10px" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div id="search_ajax" style="margin-top: 10px"></div>
                </form>
                <select class="custom-select mr-sm-2" id="switch_color">
                    <option value="xam">Xám</option>
                    <option value="den">Đen</option>
                </select>

                <!-- User dropdown -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle navbar-link-custom" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"
                                style="margin-right: 5px"></i>{{ Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-secondary" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" style="margin-right: 10px" aria-hidden="true"></i>Đăng
                                    xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li>
                                <a class="dropdown-item {{ Auth::user()->is_admin != 1 ? 'd-none' : '' }}"
                                    href="{{ route('home') }}">
                                    <i class="fa fa-cogs" style="margin-right: 10px" aria-hidden="true"></i>Quản lý
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('favorite.stories') }}" class="btn btn-primary">
                                    Danh sách yêu thích
                                </a>                                
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Your slide-welcome -->
    <div class="welcome text-center py-4" style="background-color: #fff;">
        <p class="marquee mb-0">
            <i class="fa fa-truck" aria-hidden="true" style="margin-right: 10px"></i>Đọc truyện online, đọc
            truyện
            chữ, truyện full, truyện hay. Tổng hợp đầy đủ và cập nhật liên tục.
            <i class="fa fa-heartbeat" aria-hidden="true" style="margin-left: 10px"></i>
        </p>
    </div>

    <!-- Link to Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom JavaScript -->
    <script>
        // Your custom JavaScript code
    </script>
</body>

{{-- </html> --}}
<div style="margin-top: 15px">
    <!-- Slider -->
    @yield('slide')
    <!-- Truyện mới -->
    @yield('content')
    <!-- footer -->
    <hr />
    <!-- Đoạn mã HTML -->
    <footer class="footer">
        <div class="container">
            <p>Đây là nội dung footer của bạn.</p>
            <a href="#" class="btn btn-primary btn-sm mb-3" id="back-to-top-btn"><i class="fas fa-arrow-up"></i></a>
        </div>
    </footer>
    <script>
        document.getElementById('back-to-top-btn').addEventListener('click', function(event) {
            event.preventDefault();

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>



</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
{{-- <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script> --}}
<!-- tim kiem nang cao -->
<script type="text/javascript">
    $('#keywords').keyup(function() {
        var keywords = $(this).val();
        if (keywords != '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/timkiem-ajax') }}",
                method: "POST",
                data: {
                    keywords: keywords,
                    _token: _token
                },
                success: function(data) {
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        } else {
            $('#search_ajax').fadeOut();
        }
    });

    $(document).on('click', '.li_search_ajax', function() {
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut()
    });
</script>

<script type="text/javascript">
    $('.select-chapter').on('change', function() {
        var url = $(this).val();
        if (url) {
            window.location = url
        }
        return false;
    });

    current_chapter();

    function current_chapter() {
        var url = window.location.href;

        $('.select-chapter').find('option[value="' + url + '"]').attr("selected", true);
    }
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0"
    nonce="jCWYfRvJ"></script>
<script type="text/javascript">

</script>
<style>
    .welcome {
        background-color: #fff;
        overflow: hidden;
    }

    .welcome .marquee {
        display: inline-block;
        margin-bottom: 0;
        animation: marquee 20s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .bg-title:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }

    .bg-title {
        position: relative;
        cursor: pointer;
        border: 3px solid #000;
        border-image: url("data:image/svg+xml;charset=utf-8,%3Csvg width='100' height='100' viewBox='0 0 100 100' fill='none' xmlns='http://www.w3.org/2000/svg'%3E %3Cstyle%3Epath%7Banimation:stroke 5s infinite linear%3B%7D%40keyframes stroke%7Bto%7Bstroke-dashoffset:776%3B%7D%7D%3C/style%3E%3ClinearGradient id='g' x1='0%25' y1='0%25' x2='0%25' y2='100%25'%3E%3Cstop offset='0%25' stop-color='%232d3561' /%3E%3Cstop offset='25%25' stop-color='%23c05c7e' /%3E%3Cstop offset='50%25' stop-color='%23f3826f' /%3E%3Cstop offset='100%25' stop-color='%23ffb961' /%3E%3C/linearGradient%3E %3Cpath d='M1.5 1.5 l97 0l0 97l-97 0 l0 -97' stroke-linecap='square' stroke='url(%23g)' stroke-width='3' stroke-dasharray='388'/%3E %3C/svg%3E") 1;
    }

    .bg-title img {
        height: 185px;
        z-index: 1;
    }

    .bg-title .content {
        position: absolute;
        bottom: 0;
        left: 0;
        background-color: rgba(0, 35, 82, 0.7);
        z-index: 999;
        width: 100%;
        color: #fff;
    }

    .col-content {
        cursor: pointer;
    }

    .image-hover {
        border: 3px solid orange;
        height: 195px;
    }

    .image-hover:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }

    .bread_style {
        padding: 10px;
        border-radius: 5px;
    }

    .bread_style li a {
        text-decoration: none;
    }

    /* Style for the pagination links */
    .pagination {
        display: flex;
        justify-content: center;

    }

    .pagination li {
        display: inline-block;
        margin-right: 10px;
        font-size: 16px;
    }

    .pagination li a {
        display: block;
        background-color: #f5f5f5;
        color: #333;
        border-radius: 5px;
    }

    .pagination li a:hover {
        background-color: #333;
        color: #fff;
    }

    .pagination .active a {
        background-color: #333;
        color: #fff;
    }

    .page-link.active,
    .active>.page-link {
        border-radius: 5px;
    }

    .navbar-custom {
        background-color: #f8f9fa;
        /* Custom navbar background color */
    }

    .navbar-brand-custom {
        color: #343a40;
        /* Custom brand text color */
        font-weight: bold;
    }

    .navbar-nav .dropdown-menu {
        background-color: #fff;
        /* Màu nền cho dropdown menu */
        border: none;
        /* Loại bỏ viền */
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        /* Hiệu ứng bóng đổ */
    }

    .navbar-nav .dropdown-menu a {
        color: #000;
        /* Màu chữ cho các mục trong dropdown menu */
    }

    .navbar-nav .dropdown-menu a:hover {
        background-color: #f1f1f1;
        /* Màu nền khi hover chuột */
    }
</style>
