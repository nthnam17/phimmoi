@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card">
                @if(!isset($movie))
                <div class="d-flex card-header justify-content-between align-items-center">
                    {{-- <div class="">Thêm mới Phim</div> --}}
                    <h1 style="padding: 10px 0;">Thêm mới Phim</h1>

                    {{-- <a href="{{route('movie.index')}}" class="btn btn-primary">Danh sách</a> --}}
                </div>
                @else
                    {{-- <div class="card-header">Cập nhật phim</div> --}}
                    <h1 style="padding: 10px 0;">Cập nhật phim</h1>

                @endif

                <div class="card-body">
                    @if(!isset($movie))
                        {!! Form::open(['method' => 'POST', 'route' => 'movie.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['method' => 'PUT', 'route' => ['movie.update',$movie->id] , 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label('title', 'Tên phim') !!}
                    {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'required' => 'required','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_en', 'Tên phim(Tiếng anh)') !!}
                        {!! Form::text('title_en', isset($movie) ? $movie->title_en : '', ['class' => 'form-control', 'required' => 'required' ]) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        {!! Form::label('slug', 'Slug phim') !!}
                        {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'required' => 'required', 'id' => 'convert_slug']) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('director', 'Đạo diễn') !!}
                        {!! Form::text('director', isset($movie) ? $movie->director : '', ['class' => 'form-control' ]) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('actor', 'Diễn viên') !!}
                        {!! Form::textarea('actor', isset($movie) ? $movie->actor : '', ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('trailer', 'Trailer') !!}
                        {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control', 'required' => 'required' ]) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', 'Mô tả') !!}
                    {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('status', 'Active') !!}
                        {!! Form::select('status', ['2' => 'Sắp chiếu','1' => 'Hiển thị', '0' => 'Ẩn đi'],isset($movie) ? $movie->status : '', ['id' => 'status', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('trending', 'Trending') !!}
                        {!! Form::select('trending', ['1' => 'Hot trend', '0' => 'Down trend'],isset($movie) ? $movie->trending : '', ['id' => 'trending', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                   
                    <div class="form-group">
                        {!! Form::label('', 'Thể loại') !!} <br/>
                        
                        @foreach($list_genre as $key => $val)
                                <div class="form-group form-check form-check-inline{{ $errors->has('checkbox_id') ? ' has-error' : '' }}">
                                    @if(isset($movie))
                                        {!! Form::checkbox('genre[]',$val->id, isset($movie_genre) && $movie_genre->contains($val->id) ? true : false, ['id' => 'checkbox_id', 'class' => 'form-check-input']) !!}
                                        {!! Form::label('genre', $val->title , ['class' => 'form-check-label']) !!}
                                    @else
                                        {!! Form::checkbox('genre[]',$val->id, null, ['id' => 'checkbox_id', 'class' => 'form-check-input']) !!}
                                        {!! Form::label('genre', $val->title , ['class' => 'form-check-label']) !!}
                                    @endif
                                </div>
                        @endforeach
                        {{-- <small class="text-danger">{{ $errors->first('checkbox_id') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category_id', 'Danh mục') !!}
                        {!! Form::select('category_id',$category,isset($movie) ? $movie->category_id : null ,['id' => 'category_id', 'class' => 'form-control', 'required' => 'required']) !!}
                            {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country_id', 'Quốc gia') !!}
                        {!! Form::select('country_id',$country, isset($movie) ? $movie->country_id : null,['id' => 'country_id', 'class' => 'form-control', 'required' => 'required']) !!}
                                {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'Phụ đề') !!}
                        {!! Form::select('subtitle', ['0' => 'Vietsub' , '1' => 'Thuyết minh', '2' => 'Ensub'],isset($movie) ? $movie->subtitle : '', ['id' => 'subtitle', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('resolution', 'Độ phân giải') !!}
                        {!! Form::select('resolution', ['0' => '4K', '1' => '2K','2' => 'FullHD','3' => 'HD','4' => 'SD','5' => 'CAM',],isset($movie) ? $movie->resolution : '', ['id' => 'resolution', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('release', 'Năm phát hành') !!}
                        {!! Form::selectYear('release','2000',$year_now,isset($movie) ? $movie->release : '', ['id' => 'trending', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('duration', 'Thời lượng(Đơn vị: Phút/Tập )') !!}
                        {!! Form::text('duration', isset($movie) ? $movie->duration : '', ['class' => 'form-control', 'required' => 'required','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episodes', 'Số tập') !!}
                        {!! Form::text('episodes', isset($movie) ? $movie->episodes : '', ['class' => 'form-control', 'required' => 'required','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
                    </div>
                    <div class="form-group">
                    {!! Form::label('img', 'Ảnh phim') !!}
                    {!! Form::file('img', ['class' => 'form-control-file']) !!}
                    </div>
                    @if(isset($movie))
                       <div class="form-group">
                            <img src="{{asset('uploads/thumb/'.$movie->img)}}" alt="" width="20%">
                        </div> 
                    @endif
                    <div class="btn-group pull-right">
                    {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
                    @if(!isset($movie))
                        {!! Form::submit('Tạo mới', ['class' => 'btn btn-success']) !!}
                    @else
                    <div class="form-group">
                        {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                        <a class="btn btn-secondary" href="{{route('movie.index')}}">Trở về</a>
                    </div>
                        
                    @endif
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
