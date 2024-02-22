@extends('layout')
@section('content')
<div class="row container" id="wrapper">
   <div class="halim-panel-filter">
      <div class="panel-heading">
         <div class="row">
            <div class="col-xs-6">
               <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Thể Loại</a> » <span class="breadcrumb_last" aria-current="page">{{$genre_slug->title}}</span></span></span></div>
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
            <h1 class="section-title"><span>{{$genre_slug->title}}</span></h1>
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
                     @include('pages.inc.filter');
               </div>
         </div>
         <div class="halim_box">
            @foreach($movieByGenre as $key =>$val) 
            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
               <div class="halim-item">
                  <a class="halim-thumb" href="{{route('movie',$val->slug)}}" title="{{$val->title}}">
                     @php 
                        $check_img = substr($val->img, 0, 4);
                     @endphp
                     @if($check_img == 'https')
                        <figure><img class="lazy img-responsive" src="{{$val->img}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
                     @else
                        <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb/'. $val->img)}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
                     @endif
                     <span class="status">{{$val->episodes .'/'.$val->episodes}}</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                        @if($val->subtitle == 0)
                           Vietsub
                        @elseif($val->subtitle == 1)
                           ThuyetMinh
                        @else
                           Ensub
                        @endif
                     </span> 
                     <div class="icon_overlay"></div>
                     <div class="halim-post-title-box">
                        <div class="halim-post-title ">
                           <p class="entry-title">{{$val->title}}</p>
                           <p class="original_title">The Mire Season 1</p>
                        </div>
                     </div>
                  </a>
               </div>
            </article>
            @endforeach
         
         </div>
         <div class="clearfix"></div>
         <div class="text-center">
            {{$movieByGenre->links("pagination::bootstrap-4")}}
         </div>
      </section>
   </main>
   @include('pages.inc.sibar');
</div>
@endsection