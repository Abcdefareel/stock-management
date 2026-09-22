@extends('layouts.app')

@section('content')

<form action="/suppliers" method="POST">
    @csrf
    <input type="text" name="name_supplier" placeholder="nama supplier">
    <button type="submit">Simpan</button>
</form>

@endsection