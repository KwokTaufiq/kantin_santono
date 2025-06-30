<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = ['nama_pelanggan','nomor_meja', 'status'];

    public function items()
{
    return $this->hasMany(PesananItem::class);
}

public function getTotalHargaAttribute()
{
    return $this->items->sum(function ($item) {
        return $item->jumlah * $item->menu->harga;
    });
}


}
