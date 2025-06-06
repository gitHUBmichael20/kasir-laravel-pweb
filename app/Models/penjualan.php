<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'PenjualanID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'PenjualanID',
        'PelangganID',
        'TanggalPenjualan',
        'TotalHarga'
    ];

    protected $casts = [
        'TanggalPenjualan' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->PenjualanID)) {
                $lastPenjualan = self::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastPenjualan ? (int) str_replace('SALE-', '', $lastPenjualan->PenjualanID) : 0;
                $model->PenjualanID = 'SALE-' . ($lastNumber + 1);
            }
        });
    }

    /**
     * Get the pelanggan that owns the Penjualan.
     * Sebuah penjualan dimiliki oleh satu pelanggan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan(): BelongsTo
    {

        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
    }

    /**
     * Get all of the detailpenjualans for the Penjualan.
     * Sebuah penjualan memiliki banyak detail penjualan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailpenjualans(): HasMany
    {

        return $this->hasMany(Detailpenjualan::class, 'PenjualanID', 'PenjualanID');
    }
}
