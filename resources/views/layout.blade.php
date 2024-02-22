<!DOCTYPE html>
<html lang="vi">
   <head>
      <meta charset="utf-8" />
      <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta name="theme-color" content="#234556">
      <meta http-equiv="Content-Language" content="vi" />
      <meta content="VN" name="geo.region" />
      <meta name="DC.language" scheme="utf-8" content="vi" />
      <meta name="language" content="Việt Nam">
      

      <link rel="shortcut icon" href="{{asset('/uploads/logo/'.$info->icon)}}" type="image/x-icon" />
      <meta name="revisit-after" content="1 days" />
      <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
      <title>
         @if(!isset($meta_title) || $meta_title == '')
               {{$info->title}}
         @else
           {{$meta_title}}
         @endif
      </title>
      @if(!isset($meta_description) || $meta_description == '')
         <meta name="description" content="{{$info->description}}" />
      @else
         <meta name="description" content="{{$meta_description}}" />
      @endif

      <link rel="canonical" href="{{Request::url()}}">
      <link rel="next" href="" />
      <meta property="og:locale" content="vi_VN" />
      @if(!isset($meta_title) || $meta_title == '')
         <meta property="og:title" content="{{$info->title}}" />
      @else
         <meta property="og:title" content="{{$meta_title}}" />
      @endif
      
      @if(!isset($meta_description) || $meta_description == '')
         <meta property="og:description" content="{{$info->description}}" />
      @else
         <meta property="og:description" content="{{$meta_description}}" />
      @endif
      <meta property="og:url" content="{{Request::url()}}" />
      <meta property="og:site_name" content="chilloflim.me" />
      @if(!isset($meta_img) || $meta_img == '')
         <meta property="og:image" content="{{asset('/uploads/logo/'.$info->logo)}}" />
      @else
         <meta property="og:image" content="{{$meta_img}}" />
      @endif
      <meta property="og:image:width" content="300" />
      <meta property="og:image:height" content="55" />
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
     
      <link rel='dns-prefetch' href='//s.w.org' />
      
      <link rel='stylesheet' id='bootstrap-css' href='{{asset('/css/bootstrap.min.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='style-css' href='{{asset('/css/style.css?ver=5.7.2')}}' media='all' />
      <link rel='stylesheet' id='wp-block-library-css' href='{{asset('/css/style.min.css?ver=5.7.2')}}' media='all' />

      {{-- gg font --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">

      <script type='text/javascript' src='{{asset('/js/jquery.min.js?ver=5.7.2')}}' id='halim-jquery-js'></script>
      {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
      <style type="text/css" id="wp-custom-css">
         .textwidget p a img {
         width: 100%;
         }
      </style>
      {{-- <style>#header .site-title {background: url(https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png) no-repeat top left;background-size: contain;text-indent: -9999px;}</style> --}}
   </head>
   <body class="home blog halimthemes halimmovies" data-masonry="">
      <header id="header">
         <div class="container">
            <div class="row" id="headwrap" style="display: flex; align-items: center;">
               <div class="col-md-2 col-sm-6 slogan" style="padding-left: 0; padding-right: 0;">
                  {{-- <p class="site-title"><a class="logo" href="" title="phim hay ">Phim Hay</p> --}}
                     <img src="{{asset('uploads/logo/'.$info->logo)}}" alt="">
                  </a>
               </div>
               <div class="col-md-6 col-sm-6 halim-search-form hidden-xs">
                  <div class="header-nav">
                     <div class="col-xs-12">
                        <style>
                           #result {
                              position: absolute;
                              z-index: 9999;
                              width: 100%;
                              padding: 10px;
                              margin: 1px;
                              background-color: #1b2d3c;
                           }
                        </style>
                        <form action="{{route('search')}}" method="GET">
                           <div class="form-group" >
                              <div class="input-group col-xs-12" style="display: flex;">
                                 <input id="search" type="text" name="search" class="form-control" placeholder="Tìm kiếm..." autocomplete="off" required>
                                 <i class="animate-spin hl-spin4 hidden"></i>
                                 <button class="btn btn-primary">Tìm Kiếm</button>
                              </div>
                           </div>
                        </form>
                        <ul class="list-group" id="result" style="display: none;"></ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 hidden-xs" style="float: right;">
                  @if(Auth::check())
                  <div class="mega dropdown">
                     <a title="" href="#" data-toggle="dropdown" class="btn btn-login dropdown-toggle" aria-haspopup="true"> <span><i class="fa-solid fa-user"></i></span> {{Auth::user()->name}}</a>
                     <ul role="menu" class=" dropdown-menu" style="padding: 12px;">
                        @if(Auth::user()->role_as == 1)
                           <li><a title="" href="{{route('home')}}" style=" margin-bottom: 8px;">Trang quản trị</a></li>
                        @endif
                        <li><a title="" href="{{route('favorite')}}" style=" margin-bottom: 8px;">Phim yêu thích</a></li>
                        <li><a class="btn btn-danger" title="" href="{{route('logout-home')}}" style=" margin-bottom: 8px;"><span><i class="fa-regular fa-arrow-right-from-bracket"></i></span> Đăng xuất</a></li>
                     </ul>
                  </div>
                  @else
                     <a href="{{url('/login')}}" class="btn-login"><span><i class="fa-solid fa-user"></i></span> Đăng nhập</a>
                  @endif
               </div>
               <style>
                  .btn-login {
                     background-color: #03090d;
                     color: #abacad;
                     padding: 6px 20px;
                     border-radius: 14px;
                     font-weight: 450;
                     font-size: 16px;
                     text-decoration: none;
                  }
               </style>
            </div>
         </div>
      </header>
      <div class="navbar-container">
         <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#halim" aria-expanded="false">
                  <span class="sr-only">Menu</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                  <span class="hl-search" aria-hidden="true"></span>
                  </button>
                  <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                  Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                  <span class="count">0</span>
                  </button>
                  {{-- <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                  <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i class="fas fa-filter"></i></a>
                  </button> --}}
               </div>
               <div class="collapse navbar-collapse" id="halim">
                  <div class="menu-menu_1-container">
                     <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                        <li class="current-menu-item "><a title="Trang Chủ" href="{{route('homepage')}}">TRANG CHỦ</a></li>
                        <li class="mega dropdown">
                           <a title="Thể loại" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">THỂ LOẠI <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($genre_viewAll as $key => $val)
                              <li><a title="{{$val->title}}" href="{{route('genre',$val->slug)}}">{{$val->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="mega dropdown">
                           <a title="Quốc gia" href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">QUỐC GIA <span class="caret"></span></a>
                           <ul role="menu" class=" dropdown-menu">
                              @foreach($country_viewAll as $key => $val)
                              <li><a title="{{$val->title}}" href="{{route('country',$val->slug)}}">{{$val->title}}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        @foreach($category_viewAll as $key => $cat)
                           
                        <li><a class="text-uppercase" title="{{$cat->title}}" href="{{route('category',$cat->slug)}}">{{$cat->title}}</a></li>
                        @endforeach
                     </ul>
                  </div>
                  {{-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                     <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                  </ul> --}}
               </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
               <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
               <div id="mobile-user-login"></div>
            </div>
         </div>
      </div>
      </div>
      
      <div class="container">
         <div class="row fullwith-slider"></div>
      </div>
      <div class="container">
         @yield('content')
         @include('pages.inc.banner')
      </div>
      <div class="clearfix"></div>
      <footer id="footer" class="clearfix">
         <div class="container footer-columns">
            <div class="row container">
               <div class="widget about col-xs-12 col-sm-4 col-md-4">
                  <div class="footer-logo">
                     <img class="img-responsive" src="{{asset('img/logo/logo.png')}}" alt="Phim hay 2021- Xem phim hay nhất" />
                  </div>
                  Liên hệ QC: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e5958d8c888d849ccb868aa58288848c89cb868a88">[nthnam.dev@gmail.com&#160;protected]</a>
               </div>
               <div class="col-xs-12 col-sm-4 col-md-4">
                  {!! $info->fanpage !!}
               </div>
            </div>
         </div>
      </footer>
      <div id='easy-top'></div>
     
      <script type='text/javascript' src='{{asset('js/bootstrap.min.js')}}' id='bootstrap-js'></script>
      <script type='text/javascript' src='{{asset('js/owl.carousel.min.js')}}' id='carousel-js'></script>
      <div id="fb-root"></div>
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="RQXgZ3HL"></script>
      <script type='text/javascript' src='{{asset('js/halimtheme-core.min.js')}}' id='halim-init-js'></script>
      <!-- Messenger Plugin chat Code -->
      <div id="fb-root"></div>

      <!-- Your Plugin chat code -->
      <div id="fb-customer-chat" class="fb-customerchat">
      </div>

      <script>
         var chatbox = document.getElementById('fb-customer-chat');
         chatbox.setAttribute("page_id", "102239029414779");
         chatbox.setAttribute("attribution", "biz_inbox");
      </script>

      <!-- Your SDK code -->
      <script>
         window.fbAsyncInit = function() {
         FB.init({
            xfbml            : true,
            version          : 'v17.0'
         });
         };

         (function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
         fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
    {{-- End chat plugin --}}
      
      <script type='text/javascript'>
         $(document).ready(function() {
             $('#search').keyup(function(){
               // alert('ok');
               $('#result').html('');
               var searchField = $('#search').val();
               if(searchField != '')  {
                  var expression = new RegExp(searchField, "i");
                  // alert(expression);
                  $.getJSON('/json/movie.json', function(data) {
                     $.each(data,  function(key, value) {
                        if(value.title.search(expression) != -1 || value.actor.search(expression) != -1){
                           // alert('value: ' + value.title);
                           var slugs = value.slug;
                           var host = $(location).attr('host');
                           var protocol = $(location).attr('protocol');
                           var url = protocol+'//'+host+'/';
                           $('#result').css('display','block');
                           // 
                           var check_img = value.img.substr(0, 5);
                           if(check_img == 'https'){
                              $('#result').append('<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"> <img src="'+value.img+'" width="100" class="" /><a href="'+url+'phim/'+value.slug+'"><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%">'+value.title+'</h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted"> '+value.title_en+'</span><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted"> '+value.actor+'</span></div> </a> </li>');
                           }else {
                              $('#result').append('<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"> <img src="/uploads/thumb/'+''+value.img+'" width="100" class="" /><a href="'+url+'phim/'+value.slug+'"><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%">'+value.title+'</h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted"> '+value.title_en+'</span><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted"> '+value.actor+'</span></div> </a> </li>');
                           }
                        }
                     })
                  })
               }
               

             })
         })
      </script>

      <script type='text/javascript'>
         $(window).on('load', function () {
            // $('#modalBanner').modal('show');
            // var url = $(location).attr('href');
            // var segment = url.split('/');
            // var lengthSeg = segment.length;
            // // alert(lengthSeg);
            // if(lengthSeg <= 4){
            //    $('#modalBanner').modal('show');
            // }
         })
      </script>

      <script>
            $('#bookmark').click(function () {
               var url = $(location).attr('href');
               var segment = url.split('/');
               var slug = segment[segment.length - 1]
               $.ajax({
                 
                  type: 'GET',
                  url: "{{route('favorites_add')}}",
                  data: {slug: slug},
                  success: function (data) {
                     // alert(data);
                     if(data == 2){
                        $(location).attr('href', '{{route('login')}}');
                     }else if(data == 1) {
                        $('.halim-pulse-ring').html('<span class="favoriteFilm" style="display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;color: #e94779;"><i class="fa-light fa-heart"></i></span>')
                        $('.title-wrapper').html('Thêm vào danh sách yêu thích')
                     }else {
                        $('.halim-pulse-ring').html('<span class="favoritedFilm" style="display: flex;align-items: center;justify-content: center;width: 100%;height: 100%;color: #e94779;"><i class="fa-sharp fa-solid fa-heart"></i></span>')
                        $('.title-wrapper').html('Đã thêm danh sách yêu thích')
                     }
                  }
               })
            })
         
      </script>
      
      <script src="https://kit.fontawesome.com/3426ec3618.js" crossorigin="anonymous"></script>
     
     
   
      <style>#overlay_mb{position:fixed;display:none;width:100%;height:100%;top:0;left:0;right:0;bottom:0;background-color:rgba(0, 0, 0, 0.7);z-index:99999;cursor:pointer}#overlay_mb .overlay_mb_content{position:relative;height:100%}.overlay_mb_block{display:inline-block;position:relative}#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:600px;height:auto;position:relative;left:50%;top:50%;transform:translate(-50%, -50%);text-align:center}#overlay_mb .overlay_mb_content .cls_ov{color:#fff;text-align:center;cursor:pointer;position:absolute;top:5px;right:5px;z-index:999999;font-size:14px;padding:4px 10px;border:1px solid #aeaeae;background-color:rgba(0, 0, 0, 0.7)}#overlay_mb img{position:relative;z-index:999}@media only screen and (max-width: 768px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:400px;top:3%;transform:translate(-50%, 3%)}}@media only screen and (max-width: 400px){#overlay_mb .overlay_mb_content .overlay_mb_wrapper{width:310px;top:3%;transform:translate(-50%, 3%)}}</style>
    
      <style>
         #overlay_pc {
         position: fixed;
         display: none;
         width: 100%;
         height: 100%;
         top: 0;
         left: 0;
         right: 0;
         bottom: 0;
         background-color: rgba(0, 0, 0, 0.7);
         z-index: 99999;
         cursor: pointer;
         }
         #overlay_pc .overlay_pc_content {
         position: relative;
         height: 100%;
         }
         .overlay_pc_block {
         display: inline-block;
         position: relative;
         }
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 600px;
         height: auto;
         position: relative;
         left: 50%;
         top: 50%;
         transform: translate(-50%, -50%);
         text-align: center;
         }
         #overlay_pc .overlay_pc_content .cls_ov {
         color: #fff;
         text-align: center;
         cursor: pointer;
         position: absolute;
         top: 5px;
         right: 5px;
         z-index: 999999;
         font-size: 14px;
         padding: 4px 10px;
         border: 1px solid #aeaeae;
         background-color: rgba(0, 0, 0, 0.7);
         }
         #overlay_pc img {
         position: relative;
         z-index: 999;
         }
         @media only screen and (max-width: 768px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 400px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
         @media only screen and (max-width: 400px) {
         #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
         width: 310px;
         top: 3%;
         transform: translate(-50%, 3%);
         }
         }
      </style>
     
      <style>
         .float-ck { position: fixed; bottom: 0px; z-index: 9}
         * html .float-ck /* IE6 position fixed Bottom */{position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
         #hide_float_left a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;float: left;}
         #hide_float_left_m a {background: #0098D2;padding: 5px 15px 5px 15px;color: #FFF;font-weight: 700;}
         span.bannermobi2 img {height: 70px;width: 300px;}
         #hide_float_right a { background: #01AEF0; padding: 5px 5px 1px 5px; color: #FFF;float: left;}
      </style>

      {{-- <iframe src="//zatloudredr.com/4/6189632" frameborder="0"></iframe> --}}
   </body>
</html>