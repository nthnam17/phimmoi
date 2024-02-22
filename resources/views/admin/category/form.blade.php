@extends('layouts.app')

@section('content')
<div class="container" style="margin: 10px;">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                @if(!isset($category))
                    <h1 class="card-header text-center">Tạo Danh Mục</h1>
                @else
                    <h1 class="card-header text-center">Cập nhật Danh Mục</h1>
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
                    @if(!isset($category))
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
