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
        'nota_jual_id',
        'nota_beli_id',
        'nama_penerima',
        'status',
    ];

    
    public function nota_beli(): BelongsTo{
        return $this->belongsTo(NotaBeli::class);
    }
    public function nota_jual(): BelongsTo{
        return $this->belongsTo(NotaJual::class);
    }
}
