<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class Pelanggan extends Model
{
    use HasFactory; // Gunakan HasFactory

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
                // Ambil ID pelanggan terakhir yang dibuat berdasarkan urutan descending created_at
                // Jika tidak ada, mulai dari 0
                $lastPelanggan = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastPelanggan ? (int) str_replace('CUST-', '', $lastPelanggan->PelangganID) : 0;
                // Buat ID baru dengan format 'CUST-X'
                $model->PelangganID = 'CUST-' . ($lastNumber + 1);
            }
        });
    }

    /**
     * Get all of the penjualan for the Pelanggan.
     * Seorang pelanggan memiliki banyak penjualan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjualans(): HasMany // Nama relasi diubah menjadi "penjualans" (plural)
    {
        // Parameter: model terkait, foreign key di model terkait, local key di model ini
        return $this->hasMany(Penjualan::class, 'PelangganID', 'PelangganID');
    }
}
