@php 
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card mb-3">
                <div class="" style="display: flex; align-items: center;">
                    <h2 class="" style="padding: 10px 0;">Quản lý tập phim</h2>
                    <div class="" style="margin-left: 32px">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#leechEpisode">
                        Thêm phim API
                      </button>
                    </div>
                </div>
                
    
                <div class="card-body">
                    <div class="container">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Gần nhất</th>
                                <th scope="col">Tập</th>
                              </tr>
                            </thead>
                            <tbody >
                              <tr>
                                <td>
                                  @php
                                    $check_img = substr($movie->img, 0, 5);
                                  @endphp
                                  @if($check_img == 'https')
                                  <img style="width: 20%" src="{{$movie->img}}" alt="">
                                  @else
                                  <img style="width: 20%" src="{{asset('uploads/thumb/'.$movie->img)}}" alt="">
                                  @endif
                                </td>
                                <td>{{$movie->title}}</td>
                                <td>{{$movie->update_time}}</td>
                                <td>{{$episode_count}}/{{$movie->episodes}}</td>
                              </tr>
                            </tbody>
                          </table>
                          @php
                            $movie_id = $movie->id;
                          @endphp
                    </div>
                    <div class="contaier mt-5">
                        <h4>Thêm mới link : </h4> <br/>
                        @for($i = 1; $i <= $movie->episodes; $i++)
                          
                            @if($i <= $episode_count)                        
                              <a href="#"  class="btn btn-primary m-1">{{$i}}</a>
                            @else
                              <a href="{{route('episode.create',['movie_id' => $movie_id , 'ep' => $i])}}" class="btn btn-success m-1">{{$i}}</a>
                            @endif
                          
                        @endfor
                    </div>
                    
                </div>
            </div>

            <div class="card mb-3">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div class="">Xử lý tập phim</div>
                </div>
    
                <div class="card-body">
                    <div class="container">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gần nhất</th>
                                <th scope="col">Link</th>
                                <th scope="col">Nguồn</th>
                                <th scope="col">Tùy chọn</th>
                              </tr>
                            </thead>
                            <tbody >
                            @foreach($episode as $key => $val)
                              <tr>
                                <th scope="row">{{$val->episode}}</th>
                                <td>{{$val->updated_at}}</td>
                                <td style="width: 20%;">{!!$val->link!!}</td>
                                @if($val->type == 0)
                                    <td>Youtube</td>
                                @elseif($val->type == 1)
                                    <td>Ổ Phim</td>
                                @elseif($val->type == 2)
                                    <td>Hyrax</td>
                                @else
                                    <td>Khác</td>
                                @endif
                                <td>
                                    <a href="{{route('episode.edit', $val->id)}}"  class="btn btn-primary mb-2">Sửa</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['episode.destroy', $val->id], 'class' => 'form-horizontal', 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa ?")']) !!}
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
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="leechEpisode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm tập phim nhanh bằng API</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="d-flex justify-content-center">
                 
                       <div class="" style="display: flex;justify-content: space-around;">
                      <input id="episodeApiInput" class="form-control me-2 w-75" type="search" placeholder="Nhập đường dẫn API của phim" aria-label="Search" style="width: 70%;">
                      <a id="episodeApiBtn" class="btn btn-success w-25 mx-2">Thêm mới</a>
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
