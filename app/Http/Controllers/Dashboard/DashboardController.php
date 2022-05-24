<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = trans('site.dashboard');
        return view('dashboard.welcome',compact('title'));
    }
}
