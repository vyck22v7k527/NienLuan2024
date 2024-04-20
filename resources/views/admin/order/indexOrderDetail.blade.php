<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Đơn hàng</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Đơn hàng',
            'key' => 'Danh sách chi tiết đơn hàng',
            'control' => 'admin.orders.index',
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
                                    <th>ID Đơn hàng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderDetail as $item)
                                    <tr>
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->order_id }}</td>
                                        <td class="align-middle">{{ $item->name }}</td>
                                        <td class="align-middle">
                                            <img src="{{ asset($item->image_path) }}" width="150rem" alt=""
                                                srcset="">
                                        </td>
                                        <td class="align-middle">{{ $item->quality }}</td>
                                        <td class="align-middle">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
