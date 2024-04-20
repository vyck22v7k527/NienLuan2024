<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Sửa sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Sản phẩm',
            'key' => 'Sửa sản phẩm',
            'control' => 'admin.products.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container mt-5">
                        <h2>Sửa Sản Phẩm</h2>

                        <form action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="id" value="{{ $product->id }}"
                                name="id">
                            <div class="form-group">
                                <label for="name">Tên Sản Phẩm:</label>
                                <input type="text" class="form-control" id="name" value="{{ $product->name }}"
                                    name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Giá:</label>
                                <input type="text" class="form-control" id="price" value="{{ $product->price }}"
                                    name="price" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="promotional_price">Giá khuyến mãi:</label>
                                <input type="text" class="form-control" id="promotional_price"
                                    value="{{ $product->promotional_price }}" name="promotional_price" min="0"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="description">Mô Tả:</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="category">Danh Mục:</label>
                                <select class="form-control" id="category" name="category" required>
                                    @foreach ($category as $cg)
                                        <option value="{{ $cg->id }}"
                                            {{ $cg->id == $product->category_id ? 'selected' : '' }}>{{ $cg->name }}
                                        </option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="file" class="form-control-file mb-1" id="image" name="image"
                                    accept="image/*">
                                <input type="hidden" class="form-control-file mb-1" id="image_old_path"
                                    name="image_old_path" value="{{ $product->image_path }}">
                                <input type="hidden" class="form-control-file mb-1" id="image_old_name"
                                    name="image_old_name" value="{{ $product->image_name }}">
                                <img src="{{ asset($product->image_path) }}" width="200rem" alt="" srcset="">
                                <p>{{ $product->image_name }}</p>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
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
