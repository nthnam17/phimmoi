<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderBy('position','ASC')->get();
        return view('admin.category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        // $data = $request->all();
        $data = $request->validate(
            [
                'title' => 'required|unique:categories|max:255',
                'slug' => 'required|unique:categories|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'title.unique' => 'Tên danh mục đã tồn tại',
                'slug.unique' => 'slug danh mục đã tồn tại',
                'title.required' => 'Tên danh mục không được bỏ trống',
                'description.required' => 'Mo tả danh mục không được bỏ trống',
                'status.required' => 'Vui lòng co biết danh mục có hiển thị hay không ?',
            ]
    );
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->save();
        toastr()->timeOut(1000)->addSuccess('Thêm mới danh mục thành công','Thêm danh mục');
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
        $category = Category::find($id);
        $list = Category::all();
        return view('admin.category.form',compact('category','list'));
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
        $category =  Category::find($id);
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug' => 'required|max:255',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'description' => 'required',
                'status' => 'required',
            ],
            [
                'title.required' => 'Tên danh mục không được bỏ trống',
                'description.required' => 'Mo tả danh mục không được bỏ trống',
                'status.required' => 'Vui lòng co biết danh mục có hiển thị hay không ?',
            ]
    );
        // $data = $request->all();
        $category->title = $data['title'];
        $category->description = $data['description'];
        $category->status = $data['status'];
        $category->slug = $data['slug'];
        $category->save();
        toastr()->timeOut(1000)->addInfo('Sửa danh mục thành công','Sửa danh mục');
        return redirect('/category/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        toastr()->timeOut(1000)->addError('Xóa danh mục thành công','Xóa danh mục');
        return redirect()->back();
    }

    public function resorting (Request $request){
        $data = $request->all();
        foreach ($data['array_id'] as $key => $val) {
            $category = Category::find($val);
            $category->position = $key;
            $category->save();
        }
    }
}
