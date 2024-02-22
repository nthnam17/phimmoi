<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\models\Category;
use App\models\Genre;
use App\models\Country;
use App\models\Movie;
use App\models\Movie_genre;
use App\models\Episode;
use DB;
use App;
use Carbon\Carbon;
use File;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        //Sitemap for homepage
        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');
        //Sitemap for category
        $category = Category::all();
            foreach ($category as $key){
                $sitemap->add(env('APP_URL') . "/danh-muc/{$key->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
            }
         //Sitemap for genregenre
        $genre = Genre::all();
            foreach ($genre as $key){
                $sitemap->add(env('APP_URL') . "/the-loai/{$key->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
            }

        //Sitemap for country
        $country = Country::all();
            foreach ($country as $key){
                $sitemap->add(env('APP_URL') . "/quoc-gia/{$key->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
            }

        //Sitemap for movie
        $movie = Movie::all();
            foreach ($movie as $key){
                $sitemap->add(env('APP_URL') . "/phim/{$key->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
            }
        
        //Sitemap for episode
        $episode = Episode::all();
        $movie_all = Movie::all();
            foreach ($episode as $key){
                foreach ($movie_all as $key2){
                    if($key->movie_id == $key2->id){
                        $sitemap->add(env('APP_URL') . "/xem-phim/{$key2->slug}/{$key->episode}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
                    }
                    elseif($key->movie_id == $key2->id && $key->episode == 1){
                        $sitemap->add(env('APP_URL') . "/xem-phim/{$key2->slug}", Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
                    }
                }
            }

        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path() . '/sitemap.xml')) {
            File::copy(public_path( 'sitemap.xml'), base_path('sitemap.xml'));
        }


    }
}
