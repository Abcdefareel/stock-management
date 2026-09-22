<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::where('product_name', 'like', '%' . $request['search'] . '%')->paginate(3)->withQueryString();
        // return response()->json($products);
        return view('product.index', compact('products'));
        // return view('product.index', ['products' => $products]);
        //
    }

    /**P
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'id_category' => 'required',
            'id_supplier' => 'required',
        ]);

        Product::create($request->all());

        return redirect('/products');
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
        $data = Product::find($id);
        return view('product.edit', ['product' => $data]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required',
            'id_category' => 'required',
            'id_supplier' => 'required'
        ]);

        $data = Product::find($id)->update($request->all());
        
        return redirect('/products');

    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $hasil = $product->stockMovements->count();
        if ($hasil > 0) {
            return redirect('/products')->with('error', 'tidak dapat menghapus product');
        }
        $data = Product::find($id)->delete();
        return redirect('/products');
        //
    }
}
