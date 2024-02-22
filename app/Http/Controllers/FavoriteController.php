<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Movie;

class FavoriteController extends Controller
{


    public function favorites_add (Request $request) {
        $slug = $request->slug;
        $movie = Movie::where('slug', $slug)->first();
        $movie_id = $movie->id;
        $check = '';
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $check_fav = Favorite::where('user_id', $user_id)->where('movie_id', $movie_id)->first();
            if($check_fav){
                $id_fav = $check_fav->id;
                Favorite::find($id_fav)->delete();
                $check = 1;
            }else {
                $fav = new Favorite();
                $fav->user_id = $user_id;
                $fav->movie_id = $movie_id;
                $fav->save();
                $check = 0;
            }
        }else {
            $check = 2;
        }
        return $check;
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
