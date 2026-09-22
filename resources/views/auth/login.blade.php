@extends('layouts.app')

@section('content')
<form action="/login" method="POST">
    @csrf
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <button>login</button>
</form>

<a href="{{ route('register') }}">register</a>
@endsection
