<aside class="sidebar-left">
  <nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button
        type="button"
        class="navbar-toggle collapsed"
        data-toggle="collapse"
        data-target=".collapse"
        aria-expanded="false"
      >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <h1>
        <a class="navbar-brand" href="{{url('/home')}}"
          ><span class="fa fa-area-chart"></span> Admin<span
            class="dashboard_text"
            >Panel & Dashboard</span
          ></a
        >
      </h1>
    </div>
    <div
      class="collapse navbar-collapse"
      id="bs-example-navbar-collapse-1"
    >
      @php
        $segment = Request::segment(1);
      @endphp
      <ul class="sidebar-menu">
        <li class="header">DANH MỤC</li>
        <li class="treeview {{$segment == 'home' ? 'active' : ''}}">
          <a href="{{url('/home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview {{$segment == 'info' ? 'active' : ''}}">
          <a href="{{route('info.create')}}">
            <i class="fa-solid fa-circle-info"></i> <span>Thông Tin Website</span>
          </a>
        </li>
        <li class="treeview {{$segment == 'category' ? 'active' : ''}}">
          <a href="#">
            <i class="fa-solid fa-list-dropdown "></i>
            <span>Danh Mục</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{route('category.create')}}"
                ><i class="fa-solid fa-square-plus"></i> Thêm mới</a
              >
            </li>
            <li>
              <a href="{{route('category.index')}}"
                ><i class="fa-solid fa-list-ul"></i> Tất cả danh mục</a
              >
            </li>
          </ul>
        </li>

        <li class="treeview {{$segment == 'genre' ? 'active' : ''}}">
          <a href="#">
            <i class="fa-regular fa-list-tree "></i>
            <span>Thể Loại</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{route('genre.create')}}"
                ><i class="fa-solid fa-square-plus"></i> Thêm mới</a
              >
            </li>
            <li>
              <a href="{{route('genre.index')}}"
                ><i class="fa-solid fa-list-ul"></i> Tất cả thể loại</a
              >
            </li>
          </ul>
        </li>

        <li class="treeview {{$segment == 'country' ? 'active' : ''}}">
          <a href="#">
            <i class="fa-solid fa-earth-americas "></i>
            <span>Quốc Gia</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{route('country.create')}}"
                ><i class="fa-solid fa-square-plus"></i> Thêm mới</a
              >
            </li>
            <li>
              <a href="{{route('country.index')}}"
                ><i class="fa-solid fa-list-ul"></i> Tất cả quốc gia</a
              >
            </li>
          </ul>
        </li>

        <li class="treeview {{$segment == 'movie' ? 'active' : ''}}">
          <a href="#">
            <i class="fa-solid fa-film"></i>
            <span>Phim</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{route('movie.create')}}"
                ><i class="fa-solid fa-square-plus"></i> Thêm mới</a
              >
            </li>
            <li>
              <a href="{{route('movie.index')}}"
                ><i class="fa-solid fa-list-ul"></i> Tất cả phim</a
              >
            </li>
          </ul>
        </li>

        <li class="treeview {{$segment == 'episode' ? 'active' : ''}}">
          <a href="#">
            <i class="fa-solid fa-clapperboard-play"></i>
            <span>Tập Phim</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{route('episode.index')}}"
                ><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Tìm kiếm phim</a
              >
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a href="{{route('homepage')}}">
            <i class="fa-solid fa-circle-info"></i> <span>Xem Phim Thôi</span>
          </a>
        </li>
        
        {{-- <li class="header">LABELS</li>
        <li>
          <a href="#"
            ><i class="fa fa-angle-right text-red"></i>
            <span>Important</span></a
          >
        </li>
        <li>
          <a href="#"
            ><i class="fa fa-angle-right text-yellow"></i>
            <span>Warning</span></a
          >
        </li>
        <li>
          <a href="#"
            ><i class="fa fa-angle-right text-aqua"></i>
            <span>Information</span></a
          >
        </li> --}}
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </nav>
</aside>