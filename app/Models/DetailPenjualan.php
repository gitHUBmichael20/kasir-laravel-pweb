<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    protected $table = 'detailpenjualan';
    protected $primaryKey = 'DetailID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'DetailID',
        'PenjualanID',
        'ProdukID',
        'JumlahProduk',
        'Subtotal',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->DetailID)) {
                $lastDetail = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastDetail ? (int) str_replace('SALE-INFO-', '', $lastDetail->DetailID) : 0;
                $model->DetailID = 'SALE-INFO-' . ($lastNumber + 1);
            }
        });
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID', 'PenjualanID');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID', 'ProdukID');
    }
}
