@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card">
                @if(!isset($episode))
                    <div class="card-header">Phim {{$movie->title}} Tập  {{$ep}}</div>
                @else
                    <div class="card-header">Cập nhật Phim {{$movie->title}} Tập  {{$ep}}</div>
                @endif

                <div class="card-body">
                    @if(!isset($episode))
                        {!! Form::open(['method' => 'POST', 'route' => 'episode.store', 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'PUT', 'route' => ['episode.update',$episode->id] , 'class' => 'form-horizontal']) !!}
                    @endif

                    <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                        {!! Form::label('movie_id', 'ID Phim') !!}
                        {!! Form::text('movie_id', isset($episode) ? $episode->movie_id : $movie_id, ['class' => 'form-control', 'required' => 'required']) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('episode') ? ' has-error' : '' }}">
                        {!! Form::label('episode', 'Tập số') !!}
                        {!! Form::text('episode', isset($episode) ? $episode->episode : $ep, ['class' => 'form-control', 'required' => 'required' ]) !!}
                        {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                    {!! Form::label('link', 'Link tập phim') !!}
                    {!! Form::text('link', isset($episode) ? $episode->link : '', ['class' => 'form-control', 'required' => 'required' ]) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', 'Nguồn link') !!}
                        {!! Form::select('type', ['0' => 'Youtube' , '1' => 'Ổ Phim', '2' => 'Hyrax'],isset($episode) ? $episode->type : '', ['id' => 'type', 'class' => 'form-control', 'required' => 'required']) !!}
                    {{-- <small class="text-danger">{{ $errors->first('inputname') }}</small> --}}
                    </div>
                    <div class="btn-group pull-right">
                    {{-- {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!} --}}
                    @if(!isset($episode))
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
