<?php

namespace App\Helpers;

use Exception;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\DB;

class ForecastPermintaan
{
    public $x1, $x2, $y, $b1, $b2, $a; //for produksi
    // public $x1, $x2, $y, $b1, $b2, $a; //for produksi

    public function __construct($x = null, $y = null, $produksi = 'permintaan')
    {
        if (!is_null($x) && !is_null($y)) {

            if ($produksi == 'permintaan') {
                dd('masuk permintaan');
                $this->compute();
            }
            dd('masuk produksi');
            $this->compute();
        }
    }

    public function compute()
    {
        if (is_array($this->x) && is_array($this->y)) {
            if (count($this->x) == count($this->y)) {
                $this->n  = count($this->x);

                $this->prepare_calculation();
                $this->ab();
                $this->linear_regression();
            } else {
                throw new Exception('Jumlah data variabel X dan Y harus sama');
            }
        } else {
            throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }

    public function prepare_calculation()
    {
        //persiapan menghitung x2, y2, dan xy;
        $this->x2 = array_map(function ($n) {
            return $n * $n;
        }, $this->x);
        $this->y2 = array_map(function ($n) {
            return $n * $n;
        }, $this->y);


        for ($i = 0; $i < $this->n; $i++) {
            $this->xy[$i] = $this->x[$i] * $this->y[$i];
        }
    }

    public function ab()
    {
        //mendapat nilai konstanta A dan B
        $a = ((array_sum($this->y) * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->xy))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->a = $a;

        $b = (($this->n * array_sum($this->xy)) - (array_sum($this->x) * array_sum($this->y))) / (($this->n * array_sum($this->x2)) - (array_sum($this->x) * array_sum($this->x)));
        $this->b = $b;
    }

    public function forecast($xfore)
    {
        $y = $this->a + ($this->b * $xfore);
        return $y;
    }

    public function linear_regression()
    {
        $n = 0;
        foreach ($this->x as $xnew) {
            $this->all[$n] = $this->forecast($xnew);
            $n++;
        }
    }
}
