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
            'key' => 'Danh sách',
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
                                    <th>Người đặt</th>
                                    <th>Tổng giá</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày</th>
                                    <th>Hủy đơn hàng</th>
                                    <th>Xác nhận đơn hàng</th>
                                    <th>Chi tiết đơn hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersWithOrders as $item)
                                    <tr>
                                        <td class="align-middle">{{ $loop->count - $loop->iteration + 1 }}</td>
                                        <td class="align-middle">{{ $item->name }}</td>
                                        <td class="align-middle">{{ $item->total_price }}</td>
                                        <td class="align-middle">
                                            @switch($item->status)
                                                @case(1)
                                                    New
                                                @break

                                                @case(2)
                                                    Đã xác nhân
                                                @break

                                                @case(3)
                                                    Đã Hủy
                                                @break

                                                @default
                                                    Unknown Status
                                            @endswitch
                                        </td>
                                        <td class="align-middle">{{ $item->method_pay }}</td>
                                        <td class="align-middle">{{ $item->address1 }}</td>
                                        <td class="align-middle">{{ $item->created_at }}</td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-primary btn-danger {{ $item->status == 3 ? 'unenabled ' : 'action_cancel ' }}"
                                                data-url="{{ route('admin.orders.cancel', ['id' => $item->id]) }}"><i
                                                    class="fa-solid fa-ban"></i></a>
                                        </td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-primary btn-primary {{ $item->status == 3 ? 'unenabled ' : '' }}"
                                                href="{{ route('admin.orders.orderDetermination', ['id' => $item->id]) }}"><i
                                                    class="fa-solid fa-square-check"></i></a>
                                        </td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-primary btn-success"
                                                href="{{ route('admin.orders.indexOrderDetail', ['id' => $item->id]) }}"><i
                                                    class="fa-solid fa-circle-right"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                                {{-- <td class="canGiua align-middle">
                                            <a class="btn btn-primary btn-submit" href="{{ route('admin.products.edit', ['id' => $pd->id]) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-danger action_delete"
                                                data-url="{{ route('admin.products.delete', ['id' => $pd->id]) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td> --}}
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="col-lg-12">
                        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div> --}}
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
