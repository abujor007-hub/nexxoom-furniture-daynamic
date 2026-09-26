<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Dashboard
     */
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */
        if ($user->user_type == 'admin') {

            // Total Users
            $totalUsers = User::count();

            // Total Orders
            $totalOrders = Order::count();

            // Order Status Count
            $deliveredOrders = Order::where('status', 'delivered')->count();

            $pendingOrders = Order::where('status', 'pending')->count();

            $processingOrders = Order::where('status', 'processing')->count();

            $shippedOrders = Order::where('status', 'shipped')->count();

            // Low Stock Products Count
            $lowStockProducts = Product::where(
                'quantity',
                '<=',
                5
            )->count();

            // Recent 15 Orders
            $recentOrders = Order::with([
                'user',
                'items.product'
            ])
                ->latest()
                ->take(15)
                ->get();

            // Order Statuses
            $orderStatuses = Order::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
                ->groupBy('status')
                ->pluck('total', 'status');

            // Top 5 Products
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
                    DB::raw(
                        'SUM(order_items.quantity) as total_sold'
                    )
                )
                ->groupBy(
                    'products.id',
                    'products.title'
                )
                ->orderByDesc('total_sold')
                ->take(5)
                ->get();

            // Stock Alerts
            $stockAlerts = Product::where(
                'quantity',
                '<=',
                5
            )
                ->orderBy('quantity', 'asc')
                ->take(5)
                ->get();

            // Admin Dashboard View
            return view(
                'pages.admin-dashboard.nexxoom-dashboard',
                compact(
                    'user',
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

        /*
        |--------------------------------------------------------------------------
        | Normal User Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'user-dashboard.user-dashboard',
            [
                'user' => $user,
            ]
        );
    }


    /**
     * Admin Profile
     */
    public function profile()
    {
        $user = Auth::user();

        return view(
            'pages.admin-dashboard.profile',
            [
                'user' => $user,
            ]
        );
    }
}