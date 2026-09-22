@extends('layouts.app')
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

@section('content')
    <form action="/products" method="GET">
        <input type="text" name="search" placeholder="Cari nama produk...">
        <button type="submit">Cari</button>
    </form>
    <ul>
        @foreach ($products as $product)
            <li>
                {{ $product->product_name }}
                <a href="/products/{{ $product->id_product }}/edit">Edit</a>
                @if (Auth::user()->role == 'admin')
                    <form action="/products/{{ $product->id_product }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                @endif
            </li>
        @endforeach
        {{ $products->links('pagination::simple-default') }}
    </ul>
@endsection
