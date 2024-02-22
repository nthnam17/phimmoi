<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::all();
        return view('admin.country.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country();
        // $data = $request->all();
        $data = $request->validate(
            [
                'title' => 'required|unique:countries|max:255',
                'slug' => 'required|unique:countries|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'title.unique' => 'Tên quốc gia đã tồn tại',
                'slug.unique' => 'slug quốc gia đã tồn tại',
                'title.required' => 'Tên quốc gia không được bỏ trống',
                'description.required' => 'Mo tả quốc gia không được bỏ trống',
                'status.required' => 'Vui lòng co biết quốc gia có hiển thị hay không ?',
            ]
    );
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->slug = $data['slug'];
        $country->save();
        toastr()->timeOut(1000)->addSuccess('Thêm mới quốc gia thành công','Thêm quốc gia');

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
        $country = Country::find($id);
        $list = Country::all();
        return view('admin.country.form',compact('country','list'));
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
        $country = Country::find($id);
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
                'title.required' => 'Tên quốc gia không được bỏ trống',
                'description.required' => 'Mo tả quốc gia không được bỏ trống',
                'status.required' => 'Vui lòng co biết quốc gia có hiển thị hay không ?',
            ]
    );
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->slug = $data['slug'];
        $country->save();
        toastr()->timeOut(1000)->addInfo('Sửa quốc gia thành công','Sửa quốc gia');
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
        Country::find($id)->delete();
        toastr()->timeOut(1000)->addError('Xóa quốc gia thành công','Xóa quốc gia');

        return redirect()->back();
    }
}
