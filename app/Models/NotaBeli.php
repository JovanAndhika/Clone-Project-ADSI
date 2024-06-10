<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NotaBeli extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'alamat_customer',
        'customer_id',
        'status',
        'komplain',
    ];

    // update status lunas bayar
    public function setStatusPembayaran()
    {
        $this->status = 1;
        $this->save();
    }

    // relationship
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class)
        ->withPivot('jumlah');
    }

    public function tugas(): HasOne{
        return $this->hasOne(Tugas::class);
    }
}
