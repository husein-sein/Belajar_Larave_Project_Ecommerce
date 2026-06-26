<x-admin-layout>
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-secondary tracking-tighter uppercase">Daftar Admin</h2>
            <p class="text-gray-400 font-medium">Kelola akses admin sistem.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase">
                        <tr>
                            <th class="px-8 py-6">Nama</th>
                            <th class="px-8 py-6">Email</th>
                            <th class="px-8 py-6 text-center">Bergabung</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($admins as $admin)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-4 font-black text-xs text-primary">{{ $admin->name }}</td>
                                <td class="px-8 py-4 text-xs font-bold text-secondary">{{ $admin->email }}</td>
                                <td class="px-8 py-4 text-center text-[10px] font-bold text-gray-500">
                                    {{ $admin->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 self-start">
            <h3 class="text-lg font-black text-secondary uppercase mb-6">Tambah Admin Baru</h3>
            <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full bg-gray-50 border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none transition-shadow" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-2">Email</label>
                    <input type="email" name="email" class="w-full bg-gray-50 border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none transition-shadow" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-gray-50 border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary outline-none transition-shadow" required minlength="8">
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-black text-xs uppercase tracking-widest py-4 rounded-xl transition-colors mt-4">
                    Simpan Admin
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
