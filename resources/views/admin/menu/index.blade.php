<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">Kelola Menu</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3">Tambah Menu</a>

        @foreach ($menus as $menu)
            <div class="border p-3 mb-2">
                <strong>{{ $menu->nama_menu }}</strong> - Rp{{ number_format($menu->harga) }}
                <div>
                    <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.menu.destroy', $menu) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
