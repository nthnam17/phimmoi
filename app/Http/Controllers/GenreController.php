<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genre.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = new Genre();
        $data = $request->validate(
            [
                'title' => 'required|unique:genres|max:255',
                'slug' => 'required|unique:genres|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'title.unique' => 'Tên thể loại đã tồn tại',
                'slug.unique' => 'slug thể loại đã tồn tại',
                'title.required' => 'Tên thể loại không được bỏ trống',
                'description.required' => 'Mo tả thể loại không được bỏ trống',
                'status.required' => 'Vui lòng co biết thể loại có hiển thị hay không ?',
            ]
    );
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        toastr()->timeOut(1000)->addSuccess('Xoa thể loại thành công','Thêm thể loại');
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form',compact('genre','list'));
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
        $genre =  Genre::find($id);
        // $data = $request->all();
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug' => 'required|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Tên thể loại không được bỏ trống',
                'description.required' => 'Mo tả thể loại không được bỏ trống',
                'status.required' => 'Vui lòng co biết thể loại có hiển thị hay không ?',
            ]
    );
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        toastr()->timeOut(1000)->addInfo('Sửa thể loại thành công','Sửa thể loại');
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        toastr()->timeOut(1000)->addError('Xóa thể loại thành công','Xóa thể loại');
        return redirect()->back();
    }
}
