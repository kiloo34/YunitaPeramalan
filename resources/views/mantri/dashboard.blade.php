@extends('layouts.myview')
@section('content')
<div class="row">
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'user', 'isi'=>count($kecamatan),
    'judul'=>'kecamatan', 'link'=>route('kecamatan.index')])
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'clock', 'isi'=>count($periode),
    'judul'=>'periode', 'link'=>route('periode.index')])
</div>
<div class="row">
    <div class="col-md-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Produksi</h4>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Permintaan</h4>
            </div>
            <div class="card-body">
                <canvas id="chartpermintaan"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        var ctx1 = document.getElementById("chartproduksi").getContext('2d');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($label),
                datasets: [
                    @foreach ($chart as $c)
                    {
                        label: @json(ucfirst($c['kecamatan'])) ,
                        data: @json($c['produksi']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        pointRadius: 4
                    },
                    @endforeach
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
                        text: @json(ucfirst($title)),
                    }
                },
                legend: {
                    display: true
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                },
            },
        });

        var ctx2 = document.getElementById("chartpermintaan").getContext('2d');
        var myChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($label),
                datasets: [
                    @foreach ($chart as $c)
                    {
                        label: @json(ucfirst($c['kecamatan'])) ,
                        data: @json($c['permintaan']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        pointRadius: 4
                    },
                    @endforeach
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
                        text: @json(ucfirst($title)),
                    }
                },
                legend: {
                    display: true
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                },
            },
        });
    });
</script>
@endpush
@include('import.chartjs')
