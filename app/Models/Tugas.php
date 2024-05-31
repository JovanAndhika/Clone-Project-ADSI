<?php

namespace App\Models;

use App\Models\NotaBeli;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'jenis_tugas',
        'notajual_id',
        'notabeli_id',
        'nama_penerima',
        'status',
    ];

    // public function notajual(): HasOne
    // {
    //     return $this->hasOne(NotaJual::class);
    // }

    public function notabeli(): BelongsTo{
        return $this->belongsTo(NotaBeli::class);
    }
}
