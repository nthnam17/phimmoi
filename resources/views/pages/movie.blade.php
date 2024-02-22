@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs"><span><span><a href="danhmuc.php">{{$movie->category->title}}</a> » <span><a href="danhmuc.php">{{$movie->country->title}}</a> » <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span></span></span></span></div>
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
            
             <div class="halim-movie-wrapper">
                <div class="title-block">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                      <div class="halim-pulse-ring">
                        @if($favorite_movie == 0)
                           <span class="favoriteFilm" style="display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;color: #e94779;"><i class="fa-light fa-heart"></i></span>
                        @else
                           <span class="favoritedFilm" style="display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;color: #e94779;"><i class="fa-sharp fa-solid fa-heart"></i></span>
                        @endif

                       </div>
                   </div>
                   <div class="title-wrapper" style="font-weight: bold;">
                     @if($favorite_movie == 0)
                        Thêm vào danh sách yêu thích
                     @else
                        Đã thêm danh sách yêu thích
                     @endif
                   </div>
                </div>
                <style>
                     .movie-poster--new {
                        position: relative;
                        /* width: 27.8%; */
                        padding: 8px;
                        display: inline-block
                     }
                     .film-poster--new {
                        position: relative;
                        /* width: 72.2%; */
                        height: auto;
                        overflow: hidden;
                        padding: 0
                     }
                     .scroll-set 
                     {
                        height: 245px;
                        overflow-y: scroll;
                     }
                     .social {
                        border: 1px solid #14212d;
                        /* padding: 12px 10px; */
                        background: #00000026;
                        /* text-shadow: 1px 1px 4px #000; */
                        box-shadow: inset 0 1px 1px transparent, 0 1px 10px rgba(0,0,0,.86);
                        width: 100%;
                        height: 50px;
                        padding: 8px;
                        

                     }
                     .social--fb {
                        clear: both;
                     }
                     .social--fb .fb-like,
                     .social--fb .fb-save
                      {
                        float: left;
                        margin: 10px 10px 0 0;
                        overflow: hidden;
                        max-width: 150px;
                        height: 25px;
                     }
                </style>
                <div class="movie_info col-xs-12">
                   <div class="col-md-4 movie-poster--new">
                     @php
                        $check_img = substr($movie->img, 0, 4);
                     @endphp
                     @if($check_img == 'http')
                        <img class="movie-thumb" src="{{$movie->img}}" alt="{{$movie->title}}">
                     @else
                        <img class="movie-thumb" src="{{asset('uploads/thumb/'. $movie->img)}}" alt="{{$movie->title}}">
                     @endif
                      <div class="bwa-content">
                         <div class="loader"></div>
                           @if(isset($episode_first))
                              <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_first->episode)}}" class="bwac-btn">
                           @else
                              <a href="{{url('xem-phim/'.$movie->slug.'/tap-1')}}" class="bwac-btn">
                           @endif
                         <i class="fa fa-play"></i>
                         </a>
                      </div>
                   </div>
                   <div class="col-md-8 film-poster--new">
                      <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
                      <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->title_en}}({{$movie->release}})</h2>
                      <ul class="list-info-group scroll-set">
                         <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                           @if($movie->resolution == 0)
                              2160p
                           @elseif($movie->resolution == 1)
                              1440p
                           @elseif($movie->resolution == 2)
                              FullHD
                           @elseif($movie->resolution == 3)
                              HD
                           @elseif($movie->resolution == 4)
                              SD
                           @else
                              Cam
                           @endif   
                        </span><span class="episode">
                           @if($movie->subtitle == 0)
                           Vietsub
                        @elseif($movie->subtitle == 1)
                           ThuyetMinh
                        @else
                           Ensub
                        @endif   
                        </span></li>
                        
                         <li class="list-info-group-item"><span>Thời lượng</span> 
                              @if($movie->episodes > 1)
                                 : {{$movie->duration}} phút/tập
                              @else
                           : {{$movie->duration}} Phút
                              @endif
                        </li>
                        @if($movie->episodes > 1)
                        <li class="list-info-group-item"><span>Tình trạng</span> :
                           @if($movie->episodes == $episode_count)
                              {{$episode_count}}/{{$movie->episodes}} - <span class="badge badge-success">Hoàn thành</span>
                           @else
                              {{$episode_count}}/{{$movie->episodes}} - <span class="badge badge-primary">Đang cập nhập</span>
                           @endif
                        </li>
                        @elseif($movie->episodes <= 1)
                           
                           <li class="list-info-group-item"><span>Tình trạng</span> : 
                              @if(!isset($episode))
                              Đang cập nhập
                              @else
                              Đang chiếu phát
                              @endif
                           </li>
                        @endif
                         <li class="list-info-group-item"><span>Danh mục</span> : <a href="" rel="category tag">{{$movie->category->title}}</a></li>
                         <li class="list-info-group-item"><span>Thể loại</span> : 
                           @foreach($movie->movie_genre as $key => $gen)
                              <a href="{{route('genre',$gen->slug)}}" rel="category tag">{{$gen->title}}</a>,
                           @endforeach
                        </li>
                         <li class="list-info-group-item"><span>Quốc gia</span> : <a href="" rel="tag">{{$movie->country->title}}</a></li>
                         <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">{{$movie->director}}</a></li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : 
                           @php
                                 $actor_arr = array();
                                 $actor_arr = explode(',', $movie->actor);
                           @endphp
                           @foreach($actor_arr as $actor)
                           <a href="{{route('actor',$actor)}}" rel="nofollow" title="{{$actor}}">{{$actor}}</a>,
                           @endforeach
                        </li>
                      </ul>
                      @php 
                        $current_url = Request::url();
                      @endphp
                      <div class="social">
                        <div class="social--fb">
                           <div class="fb-like" data-href="{{$current_url}}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
                           <div class="fb-save" data-uri="{{$current_url}}" data-size="small"></div>
                        </div>
                      </div>
                      <div class="movie-trailer hidden"></div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div id="halim_trailer"></div>
             <div class="clearfix"></div>

              {{-- Trailler  --}}
              <div class="section-bar clearfix">
               <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
            </div>
            <div class="entry-content htmlwrap clearfix">
               <div class="video-item halim-entry-box">
                  <article id="post-38424" class="item-content">
                     <iframe width="100%" height="350px" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                  </article>
               </div>
            </div>

               {{-- Nội dung phim  --}}

               <div class="section-bar clearfix">
                  <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
               </div>
               <div class="entry-content htmlwrap clearfix">
                  <div class="video-item halim-entry-box">
                     <article id="post-38424" class="item-content">
                        <a href="https://phimhay.co/goa-phu-den-38424/">{{$movie->title}}</a>
                        <p>{{$movie->description}}</p>
                        <h5>Từ Khoá Tìm Kiếm:</h5>
                        <ul>
                           <li><a href="" rel="nofollow" title="{{$movie->title}}">{{$movie->title}}</a></li>
                           <li><a href="" rel="nofollow" title="{{$movie->title_en}}">{{$movie->title_en}}</a></li>
                           <li><a href="" rel="nofollow" title="{{$movie->director}}">{{$movie->director}}</a></li>
                           <li>
                             @foreach($actor_arr as $actor)
                             <a href="{{route('actor',$actor)}}" rel="nofollow" title="{{$actor}}">{{$actor}}</a>,
                             @endforeach
                          </li>
                           
                        </ul>
                     </article>
                  </div>
               </div>

               {{-- Bình luận  --}}
            
               <div class="section-bar clearfix">
                  <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
               </div>
               <div class="entry-content htmlwrap clearfix">
                  <div class="video-item halim-entry-box">
                     <article id="post-38424" class="item-content">
                        <div width="100%" class="fb-comments" data-href="http://127.0.0.1:8000/phim/{{$movie->slug}}" data-width="" data-colorscheme="light" data-numposts="5"></div>
                     </article>
                  </div>
               </div>
            
          </div>
       </section>
       <section class="related-movies">
          <div id="halim_related_movies-2xx" class="wrap-slider">
             <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
             </div>
             <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
               @foreach($movie_recommend->take(12) as $key => $val)
                <article class="thumb grid-item post-38498">
                   <div class="halim-item">
                      <a class="halim-thumb" href="chitiet.php" title="{{$val->title}}">
                        @php
                           $check_img = substr($val->img, 0,5);
                        @endphp
                        @if($check_img == 'https')
                        <figure><img class="lazy img-responsive" src="{{$val->img}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
                        @else
                           <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb').'/'. $val->img}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
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
                               <p class="original_title">{{$val->title}}</p>
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