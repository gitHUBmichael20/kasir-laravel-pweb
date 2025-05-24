<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    protected $table = 'detailpenjualan';
    protected $primaryKey = 'DetailID';
    public $timestamps = true;

    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'JumlahProduk',
        'Subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID', 'PenjualanID');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID', 'ProdukID');
    }
}
