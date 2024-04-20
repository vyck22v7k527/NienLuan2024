@extends('user.layouts.layout')
@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
    <style>
        /* Định dạng giá gốc */
        .original-price {
            color: #888;
            text-decoration: line-through;
        }

        /* Định dạng giảm giá */
        .right-content>.discounted-price {
            color: #d74520 !important;
            font-size: 1.5em !important;
            font-weight: bold !important;
        }
    </style>
@endsection

@section('content')
    <section class="section detail-container" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="left-images">
                        <img src="{{ asset($product->image_path) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="right-content">
                        <h4>{{ $product->name }}</h4>

                        <span
                            class="{{ $product->promotional_price && $product->promotional_price < $product->price ? 'original-price' : 'discounted-price' }}">{{ number_format($product->price, 0, ',', '.') }}
                            VND</span>
                        @if ($product->promotional_price > 0 && $product->promotional_price < $product->price)
                            <span class="discounted-price">{{ number_format($product->promotional_price, 0, ',', '.') }}
                                VND</span>
                        @endif
                        <span>{{ $product->description }}</span>
                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Số lượng</h6>
                            </div>
                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus"><input type="number" step="1"
                                        min="1" max="" name="quantity" value="1" title="Qty"
                                        class="input-text qty text" size="4" pattern="" inputmode=""
                                        id="quantityInput"><input type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total">
                            <div class="btn btn-primary detail-btn profile-button"><a
                                    onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, {{ $product->promotional_price > 0 ? $product->promotional_price : 0}},  '{{ $product->image_path }}', document.getElementById('quantityInput').value)">Thêm
                                    vào giỏ hàng</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function addToCart(itemId, itemName, itemPrice, promotionalPrice, itemImage, quantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingItem = cart.find(item => item.id === itemId);

            if (existingItem) {
                // If the item is already in the cart, update its quantity
                existingItem.quantity += parseInt(quantity, 10);
            } else {
                // If the item is not in the cart, add it with the specified quantity
                const newItem = {
                    id: itemId,
                    name: itemName,
                    price: itemPrice,
                    promotionalPrice: promotionalPrice,
                    image: itemImage,
                    quantity: parseInt(quantity, 10) || 1,
                };
                cart.push(newItem);
            }

            alert('Đã thêm sản phẩm vào giỏ hàng');
            localStorage.setItem('cart', JSON.stringify(cart));
        }
    </script>
@endsection
