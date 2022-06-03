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
    public function index()
    {
        //
    }

    public function create(Client $client)
    {
        $title = trans('site.orders');
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('title', 'categories', 'client'));
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

        session()->flash('success', trans('site.data_added_successfully'));
        return redirect()->route('dashboard.orders.index');
    }

    public function show(Order $order, Client $client)
    {
        //
    }

    public function edit(Order $order, Client $client)
    {
        //
    }

    public function update(Request $request, Order $order, Client $client)
    {
        //
    }

    public function destroy(Order $order, Client $client)
    {
        //
    }
}
