@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Koefisien Regresi Permintaan (b)</h4>
                </div>
                <div class="card-body">
                    {{round($hasil->b,2)}}
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Perhitungan")}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('forecast.req.index') }}" class="btn btn-danger">{{__("Kembali")}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <th style="text-align: center" colspan="2">Periode</th>
                            <th style="text-align: center">Permintaan (Y)</th>
                            <th style="text-align: center">Periode (X)</th>
                            <th style="text-align: center">X^2</th>
                            <th style="text-align: center">Y*X</th>
                            <th style="text-align: center">Prediksi (Y`)</th>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($periode); $i++)
                            <tr>
                                <td style="text-align: center">{{$hasil->x['tahun'][$i]}}</td>
                                <td style="text-align: center">{{$hasil->x['periode'][$i]}}</td>
                                <td style="text-align: center">{{$hasil->y[$i]}}</td>
                                <td style="text-align: center">{{$hasil->x['nilai'][$i]}}</td>
                                <td style="text-align: center">{{$hasil->xex[$i]}}</td>
                                <td style="text-align: center">{{$hasil->yx[$i]}}</td>
                                <td style="text-align: center">{{round($hasil->res[$i],1)}}</td>
                            </tr>
                            @endfor
                            <tr>
                                <td style="text-align: center" colspan="2">&#931</td>
                                <td style="text-align: center">{{round(array_sum($hasil->y),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->x['nilai']),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->xex),1)}}</td>
                                <td style="text-align: center">{{round(array_sum($hasil->yx),1)}}</td>
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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title)}} Kecamatan {{$kecamatan->nama}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('forecast.permintaan.index') }}" class="btn btn-danger">Kembali </a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="chartPermintaan"></canvas>
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
                <div class="card-description"><h3>Koefisien Regresi Permintaan (b)</h3></div>
                <h5>{{round($hasil->b,2)}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-description"><h3>Prediksi</h3></div>
                <h5>{{round($hasil->display,2)}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
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
</div> --}}
@endsection

{{-- @push('scripts')
<script>
    $(document).ready(function() {
        var ctx = document.getElementById("chartPermintaan").getContext('2d');
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
@endpush --}}
{{-- @endsection --}}
{{-- @include('import.datatable') --}}
{{-- @include('import.chartjs') --}}

