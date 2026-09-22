<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::where('type', 'like', '%' . $request['search']. '%')->paginate(10)->withQueryString();
        return view('category.index', ['categories' => $categories]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        Category::create($request->all());

        return redirect('/categories');
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
        $data = Category::find($id);
        return view('category.edit', ['categories' => $data]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required'
        ]);

        $data = Category::find($id)->update($request->all());

        return redirect('/categories');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $hasil = $category->products->count();
        if ($hasil > 0) {
            return redirect('/categories')->with('error', 'tidak bisa menghapus kategori');
        }
        $data = Category::find($id)->delete();
        return redirect('/categories');
        //
    }
}
