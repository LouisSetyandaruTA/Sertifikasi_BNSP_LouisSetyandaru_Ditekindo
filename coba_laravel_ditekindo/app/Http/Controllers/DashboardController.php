<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\GameProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {

        $totalRevenue = Order::where('status', 'success')->sum('total_price');
        $totalUsers = User::count();
        $totalProducts = GameProduct::count();

        $recentOrders = Order::with('user')->where('status', 'success')->latest()->take(10)->get();

        return view('dashboard', compact('totalRevenue', 'totalUsers', 'totalProducts', 'recentOrders'));
    }

    public function exportPDF()
    {
        $orders = Order::with(['user', 'items.gameProduct'])->where('status', 'success')->get();
        $totalRevenue = $orders->sum('total_price');

        $pdf = Pdf::loadView('admin.reports.pdf', compact('orders', 'totalRevenue'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Laporan-Penjualan-' . date('Y-m-d') . '.pdf');
    }

}
