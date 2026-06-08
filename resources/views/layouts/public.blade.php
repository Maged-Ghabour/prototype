<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>معرض الأعمال - {{ \App\Models\AppSetting::first()?->app_name ?? 'النماذج التجريبية' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Cairo', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8fafc; }
    </style>
    
    @livewireStyles
</head>
<body class="antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="{{ route('portfolio') }}" class="-m-1.5 p-1.5 flex items-center gap-3">
                    @if($logo = \App\Models\AppSetting::first()?->logo_path)
                        <img class="h-10 w-auto" src="{{ asset('storage/' . $logo) }}" alt="Logo">
                    @else
                        <div class="h-10 w-10 bg-primary-600 text-white rounded-lg flex items-center justify-center font-bold text-xl">
                            {{ substr(\App\Models\AppSetting::first()?->app_name ?? 'P', 0, 1) }}
                        </div>
                    @endif
                    <span class="font-bold text-xl text-gray-900">{{ \App\Models\AppSetting::first()?->app_name ?? 'النماذج التجريبية' }}</span>
                </a>
            </div>
            <div class="flex gap-x-6">
                <a href="{{ route('portfolio') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-primary-600 transition-colors">المعرض</a>
                @auth
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-primary-600 transition-colors">لوحة التحكم <span aria-hidden="true">&larr;</span></a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="bg-white mt-auto border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-6 py-8 md:flex md:items-center md:justify-between lg:px-8">
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-gray-500">&copy; {{ date('Y') }} {{ \App\Models\AppSetting::first()?->app_name ?? 'النماذج التجريبية' }}. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
