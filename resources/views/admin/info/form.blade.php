@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card">
                @if(!isset($info))
                    <div class="card-header">Thêm thông tin website</div>
                @else
                    <div class="card-header">Thêm thông tin Website</div>
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
                    @if(!isset($info))
                        {!! Form::open(['method' => 'POST', 'route' => 'info.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['method' => 'PUT', 'route' => ['info.update',$info->id] , 'class' => 'form-horizontal' ,'enctype' => 'multipart/form-data']) !!} 
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label('title', 'Tiêu đề website') !!}
                    {!! Form::text('title', isset($info) ? $info->title : '', ['class' => 'form-control','id' => 'slug', 'onkeyup' => 'ChangeToSlug()' ]) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {!! Form::label('description', 'Mô tả') !!}
                    {!! Form::textarea('description', isset($info) ? $info->description : '', ['class' => 'form-control', 'rows' => '3']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fanpage', 'Footer Social') !!}
                        {!! Form::textarea('fanpage', isset($info) ? $info->fanpage : '', ['class' => 'form-control', 'rows' => '3']) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('image', 'Logo website') !!}
                                {!! Form::file('image', ['class' => 'form-control-file']) !!}
                            </div>
                            @if(isset($info))
                            <div class="form-group">
                                 <img src="{{asset('uploads/logo/'.$info->logo)}}" alt="" width="40%">
                            </div>
                            @endif
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('icon', 'Icon shorts website') !!}
                                {!! Form::file('icon', ['class' => 'form-control-file']) !!}
                            </div>
                            @if(isset($info))
                            <div class="form-group">
                                 <img src="{{asset('uploads/logo/'.$info->icon)}}" alt="" width="10%">
                             </div> 
                            @endif
                        </div>
                    </div>
                    
                    <div class="btn-group pull-right">
                    {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
                    @if(!isset($info))
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
