<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'PelangganID';
    public $timestamps = true;

    protected $fillable = [
        'NamaPelanggan',
        'Alamat',
        'NomorTelepon',
        'foto_pelanggan',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
    }

    public function detailpenjualans()
    {
        // Pastikan 'PenjualanID' (argumen kedua) adalah foreign key di tabel 'detailpenjualan'
        // dan 'PenjualanID' (argumen ketiga) adalah local key di tabel 'penjualan'
        return $this->hasMany(Detailpenjualan::class, 'PenjualanID', 'PenjualanID');
    }
}
