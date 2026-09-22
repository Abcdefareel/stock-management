@extends('layouts.app')
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif
@section('content')
    <form action="/categories" method="GET">
        <input type="text" name="search" placeholder="Cari nama produk...">
        <button type="submit">Cari</button>
    </form>
    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->type }}
                <a href="/categories/{{ $category->id_category }}/edit">Edit</a>
                @if (Auth::user()->role == 'admin')
                    <form action="/categories/{{ $category->id_category }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                @endif
            </li>
        @endforeach
        {{ $categories->links('pagination::simple-default') }}
    </ul>
@endsection
