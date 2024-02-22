<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
       <div class="section-bar clearfix">
          <div class="section-title">
             <span>Sắp khởi chiếu </span>
          </div>
       </div>
       <section class="tab-content">
          <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
             <div class="halim-ajax-popular-post-loading hidden"></div>
             <div id="halim-ajax-popular-post" class="popular-post">
               @foreach($movie_wait->take(6) as $key => $val)
                <div class="item post-37176">
                   <a href="{{route('movie',$val->slug)}}" title="{{$val->title}}">
                      <div class="item-link">
                         <img src="{{asset('uploads/thumb'.'/'.$val->img)}}" class="lazy post-thumb" alt="{{$val->title}}" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                         <span class="is_trailer">Trailer</span>
                      </div>
                      <p class="title">{{$val->title}}</p>
                   </a>
                   <div class="viewsCount" style="color: #9d9d9d;">{{$val->actor}}</div>
                   <div style="float: left;">
                      <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                      <span style="width: 0%"></span>
                      </span>
                   </div>
                </div>
                  @endforeach
             </div>
          </div>
       </section>
       <div class="clearfix"></div>
    </div>
 </aside>
 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
       <div class="section-bar clearfix">
          <div class="section-title">
             <span>Trending </span>
          </div>
       </div>
       <section class="tab-content">
          <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
             <div class="halim-ajax-popular-post-loading hidden"></div>
             <div id="halim-ajax-popular-post" class="popular-post">
               @foreach($movie_trend->take(6) as $key => $val)
                <div class="item post-37176">
                   <a href="{{route('movie',$val->slug)}}" title="{{$val->title}}">
                      <div class="item-link">
                           @php 
                              $check_img = substr($val->img, 0, 5);
                           @endphp
                           @if($check_img == 'https')
                              <img src="{{$val->img}}" class="lazy post-thumb" alt="{{$val->title}}" title="{{$val->title}}" />
                           @else
                           <img src="{{asset('/uploads/thumb'.'/'.$val->img)}}" class="lazy post-thumb" alt="{{$val->title}}" title="{{$val->title}}" />
                           @endif
                         {{-- <span class="is_trailer">Trailer</span> --}}
                      </div>
                      <p class="title">{{$val->title}}</p>
                   </a>
                   <div class="viewsCount" style="color: #9d9d9d;"> {{$val->interest.' lượt quan tâm'}}</div>
                   <div style="float: left;">
                      <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                      <span style="width: 0%"></span>
                      </span>
                   </div>
                </div>
                @endforeach
               
             </div>
          </div>
       </section>
       <div class="clearfix"></div>
    </div>
 </aside>