@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            
            <div class="card">
                @if(!isset($genre))
                    <div class="card-header">Tạo thể loại</div>
                @else
                    <div class="card-header">Cập nhật thể loại</div>
                @endif
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
                    <div class="btn-group pull-right">
                    {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
                    @if(!isset($genre))
                        {!! Form::submit('Tạo mới', ['class' => 'btn btn-success']) !!}
                    @else
                        {!! Form::submit('Cập nhật', ['class' => 'btn btn-success']) !!}
                    @endif
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
