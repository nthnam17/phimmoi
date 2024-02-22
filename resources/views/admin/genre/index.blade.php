@extends('layouts.app')

@section('content')
<div class="" style="display: flex; align-items: center;">
  <h1 style="padding: 10px 0;">Thể loại phim</h1>
  <div class="" style="margin-left: 32px">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
      Thêm mới thể loại
    </button>
  </div>
  
</div>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên thể loại</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Slug</th>
        <th scope="col">Active</th>
        <th scope="col">Tùy chỉnh</th>
      </tr>
    </thead>
    <tbody>
        @foreach($list as $key => $gen)
      <tr>
        <th scope="row">{{$gen->id}}</th>
        <td>{{$gen->title}}</td>
        <td>{{$gen->description}}</td>
        <td>{{$gen->slug}}</td>
        <td>
            @if($gen->status == 1)
                Hiển thị
            @else
                Ẩn đi
            @endif
        </td>
        <td>
            <a href="{{route('genre.edit', $gen->id)}}"  class="btn btn-primary">Sửa</a>
        </td>
        <td>
            {!! Form::open(['method' => 'DELETE', 'route' => ['genre.destroy', $gen->id], 'class' => 'form-horizontal', 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa ?")']) !!}
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
          {{-- @if(!isset($genre))
              <div class="card-header">Tạo thể loại</div>
          @else
              <div class="card-header">Cập nhật thể loại</div>
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
              @if(!isset($genre))
                  {!! Form::open(['method' => 'POST', 'route' => 'genre.store', 'class' => 'form-horizontal']) !!}
              @else
                  {!! Form::open(['method' => 'PUT', 'route' => ['genre.update',$genre->id] , 'class' => 'form-horizontal']) !!}
              @endif

              <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              {!! Form::label('title', 'Tên thể loại') !!}
              {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                  {!! Form::label('slug', 'Slug thể loại') !!}
                  {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'id' => 'convert_slug']) !!}
                  {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              {!! Form::label('description', 'Mô tả') !!}
              {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['class' => 'form-control', 'rows' => '3']) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
              </div>
              <div class="form-group{{ $errors->has('statu') ? ' has-error' : '' }}">
              {!! Form::label('status', 'Active') !!}
              {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Ẩn đi'],isset($genre) ? $genre->status : null, ['id' => 'status', 'class' => 'form-control']) !!}
              {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
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