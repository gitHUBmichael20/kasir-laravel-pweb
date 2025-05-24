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

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'PelangganID', 'PelangganID');
    }
}
