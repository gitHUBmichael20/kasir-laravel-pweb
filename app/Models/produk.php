<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'ProdukID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'ProdukID',
        'NamaProduk',
        'Harga',
        'Stok',
        'foto_produk',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->ProdukID)) {
                $lastProduk = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastProduk ? (int) str_replace('PROID-', '', $lastProduk->ProdukID) : 0;
                $model->ProdukID = 'PROID-' . ($lastNumber + 1);
            }
        });
    }
    public function detailpenjualans()
    {
        return $this->hasMany(Detailpenjualan::class, 'ProdukID', 'ProdukID');
    }
}
