@php 
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col">
            <div class="card mb-3">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h3 class="" style="padding: 10px 0;">Tìm Kiếm Phim</h2>
                </div>
                
    
                <div class="card-body">
                    <div class="container d-flex justify-content-center">
                        <form class="d-flex justify-content-center" style="width: 100%;display: flex;align-items: center;">
                            <input id="search_espisode" class="form-control me-2 w-75" type="search" placeholder="Search" aria-label="Search" style="width: 55%;">
                            <button class="btn btn-success" type="submit" style="width: 15%;margin-left: 5%;">Tim Kiem</button>
                        </form>
                    </div>
                    <div class="container mt-5">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Thumb</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Gần nhất</th>
                                <th scope="col">Tập</th>
                              </tr>
                            </thead>
                            <tbody id="result">
                              
                            </tbody>
                          </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
