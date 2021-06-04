@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title).' '.ucfirst($kecamatan->nama)}}</h4>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Daftar Produksi")}} {{ucfirst($kecamatan->nama)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produksi" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Tahun')}}</th>
                            <th>{{__('Periode')}}</th>
                            <th>{{__('Produksi')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($produksi as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$k->tahun}}</td>
                                <td>{{$k->periode}}</td>
                                <td>{{number_format($k->produksi)}}</td>
                                {{-- <td>{{ucfirst($k->nama)}}</td> --}}
                                {{-- <td>{{count($produksi->where('kecamatan_id', $k->id))}}</td> --}}
                                <td>
                                    {{-- <a href="{{ route('produksi.create', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-plus"></i> {{__("Tambah Data")}}</a>
                                    @if (count($produksi->where('kecamatan_id', $k->id)) > 0)
                                    <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info" id="produksiModal" data-produksi="{{$k->id}}"><i class="far fa-chart-bar"></i> Produksi</a>
                                    <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-chart-bar"></i> produksi</a>
                                    <a href="{{ route('produksi.show', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-info-circle"></i> {{__("Detail")}}</a> --}}
                                    {{-- @endif --}}

                                </td>
                                <?php $no++; ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#produksi').DataTable();

        var ctx = document.getElementById("chartproduksi").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chart['label']),
                datasets: [{
                    label: @json(ucfirst($title)),
                    data: @json($chart['data']),
                    borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                    backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                    pointRadius: 4
                }]
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
@endsection
@include('import.datatable')
@include('import.chartjs')
