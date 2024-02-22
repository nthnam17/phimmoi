<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use App\Models\Category;
use App\Models\country;
use App\Models\genre;
use App\Models\movie;
use App\Models\episode;
use Carbon\Carbon;
use File;


class ApiController extends Controller
{

    public function leech_movie(Request $request) {
        $url = $request->url;
        $resp =  Http::get($url)->json();
        $data_movie_arr[] = $resp['movie'];
        $data_movie = $data_movie_arr[0];
        $check_movie = Movie::where('slug', $data_movie['slug'])->first();
        if($check_movie){
            $id = $check_movie['id'];
            $movie = Movie::find($id);
        }else {
            $movie = new Movie();
        }

        $movie->title = $data_movie['name'];
        $movie->slug = $data_movie['slug'];
        $movie->description = $data_movie['content'];
        $movie->status = 1;
        $movie->trending = 0;
        if($data_movie['lang'] == 'Vietsub'){
            $movie->subtitle = 0;
        }else {
            $movie->subtitle = 1;
        }
        if($data_movie['quality'] == 'FHD') {
            $movie->resolution = 2;
        }
        elseif($data_movie['quality'] == 'HD') {
            $movie->resolution = 3;
        }else {
            $movie->resolution = 4;
        }
        $movie->release = $data_movie['year'];
        $duration = $data_movie['time'];
        if (preg_match('/(\d+)/', $duration, $matches)) {   
            $duration_val = (int)$matches[1];
            $movie->duration = $duration_val;
        }

        $episodes = $data_movie['episode_total'];
          if (preg_match('/(\d+)/', $episodes, $matches)) {
              $episode_total = (int)$matches[1];
              $movie->episodes = $episode_total;
        }

        if($data_movie['type'] == 'series'){
            $movie->category_id = 3;
        }
        elseif($data_movie['type'] == 'single'){
            $movie->category_id = 9;
        }elseif($data_movie['type'] == 'hoathinh'){
            $movie->category_id = 18;
        }elseif($data_movie['type'] == 'tvshows'){
            $movie->category_id = 11;
        }elseif(isset($data_movie['chieurap']) && $data_movie['chieurap'] == true){
            $movie->category_id = 2;
        }
        else{
            $movie->category_id = 1;
        }
        $country = Country::all();
        foreach($country as $key => $value) {
            if($value->slug == $data_movie['country'][0]['slug']) {
                $movie->country_id = $value->id;
            }
        }
        $movie->title_en = $data_movie['origin_name'];

        $movie->director = $data_movie['director'][0];

        $actor_arr = $data_movie['actor'];
        $actor = implode(",",$actor_arr);
        $movie->actor = $actor;

         // handle trailer srtat 
         $trailer = $data_movie['trailer_url'];
         $part = explode("=",$trailer);
         if(isset($part[1])){
             $trailer_url = $part[1];
             $movie->trailer = $trailer_url;
         }else {
             $movie->trailer = $data_movie['trailer_url'];
         }
         // handle trailer end

        $movie->create_time = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update_time = Carbon::now('Asia/Ho_Chi_Minh');

        $genre = Genre::all();
        foreach($genre as $key => $value) {
            if($value->slug == $data_movie['category'][0]['slug']) {
                $movie->genre_id = $value->id;
            }
        }

        
        $movie->img = $data_movie['thumb_url'];
        

        $movie->save();

        // $movie->movie_genre()->attach($data_movie['category']);

        $last_record = Movie::orderBy('id', 'desc')->first();
        $movie_id = $last_record['id'];

        if($check_movie){
            return $id;
        }
        else {
            return $movie_id;
        }
        
    }

    public function leech_episode(Request $request) {
        $url = $request->url;
        $movie_id = $request->movie_id;
        $resp =  Http::get($url)->json();
        $data_episode_arr[] = $resp['episodes'];
        $data_episode = $data_episode_arr[0][0]['server_data'];
        foreach($data_episode as $key => $val) {
            $check_episode = Episode::where('movie_id',$movie_id)->where('episode', $val['slug'])->first();
            if($check_episode){
                $id = $check_episode['id'];
                $episode = Episode::find($id);
            }else {
                $episode = new Episode();
                // $id = 1111111;
            }
            $episode->link = $val['link_embed'];
            $episode->movie_id = $movie_id;
            $episode->episode = $val['slug'];
            $episode->type = 1;
            $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
            // return ;
        }
        // return 'Thêm tập phim thành công';
    }


    public function choose_treding (Request $request) {
        $movie_id = $request->movie_id;
        $trending = $request->trending;
        $movie = Movie::find($movie_id);
        $movie->trending = $trending;
        $movie->save();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
