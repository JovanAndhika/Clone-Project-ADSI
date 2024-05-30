<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'jenis_tugas',
        'nota_jual_id',
        'nota_beli_id',
        'alamat',
        'nama_penerima',
        'status',
    ];

    public function nota_jual(): HasOne
    {
        return $this->hasOne(Nota_Jual::class);
    }

    public function nota_beli(): HasOne{
        return $this->hasOne(Nota_Beli::class);
    }
}
