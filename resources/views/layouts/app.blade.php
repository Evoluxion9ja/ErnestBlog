<!DOCTYPE html>
@include('partials._head')
<body>
    <div id="app">
        @include('partials._nav')
        <main class="py-4">
            @yield('stylesheets')
            @yield('content')
        </main>
    </div>
    @yield('javascripts')
</body>
</html>
