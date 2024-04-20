<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User; // Make sure to adjust the namespace if needed
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\category;
use App\Models\product;
use App\Models\order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $category;
    public function __construct(category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $category = $this->category::all();

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $orders = Order::where('user_id', $userId)->orderBy('id', 'desc')->get();
            $orderDetails = [];

            foreach ($orders as $order) {
                $details = OrderDetail::where('order_id', $order->id)->get();

                // Get all products related to order details for the current order
                $products = Product::whereIn('id', $details->pluck('product_id'))->get();

                // Associate products with order details using the product_id as the key
                $orderDetails[$order->id] = $details->map(function ($detail) use ($products) {
                    $detail->product = $products->where('id', $detail->product_id)->first();
                    return $detail;
                });
            }

            return view('user.profile', compact('category', 'orders', 'orderDetails'));
        } else {
            // Handle the case where the user is not authenticated
            // You might want to redirect them to the login page or handle it based on your requirements
        }
    }

    public function update(Request $request)
    {
        $email = Session::get('user_email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
            ]);

            // Update session data
            Session::put('user_username', $request->input('name'));
            Session::put('user_address1', $request->input('address1'));
            Session::put('user_address2', $request->input('address2'));
            Session::put('user_phone', $request->input('phone'));

            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        } else {
            // Handle the case where the user with the given email is not found
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }

    }
}
