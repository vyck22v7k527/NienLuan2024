@extends('user.layouts.layout')

@section('title')
    <title>Liên hệ</title>
@endsection

@section('content')
    <div class="news-container">
        <div class="container">
           @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <label for="fname">Họ tên</label>
            <input class="contact-input" type="text" id="fname" name="name" placeholder="Họ và tên" required>

            <label for="lname">Số điện thoại</label>
            <input class="contact-input" type="text" id="lname" name="phone" placeholder="Số điện thoại" required>
            
            <label for="lname">Email</label>
            <input class="contact-input" type="email" id="ename" name="email" placeholder="Email" required>

            <label for="content">Nội dung</label>
            <textarea class="contact-textarea" id="content" name="content" placeholder="Nội dung" style="height:200px" required></textarea>

            <input class="contact-submit" type="submit" value="Submit">
        </form>
    </div>
        
@endsection
