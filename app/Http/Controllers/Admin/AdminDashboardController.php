<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('recentOrders'));
    }
}
