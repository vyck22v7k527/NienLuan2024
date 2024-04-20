<!-- resources/views/child.blade.php -->

@extends('admin.layouts.admin')

@section('title')
    <title>Sản phẩm</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header', [
            'name' => 'Sản phẩm',
            'key' => 'Danh sách',
            'control' => 'admin.products.index',
        ])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-success mb-2 float-right" href="{{ route('admin.products.create') }}">Thêm sản phẩm</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th class="canGiua">Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Giới thiệu sản phẩm</th>
                                    <th class="canGiua">Sửa</th>
                                    <th class="canGiua">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $pd)
                                    <tr>
                                        <td class="align-middle">{{ $pd->id }}</td>
                                        <td class="align-middle">{{ $pd->name }}</td>
                                        <td class="canGiua align-middle">
                                            <img src="{{ asset($pd->image_path) }}" width="150rem" alt=""
                                                srcset="">
                                        </td>
                                        <td class="align-middle">{{ $pd->price }}</td>
                                        <td class="align-middle">{{ $pd->promotional_price }}</td>
                                        <td class="align-middle">{{ $pd->description }}</td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-primary btn-submit" href="{{ route('admin.products.edit', ['id' => $pd->id]) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td class="canGiua align-middle">
                                            <a class="btn btn-danger action_delete"
                                                data-url="{{ route('admin.products.delete', ['id' => $pd->id]) }}">
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
                        {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
