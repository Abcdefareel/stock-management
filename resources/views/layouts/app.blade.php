<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Inventory Management System')</title>
</head>

<body>
    <nav>
        <a href="/products">Products</a>
        <a href="/categories">Categories</a>
        <a href="/suppliers">Suppliers</a>
        <a href="/stock-movements">Stock Movements</a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Logout
            </button>
        </form>
    </nav>

    <main>
        @yield('content')
    </main>
</body>

</html>
