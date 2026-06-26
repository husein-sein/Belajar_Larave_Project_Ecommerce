<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm font-medium text-gray-500">
            <a href="/" class="hover:text-primary transition-colors">Home</a>
            <span class="mx-2 text-gray-300">/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-primary transition-colors">{{ $product->category->name }}</a>
            <span class="mx-2 text-gray-300">/</span>
            <span class="text-secondary truncate">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20">
            <!-- Product Images Section -->
            <div x-data="{ activeImg: '{{ $product->image }}' }">
                <div class="aspect-square bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-xl mb-6 group relative">
                    <img :src="activeImg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $product->name }}">
                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                </div>
                <!-- Thumbnail Logic (Placeholder for now, can be expanded if multiple images exist) -->
                <div class="flex gap-4">
                    <button @click="activeImg = '{{ $product->image }}'" class="w-20 h-20 bg-white rounded-xl overflow-hidden border-2 transition-all p-1" :class="activeImg === '{{ $product->image }}' ? 'border-primary' : 'border-transparent'">
                        <img src="{{ $product->image }}" class="w-full h-full object-cover rounded-lg">
                    </button>
                    <!-- More dummy thumbnails -->
                    @for($i=1; $i<=2; $i++)
                    <div class="w-20 h-20 bg-gray-100 rounded-xl border border-gray-100 flex items-center justify-center text-gray-300">
                         <i class="fa-solid fa-image text-xl"></i>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="flex flex-col">
                <div class="mb-6">
                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-bold rounded-full mb-4 inline-block uppercase tracking-wider">{{ $product->category->name }}</span>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-secondary mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span class="text-sm font-bold text-secondary">4.9</span>
                            <span class="text-sm text-gray-400">(150+ Penilaian)</span>
                        </div>
                        <span class="h-4 w-[1px] bg-gray-200"></span>
                        <div class="text-sm text-gray-500 font-medium">
                            Terjual <span class="text-secondary font-bold">2.5rb+</span>
                        </div>
                    </div>
                </div>

                <div class="mb-8 p-8 bg-gray-50 rounded-2xl border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Harga Spesial</p>
                        <div class="flex items-baseline gap-3">
                            <span class="text-4xl font-extrabold text-primary tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-400 line-through">Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="px-3 py-1.5 bg-red-100 text-red-600 font-bold text-xs rounded-lg">Hemat 20%</div>
                </div>

                <!-- Tabs/Description Section -->
                <div class="mb-10 space-y-6">
                    <div class="border-b border-gray-100 flex gap-8">
                        <button class="pb-4 border-b-2 border-primary text-primary font-bold text-sm">Deskripsi</button>
                        <button class="pb-4 text-gray-400 font-medium text-sm hover:text-gray-600 transition-colors">Spesifikasi</button>
                    </div>
                    <div class="prose prose-sm text-gray-600 max-w-none leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <!-- Shopping Card/Actions -->
                <div class="mt-auto p-6 bg-white border border-gray-100 rounded-3xl shadow-2xl shadow-gray-200/50" x-data="{ qty: 1 }">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-center gap-6">
                            <span class="text-sm font-bold text-gray-700">Jumlah</span>
                            <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
                                <button @click="if(qty > 1) qty--" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 text-primary font-bold transition-colors">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>
                                <input type="number" x-model="qty" class="w-12 text-center border-none focus:ring-0 text-sm font-bold bg-transparent" readonly>
                                <button @click="if(qty < {{ $product->stock }}) qty++" class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 text-primary font-bold transition-colors">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 font-medium font-mono uppercase">Stok: {{ $product->stock }}</p>
                        </div>
                        
                        <div class="flex gap-4">
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-1 md:flex-none flex">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" x-bind:value="qty">
                                <button type="submit" class="w-full flex items-center justify-center gap-3 px-8 py-3.5 bg-primary/10 text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all transform active:scale-95 group">
                                    <i class="fa-solid fa-cart-shopping transition-transform group-hover:scale-125"></i>
                                    <span class="text-sm">+ Keranjang</span>
                                </button>
                            </form>
                            <a href="{{ route('checkout.index') }}" class="flex-1 md:flex-none flex items-center justify-center px-8 py-3.5 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark shadow-lg shadow-primary/20 transition-all transform active:scale-95 text-sm">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="mt-24">
             <div class="flex items-center justify-between mb-12">
                <h2 class="text-2xl font-bold border-l-4 border-primary pl-4">Produk Pilihan Untuk Anda</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
             </div>
             
             <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl transition-all h-full flex flex-col overflow-hidden">
                        <a href="{{ route('product.show', $related->slug) }}" class="aspect-square bg-gray-50 overflow-hidden block">
                             <img src="{{ $related->image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </a>
                        <div class="p-4 flex flex-col flex-1">
                            <a href="{{ route('product.show', $related->slug) }}">
                                <h3 class="font-bold text-secondary text-xs mb-2 group-hover:text-primary leading-tight line-clamp-2 h-8">
                                     {{ $related->name }}
                                </h3>
                            </a>
                            <p class="text-sm font-extrabold text-primary mt-auto">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            
                            <div class="flex items-center mt-2 space-x-1">
                                <i class="fa-solid fa-star text-yellow-400 text-[10px]"></i>
                                <span class="text-[10px] font-bold text-gray-500">4.9</span>
                            </div>
                        </div>
                    </div>
                @endforeach
             </div>
        </div>
    </div>
</x-app-layout>
