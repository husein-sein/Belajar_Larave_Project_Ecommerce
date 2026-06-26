<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ecommerce IT') }}</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
<body class="bg-gray-50 text-secondary antialiased" x-data="{ searchOpen: false }">

    <!-- Header / Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-8">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary tracking-tight">
                        Ecommerce <span class="text-secondary">IT</span>
                    </a>
                </div>

                <!-- Search (Tokopedia Style) -->
                <div class="hidden md:flex flex-1 max-w-2xl px-4">
                    <div class="relative w-full group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari Server, Laptop, atau PC..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg bg-gray-50 leading-5 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200">
                    </div>
                </div>

                <!-- Icons & User Profile -->
                <div class="flex items-center gap-4 sm:gap-6">
                    <!-- Wishlist -->
                    <a href="#" class="text-gray-500 hover:text-primary relative group">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 block h-4 w-4 bg-red-500 text-white text-[10px] font-bold text-center rounded-full leading-4">0</span>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-primary relative group">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 block h-4 w-4 bg-primary text-white text-[10px] font-bold text-center rounded-full leading-4">
                            {{ auth()->check() ? \App\Models\CartItem::whereHas('cart', function($q){ $q->where('user_id', auth()->id()); })->sum('quantity') : 0 }}
                        </span>
                    </a>

                    @auth
                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none group">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center border border-primary/20 group-hover:bg-primary/20 transition-colors">
                                    <span class="text-primary font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden sm:inline text-sm font-medium text-gray-700 group-hover:text-primary transition-colors">{{ auth()->user()->name }}</span>
                            </button>
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-primary font-bold hover:bg-primary/5">Admin Dashboard</a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                @endif
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login/Register Buttons -->
                        <div class="flex items-center gap-2">
                             <a href="/login" class="px-4 py-1.5 text-sm font-semibold text-primary border border-primary rounded-lg hover:bg-primary hover:text-white transition-all">Masuk</a>
                             <a href="/register" class="px-4 py-1.5 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-primary-dark shadow-sm shadow-primary/20 transition-all">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Slot -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="/" class="text-2xl font-bold text-white tracking-tight mb-4 inline-block">
                        Ecommerce <span class="text-primary">IT</span>
                    </a>
                    <p class="text-sm leading-relaxed mb-6">
                        Solusi terbaik untuk kebutuhan infrastruktur IT Anda. Dari Server hingga Aksesoris, kami menyediakan barang asli bergaransi.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="hover:text-primary transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="hover:text-primary transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zM12 7.004c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8.22c-1.778 0-3.22-1.442-3.22-3.22s1.442-3.22 3.22-3.22 3.22 1.442 3.22 3.22-1.442 3.22-3.22 3.22zm5.23-8.415a1.2 1.2 0 100-2.4 1.2 1.2 0 000 2.4z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Belanja</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Server</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">PC Komputer</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Laptop</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Networking</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Bantuan</h4>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-primary transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Kontak</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Cara Belanja</a></li>
                        <li><a href="#" class="hover:text-primary transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Pembayaran</h4>
                    <div class="grid grid-cols-4 gap-2">
                        <div class="h-8 bg-white/10 rounded flex items-center justify-center font-bold text-[10px]">GOPAY</div>
                        <div class="h-8 bg-white/10 rounded flex items-center justify-center font-bold text-[10px]">DANA</div>
                        <div class="h-8 bg-white/10 rounded flex items-center justify-center font-bold text-[10px]">QRIS</div>
                        <div class="h-8 bg-white/10 rounded flex items-center justify-center font-bold text-[10px]">BANK</div>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800 text-center text-xs">
                &copy; {{ date('Y') }} Ecommerce IT. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
