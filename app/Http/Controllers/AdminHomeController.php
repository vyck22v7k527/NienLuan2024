<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\order;
use App\Models\post;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    private $order;
    private $product;
    private $user;
    private $post;
    public function __construct(order $order, product $product, User $user, post $post)
    {
        $this->order = $order;
        $this->product  = $product;
        $this->user  = $user;
        $this->post  = $post;
    }
    //
    public function index()
    {

        // Đếm đơn đặt hàng
        $orders = $this->order->count();

        // Đếm sản phẩm
        $products = $this->product->count();

        // Đếm user
        $users = $this->user->count();

        // Đếm bài đăng
        $posts = $this->post->count();
        return view('admin.home', compact('orders', 'products', 'users', 'posts'));
    }
}
