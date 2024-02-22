<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use App\models\Genre;
use App\models\Country;
use App\models\Movie;
use App\models\Movie_genre;
use App\models\Episode;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // $day_now = Carbon::now('Asia/Ho_Chi_Minh')->month();
        // $movie_test = Movie::all()->first();
        // return response()->json($movie_test);
        // $model->visitLogs()->count();
        // visitor()->visit();
        // $request->visitor()->browser();
        if( Auth::user()->role_as == 1) {
            // return redirect()->route('home')->with('success', 'Đăng nhập thành công với quyền quản trị viên');
            return view('home');
        }else {
            return redirect('/')->with('error', 'Bạn không có quyền quản trị viên ');
        }

    }

    
}
