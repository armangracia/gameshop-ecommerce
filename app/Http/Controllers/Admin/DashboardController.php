<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\GameComp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalGameComp = GameComp::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as','0')->count();
        $totalAdmin = User::where('role_as','1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        // $totalOrder = Order::count();
        // $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        // $thisMonthOrder = Order::whereDate('created_at', $thisMonth)->count();
        // $thisYearOrder = Order::whereDate('created_at', $thisYear)->count();

//use this
        // return view('admin.dashboard', compact ('totalProducts', 'totalCategories', 'totalGameComp', 'totalAllUsers',
        //                                         'totalUser','totalAdmin','totalOrder','todayOrder',
        //                                         'thisMonthOrder','thisYearOrder'    ));

        return view('admin.dashboard');
    }
}