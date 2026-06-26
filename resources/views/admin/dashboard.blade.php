<x-admin-layout>
    <div class="mb-12">
        <h2 class="text-3xl font-black text-secondary tracking-tighter uppercase">Overview Dashboard</h2>
        <p class="text-gray-400 font-medium">Monitoring performa toko dan manajemen akses cepat.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all group relative overflow-hidden">
            <div class="absolute right-[-10px] top-[-10px] opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fa-solid fa-cart-shopping text-8xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 group-hover:text-primary transition-colors">Total Pesanan</p>
            <h3 class="text-4xl font-black text-secondary">{{ $totalOrders }}</h3>
            <p class="text-xs text-green-500 font-bold mt-2"><i class="fa-solid fa-arrow-up mr-1"></i> +12% vs bulan lalu</p>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-accent/20 transition-all group relative overflow-hidden">
            <div class="absolute right-[-10px] top-[-10px] opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fa-solid fa-dollar-sign text-8xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 group-hover:text-accent transition-colors">Total Pendapatan</p>
            <h3 class="text-3xl font-black text-secondary">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <p class="text-xs text-green-500 font-bold mt-2"><i class="fa-solid fa-arrow-up mr-1"></i> +5.4% harian</p>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all group relative overflow-hidden">
            <div class="absolute right-[-10px] top-[-10px] opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fa-solid fa-box text-8xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 group-hover:text-primary transition-colors">Katalog Produk</p>
            <h3 class="text-4xl font-black text-secondary">{{ $totalProducts }}</h3>
            <p class="text-xs text-gray-400 font-bold mt-2">Aktif di etalase</p>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-primary/20 transition-all group relative overflow-hidden">
            <div class="absolute right-[-10px] top-[-10px] opacity-5 group-hover:opacity-10 transition-opacity">
                <i class="fa-solid fa-users text-8xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 group-hover:text-primary transition-colors">Total Pengguna</p>
            <h3 class="text-4xl font-black text-secondary">{{ $totalUsers }}</h3>
            <p class="text-xs text-gray-400 font-bold mt-2">Member terdaftar</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Form Assign -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden h-full">
                <div class="p-8 border-b border-gray-100 bg-secondary/5">
                    <h4 class="font-black text-secondary uppercase text-sm tracking-widest">Penambahan Inventori User</h4>
                    <p class="text-xs text-gray-500 mt-1">Berikan barang langsung ke akun user tertentu.</p>
                </div>
                <div class="p-8">
                    <form action="{{ route('admin.assign-product') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama User</label>
                            <select name="user_id" required class="w-full border-gray-100 rounded-2xl focus:ring-primary focus:border-primary text-sm px-4 py-4 bg-gray-50 font-bold">
                                <option value="" disabled selected>Pilih target user...</option>
                                @foreach($allUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Item Produk</label>
                            <select name="product_id" required class="w-full border-gray-100 rounded-2xl focus:ring-primary focus:border-primary text-sm px-4 py-4 bg-gray-50 font-bold">
                                <option value="" disabled selected>Pilih item produk...</option>
                                @foreach($allProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kuantitas</label>
                            <input type="number" name="quantity" value="1" min="1" required class="w-full border-gray-100 rounded-2xl focus:ring-primary focus:border-primary text-sm px-4 py-4 bg-gray-50 font-bold">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white font-black py-4 rounded-2xl hover:bg-primary-dark transition-all transform active:scale-95 shadow-xl shadow-primary/20 uppercase tracking-widest text-xs">
                            Kirim Barang Sekarang
                        </button>
                    </form>
                    @if(session('success'))
                        <div class="mt-6 p-4 bg-green-50 text-green-600 text-[10px] font-black rounded-2xl border border-green-100 flex items-center gap-2 uppercase">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right: Recent Activity -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full">
                <div class="p-8 border-b border-gray-100 flex items-center justify-between">
                    <h4 class="font-black text-secondary uppercase text-sm tracking-widest">Aktivitas Pesanan Terakhir</h4>
                    <a href="{{ route('admin.orders') }}" class="text-[10px] font-black text-primary hover:underline uppercase tracking-widest">Semua Pesanan</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase">
                            <tr>
                                <th class="px-8 py-6 tracking-widest">ID Pesanan</th>
                                <th class="px-8 py-6 tracking-widest">Kostumer</th>
                                <th class="px-8 py-6 tracking-widest text-right">Nominal</th>
                                <th class="px-8 py-6 tracking-widest text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($latestOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-5 font-black text-xs text-primary">{{ $order->order_number }}</td>
                                    <td class="px-8 py-5">
                                        <p class="text-xs font-black text-secondary">{{ $order->user->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">{{ $order->user->email }}</p>
                                    </td>
                                    <td class="px-8 py-5 text-right font-black text-xs text-secondary">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span class="px-3 py-1 bg-green-100 text-green-600 font-black text-[9px] rounded-full uppercase tracking-tighter shadow-sm border border-green-200">{{ $order->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center text-gray-400 italic">Data pesanan masih kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
