<?php

namespace App\Models;

use App\Models\kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class data extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria_id',
        'alternatif_id',
        'value',
    ];

    // Jika Anda memiliki relasi dengan model lain, Anda dapat menentukannya di sini
    public function kriteria()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }

    public function alternatif()
    {
        return $this->belongsTo(alternatif::class, 'alternatif_id');
    }
}
