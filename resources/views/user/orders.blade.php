<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Riwayat Pesanan</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 pb-4 border-b border-gray-50 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Nomor Pesanan</p>
                            <p class="font-bold text-gray-900">{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal</p>
                            <p class="font-bold text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total</p>
                            <p class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Metode</p>
                            <p class="font-bold text-gray-900">{{ $order->paymentMethod->name ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Status</p>
                            @php
                                $statusColor = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'shipped' => 'bg-purple-100 text-purple-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                ][$order->status] ?? 'bg-gray-100 text-gray-800';
                                
                                $statusLabel = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'processing' => 'Diproses',
                                    'shipped' => 'Di Perjalanan',
                                    'completed' => 'Selesai',
                                ][$order->status] ?? ucfirst($order->status);
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @if($order->status === 'shipped' && $order->estimated_delivery_date)
                            <div class="bg-purple-50 p-4 rounded-xl flex items-start gap-4 mb-4 border border-purple-100">
                                <i class="fa-solid fa-truck-fast text-purple-500 text-xl mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-sm text-purple-900">Pesanan Dalam Perjalanan</h4>
                                    <p class="text-xs text-purple-700 mt-1">
                                        Estimasi sampai pada: <span class="font-black">{{ \Carbon\Carbon::parse($order->estimated_delivery_date)->format('d M Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        @endif

                        @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <img src="{{ $item->product->image }}" class="w-16 h-16 rounded-xl object-cover">
                            <div>
                                <h4 class="font-bold text-sm text-gray-800">{{ $item->product->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($order->status === 'shipped')
                    <div class="mt-6 pt-4 border-t border-gray-50 flex justify-end">
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-600 transition-all shadow-lg shadow-green-500/30">
                                Sudah Sampai
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <i class="fa-solid fa-box-open text-6xl text-gray-200 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-500 mb-6">Ayo mulai belanja dan temukan produk menarik!</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                        Mulai Belanja
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
