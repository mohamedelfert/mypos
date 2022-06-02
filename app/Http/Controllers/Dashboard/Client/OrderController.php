<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

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
        return view('dashboard.clients.orders.create', compact('title', 'categories','client'));
    }

    public function store(Request $request, Client $client)
    {
        dd($request->all());
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
