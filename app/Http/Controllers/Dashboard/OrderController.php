<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('site.orders');
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('total_price', 'LIKE', '%' . $request->search . '%');

        })->latest()->paginate(5);
        return view('dashboard.orders.index', compact('title', 'orders'));
    }

    public function products(Order $order)
    {
        $products = $order->products;
        return view('dashboard.orders._products', compact('products', 'order'));
    }

    public function destroy(Order $order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }

        $order->delete();
        session()->flash('success', trans('site.data_deleted_successfully'));
        return redirect()->back();
    }
}
