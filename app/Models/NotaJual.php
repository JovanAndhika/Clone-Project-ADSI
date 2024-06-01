<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaJual extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'foto',
        'alamat',
        'status',
        'harga',
        'customer_id',
        'wirausaha_id',
    ];

    // relationship
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function wirausaha(): BelongsTo
    {
        return $this->belongsTo(Wirausaha::class);
    }
    public function tugas(): HasOne
    {
        return $this->hasOne(Tugas::class);
    }
}
