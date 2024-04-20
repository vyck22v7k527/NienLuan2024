<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Models\order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    //
    private $order;
    public function __construct(order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        $usersWithOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name', 'users.address1', 'users.address2')
            ->orderBy('orders.id', 'desc') // or 'desc' for descending order
            ->get(); // remove pagination
        return view("admin.order.index", compact("usersWithOrders"));
    }


    public function indexOrderDetail($id)
    {
        $orderDetail = OrderDetail::where('order_id', $id)
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('order_details.*', 'products.image_path')
            ->get();


        return view("admin.order.indexOrderDetail", compact("orderDetail"));
    }

    public function cancel(Request $request, $id)
    {
        try {
            $note = $request->query('note');
            $this->order->find($id)->update(['note' => $note, 'status' => 3]);
            return response()->json([
                'code' => Constants::tc_200,
                'message' => Constants::txt_success
            ], Constants::tc_200);
        } catch (\Exception $exception) {
            Log::error("message" . $exception->getMessage() . " --- Line : " . $exception->getLine());
            return response()->json([
                'code' => Constants::tc_500,
                'message' => Constants::txt_failure
            ], Constants::tc_500);
        }
    }

    public function orderDetermination($id)
    {
        $this->order->find($id)->update(['status' => 2]);
        return redirect()->to(route('admin.orders.index'));
    }
}