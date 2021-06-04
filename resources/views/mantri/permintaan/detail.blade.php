@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart {{ucfirst($title).' '.ucfirst($kecamatan->nama)}}</h4>
            </div>
            <div class="card-body">
                <canvas id="chartPermintaan"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Daftar Permintaan")}} {{ucfirst($kecamatan->nama)}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permintaan" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Tahun')}}</th>
                            <th>{{__('Periode')}}</th>
                            <th>{{__('permintaan')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($permintaan as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>{{$p->periode}}</td>
                                <td>{{number_format($p->permintaan)}}</td>
                                <td>
                                    <a href="{{ route('permintaan.edit', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> {{__("Edit Data")}}</a>
                                    <a href="{{ route('permintaan.edit', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-danger"><i class="far fa-trash"></i> {{__("Hapus")}}</a>
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
        $('#permintaan').DataTable();

        var ctx = document.getElementById("chartPermintaan").getContext('2d');
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
