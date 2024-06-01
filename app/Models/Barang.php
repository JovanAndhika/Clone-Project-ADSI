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
        'wirausaha_id', 
        'jenis_barang_id',
        'foto',
        'detail'
    ];

    // scope filter search
    public function scopeFilter($query, $filters)
    {
        $query->when($filters ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        });
    }

    // relationship
    public function notabeli(): BelongsToMany
    {
        return $this->belongsToMany(NotaBeli::class)
        ->withPivot('jumlah');
    }

    public function wirausaha(): BelongsTo
    {
        return $this->belongsTo(Wirausaha::class);
    }

    public function jenisbarang(): BelongsTo 
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }
}
