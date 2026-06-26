<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center md:text-left">Pengiriman</h1>
        
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            
            @foreach($itemIds as $id)
                <input type="hidden" name="items[]" value="{{ $id }}">
            @endforeach

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Checkout Form -->
                <div class="flex-1 space-y-8">
                    
                    <!-- Selected Items Preview -->
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-primary/10 text-primary rounded-lg">
                                <i class="fa-solid fa-box text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Barang yang dibeli</h2>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                            <div class="flex items-center gap-4 border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                                <img src="{{ $item->product->image }}" class="w-16 h-16 rounded-xl object-cover">
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-primary/10 text-primary rounded-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Alamat Pengiriman</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                                <textarea name="shipping_address" rows="3" required class="w-full border-gray-200 rounded-xl focus:ring-primary focus:border-primary px-4 py-3" placeholder="Masukkan alamat lengkap pengiriman">{{ auth()->user()->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Section -->
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-primary/10 text-primary rounded-lg">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Metode Pembayaran</h2>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" x-data="{ selected: '{{ $paymentMethods->first()->id ?? 1 }}' }">
                            <input type="hidden" name="payment_method_id" x-model="selected">
                            
                            @foreach($paymentMethods as $payment)
                            <button type="button" @click="selected = '{{ $payment->id }}'" :class="selected == '{{ $payment->id }}' ? 'border-primary bg-primary/5 ring-2 ring-primary/20' : 'border-gray-100 hover:border-primary/50'" class="p-4 border rounded-2xl transition-all text-center flex flex-col items-center">
                                <span class="font-bold text-sm">{{ $payment->name }}</span>
                                <span class="text-[10px] text-gray-400 mt-1">{{ strtoupper($payment->code) }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Summary Sidebar -->
                <div class="w-full lg:w-96">
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-xl sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Total Harga ({{ $cartItems->sum('quantity') }} barang)</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Pengiriman</span>
                                <span class="text-gray-900 font-medium">Rp 25.000</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Layanan</span>
                                <span class="text-gray-900 font-medium">Rp 1.000</span>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                                <span class="text-primary font-extrabold text-2xl">Rp {{ number_format($total + 26000, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all transform hover:scale-[1.02] active:scale-95">
                            Bayar Sekarang
                        </button>
                        
                        <p class="text-[10px] text-gray-400 text-center mt-4">
                            Dengan menekan tombol di atas, Anda menyetujui <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> kami.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
