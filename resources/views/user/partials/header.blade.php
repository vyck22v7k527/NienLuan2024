<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/">
                        <img class="logo" src="{{ asset('user_hexashop/assets/images/logo.jpg')}}">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="/" id="header-items1">Trang chủ</a></li>
                        <li class="scroll-to-section"><a href="/products" id="header-items2">Sản phẩm</a></li>
                        <li class="submenu">
                            <a href="javascript:;" id="header-items3">Loại sản phẩm</a>
                            <ul>
                                @foreach($category as $item)
                                    <li><a href="/productCategory/{{$item->id}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="scroll-to-section"><a href="/contact" id="header-items7">Liên hệ</a></li>
                        @auth
                            <li class="submenu">
                                <a href="javascript:;"><img class="user-avatar" src="{{ asset('user_hexashop/assets/images/avatar.jpg')}}" alt=""></a>
                                <ul>
                                    <li><a id="menu-item1"  href="/profile">{{ auth()->user()->name }}</a></li>
                                    <li><a  id="menu-item2" href="/logout">Đăng xuất</a></li>
                                </ul>
                            </li>
                        @else
                            <!-- Show login and register links when not logged in -->
                            <li class="scroll-to-section"><a href="/login" id="header-items5">Đăng nhập</a></li>
                            <li class="scroll-to-section"><a href="/register" id="header-items6">Đăng ký</a></li>
                        @endauth

                         <li class="scroll-to-section"><a href="/cart">
                                <img class="cart" src="{{ asset('user_hexashop/assets/images/cart.png')}}" alt="">
                        </a></li>

                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
