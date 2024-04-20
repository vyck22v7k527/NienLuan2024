<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    private $category;
    public function __construct(category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $category = $this->category::all();
        return view('user.cart', compact('category'));
    }

    public function createOrder(Request $request)
    {
        try {
            $formData = $request->all();
            $cartData = json_decode($request->input('cartData'), true);

            $request->validate([
                'address' => 'required',
                'method_pay_select' => 'required',
                'note' => 'nullable',
                'total_price' => 'required|numeric',
            ]);

            $order = new Order();
            $order->address = $request->input('address');
            $order->method_pay = $request->input('method_pay_select');
            $order->total_price = $request->input('total_price');
            $order->phone = auth()->user()->phone;
            $order->status = 1;
            $order->user_id = auth()->user()->id;

            $order->save();

            foreach ($cartData as $cartItem) {
                $orderItem = new OrderDetail();
                $orderItem->order_id = $order->id; // Associate with the order
                $orderItem->product_id = $cartItem['id'];
                $orderItem->quality = $cartItem['quantity'];
                $orderItem->price = $cartItem['price'];
                $orderItem->save();
            }

            return 'Đặt hàng thành công';
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function cancelOrder(Request $request)
    {
        $orderId = $request->input('orderId');
        $reason = $request->input('reason');
        Order::where('id', $orderId)->update([
            'status' => 3,
            'note' => $reason,
        ]);

        return back();
    }

}
