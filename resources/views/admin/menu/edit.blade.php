<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Menu</h2>
    </x-slot>

    <form action="{{ route('admin.menu.update', $menu) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="form-control mb-2">
        <input type="number" name="harga" value="{{ $menu->harga }}" class="form-control mb-2">
        <button class="btn btn-primary">Update</button>
    </form>
    </div>
</x-app-layout>
