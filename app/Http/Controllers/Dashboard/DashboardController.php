<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders=Order::get();
        $reviews=Review::get();
        return view('dashboard.index' ,compact('orders' ,'reviews'));
    }
}
