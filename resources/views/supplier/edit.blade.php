@extends('layouts.app')

@section('content')
<form action="/suppliers/{{ $suppliers->id_supplier }}" method="POST">
    @csrf
    @method('PUT')
    <input name="name_supplier" value="{{ $suppliers->name_supplier }}">>
    <button type="submit">Simpan</button>
</form>
@endsection