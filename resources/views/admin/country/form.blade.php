@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">

            <div class="card">
                @if(!isset($country)) 
                    <div class="card-header">Quốc gia</div>
                @else
                    <div class="card-header">Cập nhật quốc gia</div>
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
                    @if(!isset($country))
                        {!! Form::open(['method' => 'POST', 'route' => 'country.store', 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'PUT', 'route' => ['country.update',$country->id] , 'class' => 'form-horizontal']) !!}
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label('title', 'Tên quốc gia') !!}
                    {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control','id' => 'slug','onkeyup' => 'ChangeToSlug()' ]) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        {!! Form::label('slug', 'Slug quốc gia') !!}
                        {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control','id' => 'convert_slug']) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                        </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', 'Mô tả') !!}
                    {!! Form::textarea('description', isset($country) ? $country->description : '', ['class' => 'form-control', 'rows' => '3']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('statu') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Active') !!}
                    {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Ẩn đi'],isset($country) ? $country->status : null, ['id' => 'status', 'class' => 'form-control']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="btn-group pull-right">
                    {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
                    @if(!isset($country))
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
