@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
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
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <div class="card-description"><h3>Prediksi</h3></div>
                <h5>{{$hasil->display}}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card card-hero">
            <div class="card-header">
                <h3>Nilai MAPE</h3>
                <div class="row">
                    <div class="col-md-6">
                        <h5>{{$hasil->mape}} %</h5>
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // $('#produksi').DataTable();

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
@endpush
{{-- @endsection --}}
@include('import.datatable')
@include('import.chartjs')

