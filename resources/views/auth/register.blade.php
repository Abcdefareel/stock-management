@extends('layouts.app')
@error('name')
    <p>{{ $message }}</p>
@enderror
@error('email')
    <p>{{ $message }}</p>
@enderror
@error('password')
    <p>{{ $message }}</p>
@enderror

@section('content')
    <form action="/register" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button>register</button>
    </form>
@endsection
