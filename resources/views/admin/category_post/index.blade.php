<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Danh mục bài đăng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Danh mục bài đăng',
            'key' => 'Danh sách',
            'control' => 'admin.category_posts.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ route('admin.category_posts.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="form-control-id" name="id" value="">
                                <label for="form-control-name">Tên danh mục bài đăng</label>
                                <input type="text" name="name" value="{{ old("name") }}"
                                    class="form-control mb-1 @error('name') is-invalid @enderror" id="form-control-name"
                                    placeholder="Nhập tên danh mục bài đăng">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <a id="huy-cap-nhat" style="display: none" class="btn btn-danger">Hủy cập nhật</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục bài đăng</th>
                                    <th>Slug</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category_posts as $cgp)
                                    <tr>
                                        <td>{{ $cgp->id }}</td>
                                        <td>{{ $cgp->name }}</td>
                                        <td>{{ $cgp->slug }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-primary btn-submit"
                                                data-param='{"id": "{{ $cgp->id }}", "name": "{{ $cgp->name }}"}'><i
                                                    class="fas fa-edit"></i></button>
                                        </td>
                                        <td class="align-middle">
                                            <a class="btn btn-danger action_delete"
                                                data-url="{{ route('admin.category_posts.delete', ['id' => $cgp->id]) }}">
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
                        {!! $category_posts->withQueryString()->links('pagination::bootstrap-5') !!}
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
