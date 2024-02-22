@extends('layout')
@section('content')
<div class="row container" id="wrapper">
   <div class="halim-panel-filter">
      <div class="panel-heading">
         <div class="row">
            <div class="col-xs-6">
               <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{Auth::user()->name}}</a> » <span class="breadcrumb_last" aria-current="page">Danh sách phim yêu thích</span></span></span></div>
            </div>
         </div>
      </div>
      <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
         <div class="ajax"></div>
      </div>
   </div>
   <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
      <section>
         <div class="section-bar clearfix">
            <h1 class="section-title"><span>Danh sách phim yêu thích</span></h1>
         </div>
         <div class="section-bar clearfix">
            <style>
               .stylish_filter{
                  background-color: rgb(11,15,21);
                  color: rgb(255,255,255);
                  border: none;
                  font-size: 12px;
               }
               .btn-filter {
                  padding: 6px 12px; 
                  color: #fff; 
                  background-color: rgb(11,15,21); 
                  border: none;
                  border-radius: 5px;

               }
               .btn-filter:hover{
                  background-color: #fff;
                  color: #000;
               }
            </style>
               <div class="row">
                     @include('pages.inc.filter')
               </div>
         </div>
         <div class="halim_box">
            @if(!isset($favorite))
               <span>Bạn chưa quan tâm đến bộ phim nào !!!!. Về </span><a href="{{route('homepage')}}">Trang chủ</a>
            @else
            @foreach($favorite as $key =>$val) 
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{route('movie',$val->movie->slug)}}" title="{{$val->movie->title}}">
                     @php 
                        $check_img = substr($val->movie->img, 0, 5);
                     @endphp
                     @if($check_img == 'https')
                        <figure><img class="lazy img-responsive" src="{{$val->movie->img}}" alt="{{$val->movie->title}}" title="{{$val->movie->title}}"></figure>
                     @else
                        <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb/'. $val->movie->img)}}" alt="{{$val->movie->title}}" title="{{$val->movie->title}}"></figure>
                     @endif
                     <span class="status">
                        @if($val->resolution == 0)
                           FullHD
                        @elseif($val->resolution == 1)
                           HD
                        @elseif($val->resolution == 2)
                           SD
                        @else
                           Cam
                        @endif      
                     </span>
                     <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                        @if($val->movie->subtitle == 0)
                           Vietsub
                        @elseif($val->movie->subtitle == 1)
                           ThuyetMinh
                        @else
                           Ensub
                        @endif
                     </span> 
                     <div class="icon_overlay"></div>
                     <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                           <p class="entry-title">{{$val->movie->title}}</p>
                           <p class="original_title">{{$val->movie->title_en}}</p>
                        </div>
                     </div>
                  </a>
               </div>
            </article>
            @endforeach
            @endif
         
         </div>
         <div class="clearfix"></div>
         <div class="text-center">
            {{-- {{$favorite->links("pagination::bootstrap-4")}} --}}
         </div>
      </section>
   </main>
   @include('pages.inc.sibar')
</div>
@endsection