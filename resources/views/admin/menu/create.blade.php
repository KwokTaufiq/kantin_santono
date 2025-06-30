<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Menu</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama_menu" placeholder="Nama menu" class="form-control mb-2">
            <input type="number" name="harga" placeholder="Harga" class="form-control mb-2">
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
</x-app-layout>
