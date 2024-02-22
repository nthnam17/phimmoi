@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="{{route('country',$movie->category->slug)}}">{{$movie->category->title}}</a> » <span><a href="{{route('country',$movie->country->slug)}}">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            @if(isset($episode))
            <iframe src="{{$episode->link}}" width="100%" height="500px" frameborder="0" allowfullscreen="" title=">{{$movie->title}}" ></iframe>
            @else
            <iframe width="100%" height="350px" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            @endif
             <div class="button-watch">
                <ul class="halim-social-plugin col-xs-4 hidden-xs">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                </ul>
                <ul class="col-xs-12 col-md-8">
                   <div id="autonext" class="btn-cs autonext">
                      <i class="icon-autonext-sm"></i>
                      <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                   </div>
                   <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                      Expand 
                   </div>
                   <div id="toggle-light"><i class="hl-adjust"></i>
                      Light Off 
                   </div>
                   <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                   <div class="luotxem"><i class="hl-eye"></i>
                      <span>1K</span> lượt xem 
                   </div>
                   <div class="luotxem">
                      <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                   </div>
                </ul>
             </div>
             <div class="collapse" id="moretool">
                <ul class="nav nav-pills x-nav-justified">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                   <div class="fb-save" data-uri="" data-size="small"></div>
                </ul>
             </div>
          
             <div class="clearfix"></div>
             <div class="clearfix"></div>
             <div class="title-block">
                <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                      <div class="halim-pulse-ring"></div>
                   </div>
                </a>
                <div class="title-wrapper-xem full">
                  @if($movie->episodes > 1 && isset($episode) )
                   <h2 class="entry-title"><a href="{{route('movie',$movie->slug)}}" title="Tôi Và Chúng Ta Ở Bên Nhau" class="tl">{{$movie->title}} tập {{$episode->episode}}</a></h1>
                  @elseif($movie->episodes > 1 && !isset($episode))
                  <h2 class="entry-title"><a href="{{route('movie',$movie->slug)}}" title="Tôi Và Chúng Ta Ở Bên Nhau" class="tl">{{$movie->title}} - Sắp khởi chiếu</a></h1>
                  @else
                  <h2 class="entry-title"><a href="{{route('movie',$movie->slug)}}" title="Tôi Và Chúng Ta Ở Bên Nhau" class="tl">{{$movie->title}} Full</a></h1>
                  @endif
                </div>
             </div>
             <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                <article id="post-37976" class="item-content post-37976"></article>
             </div>
             <div class="clearfix"></div>
             <div class="text-center">
                <div id="halim-ajax-list-server"></div>
             </div>
             <div id="halim-list-server">
               @if($movie->episodes <= 1)
                  {{''}}
               @else
                <ul class="nav nav-tabs" role="tablist">
                   <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i> Vietsub</a></li>
                </ul>
                <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                      <div class="halim-server">
                         <ul class="halim-list-eps">
                              @foreach($movie->episode as $key =>$val)
                              
                              <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$val->episode)}}">
                              <li class="halim-episode"><span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow {{$val->episode == $episode->episode ? 'active' : ''}}" data-post-id="37976" data-server="1" data-episode="1" data-position="first" data-embed="0" data-title="Xem phim {{$movie->title}} - Tập {{$val->episode}} - {{$movie->title_en}} - vietsub + Thuyết Minh" data-h1="{{$movie->title}} - tập  {{$val->episode}}"> {{$val->episode}}</span></li>
                              </a>
                              @endforeach
                         </ul>
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
               @endif
             </div>
             <div class="clearfix"></div>
             <div class="htmlwrap clearfix">
                <div id="lightout"></div>
             </div>
       </section>
       <section class="related-movies">
       <div id="halim_related_movies-2xx" class="wrap-slider">
       <div class="section-bar clearfix">
       <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
       </div>
       <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
         @foreach($movie_recommend as $key => $val)
            <article class="thumb grid-item post-38494">
            <div class="halim-item">
            <a class="halim-thumb" href="{{route('movie',$val->slug)}}" title="{{$val->title}}">
            <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb'.'/'.$val->img)}}" alt="Câu Chuyện Kinh Dị Cổ Điển" title="Câu Chuyện Kinh Dị Cổ Điển"></figure>
            <span class="status">
               @if($val->resolution == 0)
               2160p
            @elseif($val->resolution == 1)
               1440p
            @elseif($val->resolution == 2)
               FullHD
            @elseif($val->resolution == 3)
               HD
            @elseif($val->resolution == 4)
               SD
            @else
               Cam
            @endif      
            </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
               @if($val->subtitle == 0)
               Vietsub
            @elseif($val->subtitle == 1)
               ThuyetMinh
            @else
               Ensub
            @endif   
            </span> <div class="icon_overlay"></div>
            <div class="halim-post-title-box">
            <div class="halim-post-title ">
            <p class="entry-title">{{$val->title}}</p><p class="original_title">{{$val->title_en}}</p>
            </div>
            </div>
            </a>
            </div>
            </article>
         @endforeach
       
      
       </div>
       <script>
          jQuery(document).ready(function($) {				
          var owl = $('#halim_related_movies-2');
          owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
       </script>
       </div>
       </section>
    </main>
    @include('pages.inc.sibar');
 </div>
 @endsection