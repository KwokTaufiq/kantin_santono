<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananItem;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('items.menu')->latest()->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_pelanggan' => 'required|string|max:20',
        'nomor_meja' => 'required|integer|between:1,99',
        'pesanan_data' => 'required|string', 
    ]);

    $pesanan = Pesanan::create([
        'nama_pelanggan' => $request->nama_pelanggan,
        'nomor_meja' => $request->nomor_meja,
        'status' => 'pending',
    ]);

    $items = json_decode($request->pesanan_data, true);

    if (!$items || count($items) === 0) {
    return redirect()->back()->with('error', 'Keranjang tidak boleh kosong.');
    }

    $total_harga = 0;

    foreach ($items as $item) {
        PesananItem::create([
            'pesanan_id' => $pesanan->id,
            'menu_id' => $item['id'], 
            'jumlah' => $item['quantity'],
        ]);

        // Ambil harga asli dari database
        $menu = Menu::find($item['id']);
        $total_harga += $menu->harga * $item['quantity'];
    }

    $pesanan->update(['total_harga' => $total_harga]);

    return redirect('/')->with('success', 'Pesanan berhasil dibuat!');
}

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = 'selesai';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan dikonfirmasi!');
    }

    //new
    public function form()
{
    $menus = Menu::all();
    return view('pesan.index', compact('menus'));
}

public function destroy($id)
{
    $pesanan = Pesanan::findOrFail($id);

    // Hapus semua item yang terkait dulu
    $pesanan->items()->delete();

    // Lalu hapus pesanan-nya
    $pesanan->delete();

    return redirect()->back()->with('success', 'Pesanan berhasil dihapus');
}

}