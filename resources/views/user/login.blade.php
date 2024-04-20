@extends('user.layouts.login-layout')
@section('title')
    <title>Đăng nhập</title>
@endsection

@section('content')
    <section class="login">
        <div class="login_box">
            <div class="left">
                <div class="top_link">
                    <a href="/"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Trang chủ</a>
                    <a href="/register">Đăng ký</a>
                </div>
                <div class="contact">
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <h3>Đăng nhập</h3>

                        <!-- Display error message -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" class="submit profile-button">Đăng nhập</button>
                    </form>
                </div>
            </div>
            <div class="right">
                <div class="right-text">
                    <h2>Thế Giới Skincare</h2>
                </div>
            </div>
        </div>
    </section>
@endsection