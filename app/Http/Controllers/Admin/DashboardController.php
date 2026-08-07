<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'productCount'        => Product::count(),
            'orderCount'          => Order::count(),
            'unreadMessageCount'  => Message::where('is_read', false)->count(),
            'userCount'           => User::where('is_admin', false)->count(),
        ]);
    }
}
