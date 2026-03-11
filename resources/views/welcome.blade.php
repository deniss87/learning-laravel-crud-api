<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NextCRM</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>👥</text></svg>">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;800&display=swap');
            body { font-family: 'Sora', sans-serif; }
        </style>
    </head>
    <body class="antialiased bg-gradient-to-br from-slate-100 to-indigo-50 min-h-screen flex items-center justify-center">

        <div class="w-full max-w-lg mx-auto px-4">

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-200 px-10 py-12 text-center">

                {{-- Icon --}}
                <div class="flex justify-center mb-6">
                    <div class="w-14 h-14 rounded-xl bg-indigo-600 flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 0a3 3 0 100-6 3 3 0 000 6zM3 20a3 3 0 013-3"/>
                        </svg>
                    </div>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl font-extrabold text-gray-900 mb-3 leading-tight">
                    Customer & Order<br>
                    <span class="text-indigo-600">Management</span>
                </h1>

                {{-- Subtitle --}}
                <p class="text-gray-500 text-sm leading-relaxed mb-10">
                    Welcome to our educational Laravel CRUD project.<br>
                    Manage your clients and orders efficiently.
                </p>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-7 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all duration-150">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-7 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl shadow-sm hover:bg-gray-50 active:scale-95 transition-all duration-150">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-7 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-md hover:bg-indigo-700 active:scale-95 transition-all duration-150">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>

            </div>

            {{-- Footer note --}}
            <p class="text-center text-xs text-gray-400 mt-6">Deniss Patancevs · Educational Project</p>

        </div>

    </body>
</html>