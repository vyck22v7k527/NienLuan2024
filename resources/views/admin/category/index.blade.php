<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>loại sản phẩm sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'loại sản phẩm sản phẩm',
            'key' => 'Danh sách',
            'control' => 'categories.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('categories.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="form-control-id" name="id" value="">
                                <label for="form-control-name">Tên loại sản phẩm</label>
                                <input type="text" name="name" value=""
                                    class="form-control mb-1 @error('name') is-invalid @enderror" id="form-control-name"
                                    placeholder="Nhập tên loại sản phẩm">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary btn-success">Lưu</button>
                                <a id="huy-cap-nhat" style="display: none" class="btn btn-danger">Hủy cập nhật</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên loại sản phẩm</th>
                                    <th>Slug</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $cg)
                                    <tr>
                                        <td>{{ $cg->id }}</td>
                                        <td>{{ $cg->name }}</td>
                                        <td>{{ $cg->slug }}</td>
                                        <td class="align-middle">
                                            <a class="btn btn-primary btn-submit"
                                                data-param='{"id": "{{ $cg->id }}", "name": "{{ $cg->name }}"}'><i
                                                    class="fas fa-edit"></i></a>
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-danger action_delete"
                                                data-url="{{ route('categories.delete', ['id' => $cg->id]) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        {!! $category->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/categories/index.js') }}"></script>
@endsection
