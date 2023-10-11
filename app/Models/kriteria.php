<?php

namespace App\Models;

use App\Models\data;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';
    protected $fillable = [
        'nama',
        'bobot',
        'atribut'
    ];

    public function alternatif()
    {
        return $this->belongsToMany(alternatif::class)->withPivot('value'); // Jika Anda ingin mengambil nilai dari tabel pivot
    }
}
