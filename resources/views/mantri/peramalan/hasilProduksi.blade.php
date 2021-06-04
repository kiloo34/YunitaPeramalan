@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // $('#produksi').DataTable();

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
                        backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        pointRadius: 4
                    },
                    {
                        label: 'Prediksi',
                        data: @json($chart['ramal']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        pointRadius: 4,
                        // lineTension: 1,
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
                // scales: {
                //     x: {
                //         stacked: true,
                //     },
                //     y: {
                //         stacked: true
                //     }
                // },
            },
        });
    });
</script>
@endpush
{{-- @endsection --}}
@include('import.datatable')
@include('import.chartjs')
