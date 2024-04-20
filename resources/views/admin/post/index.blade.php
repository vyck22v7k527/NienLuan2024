<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Bài đăng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Bài đăng',
            'key' => 'Danh sách',
            'control' => 'admin.posts.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-success mb-2 float-right" href="{{ route('admin.posts.create') }}">Thêm bài đăng</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th class="">Hình ảnh</th>
                                    <th>Nôi dung</th>
                                    <th>Ngày đăng</th>
                                    <th class="">Sửa</th>
                                    <th class="">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $p)
                                    <tr>
                                        <td class="align-middle">{{ $p->id }}</td>
                                        <td class="align-middle">{{ $p->name }}</td>
                                        <td class=" align-middle">
                                            <img src="{{ asset($p->image_path) }}" width="150rem" alt=""
                                                srcset="">
                                        </td>
                                        <td class="align-middle">{{ $p->content }}</td>
                                        <td class="align-middle">{{ $p->created_at }}</td>
                                        <td class=" align-middle">
                                            <a class="btn btn-primary btn-submit" href="{{ route('admin.posts.edit', ['id' => $p->id]) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td class=" align-middle">
                                            <a class="btn btn-danger action_delete"
                                                data-url="{{ route('admin.posts.delete', ['id' => $p->id]) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="col-lg-12">
                        {!! $category->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div> --}}
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection

