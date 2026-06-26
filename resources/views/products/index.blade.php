<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="w-full md:w-64 space-y-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <a href="{{ route('products.index') }}" class="block hover:text-primary transition-colors {{ !request('category') ? 'text-primary font-bold' : '' }}">Semua Produk</a>
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                           class="block hover:text-primary transition-colors {{ request('category') == $category->slug ? 'text-primary font-bold' : '' }}">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Harga</h3>
                    <div class="space-y-4">
                        <input type="number" placeholder="Min" class="w-full text-sm border-gray-200 rounded-lg focus:ring-primary focus:border-primary">
                        <input type="number" placeholder="Max" class="w-full text-sm border-gray-200 rounded-lg focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ request('category') ? 'Kategori: ' . ucfirst(request('category')) : 'Semua Produk' }}
                    </h1>
                    <div class="text-sm text-gray-500">
                        Menampilkan {{ $products->total() }} produk
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="group bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                        <a href="{{ route('product.show', $product->slug) }}" class="relative aspect-square overflow-hidden bg-gray-50">
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </a>

                        <div class="p-4 flex flex-col flex-1">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-sm font-medium text-gray-800 line-clamp-2 mb-2 group-hover:text-primary transition-colors h-10">
                                {{ $product->name }}
                            </a>
                            
                            <div class="mt-auto">
                                <p class="text-lg font-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                
                                <div class="flex items-center mt-2 space-x-1">
                                    <div class="flex items-center text-yellow-400">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <span class="text-xs font-medium text-gray-500 ml-1">4.9</span>
                                    </div>
                                    <span class="text-[10px] text-gray-400 font-medium ml-2">50+ Terjual</span>
                                </div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('product.show', $product->slug) }}" class="text-center bg-gray-100 text-gray-800 text-[10px] font-bold py-2 rounded-lg hover:bg-gray-200 transition-colors">Detail</a>
                                <form action="{{ route('cart.add') }}" method="POST" class="flex w-full">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-primary/10 text-primary text-[10px] font-bold py-2 rounded-lg hover:bg-primary hover:text-white transition-all">+ Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
