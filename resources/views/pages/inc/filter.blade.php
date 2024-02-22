
    <form action="{{route('filter')}}" method="GET">
                
        <div class="col-md-2">
        <div class="form-group">
            <select class="form-control stylish_filter" name="order">
            <option value ="">--Sắp xếp--</option>
            <option value="name">--Tên phim--</option>
            <option value="views">--Lượt xem--</option>
            <option value="date">--Năm sản xuất--</option>
            </select>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            <select class="form-control stylish_filter" name="genre">
                <option value ="">--Thể loại--</option>
                @foreach($genre_viewAll as $key => $val)
                    <option {{ isset($_GET['genre']) && $_GET['genre'] == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->title}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            <select class="form-control stylish_filter" name="country" >
                <option value ="">--Quốc gia--</option>
                @foreach($country_viewAll as $key => $val)
                    <option {{ isset($_GET['country']) && $_GET['country'] == $val->id ? 'selected' : ''}} value="{{$val->id}}">{{$val->title}}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="col-md-2">
        <div class="form-group">
            {!! Form::selectYear('year','2010',$year_now, isset($_GET['year']) ? $_GET['year'] : null, ['id' => 'trending', 'class' => 'form-control stylish_filter', 'placeholder' => '--Năm phim--']) !!}
        </div>
        </div>
    <div class="col-md-2 ">
        <button class="btn-filter" style="" type="submit">Lọc phim</button>
    </div>


    </form>