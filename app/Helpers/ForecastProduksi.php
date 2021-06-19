<?php

namespace App\Helpers;

use Exception;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\DB;

class ForecastProduksi
{
    public $x1, //Luas Panen
        $x2, // Curah Hujan
        $y, // Produksi

        $x1ex, // exponent
        $x2ex, // exponent
        $yex, // exponent

        $x1y,
        $x2y,
        $x1x2,

        // aritmekika
        $sx1ex = 0,
        $sx2ex = 0,
        $syex = 0,
        $sx1y = 0,
        $sx2y = 0,
        $sx1x2 = 0,

        $b1,
        $b2,
        $a,

        $inputX1, //Input Param
        $inputX2,

        $res,
        $mape,
        $display; //Highlight



    public function __construct($x1 = null, $x2 = null, $y = null, $inputX1 = 0, $inputX2 = 0)
    {
        if (!is_null($x1) && !is_null($x2) && !is_null($y)) {
            $this->x1 = $x1;
            $this->x2 = $x2;
            $this->y = $y;
            $this->inputX1 = $inputX1;
            $this->inputX2 = $inputX2;

            $this->compute();
        }
    }

    public function compute()
    {
        // dd(is_array($this->x1));
        if (is_array($this->x1) && is_array($this->y) && is_array($this->x2)) {

            if (count($this->x1) == count($this->y)) {
                $this->n  = count($this->x1);

                $this->prepare_calculation(); // Step tabel awal
                // dd('x1 exponent', $this->x1ex, 'x2 exponent', $this->x2ex, 'y exponent', $this->yex, 'x1y exponent', $this->x1y, 'x2y exponent', $this->x2y, 'x1x2 exponent', $this->x1x2);
                $this->aritmetika();
                $this->ab1b2();
                // dd('masuk');
                $this->linear_regression($this->inputX1, $this->inputX2);
                $this->mape();
            } else {
                return false;
                // throw new Exception('Jumlah data variabel X dan Y harus sama');
            }
        } else {
            return false;
            // throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }

    public function prepare_calculation()
    {
        $this->x1ex = array_map(function ($n) {
            return $n * $n;
        }, $this->x1);
        $this->x2ex = array_map(function ($n) {
            return $n * $n;
        }, $this->x2);
        $this->yex = array_map(function ($n) {
            return $n * $n;
        }, $this->y);

        for ($i = 0; $i < $this->n; $i++) {
            $this->x1y[$i] = $this->x1[$i] * $this->y[$i];
            $this->x2y[$i] = $this->x2[$i] * $this->y[$i];
            $this->x1x2[$i] = $this->x2[$i] * $this->x1[$i];
        }
    }

    public function aritmetika()
    {
        $this->sx1ex = array_sum($this->x1ex) - (pow(array_sum($this->x1), 2) / count($this->x1)); //P6
        $this->sx2ex = array_sum($this->x2ex) - (pow(array_sum($this->x2), 2) / count($this->x1)); //P7
        $this->syex = array_sum($this->yex) - (pow(array_sum($this->y), 2) / count($this->x1)); //P8
        $this->sx1y = array_sum($this->x1y) - ((array_sum($this->x1) * array_sum($this->y)) / count($this->x1)); //P9
        $this->sx2y = array_sum($this->x2y) - ((array_sum($this->x2) * array_sum($this->y)) / count($this->x1)); //P10
        $this->sx1x2 = array_sum($this->x1x2) - ((array_sum($this->x2) * array_sum($this->x1)) / count($this->x1)); //P11
        // dd('total x1 exponent', $this->sx1ex, 'total x2 exponent', $this->sx2ex, 'total y exponent', $this->syex, 'total x1y exponent', $this->sx1y, 'total x2y exponent', $this->sx2y, 'total x1x2 exponent', $this->sx1x2);
    }

    public function ab1b2()
    {
        //mendapat nilai konstanta A dan B
        // =((P7*P9)-(P11*P10))/((P6*P7)-(P11^2))
        $this->b1 = round((($this->sx2ex * $this->sx1y) - ($this->sx1x2 * $this->sx2y)) / (($this->sx1ex * $this->sx2ex) - pow($this->sx1x2, 2)), 4); //P13
        // =((P6*P10)-(P11*P9))/((P6*P7)-(P11^2))
        $this->b2 = round((($this->sx1ex * $this->sx2y) - ($this->sx1x2 * $this->sx1y)) / (($this->sx1ex * $this->sx2ex) - pow($this->sx1x2, 2)), 4); //P14
        // =(C22-(P13*D22)-(P14*E22))/P5
        $this->a = round((array_sum($this->y) - ($this->b1 * array_sum($this->x1)) - ($this->b2 * array_sum($this->x2))) / count($this->x1), 4); //P15
        // dd($this->b1, $this->b2, $this->a);
    }

    public function forecast($x1, $x2)
    {
        // =P15+(P13*Q17)+(P14*Q18)
        // =P15+(P13*D7)+(P14*E7)
        $y = $this->a + ($this->b1 * $x1) + ($this->b2 * $x2);
        return $y;
    }

    public function linear_regression($inputX1, $inputX2)
    {
        $n = 0;
        for ($i = 0; $i < count($this->x1); $i++) {
            if (($i + 1) < count($this->x1)) {
                $this->res[$i] = $this->forecast($this->x1[$i + 1], $this->x2[$i + 1]);
            } else {
                $this->res[$i] = round($this->forecast($inputX1, $inputX2), 4);
                $this->display = round($this->forecast($inputX1, $inputX2), 4);
                $this->res[$i + 1] = $this->display;
            }
        }
    }

    public function mape()
    {
        $arr[] = null;
        // dd($this->y);
        for ($i = 0; $i < count($this->y); $i++) {
            // =ABS((C6-L6)/C6)
            $arr[$i] = abs(($this->y[$i] - $this->res[$i]) / $this->y[$i]);
            // dd($arr);
        }
        // =(SUM(M6:M21)/16)*100%
        $this->mape = round((array_sum($arr) / count($this->y)), 4);
        // dd($this->mape);
    }
}
