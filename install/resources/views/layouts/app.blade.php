<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.components.meta')
</head>
<body>
    <div id="app">
        @include('layouts.components.header-nav')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.components.footer')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('flash::message')
</body>
</html>
