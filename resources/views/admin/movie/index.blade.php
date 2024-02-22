@php 
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    $now = Carbon::now('Asia/Ho_Chi_Minh');
@endphp

@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card mb-3">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div class="">Danh Sách Phim</div>
                    <a href="{{route('movie.create')}}" class="btn btn-success">Thêm mới </a>
                </div>
                
    
                <div class="card-body">
                    
    
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="" style="display: flex; align-items: center;">
    <h1 style="padding: 10px 0;">Danh sách phim</h1>
    <div class="" style="margin-left: 32px">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalLeech">
        Thêm phim API
      </button>
    </div>
    
</div>
<table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tên Phim</th>
        <th scope="col">Thumb</th>
        <th scope="col">Tiến trình</th>
        <th scope="col">Cập nhập gần nhất</th>
        <th scope="col">Slug</th>
        <th scope="col">Danh mục</th>
        <th scope="col">Thể loại</th>
        <th scope="col">Quốc gia</th>
        <th scope="col">Active</th>
        <th scope="col">Trending</th>
        <th scope="col">Tùy chỉnh</th>
      </tr>
    </thead>
    <tbody>
        @foreach($list as $key => $val)
      <tr>
        <th scope="row">{{$val->id}}</th>
        <td>{{$val->title}}</td>
        @php
          $check_img = substr($val->img, 0,5);
        @endphp
        <td>
            @if($check_img == 'https')
              <img width="50%" src="{{$val->img}}" alt="{{$val->title}}">
            @else
              <img width="50%" src="{{asset('uploads/thumb/'.$val->img)}}" alt="{{$val->title}}">
            @endif
        </td>
        <td>{{$val->episode_count}}/{{$val->episodes}}</td>
        <td>
            @if(!isset($val->create_time))
            {{Carbon::parse($val->create_time)->diffForHumans($now)}}
            @else
                @php
                    $dt = Carbon::create(2020, 10, 18, 14, 40, 16);
                    echo $dt->diffForHumans($now);
                @endphp
            @endif

        </td>
        <td>{{$val->slug}}</td>
        <td>{{$val->category->title}}</td>
        @php
            $genre_arr = explode(',', $val->genre_id);
        @endphp
        <td>
        @foreach($val->movie_genre as $key => $genre)
        
        <span class="badge badge-info">{{$genre->title}}</span>
        @endforeach
        </td>
        
        <td>{{$val->country->title}}</td>
        <td>
            @if($val->status == 1)
                Hiển thị
            @elseif($val->status == 0)
                Ẩn đi
            @else
                Sắp chiếu
            @endif
        </td>
        <td>
            {{-- @if($val->trending == 1)
                Hot trend
            @else
                Down trend
            @endif --}}
            <div class="form-group{{ $errors->has('trending_choose') ? ' has-error' : '' }}">
            {{-- {!! Form::label('trending_choose', 'Input label') !!} --}}
            {!! Form::select('trending_choose', ['2' => 'Sắp Chiếu','1' => 'Đang hot', '0' => 'Giảm nhiệt'], $val->trending, ['id' => $val->id, 'class' => 'form-control trending_choose', 'required' => 'required']) !!}
            {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
            </div>
        </td>
        <td>
            <a href="{{route('episode.show', $val->id)}}"  class="btn btn-success mb-2">Thêm tập</a>
            <a href="{{route('movie.edit', $val->id)}}"  class="btn btn-primary mb-2">Chi tiết</a>
            {!! Form::open(['method' => 'DELETE', 'route' => ['movie.destroy', $val->id], 'class' => 'form-horizontal', 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa ?")']) !!}
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
<div class="modal fade" id="modalLeech" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Thêm mới phim bằng API</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center">
               
                     <div class="" style="display: flex;justify-content: space-around;">
                    <input id="movieApiInput" class="form-control me-2 w-75" type="search" placeholder="Nhập đường dẫn API của phim" aria-label="Search" style="width: 70%;">
                    <a id="movieApiBtn" class="btn btn-success w-25 mx-2">Thêm mới</a>
                    </div>
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          {{-- {!! Form::submit('Tạo mới', ['class' => 'btn btn-success']) !!} --}}
        </div>
          
          {{-- {!! Form::close() !!} --}}
      </div>
    </div>
  </div>
@endsection
