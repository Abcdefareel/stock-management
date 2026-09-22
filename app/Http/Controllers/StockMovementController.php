<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stockMovements = StockMovement::whereHas('product', function ($query) use ($request) {
            $query->where('product_name', 'like', '%' . $request->input('search', '') . '%');
        })->paginate(10)->withQueryString();
        return view('stock-movement.index', ['stockMovements' => $stockMovements]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Product::all();
        return view('stock-movement.create', ['products' => $data]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_product' => 'required',
            'movement_type' => 'required',
            'stock_amount' => 'required'
        ]);

        $stockIn = StockMovement::where('id_product', $request['id_product'])->where('movement_type', 'in')->sum('stock_amount');
        $stockOut = StockMovement::where('id_product', $request['id_product'])->where('movement_type', 'out')->sum('stock_amount');
        $totalStock = $stockIn - $stockOut;

        if ($request['movement_type'] == 'out') {
            if ($totalStock < $request['stock_amount']) {
                return redirect('/stock-movements')->with('error', 'jumlah stock lebih sedikit dari total stock');
            }
        }


        StockMovement::create($request->all());

        return redirect('/stock-movements');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = StockMovement::find($id);
        $product = Product::all();
        return view('stock-movement.edit', [
            'movement' => $data,
            'products' => $product
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_product' => 'required',
            'movement_type' => 'required',
            'stock_amount' => 'required'
        ]);
        $stockIn = StockMovement::where('id_product', $request['id_product'])->where('movement_type', 'in')->where('id_stock_movement', '!=', $id)->sum('stock_amount');
        $stockOut = StockMovement::where('id_product', $request['id_product'])->where('movement_type', 'out')->where('id_stock_movement', '!=', $id)->sum('stock_amount');

        $totalStock = $stockIn - $stockOut;

        if ($request['movement_type'] == 'out') {
            if ($totalStock < $request['stock_amount']) {
                return redirect('/stock-movements')->with('error', 'jumlah stock lebi sedikit dari total stock');
            }
        }

        $data = StockMovement::find($id)->update($request->all());

        return redirect('/stock-movements');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = StockMovement::find($id)->delete();
        return redirect('/stock-movements');

        //
    }

    public function reset(string $id_product)
    {
        DB::transaction(function () use ($id_product) {
            $data = StockMovement::where('id_product', $id_product)->delete();

            StockMovement::create([
                'id_product' => $id_product,
                'movement_type' => 'out',
                'stock_amount' => 0
            ]);
        });
        
        return redirect('/stock-movements');
    }
}
