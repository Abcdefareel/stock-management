@extends('layouts.app')
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@section('content')
    <form action="/stock-movements" method="GET">
        <input type="text" name="search" placeholder="Cari nama produk...">
        <button type="submit">Cari</button>
    </form>
    <ul>
        @foreach ($stockMovements as $movement)
            <li>
                {{ $movement->product->product_name }} —
                {{ $movement->movement_type }} —
                {{ $movement->stock_amount }}
                <a href="/stock-movements/{{ $movement->id_stock_movement }}/edit">Edit</a>
                @if (Auth::user()->role == 'admin')
                    <form action="/stock-movements/{{ $movement->id_stock_movement }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                    <form action="/stock-movements/{{ $movement->id_product }}/reset" method="POST">
                        @csrf
                        <button type="submit">Reset</button>
                    </form>
                @endif
            </li>
        @endforeach
        {{ $stockMovements->links('pagination::simple-default') }}
    </ul>
@endsection
