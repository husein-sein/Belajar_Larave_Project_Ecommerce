<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="/" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-primary mb-6 transition-colors group">
            <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Beranda
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mb-8 border-l-4 border-primary pl-4">Profil Saya</h1>
        
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-primary/5 p-8 border-b border-gray-100 flex items-center gap-6">
                <div class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-4xl font-extrabold shadow-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-secondary">{{ $user->name }}</h2>
                    <p class="text-gray-500 font-medium">{{ $user->email }}</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-full uppercase tracking-widest">{{ $user->role }}</span>
                </div>
            </div>
            
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-xl flex items-center gap-2 text-sm font-bold">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url()->current() }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-200 rounded-xl focus:ring-primary focus:border-primary px-4 py-3 bg-gray-50">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Email</label>
                        <input type="email" value="{{ $user->email }}" disabled class="w-full border-gray-200 rounded-xl px-4 py-3 bg-gray-100 text-gray-400 cursor-not-allowed">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ $user->phone ?? '' }}" placeholder="0812xxxx" class="w-full border-gray-200 rounded-xl focus:ring-primary focus:border-primary px-4 py-3 bg-gray-50">
                    </div>
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 ml-1">Alamat Pengiriman</label>
                        <textarea name="address" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-primary focus:border-primary px-4 py-3 bg-gray-50" placeholder="Masukkan alamat lengkap Anda">{{ $user->address }}</textarea>
                    </div>
                    
                    <div class="md:col-span-2 pt-4">
                        <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-dark transition-all transform active:scale-95 shadow-lg shadow-primary/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
