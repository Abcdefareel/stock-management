@extends('layouts.app')

@section('content')

<form action="/categories" method="POST">
    @csrf
    <input type="text" name="type" placeholder="tipe produk">
    <button type="submit">Simpan</button>
</form>
@endsection