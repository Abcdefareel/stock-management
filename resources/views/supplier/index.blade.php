@extends('layouts.app')
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@section('content')
    <form action="/suppliers" method="GET">
        <input type="text" name="search" placeholder="Cari nama produk...">
        <button type="submit">Cari</button>
    </form>
    <ul>
        @foreach ($suppliers as $supplier)
            <li>
                {{ $supplier->name_supplier }}
                <a href="/suppliers/{{ $supplier->id_supplier }}/edit">Edit</a>
                @if (Auth::user()->role == 'admin')
                    <form action="/suppliers/{{ $supplier->id_supplier }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                @endif
            </li>
        @endforeach
        {{ $suppliers->links('pagination::simple-default') }}
    </ul>
@endsection
