<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'بلاگ')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">

<!-- Header -->
<x-blog.header/>

<!-- Main Content -->
<main class="min-h-screen">
    @yield('content')
</main>

<!-- Footer -->
<x-blog.footer/>

<!-- Livewire Scripts -->
@livewireScripts
</body>
</html>
