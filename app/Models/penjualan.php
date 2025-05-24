<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'PenjualanID';
    public $timestamps = true;

    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'PelangganID',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
    }

    public function detailpenjualans()
    {
        return $this->hasMany(Detailpenjualan::class, 'PenjualanID', 'PenjualanID');
    }
}
