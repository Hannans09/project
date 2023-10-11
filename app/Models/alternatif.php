<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $fillable = [
        'nama',
        'keterangan'
    ];

    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class)->withPivot('value'); // Jika Anda ingin mengambil nilai dari tabel pivot
    }
}
