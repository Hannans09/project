<?php

namespace App\Http\Controllers;

use App\Models\alternatif;
use App\Models\data;
use App\Models\kriteria;
use Illuminate\Http\Request;

class metodeWpController extends Controller
{
    public function index()
    {

        $data = data::with('kriteria', 'alternatif')->get();
        // Mengambil data dari tabel Alternatif dan kriteria
        $kriteria = kriteria::all();
        $alternatif = alternatif::all();

        // Mengambil data dari tabel data
        $data = data::all();

        // Membuat array untuk menyimpan bobot kriteria
        $weights = [];

        // Mengisi bobot kriteria sesuai dengan data dari tabel Kriteria
        $totalWeight = 0; // Menyimpan jumlah total bobot

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot; // Bobot kriteria disimpan dalam array
            $totalWeight += $k->bobot; // Menambahkan bobot ke jumlah total
        }

        // Mengubah bobot kriteria menjadi bobot yang telah dibagi dengan jumlah bobot keseluruhan
        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = round($bobot / $totalWeight, 2);
        }

        // Membuat array untuk menyimpan nilai terbobot
        $weightedValues = [];

        // Menghitung nilai terbobot untuk setiap alternatif
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                // Mencari data dari tabel AlternatifKriteriaValue berdasarkan id alternatif dan kriteria
                $Data = $data->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                // Periksa apakah data ditemukan
                $value = $Data->value;

                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else { // Jika atribut adalah "cost"
                    // Menggunakan nilai negatif untuk atribut "cost"
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = round($weightedValue, 4);
        }

        // dd($weightedValues);
        // Menghitung nilai V (Vektor S)
        $totalWeightedValues = array_sum($weightedValues);

        // Membuat array untuk menyimpan nilai V (Vektor S) final
        $finalValues = [];

        // Menghitung nilai V (Vektor S) final untuk setiap alternatif
        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = round($finalValue, 4);
        }


        // dd($finalValues);

        // Menentukan alternatif terbaik
        // $bestAlternative = collect($finalValues)->keys()->max();

        return view('metodeWp.index', compact('weightedValues', 'finalValues', 'alternatif'));
    }

    public function hasil()
    {

        // Mengambil data dari tabel Alternatif
        $alternatif = Alternatif::all();

        // Mengambil data dari tabel Kriteria
        $kriteria = Kriteria::all();

        // Mengambil data dari tabel AlternatifKriteriaValue
        $data = data::all();

        // Membuat array untuk menyimpan bobot kriteria
        $weights = [];

        // Mengisi bobot kriteria sesuai dengan data dari tabel Kriteria
        $totalWeight = 0; // Menyimpan jumlah total bobot

        foreach ($kriteria as $k) {
            $weights[$k->id] = $k->bobot; // Bobot kriteria disimpan dalam array
            $totalWeight += $k->bobot; // Menambahkan bobot ke jumlah total
        }

        // Mengubah bobot kriteria menjadi bobot yang telah dibagi dengan jumlah bobot keseluruhan
        foreach ($weights as $kriteriaId => $bobot) {
            $weights[$kriteriaId] = round($bobot / $totalWeight, 2);
        }

        // Membuat array untuk menyimpan nilai terbobot
        $weightedValues = [];

        // Menghitung nilai terbobot untuk setiap alternatif
        foreach ($alternatif as $a) {
            $weightedValue = 1;
            foreach ($kriteria as $k) {
                // Mencari data dari tabel AlternatifKriteriaValue berdasarkan id alternatif dan kriteria
                $Data = $data->where('alternatif_id', $a->id)->where('kriteria_id', $k->id)->first();

                // Periksa apakah data ditemukan
                $value = $Data->value;

                if ($k->attribut == 'benefit') {
                    $weightedValue *= pow($value, $weights[$k->id]);
                } else { // Jika atribut adalah "cost"
                    // Menggunakan nilai negatif untuk atribut "cost"
                    $weightedValue *= pow($value, -$weights[$k->id]);
                }
            }
            $weightedValues[$a->id] = round($weightedValue, 4);
        }

        // dd($weightedValues);
        // Menghitung nilai V (Vektor S)
        $totalWeightedValues = array_sum($weightedValues);

        // Membuat array untuk menyimpan nilai V (Vektor S) final
        $finalValues = [];

        // Menghitung nilai V (Vektor S) final untuk setiap alternatif
        foreach ($alternatif as $a) {
            $finalValue = $weightedValues[$a->id] / $totalWeightedValues;
            $finalValues[$a->id] = round($finalValue, 4);
        }

        arsort($finalValues);

        // Inisialisasi array untuk menyimpan peringkat
        $ranking = [];

        // Hitung peringkat dan simpan dalam array
        $rank = 1;
        foreach ($finalValues as $alternatifId => $finalValue) {
            $alternatif = Alternatif::find($alternatifId); // Mengambil data alternatif berdasarkan ID

            if ($alternatif) {
                $ranking[] = [
                    'rank' => $rank,
                    'alternatif_name' => $alternatif->keterangan,
                    'final_value' => $finalValue,
                ];
            }

            $rank++;
        }

        return view('menu.hasil', compact('weightedValues', 'finalValues', 'alternatif', 'ranking'));
    }
}
