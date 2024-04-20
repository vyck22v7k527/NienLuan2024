<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Người dùng',
            'key' => 'Danh sách',
            'control' => 'admin.users.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ 1</th>
                                    <th>Địa chỉ 2</th>
                                    <th>Vai trò</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $u)
                                    <tr>
                                        <td class="align-middle">{{ $u->id }}</td>
                                        <td class="align-middle">{{ $u->name }}</td>
                                        <td class="align-middle">{{ $u->email }}</td>
                                        <td class="align-middle">{{ $u->phone }}</td>
                                        <td class="align-middle">{{ $u->address1 }}</td>
                                        <td class="align-middle">{{ $u->address2 }}</td>
                                        <td class="align-middle">{{ $u->is_admin == 1 ? "Quản lý" : "Người dùng" }}</td>
                                        <td class="align-middle">{{ $u->created_at }}</td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
