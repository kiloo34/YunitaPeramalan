@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Nilai Konstanta (a)</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->a,2)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Prediksi</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->display,2)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Nilai MAPE</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->mape,2)}} %
                    @if ($hasil->mape < 10)
                    <div class="card-description float-right"><h5>{{__("Akurat")}}</h5></div>
                    @elseif($hasil->mape >= 10 || $hasil->mape < 20)
                    <div class="card-description float-right"><h5>{{__("Baik")}}</h5></div>
                    @elseif($hasil->mape >= 20 || $hasil->mape < 50)
                    <div class="card-description float-right"><h5>{{__("Wajar")}}</h5></div>
                    @else
                    <div class="card-description float-right"><h5>{{__("Tidak Akurat")}}</h5></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Koefisien Regresi Linier Luas Panen</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->b1,2)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Koefisien Regresi Linier Curah Hujan</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->b2,2)}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Simple Table</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <th style="text-align: center" colspan="2">Periode</th>
                            <th style="text-align: center">Produksi (Y)</th>
                            <th style="text-align: center">Luas Panen (X1)</th>
                            <th style="text-align: center">Curah Hujan (X2)</th>
                            <th style="text-align: center">X1^2</th>
                            <th style="text-align: center">X2^2</th>
                            <th style="text-align: center">Y^2</th>
                            <th style="text-align: center">X1.Y</th>
                            <th style="text-align: center">X2.Y</th>
                            <th style="text-align: center">X1.X2</th>
                            <th style="text-align: center">Prediksi (Y`)</th>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($periode); $i++)
                            <tr>
                                <td style="text-align: center">{{$periode[$i]->tahun}}</td>
                                <td style="text-align: center">{{$periode[$i]->periode}}</td>
                                <td style="text-align: center">{{$hasil->y[$i]}}</td>
                                <td style="text-align: center">{{$hasil->x1[$i]}}</td>
                                <td style="text-align: center">{{round($hasil->x2[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->x1ex[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->x2ex[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->yex[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->x1y[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->x2y[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->x1x2[$i],1)}}</td>
                                <td style="text-align: center">{{round($hasil->res[$i],1)}}</td>
                            </tr>
                            @endfor
                            <tr>
                                <td style="text-align: center" colspan="2">&#931</td>
                                <td style="text-align: center">{{round(array_sum($hasil->y),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x1),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x2),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x1ex),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x2ex),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->yex),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x1y),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x2y),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x1x2),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->res),1)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title)}} Kecamatan {{$kecamatan->nama}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('forecast.produksi.index') }}" class="btn btn-danger">Kembali </a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-description"><h3>Nilai Konstanta (a)</h3></div>
                <h5>{{round($hasil->a,2)}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-description"><h3>Koefisien Regresi Linier Luas Panen</h3></div>
                <h5>{{round($hasil->b1,2)}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-description"><h3>Koefisien Regresi Linier Curah Hujan</h3></div>
                <h5>{{round($hasil->b2,2)}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-description"><h3>Prediksi</h3></div>
                        <h5>{{round($hasil->display,2)}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-hero">
                    <div class="card-header">
                        <h3>Nilai MAPE</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>{{round($hasil->mape,2)}} %</h5>
                            </div>
                            <div class="col-md-6">
                                @if ($hasil->mape < 10)
                                <div class="card-description float-right"><h5>{{__("Akurat")}}</h5></div>
                                @elseif($hasil->mape >= 10 || $hasil->mape < 20)
                                <div class="card-description float-right"><h5>{{__("Baik")}}</h5></div>
                                @elseif($hasil->mape >= 20 || $hasil->mape < 50)
                                <div class="card-description float-right"><h5>{{__("Wajar")}}</h5></div>
                                @else
                                <div class="card-description float-right"><h5>{{__("Tidak Akurat")}}</h5></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

{{-- @push('scripts')
<script>
    $(document).ready(function() {

        var ctx = document.getElementById("chartproduksi").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chart['label']),
                datasets: [
                    {
                        label: 'Aktual',
                        data: @json($chart['data']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        tension: 0.3,
                        pointRadius: 4
                    },
                    {
                        label: 'Prediksi',
                        data: @json($chart['ramal']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        tension: 0.3,
                        pointRadius: 4,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Peramalan Produksi',
                    }
                },
                legend: {
                    display: true
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            },
        });
    });
</script>
@endpush
@include('import.datatable')
@include('import.chartjs') --}}
