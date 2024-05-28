<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NotaBeli extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'komplain',
    ];

    // update status lunas bayar
    public function setStatusPembayaran()
    {
        $this->status = true;
        $this->save();
    }

    // relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class);
    }
}
