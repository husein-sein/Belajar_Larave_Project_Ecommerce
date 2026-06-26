<x-app-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl border border-gray-100">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-secondary tracking-tight">Selamat Datang Kembali</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Masuk ke akun Ecommerce IT Anda
                </p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 ml-1 mb-2">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                               class="appearance-none block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm" 
                               placeholder="nama@email.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 ml-1 mb-2">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm" 
                               placeholder="********">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded-md">
                        <label for="remember" class="ml-2 block text-sm text-gray-500 font-medium">Ingat saya</label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-bold text-primary hover:text-primary-dark">Lupa password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.02] active:scale-95">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fa-solid fa-lock text-primary-light group-hover:text-white transition-colors"></i>
                        </span>
                        Masuk Ke Akun
                    </button>
                </div>
            </form>

            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-100"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-400 font-medium">Atau masuk dengan</span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="w-full inline-flex justify-center py-2.5 px-4 rounded-xl shadow-sm bg-white border border-gray-100 text-sm font-bold text-gray-500 hover:bg-gray-50 transition-all transform hover:scale-[1.02]">
                    <i class="fa-brands fa-google text-red-500 mr-2"></i> Google
                </button>
                <button class="w-full inline-flex justify-center py-2.5 px-4 rounded-xl shadow-sm bg-white border border-gray-100 text-sm font-bold text-gray-500 hover:bg-gray-50 transition-all transform hover:scale-[1.02]">
                    <i class="fa-brands fa-facebook text-blue-600 mr-2"></i> Facebook
                </button>
            </div>

            <p class="text-center text-sm text-gray-500 font-medium">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-primary hover:text-primary-dark">Daftar sekarang</a>
            </p>

            <div class="pt-6 border-t border-gray-50 text-center">
                <a href="/" class="text-xs font-bold text-gray-400 hover:text-primary transition-colors inline-flex items-center group">
                    <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
