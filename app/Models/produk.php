<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'ProdukID';
    public $timestamps = true;

    protected $fillable = [
        'NamaProduk',
        'Harga',
        'Stok',
        'foto_produk',
    ];

    public function detailpenjualans()
    {
        return $this->hasMany(Detailpenjualan::class, 'ProdukID', 'ProdukID');
    }
}