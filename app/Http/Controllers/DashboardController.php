<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count();
        $totalSupplier = Supplier::count();

        $stockIn = StockMovement::where('movement_type', 'in')->sum('stock_amount');
        $stockOut = StockMovement::where('movement_type', 'out')->sum('stock_amount');

        $totalStock = $stockIn - $stockOut;

        return view('dashboard.index', [
            'products' => $totalProduct,
            'suppliers' => $totalSupplier,
            'stockIn' => $stockIn,
            'stockOut' => $stockOut,
            'totalStock' => $totalStock

        ]);
    }

    //
}
