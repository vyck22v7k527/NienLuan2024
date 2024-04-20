<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Sản phẩm',
            'key' => 'Thêm sản phẩm',
            'control' => 'admin.products.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container mt-5">
                        <h2>Thêm Sản Phẩm</h2>

                        <form action="{{ route('admin.products.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên Sản Phẩm:</label>
                                <input type="text" class="form-control @error('name') is-invalid mb-2 @enderror "
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Giá:</label>
                                <input type="text" class="form-control @error('price') is-invalid mb-2 @enderror"
                                    id="price" name="price" min="0" value="{{ old('price') }}">
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="promotional_price">Giá khuyến mãi:</label>
                                <input type="text"
                                    class="form-control @error('promotional_price') is-invalid mb-2 @enderror"
                                    id="promotional_price" name="promotional_price" min="0"
                                    value="{{ old('promotional_price') }}">
                                @error('promotional_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Mô Tả:</label>
                                <textarea class="form-control @error('description') is-invalid mb-2 @enderror" id="description" name="description"
                                    rows="4">{{ old('promotional_price') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Danh Mục:</label>
                                <select class="form-control" id="category" name="category" required>
                                    @foreach ($category as $cg)
                                        <option value="{{ $cg->id }}"
                                            {{ old('category') == $cg->id ? 'selected' : '' }}>{{ $cg->name }}
                                        </option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Ảnh:</label>
                                <input type="file" class="form-control-file  @error('image') is-invalid mb-2 @enderror""
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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