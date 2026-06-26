<x-app-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl border border-gray-100">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-secondary tracking-tight">Daftar Akun Baru</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Bergabung dengan ribuan pengguna Ecommerce IT
                </p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 ml-1 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" autocomplete="name" required 
                               class="appearance-none block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm" 
                               placeholder="Contoh: Husein Al-Banjary" value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
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
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm" 
                               placeholder="********">
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 ml-1 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                               class="appearance-none block w-full px-4 py-3 border border-gray-200 placeholder-gray-400 text-gray-900 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all sm:text-sm" 
                               placeholder="********">
                    </div>
                </div>

                <p class="text-[10px] text-gray-400 text-center leading-relaxed">
                    Dengan mendaftar, Saya menyetujui <a href="#" class="text-primary font-bold">Syarat & Ketentuan</a> serta <a href="#" class="text-primary font-bold">Kebijakan Privasi</a>.
                </p>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.02] active:scale-95">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="text-center text-sm text-gray-500 font-medium pt-4">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-dark">Masuk di sini</a>
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
