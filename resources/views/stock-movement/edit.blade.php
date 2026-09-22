@extends('layouts.app')

@section('content')

<form action="/stock-movements/{{ $movement->id_stock_movement }}" method="POST">
    @csrf
    @method('PUT')
    <select name="id_product">
        @foreach ($products as $product)
            <option value="{{ $product->id_product }}" {{ $product->id_product == $movement->id_product ? 'selected' : '' }}>
                {{ $product->product_name }}
            </option>
        @endforeach
    </select>

    <select name="movement_type">
        <option value="in" {{ $movement->movement_type == 'in' ? 'selected' : '' }}>Masuk</option>
        <option value="out" {{ $movement->movement_type == 'out' ? 'selected' : '' }}>Keluar</option>
    </select>

    <input type="number" name="stock_amount" value="{{ $movement->stock_amount }}">
    <button type="submit">Simpan</button>
</form>

@endsection