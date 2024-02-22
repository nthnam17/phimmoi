<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_genre;
use Carbon\Carbon;
use Storage;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category','genre','country')->withCount('episode')->get();
        $genre = Genre::pluck('title','id');
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');

        $path = public_path()."/json/";

        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

       File::put($path.'movie.json', json_encode($list));

        return view('admin.movie.index',compact('list','genre','category','country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Movie::with('category','movie_genre','country')->get();
        $genre = Genre::pluck('title','id');
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $year_now = Carbon::now()->year;
        $list_genre = Genre::all();

        return view('admin.movie.form',compact('list','genre','category','country','year_now','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->trending = $data['trending'];
        $movie->subtitle = $data['subtitle'];
        $movie->resolution = $data['resolution'];
        $movie->release = $data['release'];
        // $movie->duration = $data['duration'];
        $movie->episodes = $data['episodes'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->title_en = $data['title_en'];
        $movie->director = $data['director'];
        $movie->actor = $data['actor'];
         // handle trailer srtat 
         $trailer = $data['trailer'];
         $part = explode("=",$trailer);
         if(isset($part[1])){
             $trailer_url = $part[1];
             $movie->trailer = $trailer_url;
         }else {
             $movie->trailer = $data['trailer_url'];
         }
         // handle trailer end
        $movie->create_time = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update_time = Carbon::now('Asia/Ho_Chi_Minh');
        foreach($data['genre'] as $key => $value){
            $movie->genre_id = $value[0];
        }
        $get_image = $request->file('img');
        $path = 'uploads/thumb/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image));    //[0] => hinhanh1 . [1] => jpg
            $new_image = $name_image.rand(0,9900).'.'.$get_image->getClientOriginalExtension(); // hinhanh2356.jpg
            $get_image->move(public_path($path),$new_image);
            $movie->img = $new_image;
        }
        $movie->save();
        //them nhieu the loai
        $movie->movie_genre()->sync($data['genre']);

        return redirect()->back()->with('success','Thêm mới phim thành công !');


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
        $list = Movie::with('category','genre','country')->get();
        $genre = Genre::pluck('title','id');
        $category = Category::pluck('title','id');
        $country = Country::pluck('title','id');
        $movie = Movie::find($id);
        $year_now = Carbon::now()->year;
        $list_genre = Genre::all();
        $movie_genre = $movie->movie_genre;
        return view('admin.movie.form',compact('list','genre','category','country', 'movie','year_now','list_genre','movie_genre'));
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
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->trending = $data['trending'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->subtitle = $data['subtitle'];
        $movie->resolution = $data['resolution'];
        $movie->release = $data['release'];
        $movie->duration = $data['duration'];
        $movie->episodes = $data['episodes'];
        $movie->title_en = $data['title_en'];
        $movie->director = $data['director'];
        $movie->actor = $data['actor'];
        // handle trailer srtat 
        $trailer = $data['trailer'];
        $part = explode("=",$trailer);
        if(isset($part[1])){
            $trailer_url = $part[1];
            $movie->trailer = $trailer_url;
        }else {
            $movie->trailer = $data['trailer_url'];
        }
        // handle trailer end
        $movie->update_time = Carbon::now('Asia/Ho_Chi_Minh');
        // $movie->interest = rand(100,99999);
        $get_image = $request->file('img');

        $path = 'uploads/thumb/';
        if($get_image){
            if(file_exists('uploads/thumb/' . $movie->img)){
                unlink('uploads/thumb/' . $movie->img);
            }
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image));    //[0] => hinhanh1 . [1] => jpg
            $new_image = $name_image.rand(0,9900).'.'.$get_image->getClientOriginalExtension(); // hinhanh2356.jpg
            $get_image->move($path,$new_image);
            $movie->img = $new_image;
        }
        foreach($data['genre'] as $key => $value){
            $movie->genre_id = $value[0];
        }
        $movie->save();

        $movie->movie_genre()->sync($data['genre']);

        return redirect()->back()->with('info','Cập nhập phim thành công !');
    }

    // Thêm mới phim bằng API
    // public function movie_api (Request $request){
    //     $data = $request->all();
    //     $url = $data['url'];
    //     $val = file_get_contents($url);
    //     $json = json_decode($val, true);
    //     $movie = new Movie();
    //     $movie->title = $json['movie']['name'];
    //     $movie->slug = $json['movie']['slug'];
    //     $movie->description = $json['movie']['content'];
    //     if($json['movie']['status'] == true){
    //         $movie->status = 1;
    //     }else{
    //         $movie->status = 0;
    //     }
    //     $movie->trending = 1;
    //     if($json['movie']['type'] == 'series'){
    //         $movie->category_id = 3;
    //     }
    //     elseif($json['movie']['type'] == 'single'){
    //         $movie->category_id = 9;
    //     }elseif($json['movie']['type'] == 'hoathinh'){
    //         $movie->category_id = 18;
    //     }elseif($json['movie']['type'] == 'tvshows'){
    //         $movie->category_id = 11;
    //     }elseif(isset($json['movie']['chieurap']) && $json['movie']['chieurap'] == true){
    //         $movie->category_id = 2;
    //     }
    //     else{
    //         $movie->category_id = 1;
    //     }
    //     $country = Country::all();
    //     foreach($country as $key => $value){
    //         if($value->slug == $json['movie']['country']['slug']){
    //             $movie->country_id = $value->id;
    //         }
    //     }
    //     $movie->subtitle = $json['movie']['origin_name'];
    //     $movie->slug = $json['movie']['slug'];
    //     $movie->resolution = $json['movie']['quality'];
    //     $movie->release = $json['movie']['year'];
        
    //     $duration = $json['movie']['time'];
    //     if (preg_match('/(\d+)/', $duration, $matches)) {
    //         $movie->duration = (int)$matches[1];
    //     }
    //     $episodes = $json['movie']['episode_total'];
    //     if (preg_match('/(\d+)/', $episodes, $matches)) {
    //         $movie->episodes = (int)$matches[1];
    //     }
    //     $movie->title_en = $data['title_en'];
    //     $movie->director = $data['director'];
    //     $movie->actor = $data['actor'];
    //     $movie->trailer = $data['trailer'];

        
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if((file_exists('uploads/thumb/' . $movie->img))){
            unlink('uploads/thumb/' . $movie->img);
        }
        Movie_genre::whereIn('movie_id', [$movie->id])->delete();

        Episode::whereIn('movie_id', [$movie->id])->delete();

        $movie->delete();
        return redirect()->back()->with('success','Xóa phim thành công !');
    }
}
