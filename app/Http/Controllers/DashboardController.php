<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function view()
{
    $user = Auth::user();
    
    

    if ($user->user_type == 'admin') {
        return view('pages.admin-dashboard.nexxoom-dashboard', [
            'user' => $user,
        ]);
    } else {

        return view('user-dashboard.user-dashboard', [
            'user' => $user,
        ]);
    }

   
    }

    
 function profile(){
    $user = Auth::user();
    return view('pages.admin-dashboard.profile', [
        'user' => $user,
    ]);
 
}
  public function index()
    {
 

        // Total users
        $totalUsers = User::count();

        // Total orders
        $totalOrders = Order::count();

        // Order status count
        $deliveredOrders = Order::where('status', 'delivered')->count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $processingOrders = Order::where('status', 'processing')->count();

        $shippedOrders = Order::where('status', 'shipped')->count();



        $lowStockProducts = Product::where('quantity', '<=', 5)->count();


   
        $recentOrders = Order::with([
            'user',
            'items.product'
        ])
            ->latest()
            ->take(15)
            ->get();



        $orderStatuses = Order::select(
            'status',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('status')
            ->pluck('total', 'status');

        $topProducts = DB::table('order_items')
            ->join(
                'products',
                'order_items.product_id',
                '=',
                'products.id'
            )
            ->select(
                'products.id',
                'products.title',
                DB::raw('SUM(order_items.quantity) as total_sold')
            )
            ->groupBy(
                'products.id',
                'products.title'
            )
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();


 

        $stockAlerts = Product::where('quantity', '<=', 5)
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();


        return view(
            'pages.admin-dashboard.nexxoom-dashboard',
            compact(
                'totalUsers',
                'totalOrders',
                'deliveredOrders',
                'pendingOrders',
                'processingOrders',
                'shippedOrders',
                'lowStockProducts',
                'recentOrders',
                'orderStatuses',
                'topProducts',
                'stockAlerts'
            )
        );
    }

}


