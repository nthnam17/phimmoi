<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use Carbon\Carbon;
use Storage;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.episode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie_id = $_GET['movie_id'];
        $ep = $_GET['ep'];
        // $movie = Movie::find($movie_id);
        // $episode = Episode::with('movie')->where('movie_id',$movie_id)->first();
        // return response()->json($episode);
        $movie = Movie::find($movie_id);
        return view('admin.episode.form',compact('movie_id','ep','movie'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $episode = new Episode();
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $episode->link = $data['link'];
        $episode->movie_id = $data['movie_id'];
        $episode->episode = $data['episode'];
        $episode->type = $data['type'];
        $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update_time = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->save();
        $episode->save();
        return redirect()->route('episode.show',$data['movie_id'])->with('success','Tạo tập phim thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::find($id);
        $episode = Episode::orderBy('episode','DESC')->where('movie_id',$id)->get();
        $episode_list = Episode::where('movie_id',$id)->get();
        $episode_count = $episode_list->count();
        return view('admin.episode.show',compact('episode','movie','episode_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $episode = Episode::with('movie')->where('id',$id)->first(); 
        // return response()->json($episode);
        $ep = $episode->episode;
        $movie = Movie::find($episode->movie_id);
        return view('admin.episode.form',compact('episode','ep','movie'));
        
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
        $episode = Episode::find($id);
        $data = $request->all();
        $episode->link = $data['link'];
        $episode->movie_id = $data['movie_id'];
        $episode->episode = $data['episode'];
        $episode->type = $data['type'];
        $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $episode->save();
        return redirect()->route('episode.show',$data['movie_id'])->with('success','Tạo tập phim thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Episode::find($id)->delete();
        return redirect()->back();
    }
}
