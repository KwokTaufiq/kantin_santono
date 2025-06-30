<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Kolom yang boleh diisi otomatis
    protected $fillable = ['nama_menu', 'harga'];

    // Relasi: Satu menu bisa ada di banyak item pesanan
    public function pesananItems()
{
    return $this->hasMany(PesananItem::class);
}

    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}

}
