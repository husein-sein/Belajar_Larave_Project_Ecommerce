<x-admin-layout>
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-secondary tracking-tighter uppercase">Daftar Produk</h2>
            <p class="text-gray-400 font-medium">Manajemen stok dan katalog barang IT.</p>
        </div>
        <button class="bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Produk
        </button>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase">
                    <tr>
                        <th class="px-8 py-6">Produk</th>
                        <th class="px-8 py-6">Kategori</th>
                        <th class="px-8 py-6 text-right">Harga</th>
                        <th class="px-8 py-6 text-center">Stok</th>
                        <th class="px-8 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 overflow-hidden">
                                        <img src="{{ $product->image }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-xs font-black text-secondary">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <span class="text-[10px] font-bold px-2 py-1 bg-gray-100 rounded-md text-gray-600 uppercase">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-8 py-4 text-right font-black text-xs text-secondary">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-4 text-center font-bold text-xs">
                                <span class="{{ $product->stock < 10 ? 'text-red-500' : 'text-gray-600' }}">{{ $product->stock }}</span>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $products->links() }}
        </div>
    </div>
</x-admin-layout>
