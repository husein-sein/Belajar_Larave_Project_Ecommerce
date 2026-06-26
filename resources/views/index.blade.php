<x-app-layout>
    <div class="space-y-12 pb-20">
        <!-- Hero Banner Container -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="relative h-[300px] md:h-[450px] rounded-3xl overflow-hidden shadow-2xl shadow-primary/10">
                <img src="https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?auto=format&fit=crop&q=80&w=2600" class="absolute inset-0 w-full h-full object-cover" alt="Hero Promo">
                <div class="absolute inset-0 bg-gradient-to-r from-secondary/80 to-transparent flex items-center p-8 md:p-16">
                    <div class="max-w-md">
                        <span class="inline-block px-3 py-1 bg-primary text-white text-xs font-bold rounded-full mb-4 animate-bounce">PROMO RAMADAN</span>
                        <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">Upgrade Infrastruktur IT Anda Sekarang!</h1>
                        <p class="text-gray-200 text-sm md:text-lg mb-8">Dapatkan diskon hingga <span class="text-primary font-bold">25%</span> untuk semua produk Networking & Server.</p>
                        <a href="{{ route('products.index') }}" class="px-8 py-3 bg-white text-secondary font-bold rounded-xl hover:bg-primary hover:text-white transition-all transform hover:scale-105 active:scale-95 duration-200 shadow-xl inline-block">Mulai Belanja</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold border-l-4 border-primary pl-4">Kategori Populer</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors">Lihat Semua &rarr;</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group block text-center bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-primary/20 transition-all duration-300">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/10 transition-colors">
                             <i class="fa-solid {{ $category->id == 1 ? 'fa-server' : ($category->id == 2 ? 'fa-desktop' : ($category->id == 3 ? 'fa-laptop' : ($category->id == 4 ? 'fa-mobile-screen' : ($category->id == 5 ? 'fa-wifi' : 'fa-keyboard')))) }} text-2xl text-gray-400 group-hover:text-primary group-hover:scale-125 transition-all"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-700 group-hover:text-primary">{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Latest Products -->
        <div id="produk" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold border-l-4 border-primary pl-4">Produk Terbaru</h2>
                <div class="flex gap-2">
                     <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-xs font-bold rounded-full hover:bg-primary hover:text-white transition-all">Semua Produk</a>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                @foreach($products as $product)
                    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                        <!-- Product Image -->
                        <a href="{{ route('product.show', $product->slug) }}" class="relative aspect-square overflow-hidden bg-gray-50">
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if(rand(0,1))
                            <div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                                Promo
                            </div>
                            @endif
                        </a>

                        <!-- Product Info -->
                        <div class="p-3 flex flex-col flex-1">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-sm font-medium text-gray-800 line-clamp-2 mb-1 group-hover:text-primary transition-colors h-10">
                                {{ $product->name }}
                            </a>
                            
                            <div class="mt-auto">
                                <p class="text-sm font-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                
                                <div class="flex items-center mt-2 space-x-1">
                                    <div class="flex items-center text-yellow-400">
                                        <i class="fa-solid fa-star text-[10px]"></i>
                                        <span class="text-[10px] font-medium text-gray-500 ml-1">4.9</span>
                                    </div>
                                    <span class="text-[10px] text-gray-300">|</span>
                                    <span class="text-[10px] text-gray-500">Terjual {{ rand(1, 50) }}+</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="p-3 pt-0 md:opacity-0 group-hover:opacity-100 transition-opacity">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-primary text-white text-[10px] font-bold py-2 rounded-lg hover:bg-primary-dark transition-all shadow-md shadow-primary/20">
                                    + Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Popular Products Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-bold border-l-4 border-primary pl-4">Produk Populer</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-primary hover:text-primary-dark transition-colors">Lihat Semua &rarr;</a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 pb-12">
                @foreach($popularProducts as $product)
                <div class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                    <a href="{{ route('product.show', $product->slug) }}" class="relative aspect-square overflow-hidden bg-gray-50">
                        <img src="{{ $product->image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </a>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-gray-800 line-clamp-1 group-hover:text-primary transition-colors">{{ $product->name }}</h4>
                        <p class="text-sm font-black text-primary mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Banner Promo Small -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
             <div class="bg-gray-900 rounded-3xl p-8 relative overflow-hidden group">
                  <div class="relative z-10 max-w-[60%]">
                       <h3 class="text-2xl font-bold text-white mb-2">Peralatan Networking</h3>
                       <p class="text-gray-400 text-sm mb-6">Optimalkan kecepatan internet kantor Anda dengan Router Seri Terbaru.</p>
                       <a href="{{ route('products.index', ['category' => 'networking']) }}" class="text-primary font-bold hover:underline">Lihat Koleksi &rarr;</a>
                  </div>
                  <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc51?auto=format&fit=crop&q=80&w=400" class="absolute right-[-20px] bottom-[-20px] w-48 h-48 object-contain rotate-[-15deg] group-hover:scale-110 transition-transform" alt="Networking">
             </div>
             <div class="bg-primary/5 rounded-3xl p-8 border border-primary/20 relative overflow-hidden group">
                  <div class="relative z-10 max-w-[60%]">
                       <h3 class="text-2xl font-bold text-secondary mb-2">Build PC Impian</h3>
                       <p class="text-gray-600 text-sm mb-6">Konsultasi gratis untuk spesifikasi PC Kantor maupun Gaming.</p>
                       <a href="#" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary-dark">Hubungi Kami</a>
                  </div>
                  <img src="https://images.unsplash.com/photo-1542744094-24638eff58bb?auto=format&fit=crop&q=80&w=400" class="absolute right-[-20px] bottom-[-20px] w-48 h-48 object-contain group-hover:scale-110 transition-transform" alt="Build PC">
             </div>
        </div>
    </div>
</x-app-layout>
