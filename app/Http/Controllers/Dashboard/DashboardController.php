<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = trans('site.dashboard');

        $products_count = Product::count();
        $categories_count = Category::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();

        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum'),
        )->groupBy('month')->get();

        return view('dashboard.welcome', compact('title',
            'products_count', 'categories_count', 'clients_count', 'users_count', 'sales_data'));
    }
}
