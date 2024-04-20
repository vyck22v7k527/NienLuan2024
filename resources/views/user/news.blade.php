@extends('user.layouts.layout')

@section('title')
    <title>Tin tức</title>
@endsection

@section('content')
<div class="news-container">
        <h2>Tin tức</h2>
        <div class="row">
             @foreach($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img class='news-img' src="{{ asset($item->image_path) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text news-content">{{$item->content}}</p>
                            <a href="/news-detail/{{$item->id}}" class="btn btn-primary profile-button">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
