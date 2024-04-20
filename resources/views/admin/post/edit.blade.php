<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Cập nhật bài đăng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Bài đăng',
            'key' => 'Cập nhật bài đăng',
            'control' => 'admin.posts.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container mt-5">
                        <h2>Cập nhật bài đăng</h2>

                        <form action="{{ route('admin.posts.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" value="{{ $post->id }}"
                                name="id">
                            <div class="form-group">
                                <label for="name">Tiêu đề:</label>
                                <input type="text" class="form-control @error('name') is-invalid mb-2 @enderror "
                                    id="name" name="name" value="{{ $post->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Nội dung</label>
                                <textarea class="form-control @error('content') is-invalid mb-2 @enderror" id="content" name="content" rows="4">{{ $post->content }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_post_id">Danh mục bài đăng:</label>
                                <select class="form-control" id="category_post_id" name="category_post_id">
                                    @foreach ($category_posts as $cgt)
                                        <option value="{{ $cgt->id }}"
                                            {{ $post->category_post_id == $cgt->id ? 'selected' : '' }}>{{ $cgt->name }}
                                        </option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="file" class="form-control-file  " id="image" name="image"
                                    accept="image/*">
                                <input type="hidden" class="form-control-file mb-1" id="image_old_path"
                                    name="image_old_path" value="{{ $post->image_path }}">
                                <input type="hidden" class="form-control-file mb-1" id="image_old_name"
                                    name="image_old_name" value="{{ $post->image_name }}">
                                <img src="{{ asset($post->image_path) }}" width="200rem" alt="" srcset="">
                                <p>{{ $post->image_name }}</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('js/categories/index.js') }}"></script> --}}
@endsection
