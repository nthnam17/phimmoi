@extends('layouts.app')

@section('content')
<div class="" style="display: flex; align-items: center;">
  <h1 style="padding: 10px 0;">Thêm phim bằng API</h1>
</div>
<table class="table">
    @php
      print_r($data_movie['category'][0]);
    @endphp
    <thead>
      {{-- <tr>
        <th scope="col"></th>
        <th scope="col">Tên thể loại</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Slug</th>
        <th scope="col">Active</th>
        <th scope="col">Tùy chỉnh</th>
      </tr> --}}
    </thead>
    <tbody>
        {{-- @foreach($data as $key => $value)
        <tr>
            <th scope="row">Tên Phim</th>
            <td>{{$value['name']}}</td>
        </tr>
        <tr>
            <th scope="row">Slug</th>
            <td>{{$value['slug']}}</td>
        </tr>
        <tr>
            <th scope="row">Tên tiếng anh </th>
            <td>{{$value['origin_name']}}</td>
        </tr>
        <tr>
          <th scope="row">Danh mục </th>
          @if($value['type'] == 'series')
            <td>Phim Bộ</td>
          @elseif($value['type'] == 'single')
            <td>Phim Lẻ</td>
          @elseif($value['type'] == 'hoathinh')
            <td>Phim Hoạt Hình</td>
          @elseif($value['type'] == 'tvshows')
            <td>TV Show</td>
          @elseif(isset($value['chieurap']) && $value['chieurap'] ==  true)
            <td>Phim Chiếu Rạp</td>
          @endif
      </tr>
      <tr>
        <th scope="row">Thời lượng</th>
        <td>
          @php
            $duration = $value['time'];
            if (preg_match('/(\d+)/', $duration, $matches)) {
                $duration_val = (int)$matches[1];
                echo $duration_val;
            }
          @endphp
        </td>
      </tr>
      <tr>
        <th scope="row">Tổng tập</th>
        <td>
          @php
          $episodes = $value['episode_total'];
          if (preg_match('/(\d+)/', $episodes, $matches)) {
              $episode_total = (int)$matches[1];
              echo $episode_total;
          }
          @endphp
        </td>
      </tr>
      <tr>
        <th scope="row">Quốc gia</th>
          @foreach ($country_viewAll as $key => $val)
            @if($val->slug == $value['country'][0]['slug'])
              <td>{{$val->id}}</td>
            @endif
          @endforeach
      </tr>
      <tr>
        <th scope="row">Diễn viên</th>
        @php
          // print_r($value['actor'][0])
          $actor_arr = $value['actor'];
          $actor = implode(',',$actor_arr);
        @endphp
         <td>{{$actor}}</td>
      </tr>
      <tr>
        <th scope="row">Thể loại</th>
          @foreach($genre_viewAll as $key => $val)
            @if($val->slug == $value['category'][0]['slug'])
              <td>{{$val->id}}</td>
            @endif
          @endforeach
      </tr>
        @endforeach --}}
    </tbody>
  </table>
@endsection