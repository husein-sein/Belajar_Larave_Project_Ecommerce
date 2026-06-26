<x-admin-layout>
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-secondary tracking-tighter uppercase">Kategori Produk</h2>
            <p class="text-gray-400 font-medium">Pengaturan kategori untuk pengelompokan produk.</p>
        </div>
        <button class="bg-secondary text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition-all shadow-lg shadow-gray-200">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center mb-4 group-hover:bg-primary transition-colors">
                    <i class="fa-solid fa-folder-tree text-primary group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="text-lg font-black text-secondary uppercase tracking-tight">{{ $category->name }}</h3>
                <p class="text-xs text-gray-400 font-bold tracking-widest mt-1">SLUG: {{ $category->slug }}</p>
                <div class="mt-6 flex gap-2">
                    <button class="flex-1 bg-gray-50 text-gray-400 hover:text-primary hover:bg-primary/5 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Edit</button>
                    <button class="p-2 text-red-100 hover:text-red-500 transition-colors"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            </div>
        @endforeach
    </div>
</x-admin-layout>
