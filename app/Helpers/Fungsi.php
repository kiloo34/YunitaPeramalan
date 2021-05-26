<?php

namespace App\Helpers;

use Exception;

// use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\DB;

class Fungsi
{
    public function getX2($id)
    {
        $x1 = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('produksi.luas_panen', 'periode.periode', 'tahun')
            ->get()
            ->toArray();

        for ($i = 0; $i < count($x1); $i++) {
            // dd($x1[$i]);
            $x2[$i] = 0;
            switch ($x1[$i]) {
                case $x1[$i]->periode == 1:
                    $nilai = \DB::table('curah_hujan')
                        ->where([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'januari'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'februari'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'maret'],
                        ])
                        ->select('nilai')
                        ->get();
                    foreach ($nilai as $n) {
                        $x2[$i] += $n->nilai;
                    }
                    $x2[$i] = $x2[$i] / 3;
                    // dd($x2[$i]);
                    break;
                case $x1[$i]->periode == 2:
                    $nilai = \DB::table('curah_hujan')
                        ->where([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'april'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'mei'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'juni'],
                        ])
                        ->select('nilai')
                        ->get();
                    foreach ($nilai as $n) {
                        $x2[$i] += $n->nilai;
                    }
                    $x2[$i] = $x2[$i] / 3;
                    break;
                case $x1[$i]->periode == 3;
                    $nilai = \DB::table('curah_hujan')
                        ->where([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'juli'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'agustus'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'september'],
                        ])
                        ->select('nilai')
                        ->get();
                    foreach ($nilai as $n) {
                        $x2[$i] += $n->nilai;
                    }
                    $x2[$i] = $x2[$i] / 3;
                    break;
                default:
                    $nilai = \DB::table('curah_hujan')
                        ->where([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'oktober'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'november'],
                        ])
                        ->orWhere([
                            ['tahun', $x1[$i]->tahun],
                            ['bulan', 'desember'],
                        ])
                        ->select('nilai')
                        ->get();
                    foreach ($nilai as $n) {
                        $x2[$i] += $n->nilai;
                    }
                    $x2[$i] = $x2[$i] / 3;
                    break;
            }
        }
        return $x2;
    }

    public function getX1($id)
    {
        $data = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('luas_panen')
            ->get()
            ->toArray();

        for ($i = 0; $i < count($data); $i++) {
            $x1[$i] = $data[$i]->luas_panen;
        }

        return $x1;
    }

    public function getY($id)
    {
        $data = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('produksi')
            ->get()
            ->toArray();

        for ($i = 0; $i < count($data); $i++) {
            $y[$i] = $data[$i]->produksi;
        }

        return $y;
    }
}
