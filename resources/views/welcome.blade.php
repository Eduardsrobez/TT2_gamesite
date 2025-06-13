<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GameSite</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 text-gray-100 flex flex-col justify-center items-center p-6">

<!-- Main Card -->
<div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-16 max-w-4xl w-full text-center border border-gray-700 transition-all duration-300">

    <!-- Logo -->
    <div class="mb-10 flex justify-center">
        <x-application-logo class="h-24 w-auto fill-current text-gray-800 dark:text-gray-200" />
    </div>

    <!-- Name -->
    <div class="mb-8">
        <h1 class="text-5xl font-extrabold text-white tracking-wide">
            GameSite
        </h1>
    </div>

    <!-- Welcome Text -->
    <div class="mb-12 text-center text-lg leading-relaxed text-gray-300 px-8">
        Welcome to <span class="font-semibold text-white">GameSite</span> — where indie developers meet testers and gamers.
        Submit your game, test new releases, leave reviews, and explore creative projects.
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-8">
        <a href="{{ route('login') }}" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-xl font-semibold rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
            Login
        </a>
        <a href="{{ route('register') }}" class="px-10 py-4 bg-green-500 hover:bg-green-600 text-white text-xl font-semibold rounded-xl shadow-lg transition-transform transform hover:-translate-y-1">
            Register
        </a>
    </div>
</div>

<!-- Footer -->
<div class="mt-10 text-sm text-gray-500">
    © {{ date('Y') }} GameSite. All rights reserved.
</div>

</body>
</html>
