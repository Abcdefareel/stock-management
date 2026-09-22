@extends('layouts.app')

@section('content')

<form action="/products/{{ $product->id_product }}" method="POST">
    @csrf
    @method('PUT')
    <input name="product_name" value="{{ $product->product_name }}">
    <input name="id_category" value="{{ $product->id_category }}">
    <input name="id_supplier" value="{{ $product->id_supplier }}">
    <button type="submit">Simpan</button>
</form>

@endsection