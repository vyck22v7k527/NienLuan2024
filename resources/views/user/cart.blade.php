@extends('user.layouts.layout')
@section('title')
    <title>Giỏ hàng</title>
@endsection

@section('css')
    <style>
        .original-price {
            color: #888;
            text-decoration: line-through;
        }

        /* Định dạng giảm giá */
        .discounted-price {
            color: #e44d26;
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <form action="{{ url('/create-order') }}" method="POST" id="order-form" onsubmit="submitForm(event)">
        @csrf
        <div class="cart-container">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Giỏ hàng</b></h4>
                            </div>
                        </div>
                    </div>
                    <div id="cart-container">
                        <!-- Cart items will be dynamically added here -->
                    </div>
                </div>

                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Thanh toán</b></h5>
                    </div>
                    <hr>
                    <div class="left-form">
                        @if (Auth::check())
                            @if (Session::has('user_phone'))
                                <p>Số điện thoại: {{ Session::get('user_phone') }}</p>
                            @endif

                            <p>Địa chỉ</p>
                            <select name="address" id="address">
                                @if (Session::has('user_address1'))
                                    <option class="text-muted">{{ auth()->user()->address1 }}</option>
                                @endif

                                @if (Session::has('user_address2'))
                                    <option class="text-muted">{{ auth()->user()->address2 }}</option>
                                @endif
                            </select>
                        @endif



                        <p>Phương thức thanh toán</p>
                        <select name="method_pay_select" onChange="ChangeMethodPay(this.value)">
                            <option value="COD">COD</option>
                            <option value="ATM">Chuyển khoản ATM</option>
                        </select>
                        <input type="hidden" id="method_pay" name="method_pay" value="COD" />
                        <input type="hidden" id="status" name="status" value="1" />

                    </div>

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">Tổng tiền</div>
                        <div id="total-price-text" class="col text-right">&#8363; 0.00</div>
                        <input type="hidden" readonly name="total_price" id="total-price-input" value="0">
                    </div>
                    <button type="button" class="cart-btn" id="submit-btn" onClick="submitForm(event)">Đặt hàng</button>
                </div>
            </div>
        </div>
    </form>


    <script>
        renderCart();

        function renderCart() {
            // Get the cart from local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Get the container element and total price element
            let cartContainer = document.getElementById('cart-container');
            let totalPriceInputElement = document.getElementById('total-price-input');
            let totalPriceElement = document.getElementById('total-price-text');

            // Clear existing content
            cartContainer.innerHTML = '';

            // Calculate total price
            let total = 0;

            // Iterate through the cart items and generate HTML
            cart.forEach(item => {
                let cartItemHTML = `
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="${item.image}" alt="${item.name}"></div>
                        <div class="col">
                            <div class="row text-muted">${item.name}</div>
                        </div>
                        <div class="col">
                            <a href="#" onclick="updateQuantity(${item.id}, -1)">-</a>
                            <a href="#" class="border">${item.quantity}</a>
                            <a href="#" onclick="updateQuantity(${item.id}, 1)">+</a>
                        </div>
                        <div class="col">

                            <span class="${item.promotionalPrice && item.promotionalPrice < item.price ? 'original-price' : 'discounted-price '}"> ${formatCurrency(item.price)}</span>
                            ${item.promotionalPrice && item.promotionalPrice < item.price ? `<br><span class="discounted-price"> ${formatCurrency(item.promotionalPrice)}</span>` : ''}
                            <span class="close" onclick="removeItem(${item.id})">&#10005;</span>
                        </div>
                    </div>
                </div>
            `;

                // Append the generated HTML to the container
                cartContainer.innerHTML += cartItemHTML;

                // Update total price
                if(item.promotionalPrice && item.promotionalPrice < item.price) {
                    total += item.promotionalPrice * item.quantity;
                }else{
                    total += item.price * item.quantity;
                }
            });

            totalPriceInputElement.value = total;
            totalPriceElement.innerHTML = `${formatCurrency(total)}`;
        }

        function ChangeMethodPay(value) {
            // Update the value of the input field
            document.getElementById('method_pay').value = value;
        }

        function formatCurrency(amount) {
            // Use Intl.NumberFormat to format the currency with VND symbol
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        }

        function updateQuantity(itemId, change) {
            // Get the cart from local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Find the item with the specified ID in the cart
            const itemToUpdate = cart.find(item => item.id === itemId);

            if (itemToUpdate) {
                // Update the quantity based on the change value
                itemToUpdate.quantity += change;

                // Ensure the quantity is not less than 1
                itemToUpdate.quantity = Math.max(1, itemToUpdate.quantity);
            }

            // Save the updated cart back to local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Render the updated cart
            renderCart();
        }

        function removeItem(itemId) {
            // Get the cart from local storage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Remove the item with the specified ID from the cart
            cart = cart.filter(item => item.id !== itemId);

            // Save the updated cart back to local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Render the updated cart
            renderCart();
        }

        // Initial render when the page loads
        renderCart();

        function submitForm(event) {
            event.preventDefault();
            var cartData = JSON.parse(localStorage.getItem('cart'));
            var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
            if (isAuthenticated) {
                if (cartData != null && cartData.length > 0) {
                    var formData = $('#order-form').serializeArray();
                    formData.push({
                        name: 'cartData',
                        value: JSON.stringify(cartData)
                    });

                    $.ajax({
                        url: $('#order-form').attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            localStorage.clear();
                            alert('Đặt hàng thành công');
                            window.location.href = "/";
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Giỏ hàng rỗng');
                }
            } else {
                alert("Bạn cần phải đăng nhập");
            }


        }
    </script>
@endsection
