@extends('user.layouts.layout')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
<section class="section detail-container" id="grid">
    <div class="container">
        <div class="wrap wrap-products">
            <form action="{{ route('search.index') }}" method="GET" class="search">
                <input type="text" class="searchTerm" name="search" placeholder="Tìm sản phẩm">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <h4>{{$page}}</h4>
        <br />
        <br />
        <div class="row">
            @foreach($products as $item)
                <div class="col-md-4"> <!-- Adjust the column size based on your design -->
                    <div class="item">
                        <div class="thumb">
                            <div class="hover-content">
                                <ul>
                                    <li><a href="/detail/{{$item->id}}"><i class="fa fa-eye"></i></a></li>
                                    <li><a onclick="addToCart({{$item->id}}, '{{$item->name}}', {{$item->price}}, '{{$item->image_path}}')"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <img class="product-img1" src="{{ asset($item->image_path) }}" alt="">
                        </div>
                        <div class="grid-down-content down-content">
                            <h4>{{$item->name}}</h4>
                           <span>{{ number_format($item->price, 0, ',', '.') }} VND</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function addToCart(itemId, itemName, itemPrice, itemImage) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        const existingItem = cart.find(item => item.id === itemId);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            const newItem = {
                id: itemId,
                name: itemName,
                price: itemPrice,
                image: itemImage,
                quantity: 1
            };
            cart.push(newItem);
        }

        alert('Đã thêm sản phẩm vào giỏ hàng');
        localStorage.setItem('cart', JSON.stringify(cart));
         console.log('Item added to cart:', itemId, itemName, itemPrice, itemImage);
        console.log('Updated Cart:', cart);
    }
</script>
@endsection
