<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;800&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Sora', sans-serif; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-100 to-indigo-50 text-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            
            <div class="mb-6">
                <a href="/">
                    <div class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md hover:scale-105 transition-transform">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 0a3 3 0 100-6 3 3 0 000 6zM3 20a3 3 0 013-3"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 px-8 py-10">
                {{ $slot }}
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">CRM System · Auth Module</p>
        </div>
    </body>
</html>