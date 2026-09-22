@extends('layouts.app')

@section('content')

<form action="/products" method="POST">
    @csrf
    <input type="text" name="product_name" placeholder="Nama produk">
    <input type="number" name="id_category" placeholder="ID Category">
    <input type="number" name="id_supplier" placeholder="ID Supplier">
    <button type="submit">Simpan</button>
</form>

@endsection