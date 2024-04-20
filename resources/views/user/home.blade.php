@extends('user.layouts.layout')
@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
    <style>
        .hover-content {
            position: relative;
            top: -10rem;
            z-index: -1;
        }

        .hover-content>ul {
            display: flex;
            justify-content: space-evenly;
        }

        .item:hover {
            .hover-content {
                z-index: 1;
                display: block;
            }
        }

        .price-container {
            margin: 50px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Định dạng giá gốc */
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
    <div class="main-banner" id="top">
        <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="{{ asset('user_hexashop/assets/images/banner1.png') }}" class="d-block w-100" alt="Slide 1">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="{{ asset('user_hexashop/assets/images/banner2.png') }}" class="d-block w-100" alt="Slide 2">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="{{ asset('user_hexashop/assets/images/banner3.png') }}" class="d-block w-100" alt="Slide 3">
                </div>
            </div>

            <!-- Previous and Next buttons -->
            <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                <span class="icon-pre" aria-hidden="true">
                    <</span>
            </a>
            <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true">></span>
            </a>
        </div>
    </div>

    <div class="wrap">
        <form action="{{ route('search.index') }}" method="GET" class="search">
            <input type="text" class="searchTerm" name="search" placeholder="Tìm sản phẩm">
            <button type="submit" class="searchButton">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>

    @foreach ($category as $c)
        <section class="section mb-4" id="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-heading">
                            <h2>{{ $c->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @php $count = 0; @endphp
                    @foreach ($c->products as $product)
                        @if ($count < 4)
                            <div class="col-md-4">
                                <div class="item">
                                    <div class="content">
                                        <img class="product-img" src="{{ asset($product->image_path) }}" alt="">
                                        <h4>{{ $product->name }}</h4>
                                        <span
                                            class="{{ $product->promotional_price && $product->promotional_price < $product->price ? 'original-price' : 'discounted-price ' }}">{{ number_format($product->price, 0, ',', '.') }}
                                            VND</span>
                                        @if ($product->promotional_price > 0 && $product->promotional_price < $product->price)
                                            <span
                                                class="discounted-price">{{ number_format($product->promotional_price, 0, ',', '.') }}
                                                VND</span>
                                        @endif
                                    </div>
                                    <div class="hover-content">
                                        <ul>
                                            <li><a class="product-hover" href="/detail/{{ $product->id }}"><i
                                                        class="fa fa-eye"></i></a></li>
                                            <li><a class="product-hover"
                                                    onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }},{{ $product->promotional_price > 0 ? $product->promotional_price : 0}}, '{{ $product->image_path }}')"><i
                                                        class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
@endsection

@section('js')
    <script>
        function addToCart(itemId, itemName, itemPrice, promotionalPrice,  itemImage) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingItem = cart.find(item => item.id === itemId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                const newItem = {
                    id: itemId,
                    name: itemName,
                    price: itemPrice,
                    promotionalPrice: promotionalPrice,
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
