@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title)}} Kecamatan {{$kecamatan->nama}}</h4>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Perhitungan {{ucfirst($title)}} Kecamatan {{$kecamatan->nama}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-md">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Irwansyah Saputra</td>
                      <td>2017-01-09</td>
                      <td><div class="badge badge-success">Active</div></td>
                      <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Hasan Basri</td>
                      <td>2017-01-09</td>
                      <td><div class="badge badge-success">Active</div></td>
                      <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Kusnadi</td>
                      <td>2017-01-11</td>
                      <td><div class="badge badge-danger">Not Active</div></td>
                      <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Rizal Fakhri</td>
                      <td>2017-01-11</td>
                      <td><div class="badge badge-success">Active</div></td>
                      <td><a href="#" class="btn btn-secondary">Detail</a></td>
                    </tr>
                  </table>
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
