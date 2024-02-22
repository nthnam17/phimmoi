@extends('layouts.app')

@section('content')


<div class="" style="display: flex; align-items: center;">
  <h1 style="padding: 10px 0;">Danh mục phim</h1>
  <div class="" style="margin-left: 32px">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
      Thêm mới danh mục
    </button>
  </div>
  
</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên danh muc</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Slug</th>
        <th scope="col">Active</th>
        <th scope="col">Tùy chỉnh</th>
      </tr>
    </thead>
    <tbody class="order_position">
        @foreach($list as $key => $cat)
      <tr id="{{$cat->id}}">
        <th scope="row">{{$cat->position + 1}}</th>
        <td>{{$cat->title}}</td>
        <td>{{$cat->description}}</td>
        <td>{{$cat->slug}}</td>
        <td>
            @if($cat->status == 1)
                Hiển thị
            @else
                Ẩn đi
            @endif
        </td>
        <td>
            <a href="{{route('category.edit', $cat->id)}}"  class="btn btn-primary mb-2">Sửa</a>

            {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $cat->id], 'class' => 'form-horizontal', 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa ?")']) !!}
            <div class="btn-group pull-right">
            {!! Form::submit("Xóa", ['class' => 'btn btn-danger']) !!}
            {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
            </div>
            {!! Form::close() !!}
        </td>
        
        
      </tr>
        @endforeach
    </tbody>
  </table>
  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm mới danh mục</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card" style="padding: 10px;">
          {{-- @if(!isset($category))
              <h1 class="card-header text-center">Tạo Danh Mục</h1>
          @else
              <h1 class="card-header text-center">Cập nhật Danh Mục</h1>
          @endif --}}
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="card-body">
              @if(!isset($category))
                  {!! Form::open(['method' => 'POST', 'route' => 'category.store', 'class' => 'form-horizontal']) !!}
              @else
                  {!! Form::open(['method' => 'PUT', 'route' => ['category.update',$category->id] , 'class' => 'form-horizontal']) !!}
              @endif

              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              {!! Form::label('title', 'Tên danh mục') !!}
              {!! Form::text('title', isset($category) ? $category->title : '', ['class' => 'form-control','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                  {!! Form::label('slug', 'Slug danh mục') !!}
                  {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'id' => 'convert_slug']) !!}
                  {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              {!! Form::label('description', 'Mô tả') !!}
              {!! Form::textarea('description', isset($category) ? $category->description : '', ['class' => 'form-control', 'rows' => '3']) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('statu') ? ' has-error' : '' }}">
              {!! Form::label('status', 'Active') !!}
              {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Ẩn đi'],isset($category) ? $category->status : null, ['id' => 'status', 'class' => 'form-control']) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="btn-group pull-right">
              {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
              {{-- @if(!isset($category))
                  
              @else
                  {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
              @endif --}}
              </div>
              

          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        {!! Form::submit('Tạo mới', ['class' => 'btn btn-success']) !!}
      </div>
        
        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection