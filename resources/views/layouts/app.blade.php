<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="/sidebar-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/sidebar-assets/css/sidebar-style.css" rel="stylesheet">
    <link href="/css/root/root.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/root/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('customCSS')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 d-flex">

        <!-- Page Heading -->
        <header>
            @include('root.sidebar')
        </header>

        <!-- Page Content -->
        {{-- <main> --}}
        <main>
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        @yield('customJS')
    </div>
</body>

</html>
