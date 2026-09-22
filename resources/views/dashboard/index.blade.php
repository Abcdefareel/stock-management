@extends('layouts.app')

@section('content')
    <ul>
        <li>Total produk = {{ $products }}</li>
        <li>Total pemasok = {{ $suppliers }} </li>
        <li>produk masuk = {{ $stockIn }}</li>
        <li>produk keluar = {{ $stockOut }}</li>
        <li>Total stock-movements = {{ $totalStock }}</li>
    </ul>
@endsection


