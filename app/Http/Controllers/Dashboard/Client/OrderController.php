<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        $title = trans('site.orders');
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact('title', 'categories', 'client','orders'));
    }

    public function store(Request $request, Client $client)
    {
        // First way
        /*
        $validation = Validator::make($request->all(), [
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $order = $client->orders()->create([]);

        $total_price = 0;

        foreach ($request->product_ids as $index => $product_id) {

            $product = Product::findOrFail($product_id);
            $total_price += $product->sale_price * $request->quantities[$index];

            $order->products()->attach($product_id, ['quantity' => $request->quantities[$index]]);

            $product->update([
                'stock' => $product->stock - $request->quantities[$index]
            ]);

        }

        $order->update(['total_price' => $total_price]);
        */

        // Second way
        $this->attachOrder($request, $client);

        session()->flash('success', trans('site.data_added_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    private function attachOrder($request, $client)
    {
        $validation = Validator::make($request->all(), [
            'products' => 'required|array',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);

        $total_price = 0;

        foreach ($request->products as $id => $quantity) {

            $product = Product::findOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];

            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }

        $order->update(['total_price' => $total_price]);
    }

    public function edit(Client $client, Order $order)
    {
        $title = trans('site.orders');
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('title', 'categories', 'client','order', 'orders'));
    }

    public function update(Request $request, Client $client, Order $order)
    {
        // delete old order
        $this->dattachOrder($order);

        // create new order
        $this->attachOrder($request, $client);

        session()->flash('success', trans('site.data_updated_successfully_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    private function dattachOrder($order)
    {
        foreach ($order->products as $product) {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity,
            ]);
        }

        $order->delete();
    }
}
