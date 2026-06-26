<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Ecommerce IT</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-secondary antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-secondary text-gray-400 fixed inset-y-0 left-0 z-50 transition-transform lg:translate-x-0 lg:static">
            <div class="p-8">
                <a href="/" class="text-xl font-black text-white tracking-tighter">
                    ECOMMERCE <span class="text-primary italic">IT</span>
                    <p class="text-[10px] text-gray-500 font-bold tracking-[0.2em] mt-1">ADMIN CONSOLE</p>
                </a>
            </div>

            <nav class="mt-8 px-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white font-bold' : 'hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.products') ? 'bg-primary text-white font-bold' : 'hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-box w-5"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.categories') ? 'bg-primary text-white font-bold' : 'hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-tags w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.orders') ? 'bg-primary text-white font-bold' : 'hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-cart-shopping w-5"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('admin.admins') }}" class="flex items-center gap-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.admins') ? 'bg-primary text-white font-bold' : 'hover:bg-white/5 hover:text-white' }}">
                    <i class="fa-solid fa-user-shield w-5"></i>
                    <span>Admins</span>
                </a>
                <div class="pt-8 pb-4">
                    <p class="text-[10px] uppercase font-black text-gray-600 tracking-widest px-3 mb-4">User Access</p>
                    <a href="/" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 hover:text-white transition-all text-sm">
                        <i class="fa-solid fa-arrow-left w-5"></i>
                        <span>Ke Beranda Utama</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-500/10 hover:text-red-500 transition-all text-sm">
                            <i class="fa-solid fa-right-from-bracket w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-100 h-16 flex items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-gray-500">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-sm font-bold text-gray-400 capitalize">{{ str_replace('.', ' / ', request()->route()->getName()) }}</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex flex-col text-right">
                        <p class="text-xs font-black text-secondary uppercase">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] font-bold text-primary uppercase leading-tight">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center border border-primary/20">
                        <span class="text-primary font-black text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>
