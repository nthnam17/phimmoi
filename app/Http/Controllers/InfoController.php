<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Carbon\Carbon;
use Storage;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class InfoController extends Controller
{
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
        $info = Info::find(1);
        return view('admin.info.form',compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $info = new Info();
        $data = $request->validate(
            [
                'title' => 'required|unique:genres|max:255',
                // 'image' => 'required|img|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'fanpage' => 'required',
            ],
            [
                'title.unique' => 'Tên thể loại đã tồn tại',
                // 'slug.unique' => 'slug thể loại đã tồn tại',
                'title.required' => 'Tên thể loại không được bỏ trống',
                'description.required' => 'Mô tả không được bỏ trống',
                'fanpage.required' => 'vui lòng không được bỏ trống',
                
            ]
    );
        $info->title = $data['title'];
        $info->description = $data['description'];
        $info->fanpage = $data['fanpage'];
        $get_image = $request->file('image');
        // return response()->json($request->file);
        $path = 'uploads/logo/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image));    //[0] => hinhanh1 . [1] => jpg
            $new_image = $name_image.rand(0,9900).'.'.$get_image->getClientOriginalExtension(); // hinhanh2356.jpg
            $get_image->move($path,$new_image);
            $info->logo = $new_image;
        }
        $info->save();
        toastr()->timeOut(1000)->addSuccess('Thêm mới thành công','Thông tin Website');
        return redirect()->back();
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
        $info = Info::find(1);
        return view('admin.info.form',compact('info'));
        
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
        $info = Info::find(1);
        $data = $request->validate(
            [
                'title' => 'required|unique:genres|max:255',
                // 'image' => 'required|img|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'fanpage' => 'required',
            ],
            [
                'title.unique' => 'Tên thể loại đã tồn tại',
                // 'slug.unique' => 'slug thể loại đã tồn tại',
                'title.required' => 'Tên thể loại không được bỏ trống',
                'description.required' => 'Mô tả không được bỏ trống',
                'fanpage.required' => 'vui lòng không được bỏ trống',
            ]
    );
        $info->title = $data['title'];
        $info->description = $data['description'];
        $info->fanpage = $data['fanpage'];
        $get_image = $request->file('image');
        // return response()->json($request->file);
        $path = 'uploads/logo/';
        if($get_image){
            if(file_exists('uploads/logo/'.$info->logo)){
                unlink('uploads/logo/'.$info->logo);
            }
            $get_name_image = $get_image->getClientOriginalName(); //hinhanh1.jpg
            $name_image = current(explode('.',$get_name_image));    //[0] => hinhanh1 . [1] => jpg
            $new_image = $name_image.rand(0,9900).'.'.$get_image->getClientOriginalExtension(); // hinhanh2356.jpg
            $get_image->move($path,$new_image);
            $info->logo = $new_image;
        }

        $get_icon = $request->file('icon');
        if($get_icon){
            if(file_exists('uploads/logo/'.$info->icon)){
                unlink('uploads/logo/'.$info->icon);
            }
            $get_name_icon = $get_icon->getClientOriginalName(); //hinhanh1.jpg
            $name_icon = current(explode('.',$get_name_icon));    //[0] => hinhanh1 . [1] => jpg
            $new_icon = $name_icon.'-icon'.rand(0,9900).'.'.$get_icon->getClientOriginalExtension(); // hinhanh2356.jpg
            $get_icon->move($path,$new_icon);
            $info->icon = $new_icon;
        }

        $info->save();
        toastr()->timeOut(1000)->addSuccess('Cập nhập website thành công','Cập nhập Website');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
