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
        // dd($x1);
        if ($x1) {
            $bulan = $this->getHujanBulan();
            $check = \DB::table('curah_hujan')
                ->get()
                ->count();

            if ($check % $bulan) {
                return false;
            }

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
        } else {
            return redirect()->route('forecast.produksi.index')->with('error_msg', 'Data Produksi Kosong !!!');
        }
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

        if ($data) {
            for ($i = 0; $i < count($data); $i++) {
                $x1[$i] = $data[$i]->luas_panen;
            }
            return $x1;
        } else {
            return false;
        }
    }

    public function getY($id)
    {
        $a = $this->getDataProduksiPeriode($id);
        $data = $this->getDataProduksi($id);
        $periode = $this->getCountPeriode();
        $periodeTahun = $this->getCountPeriode();

        // dd('sabar bang', $data, $a, $periode, $periodeTahun);
        if ($a['countPeriodeTahun']) {
            // dd($a);
            if ($periodeTahun == count($a['countPeriodeTahun'])) {
                for ($i = 0; $i < count($a['countPeriodeTahun']); $i++) {
                    if ($periode == count($a['countPeriodeTahun'][$i])) {
                        // dd(count($a['countPeriodeTahun'][$i]));
                        for ($i = 0; $i < count($data); $i++) {
                            $y[$i] = $data[$i]->produksi;
                        }
                        return $y;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getX()
    {
        $data = \DB::table('periode')
            ->orderBy('tahun')
            ->orderBy('periode')
            ->get();
        // dd($data);
        for ($i = 0; $i < count($data); $i++) {
            $periode['tahun'][] = $data[$i]->tahun;
            $periode['periode'][] = $data[$i]->periode;
            $periode['nilai'][] = $i + 1;
        }
        // dd($periode);
        return $periode;
    }

    public function getYPermintaan($id)
    {
        // dd($id);
        $a = $this->getDatapermintaanPeriode($id);
        $data = $this->getDatapermintaan($id);
        $periode = $this->getCountPeriode();
        $periodeTahun = $this->getCountPeriode();

        // dd('sabar bang', $data, $a, $periode, $periodeTahun);
        if ($a['countPeriodeTahun']) {
            if ($periodeTahun == count($a['countPeriodeTahun'])) {
                for ($i = 0; $i < count($a['countPeriodeTahun']); $i++) {
                    if ($periode == count($a['countPeriodeTahun'][$i])) {
                        // dd(count($a['countPeriodeTahun'][$i]));
                        for ($i = 0; $i < count($data); $i++) {
                            $y[$i] = $data[$i]->permintaan;
                        }
                        return $y;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getHujanTahun()
    {
        $tahun = \DB::table('curah_hujan')
            ->groupBy('tahun')
            ->distinct()
            ->pluck('tahun')
            ->count();

        return $tahun;
    }

    public function getHujanBulan()
    {
        $bulan = \DB::table('curah_hujan')
            ->groupBy('bulan')
            ->distinct()
            ->pluck('bulan')
            ->count();

        return $bulan;
    }

    public function getCountPeriodeTahun()
    {
        $tahun = \DB::table('periode')
            ->groupBy('tahun')
            ->distinct()
            ->pluck('tahun')
            ->count();

        return $tahun;
    }

    public function getCountPeriode()
    {
        $bulan = \DB::table('periode')
            ->groupBy('periode')
            ->distinct()
            ->pluck('periode')
            ->count();

        return $bulan;
    }

    public function getMaxPeriodeTahun()
    {
        $max = (int) \DB::table('periode')
            // ->groupBy('tahun')
            // ->distinct()
            // ->pluck('tahun')
            ->max('tahun');
        return $max;
    }

    public function getMaxPeriode()
    {
        $data = (int) \DB::table('periode')
            ->groupBy('tahun')
            ->where('tahun', $this->getMaxPeriodeTahun())
            // ->distinct()
            // ->pluck('tahun')
            ->max('periode');
        return $data;
    }

    public function getAllDataPeriode()
    {
        $data = \DB::table('periode')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode', 'asc')
            ->select('periode.*')
            ->get();
        return $data;
    }

    public function getDataProduksiTahun($id)
    {
        $data = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->groupBy('periode.tahun')
            ->distinct()
            ->pluck('tahun');
        return $data;
    }

    public function getDataProduksiPeriode($id)
    {
        $tahun = $this->getDataProduksiTahun($id);
        $data['countPeriodeTahun'] = null;
        for ($i = 0; $i < count($tahun); $i++) {
            $data['countPeriodeTahun'][] = \DB::table('produksi')
                ->join('periode', 'produksi.periode_id', '=', 'periode.id')
                ->where('kecamatan_id', $id)
                ->where('periode.tahun', $tahun[$i])
                ->distinct()
                ->pluck('periode')
                ->toArray();
        }
        return $data;
    }

    public function getDataProduksi($id)
    {
        $data = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('produksi')
            ->get();
        // dd('masuk data produksi', $data);
        return $data;
    }

    public function getAllDataProduksi()
    {
        $data = \DB::table('produksi')
            ->join('periode', 'produksi.periode_id', '=', 'periode.id')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('produksi.*')
            ->get();
        return $data;
    }

    public function getDataPermintaanTahun($id)
    {
        $data = \DB::table('permintaan')
            ->join('periode', 'permintaan.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->groupBy('periode.tahun')
            ->distinct()
            ->pluck('tahun');
        return $data;
    }

    public function getDataPermintaanPeriode($id)
    {
        $tahun = $this->getDataPermintaanTahun($id);
        $data['countPeriodeTahun'] = null;
        for ($i = 0; $i < count($tahun); $i++) {
            $data['countPeriodeTahun'][] = \DB::table('permintaan')
                ->join('periode', 'permintaan.periode_id', '=', 'periode.id')
                ->where('kecamatan_id', $id)
                ->where('periode.tahun', $tahun[$i])
                ->distinct()
                ->pluck('periode')
                ->toArray();
        }
        // dd('masuk sini', $data);
        return $data;
    }

    public function getDataPermintaan($id)
    {
        $data = \DB::table('permintaan')
            ->join('periode', 'permintaan.periode_id', '=', 'periode.id')
            ->where('kecamatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('permintaan')
            ->get();
        // dd('masuk data permintaan', $data);
        return $data;
    }

    public function getAllDataPermintaan()
    {
        $data = \DB::table('permintaan')
            ->join('periode', 'permintaan.periode_id', '=', 'periode.id')
            ->orderBy('tahun', 'asc')
            ->orderBy('periode.periode', 'asc')
            ->select('permintaan.*')
            ->get();
        return $data;
    }

    public function getAllDataKecamatan()
    {
        $data = \DB::table('kecamatan')
            ->select('kecamatan.*')
            ->get();
        return $data;
    }
}
