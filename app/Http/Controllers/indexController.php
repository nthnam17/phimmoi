<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Category;
use App\models\Genre;
use App\models\Country;
use App\models\Movie;
use App\models\Movie_genre;
use App\models\Episode;
use App\models\Favorite;
use DB;
use Carbon\Carbon;
// use Shetabit\Visitor\Middlewares\LogVisits;

class indexController extends Controller
{
    

    public function home(){
        visitor()->visit();
        $phimhot = Movie::where('trending', 1)->where('status',1)->get();
          $phimmoi = Movie::withCount('episode')->where('status',1)->orderBy('create_time' ,'DESC')->get();
        $category_home = Category::with(['movie' => function($para){ $para->withCount('episode');} ])->orderBy('position','ASC')->where('status',1)->get();
        return view('pages.home',compact('category_home','phimhot','phimmoi'));
    }
    public function category($slug){
        // visitor()->visit();
        $cat_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cat_slug->id)->where('status',1)->paginate(12);
        $year_now = Carbon::now()->year;
        $meta_title = $cat_slug->title . ' Vietsub, Thuyết Minh Full HD Hay Mới Cập Nhật Năm '.$year_now.' tại ChilloFilm.me';
        $meta_description = 'Danh sách phim '.$cat_slug->title.' hay mới nhất mới cập nhật Full HD Năm '.$year_now.' tại ChilloFilm.me';
        return view('pages.category',compact('cat_slug','movie','year_now','meta_title','meta_description'));
    }
    public function genre($slug){
        // visitor()->visit();
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie_genre = Movie_genre::where('genre_id',$genre_slug->id)->get();
        $movie_many = array();
        foreach($movie_genre as $key => $value){
            $movie_many[] = $value->movie_id;
        }
        // return response()->json($movie_many);
        $movieByGenre = Movie::whereIn('id',$movie_many)->where('status',1)->orderBy('update_time','DESC')->paginate(12);

        $year_now = Carbon::now()->year;
        $meta_title = $genre_slug->title . ' Vietsub, Thuyết Minh Full HD Hay Mới Cập Nhật Năm '.$year_now.' tại ChilloFilm.me';
        $meta_description = 'Danh sách phim '.$genre_slug->title.' hay mới nhất mới cập nhật Full HD Năm '.$year_now.' tại ChilloFilm.me';
        return view('pages.genre',compact('genre_slug','movieByGenre','year_now','meta_title','meta_description'));
    }
    public function country($slug){
        // visitor()->visit();
        $country_slug = Country::where('slug',$slug)->first();
        $movieByCountry = Movie::where('country_id',$country_slug->id)->where('status',1)->paginate(12);
        $year_now = Carbon::now()->year;
        $meta_title = $country_slug->title . ' Vietsub, Thuyết Minh Full HD Hay Mới Cập Nhật Năm '.$year_now.' tại ChilloFilm.me';
        $meta_description = 'Danh sách phim '.$country_slug->title.' hay mới nhất mới cập nhật Full HD Năm '.$year_now.' tại ChilloFilm.me';
        return view('pages.country',compact('country_slug','movieByCountry','year_now','meta_title','meta_description'));
    }
    public function movies($slug){
        // visitor()->visit();
        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->first();
        $movie_recommend = Movie::with('category','genre','country')->where('category_id',$movie->category_id)->where('status',1)->get();
        $episode_list = Episode::where('movie_id',$movie->id)->get();
        $episode_first = Episode::where('movie_id',$movie->id)->orderBy('episode', 'asc')->take(1)->first();
        $episode_count = $episode_list->count();
        // dd($episode_first);
        $meta_title = $movie->title.' - '.$movie->title_en.'('.$movie->release.')';
        $desc_150 = substr($movie->description,0,100);
        $actor_arr = explode(',',$movie->actor);
        // dd($actor_arr[0]);
        $meta_description = $movie->title.' với sự tham gia của '.$actor_arr[0].' và nhiều diễn viên khác. '.$desc_150.'...';
        $meta_img = asset('uploads/thumb/'.$movie->img);
        $movie->interest = $movie->interest + 1;

        
        if(Auth::check()){
            $favorite_list = Favorite::all();
            if($favorite_list) {
                $favorite = Favorite::where('user_id',Auth::user()->id)->where('movie_id',$movie->id)->first();
                if($favorite){
                    $favorite_movie = 1;
                }else {
                    $favorite_movie= 0;
                }
            }else {
                $favorite_movie= 0;
            }
            
        }else {
                $favorite_movie = 0;
            }
    
        $movie->save();
        return view('pages.movie',compact('movie','movie_recommend','episode_count','episode_first','meta_title','meta_description','meta_img','favorite_movie'));
    }
    public function watch($slug,$tap){
        // visitor()->visit();
        if(isset($tap)){
            $ep = preg_replace('/[^0-9]/', '', $tap);
        }else {
            $ep = 1;
        }
        // dd($ep);
        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->first();
        // return response()->json($movie);
        $actor_arr = explode(',',$movie->actor);
        if($actor_arr == []){
            $actor_arr = array('Đang cập nhập','Đang cập nhập');
        }
        $episode = Episode::where('movie_id',$movie->id)->where('episode',$ep)->first();
        $movie_recommend = Movie::with('category','genre','country')->where('category_id',$movie->category_id)->where('status',1)->get();
        $meta_title = 'Xem Phim '.$movie->title.'('.$movie->title_en.')'.'- Tập '.$ep.' [FullHD VIETSUB] tại ChilloFilm.me';
        $meta_description = 'Xem phim '.$movie->title.' - '.$movie->title_en.'('.$movie->release.') - Tập'.$ep.' '.$movie->title.' là bộ phim cổ trang với sự tham gia của '.$actor_arr[0].','.$actor_arr[1].'...';
        $meta_img = asset('uploads/thumb/'.$movie->img);
        $episode->view = $episode->view + 1;
        $episode->save();
        return view('pages.watch',compact('movie','movie_recommend','episode','meta_title','meta_description','meta_img'));
       
    }

    public function actor($slug) {
        // visitor()->visit();
        $movie = Movie::with('category','genre','country')->where('actor','LIKE','%'.$slug.'%')->where('status',1)->paginate(12);
        $year_now = Carbon::now()->year;
        return view('pages.actor',compact('slug','movie','year_now'));
    }

    public function search_movie(){
        // visitor()->visit();
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            // $cat_slug = Category::where('slug',$slug)->first();

            $movie = Movie::where('title','LIKE','%'.$search.'%')->orWhere('title_en','LIKE','%'.$search.'%')->orWhere('actor','LIKE','%'.$search.'%')->paginate(12);
            return view('pages.search',compact('movie','search'));
        }else {
            return redirect()->to('/');
        }
    }

    public function filter(){
        // visitor()->visit();
        $order_get = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];
        $year_now = Carbon::now()->year;
        if($country_get == '' && $year_get == '' && $order_get == '' && $genre_get == ''){
            return redirect()->back();
        }else {
            
            if( $year_get == '' && $country_get == '' && $genre_get == ''){
                $movie = Movie::withCount('episode')->orWhere('release',$year_get)->orWhere('genre_id',$genre_get)->orWhere('country_id',$country_get)->paginate(16);
            }elseif($order_get == 'name'){
                $movie = Movie::withCount('episode')->orWhere('release',$year_get)->orWhere('genre_id',$genre_get)->orWhere('country_id',$country_get)->orderBy('title','ASC')->paginate(16);
            }
        }
            
            return view('pages.filter',compact('movie','year_now'));
        
    }

    public function fav_movie() {
        $year_now = Carbon::now()->year;
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $favorite = Favorite::with('movie')->where('user_id',$user_id)->get();
            if(!$favorite){
                $favorite = [];
            }
        }else {
            $favorite = [];
        }
        return view('pages.fav',compact('favorite','year_now'));
    }

}
