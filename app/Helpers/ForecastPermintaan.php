<?php

namespace App\Helpers;

use Exception;

use function PHPUnit\Framework\isEmpty;

// use Illuminate\Support\Facades\DB;

class ForecastPermintaan
{
    public $x,
        $y,

        $xex, // exponent
        $yx, // exponent

        $b,
        $a,

        $res,
        $mape,
        $sigmaY = 0,
        $display; //Highlight

    public function __construct($x = null, $y = null)
    {
        // dd($x, count($y));
        if (!is_null($x) && !is_null($y)) {
            $this->x = $x;
            $this->y = $y;
            $this->compute();
        }
    }

    public function compute()
    {
        if (is_array($this->x) && is_array($this->y)) {
            if (count($this->x['nilai']) == count($this->y)) {
                $this->n  = count($this->x['nilai']);

                $this->prepare_calculation();
                $this->ab();
                $this->linear_regression();
                for ($i = 0; $i < count($this->res); $i++) {
                    if ($i != (count($this->res) - 1)) {
                        $this->sigmaY += $this->res[$i];
                    }
                }
                $this->mape();
            } else {
                return false;
                // return redirect()->back()->with('error_msg', 'Jumlah Data tidak sama');
                // throw new Exception('Jumlah data variabel X dan Y harus sama');
            }
        } else {
            return false;
            // throw new Exception('Variabel X atau Y belum didefinisikan');
        }
    }

    public function prepare_calculation()
    {
        //persiapan menghitung x, y, dan xy;
        $this->xex = array_map(function ($n) {
            return $n * $n;
        }, $this->x['nilai']);

        for ($i = 0; $i < $this->n; $i++) {
            $this->yx[$i] = $this->x['nilai'][$i] * $this->y[$i];
        }
    }

    public function ab()
    {
        //mendapat nilai konstanta A dan B
        // =((D20*F20)-(E20*G20))/(16*F20-(E20^2))
        $a = ((array_sum($this->y) * array_sum($this->xex)) - (array_sum($this->x['nilai']) * array_sum($this->yx))) / ($this->n * array_sum($this->xex) - pow(array_sum($this->x['nilai']), 2));
        $this->a = round($a, 4);

        // =((16*G20)-(E20*D20))/(16*F20*(E20^2))
        $b = (($this->n * array_sum($this->yx)) - (array_sum($this->y) * array_sum($this->x['nilai']))) / ($this->n * array_sum($this->xex) * (pow(array_sum($this->x['nilai']), 2)));
        $this->b = round($b, 4);
    }

    public function forecast($x, $periode = 0)
    {
        // =L3+L4*E6
        $y = round($this->a + $this->b * ($x + $periode), 0);
        return $y;
    }

    public function linear_regression()
    {
        // dd($this->x['nilai']);
        for ($i = 0; $i < count($this->x['nilai']); $i++) {
            if (($i + 1) < count($this->x['nilai'])) {
                $this->res[$i] = $this->forecast($this->x['nilai'][$i + 1]);
            } else {
                $this->res[$i] = $this->forecast($this->x['nilai'][$i], 1);
                $this->display = round($this->forecast($this->x['nilai'][$i], 1), 4);
                // $this->res[$i + 1] = $this->display;
            }
            // if ($i == 0) {
            //     $this->res[$i] = 0;
            //     $this->res[$i + 1] = $this->forecast($this->x['nilai'][$i + 1]);
            // } elseif (($i + 1) < count($this->x['nilai'])) {
            //     $this->res[$i + 1] = $this->forecast($this->x['nilai'][$i + 1]);
            // } else {
            //     $this->res[$i + 1] = $this->forecast($this->x['nilai'][$i], 1);
            //     $this->display = round($this->forecast($this->x['nilai'][$i], 1), 4);
            // }
        }
    }

    public function mape()
    {
        $arr[] = null;
        // =ABS((D5-H5)/D5)
        // dd($this->res);
        for ($i = 0; $i < count($this->y); $i++) {
            if ($i == 0) {
                $arr[$i] = 0;
            } else {
                $arr[$i] = abs(($this->y[$i] - $this->res[$i]) / $this->y[$i]);
            }
        }
        // =(SUM(M6:M21)/16)*100%
        $this->mape = round((array_sum($arr) / count($this->y)), 4);
    }
}
