@extends('user.layouts.layout')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('content')
<div class="order-container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="{{ asset('user_hexashop/assets/images/avatar.jpg')}}"><span class="font-weight-bold">{{ auth()->user()->name }}</span><span class="text-black-50">{{ auth()->user()->email }}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Thông tin cá nhân</h4>
                </div>
                <form method="POST" action="{{ route('profile.profile') }}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Họ Tên</label><input type="text" class="form-control" placeholder="Họ tên" name="name" value="{{ auth()->user()->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="{{ auth()->user()->phone }}"></div>
                        <div class="col-md-12"><label class="labels">Địa chỉ 1</label><input type="text" class="form-control" placeholder="Địa chỉ 1" name="address1" value="{{ auth()->user()->address1 }}"></div>
                        <div class="col-md-12"><label class="labels">Địa chỉ 2</label><input type="text" class="form-control" placeholder="Địa chỉ 2" name="address2" value="{{ auth()->user()->address2 }}"></div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="text" disabled class="form-control" placeholder="Địa chỉ email" value="{{ auth()->user()->email }}"></div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Cập nhật</button></div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
    <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center experience">
            <h4 class="text-right">Đơn hàng</h4>
        </div>
        <br>
        @foreach ($orders as $order)
        <form action="{{ url('/cancel-order') }}" method="Get">
            <input type="hidden" name="orderId" value="{{ $order->id }}">
        <div class="order-card">
            <div class="flex">
                <b class="order-card-labels">Mã đơn hàng: {{ $order->id }} </b> 
                <b class="order-card-labels">Trạng thái: 
                    @if ($order->status == 1)
                        Mới
                    @elseif ($order->status == 2)
                        Đã xác nhận
                    @elseif ($order->status == 3)
                        Đã hủy
                    @else
                        Không xác định
                    @endif
                </b>
            </div>
            <p>
                <b class="order-card-labels">Số điện thoại: </b> {{ $order->phone }}
            </p>
            <p>
                <b class="order-card-labels">Địa chỉ: </b> {{ $order->address }}
            </p>
            <p>
                <b class="order-card-labels">Ghi chú: </b> {{ $order->note }}
            </p>
            <p>
                <b class="order-card-labels">Tổng tiền: </b> {{ number_format($order->total_price, 0, ',', '.') }} đ
            </p>
            @if ($order->status == 1)
                <p>
                    <b class="order-card-labels ">Hủy đơn: </b>
                    <button type="button" class="btn btn-primary profile-button" onClick="openDialog()">Hủy</button>
                </p>
            @endif

            @foreach ($orderDetails[$order->id] as $detail)
            <div class="flex"><img class="order-img" src="{{ asset($detail->product->image_path) }}" alt="">
                <p>x{{$detail->quality}}</p>
                <p>{{ number_format($detail->price, 0, ',', '.') }} đ</p>
            </div>
            @endforeach
        </div>
       <dialog id="modal" class="modal-container">
            <form action="{{ url('/cancel-order') }}" method="Get">
                <div class="modal-close">
                    <button type="button" class="close" onClick="closeDialog()">x</button>
                </div>
                  <label for="reason">Lý do</label>
                <input type="text" placeholder="Nhập lý do hủy đơn hàng" name="reason" required>
                <br>
                <br>
                 <div class="modal-close">
                    <button type="submit" class="btn btn-primary profile-button mt">Hủy đơn</button>
                </div>
            </form> 
            </dialog>
        </form>
        <hr>
        @endforeach
        <br>
    </div>
</div>
    </div>
</div>
</div>
</div>
<script>
    function openDialog() {
        const modal = document.getElementById("modal");
        if (modal) {
            modal.style.display = "block";
        }
    }
    function closeDialog(){
       const modal = document.getElementById("modal");
        if (modal) {
            modal.style.display = "none";
        }
    }
</script>
@endsection