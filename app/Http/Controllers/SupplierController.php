<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::where('name_supplier', 'like', '%'. $request['search']. '%')->paginate(10)->withQueryString();
        return view('supplier.index', ['suppliers' => $suppliers]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_supplier' => 'required'
        ]);

        Supplier::create($request->all());

        return redirect('/suppliers');
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
        $data = Supplier::find($id);
        return view('supplier.edit', ['suppliers' => $data]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_supplier' => 'required'
        ]);

        $data = Supplier::find($id)->update($request->all());

        return redirect('/suppliers');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $hasil = $supplier->products->count();
        if ($hasil > 0) {
            return redirect('/suppliers')->with('error', 'tidak bisa menghapus supplier');
        }

        $data = Supplier::find($id)->delete();
        return redirect('/suppliers');
        
    }
}
