<div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                             
                              <a class="nav-link" href="{{route('home')}}">ADMIN</a> 
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book"></i>
                                Quản lý danh mục
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route("Category.create")}}">Thêm danh mục</a></li>
                                <li><a class="dropdown-item" href="{{route("Category.index")}}">Liệt kê danh mục</a></li>
                                <li><hr class="dropdown-divider"></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book"></i>
                                Quản lý truyện
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route("Story.create")}}">Thêm truyện</a></li>
                                <li><a class="dropdown-item" href="{{route("Story.index")}}">Liệt kê truyện</a></li>
                                <li><hr class="dropdown-divider"></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-book"></i>
                                Quản lý chapter
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route("Chapter.create")}}">Thêm chapter</a></li>
                                <li><a class="dropdown-item" href="{{route("Chapter.index")}}">Liệt kê chapter</a></li>
                                <li><hr class="dropdown-divider"></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book"></i>
                                Quản lý thể loại
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route("Genre.create")}}">Thêm thể loại</a></li>
                                <li><a class="dropdown-item" href="{{route("Genre.index")}}">Liệt kê thể loại</a></li>
                                <li><hr class="dropdown-divider"></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-book"></i>
                                Quản lý User
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route("User.index")}}">Liệt kê User</a></li>
                                <li><hr class="dropdown-divider"></li>
                              </ul>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">About</a>
                            </li>
                            <!-- Add more menu items as needed -->
                          </ul>
                          <form class="d-flex ms-auto">
                              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                              <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                      </div>
                    </nav>              
</div>
