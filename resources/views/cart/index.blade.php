<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" 
         x-data="{
            cartItems: {{ json_encode($cartItems->map(function($item) { return ['id' => $item->id, 'price' => $item->product->price, 'qty' => $item->quantity]; })) }},
            selectedItems: [],
            get allSelected() {
                return this.cartItems.length > 0 && this.selectedItems.length === this.cartItems.length;
            },
            toggleAll() {
                if (this.allSelected) {
                    this.selectedItems = [];
                } else {
                    this.selectedItems = this.cartItems.map(item => item.id);
                }
            },
            get selectedTotal() {
                return this.selectedItems.reduce((total, id) => {
                    let item = this.cartItems.find(i => i.id == id);
                    return total + (item ? item.price * item.qty : 0);
                }, 0);
            },
            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            }
         }">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 mb-4">Keranjang belanja Anda kosong.</p>
                <a href="{{ route('products.index') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">Belanja Sekarang</a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="flex-1 space-y-4">
                    <!-- Select All Checkbox -->
                    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 mb-4">
                        <input type="checkbox" id="selectAll" class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary"
                               :checked="allSelected" @change="toggleAll()">
                        <label for="selectAll" class="font-bold text-gray-900 cursor-pointer">Pilih Semua</label>
                    </div>

                    @foreach($cartItems as $item)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-6">
                        <!-- Checkbox -->
                        <input type="checkbox" x-model="selectedItems" value="{{ $item->id }}" class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                        
                        <img src="{{ $item->product->image ?? 'https://placehold.co/200' }}" class="w-24 h-24 object-cover rounded-xl" alt="{{ $item->product->name }}">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900">{{ $item->product->name }}</h3>
                            <p class="text-primary font-bold mt-1">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center border border-gray-200 rounded-lg">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $item->quantity > 1 ? $item->quantity - 1 : 1 }}">
                                <button type="submit" class="p-2 hover:bg-gray-50 text-gray-400" @if($item->quantity <= 1) disabled @endif>-</button>
                            </form>
                            
                            <span class="px-4 font-bold text-sm">{{ $item->quantity }}</span>
                            
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center border border-gray-200 rounded-lg">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="p-2 hover:bg-gray-50 text-gray-400">+</button>
                            </form>
                        </div>

                        <div class="text-right w-32">
                            <p class="text-xs text-gray-400 mb-1">Subtotal</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                        </div>

                        <!-- Remove Button -->
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="w-full lg:w-96">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-xl sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Belanja</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Total Harga (<span x-text="selectedItems.length"></span> barang)</span>
                                <span class="text-gray-900 font-medium" x-text="formatRupiah(selectedTotal)"></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Total Diskon</span>
                                <span class="text-green-500 font-medium">- Rp 0</span>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span>Total</span>
                                <span class="text-primary font-extrabold text-2xl" x-text="formatRupiah(selectedTotal)"></span>
                            </div>
                        </div>

                        <form action="{{ route('checkout.index') }}" method="POST">
                            @csrf
                            <!-- We can pass selected items as an array -->
                            <template x-for="itemId in selectedItems" :key="itemId">
                                <input type="hidden" name="items[]" :value="itemId">
                            </template>
                            <button type="submit" :disabled="selectedItems.length === 0" 
                                    class="block w-full text-center bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                                Beli (<span x-text="selectedItems.length"></span>)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
