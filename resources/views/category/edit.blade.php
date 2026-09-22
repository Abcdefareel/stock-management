@extends('layouts.app')

@section('content')
<form action="/categories/{{ $categories->id_category }}" method="POST">
    @csrf
    @method('PUT')
    <input name="type" value="{{ $categories->type }}">
    <button type="submit">Simpan</button>
</form>
@endsection