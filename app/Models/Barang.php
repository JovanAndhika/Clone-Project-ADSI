<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'stock',
    ];

    // relationship
    public function notabeli(): BelongsToMany
    {
        return $this->belongsToMany(NotaBeli::class);
    }

    public function wirausaha(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
