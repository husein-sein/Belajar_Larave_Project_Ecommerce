<x-admin-layout>
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-secondary tracking-tighter uppercase">Daftar Pesanan</h2>
            <p class="text-gray-400 font-medium">Lacak dan kelola transaksi pelanggan.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase">
                    <tr>
                        <th class="px-8 py-6">Order #</th>
                        <th class="px-8 py-6">Customer</th>
                        <th class="px-8 py-6 text-right">Total</th>
                        <th class="px-8 py-6 text-center">Status</th>
                        <th class="px-8 py-6 text-center">Tanggal</th>
                        <th class="px-8 py-6 text-center">Batas Pengiriman</th>
                        <th class="px-8 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-4 font-black text-xs text-primary">{{ $order->order_number }}</td>
                            <td class="px-8 py-4">
                                <p class="text-xs font-black text-secondary">{{ $order->user->name }}</p>
                                <p class="text-[10px] text-gray-400 font-medium tracking-tight">{{ $order->user->email }}</p>
                            </td>
                            <td class="px-8 py-4 text-right font-black text-xs text-secondary">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-4 text-center">
                                @php
                                    $statusColor = [
                                        'pending' => 'bg-yellow-100 text-yellow-600 border-yellow-200',
                                        'processing' => 'bg-blue-100 text-blue-600 border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-600 border-purple-200',
                                        'completed' => 'bg-green-100 text-green-600 border-green-200',
                                    ][$order->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                                @endphp
                                <span class="px-3 py-1 font-black text-[9px] rounded-full uppercase tracking-tighter border {{ $statusColor }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-center text-[10px] font-bold text-gray-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-4 text-center text-[10px] font-bold">
                                @if($order->status === 'shipped' && $order->estimated_delivery_date)
                                    <span class="text-purple-600">
                                        {{ \Carbon\Carbon::parse($order->estimated_delivery_date)->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="text-[10px] font-black text-gray-500 hover:text-primary transition-colors">DETAIL</button>
                                    
                                    @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" style="background-color: #3b82f6; color: white;" class="text-[10px] font-black px-3 py-1 rounded hover:opacity-80 transition-opacity">PROSES</button>
                                    </form>
                                    @endif

                                    @if($order->status === 'processing')
                                    <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="shipped">
                                        <button type="submit" style="background-color: #a855f7; color: white;" class="text-[10px] font-black px-3 py-1 rounded hover:opacity-80 transition-opacity">KIRIM</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-gray-50">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
