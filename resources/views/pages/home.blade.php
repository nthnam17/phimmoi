 @extends('layout')
 @section('content')
 <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
               <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                  <div class="ajax"></div>
               </div>
            </div>
            {{-- <div class="col-xs-12 carausel-sliderWidget">
               <section id="halim-advanced-widget-4">
                  <div class="section-heading">
                     <a href="danhmuc.php" title="Phim Chiếu Rạp">
                     <span class="h-text">Phim Chiếu Rạp</span>
                     </a>
                     <ul class="heading-nav pull-right hidden-xs">
                        <li class="section-btn halim_ajax_get_post" data-catid="4" data-showpost="12" data-widgetid="halim-advanced-widget-4" data-layout="6col"><span data-text="Chiếu Rạp"></span></li>
                     </ul>
                  </div>
                  <div id="halim-advanced-widget-4-ajax-box" class="halim_box">
                     <article class="col-md-2 col-sm-4 col-xs-6 thumb grid-item post-38424">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('phim')}}" title="GÓA PHỤ ĐEN">
                              <figure><img class="lazy img-responsive" src="https://lumiere-a.akamaihd.net/v1/images/p_blackwidow_disneyplus_21043-1_63f71aa0.jpeg" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                              <span class="status">HD</span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">GÓA PHỤ ĐEN</p>
                                    <p class="original_title">Black Widow</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     

                    
                  </div>
               </section>
               <div class="clearfix"></div>
            </div> --}}
            <div id="halim_related_movies-2xx" class="wrap-slider">
               <div class="section-bar clearfix">
                  <h3 class="section-title"><span>PHIM HOT</span></h3>
               </div>
               <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                  @foreach($phimhot as $key => $val)
                  <article class="thumb grid-item post-38498">
                     <div class="halim-item">
                        <a class="halim-thumb" href="{{route('movie',$val->slug)}}" title="{{$val->title}}">
                           @php 
                              $check_img = substr($val->img, 0, 4);
                           @endphp
                           @if($check_img == 'http')
                           <figure><img class="lazy img-responsive" src="{{$val->img}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
                           @else
                           <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb/'. $val->img)}}" alt="{{$val->title}}" title="{{$val->title}}"></figure>
                           @endif
                           <span class="status">
                              @if($val->resolution == 0)
                              FullHD
                              @elseif($val->resolution == 1)
                                 HD
                              @elseif($val->resolution == 2)
                                 SD
                              @else
                                 CAM
                              
                              @endif      
                           </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
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
                  owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="fa-solid fa-chevron-left"></i>', '<i class="fa-solid fa-chevron-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:5},1000: {items: 6}}})});
               </script>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="#" title="Phim Mới">
                     <span class="h-text">PHIM MỚI</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                  @foreach($phimmoi->take(12) as $key => $movie)
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$movie->slug)}}">
                              @php 
                                 $check_img = substr($movie->img, 0, 5);
                              @endphp
                              @if($check_img == 'https')
                                 <figure><img class="lazy img-responsive" src="{{$movie->img}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                              @else
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb/'. $movie->img)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                              @endif
                              <span class="status">
                                 @if($movie->episodes <= 1 )
                                    @if($movie->episode_count == 1)
                                       Full
                                    @else
                                       Trailer
                                    @endif
                                 @elseif($movie->episodes > 1)
                                    @if($movie->episode_count > 2 && $movie->episode_count == $movie->episodes)
                                       Full {{$movie->episode_count}} tập
                                    @elseif($movie->episode_count >= 1)
                                       {{$movie->episode_count .'/'.$movie->episodes}} tập
                                    @else
                                       Trailer
                                    @endif
                                 @else
                                    Trailer
                                 @endif
                              </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                 @php 
                                    $subtitle = '';
                                    if($movie->subtitle == 0){
                                       $subtitle = 'Vietsub';
                                    }elseif($movie->subtitle == 1){
                                       $subtitle = 'Thuyết Minh';
                                    }else{
                                       $subtitle = 'Ensub';
                                    }
                                    $quality = '';
                                    if($movie->resolution == 0){
                                       $quality = 'FullHD';
                                    }elseif($movie->resolution == 1){
                                       $quality = 'HD';
                                    }elseif($movie->resolution == 2){
                                       $quality = 'SD';
                                    }else{
                                       $quality = 'CAM';
                                    }
                                    $tag = $subtitle . ' ' . $quality;
                                 @endphp
                                 {{$tag}}
                              </span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$movie->title}}</p>
                                    <p class="original_title">{{$movie->title}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endforeach
                  </div>
               </section>
               @foreach($category_home as $key => $cat)
               <section id="halim-advanced-widget-2">
                  <div class="section-heading">
                     <a href="danhmuc.php" title="Phim Bộ">
                     <span class="h-text">{{$cat->title}}</span>
                     </a>
                  </div>
                  <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                  @foreach($cat->movie->take(12) as $key => $movie)
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$movie->slug)}}">
                              @php 
                                 $check_img = substr($movie->img, 0, 5);
                              @endphp
                              @if($check_img == 'https')
                                 <figure><img class="lazy img-responsive" src="{{$movie->img}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                              @else
                                 <figure><img class="lazy img-responsive" src="{{asset('uploads/thumb/'. $movie->img)}}" alt="{{$movie->title}}" title="{{$movie->title}}"></figure>
                              @endif
                              <span class="status">
                                 @if($movie->episodes <= 1 )
                                    @if($movie->episode_count == 1)
                                       Full
                                    @else
                                       Trailer
                                    @endif
                                 @elseif($movie->episodes > 1)
                                    @if($movie->episode_count >= 1)
                                       {{$movie->episode_count .'/'.$movie->episodes}}
                                    @else
                                       Trailer
                                    @endif
                                 @else
                                    Trailer
                                 @endif
                              </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
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
                                    <p class="entry-title">{{$movie->title}}</p>
                                    <p class="original_title">{{$movie->title}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endforeach
                  </div>
               </section>
               <div class="clearfix"></div>
               @endforeach
            </main>
               @include('pages.inc.sibar');
         </div> 
    </div>
@endsection