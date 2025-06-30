<x-app-layout>
<h2>Daftar Pesanan Masuk</h2>

@foreach ($pesanans as $pesanan)
    <div style="border:1px solid #ccc; padding:10px; margin:10px 0">
        <p><strong>Nama Pelanggan:</strong> {{ $pesanan->nama_pelanggan }}</p>
        <p><strong>No Meja:</strong> {{ $pesanan->nomor_meja }}</p>
        <p><strong>Status:</strong> {{ $pesanan->status }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>

        <ul>
            @foreach ($pesanan->items as $item)
                <li>{{ $item->menu->nama_menu }} (x{{ $item->jumlah }})</li>
            @endforeach
        </ul>

        <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus pesanan ini?')">
            @csrf
            @method('DELETE')
        <button type="submit">Hapus</button>
        </form>


        @if ($pesanan->status == 'pending')
            <form action="{{ route('admin.pesanan.konfirmasi', $pesanan->id) }}" method="POST">
                @csrf
                <button type="submit">Konfirmasi Selesai</button>
            </form>
        @endif
    </div>
@endforeach
</x-app-layout>