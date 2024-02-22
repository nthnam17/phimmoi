<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Movie_genre;
use App\Models\Episode;
use App\Models\Info;
use App\Models\Favorite;
use Carbon\Carbon;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //info website
        $info = Info::find(1);

        //Data all views
        $category = Category::orderBy('position','asc')->where('status',1)->get();
        $genre = Genre::orderBy('id','desc')->where('status',1)->get();
        $country = Country::orderBy('id','desc')->where('status',1)->get();
        $movie_wait = Movie::where('status',2)->get();
        $movie_trend = Movie::where('status',1)->orderBy('interest','desc')->get();
        $total_movie = Movie::all()->count();
        $movie = Movie::all();
        $total_update = 0;
        $interest_total = 0;
        // $today =  Carbon::now('Asia/Ho_Chi_Minh');
        foreach($movie as $key => $val){
            $update_time = $val->update_time;
            $datetime = Carbon::parse($update_time);
            if($datetime->isToday()) {
                $total_update++;
            }
            $interest_total += $val->interest;

        }

        $visitor_total = DB::table('shetabit_visits')->count();
        $episode = Episode::all();
        $view_total = 0;
        foreach($episode as $key => $val){
            $view_total += $val->view;
        }

        
        

        View::share([
            'info' =>$info,
            'category_viewAll' => $category,
            'genre_viewAll' => $genre,
            'country_viewAll' => $country,
            'movie_wait' => $movie_wait,
            'movie_trend' => $movie_trend,
            'total_movie' => $total_movie,
            'total_update' => $total_update,
            'visitor_total' => $visitor_total,
            'view_total' => $view_total,
            'interest_total' => $interest_total,
        ]);

    }
}
