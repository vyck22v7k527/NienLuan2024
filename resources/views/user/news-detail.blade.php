@extends('user.layouts.layout')

@section('title')
    <title>Tin tức</title>
@endsection

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img src="{{ asset($new->image_path) }}" class="card-img-top">
                    <div class="card-body">
                        <h2 class="card-title">{{$new->name}}</h2>
                        <p class="card-text">{{$new->content}}</p>
                        <p class="card-text">
                            <small class="text-muted">Ngày đăng {{$new->created_at->format('d/m/Y')}}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
