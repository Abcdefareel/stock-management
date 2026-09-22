@extends('layouts.app')

@section('content')

<form action="/stock-movements" method="POST">
    @csrf
    <select name="id_product">
        @foreach ($products as $product)
            <option value="{{ $product->id_product }}">{{ $product->product_name }}</option>
        @endforeach
    </select>

    <select name="movement_type">
        <option value="in">Masuk</option>
        <option value="out">Keluar</option>
    </select>

    <input type="number" name="stock_amount" placeholder="Jumlah">
    <button type="submit">Simpan</button>
</form>

@endsection