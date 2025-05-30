<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'PelangganID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'PelangganID',
        'NamaPelanggan',
        'Alamat',
        'NomorTelepon',
        'foto_pelanggan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->PelangganID)) {
                $lastPelanggan = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastPelanggan ? (int) str_replace('CUST-', '', $lastPelanggan->PelangganID) : 0;
                $model->PelangganID = 'CUST-' . ($lastNumber + 1);
            }
        });
    }
    public function detailpenjualans()
    {
        return $this->hasMany(Detailpenjualan::class, 'PenjualanID', 'PenjualanID');
    }
}
