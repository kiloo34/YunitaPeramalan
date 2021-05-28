@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart Permintaan {{$kecamatan->nama}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('produksi.index') }}" class="btn btn-danger">Kembali </a>
                    <a href="{{ route('permintaan.proses') }}" class="btn btn-primary">Hitung Prediksi</a>
                </div>
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
                <h4>Daftar Permintaan Kecamatan {{$kecamatan->nama}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('produksi.create', $kecamatan->id) }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produksi" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Periode')}}</th>
                            <th>{{__('Tahun')}}</th>
                            <th>{{__('Luas Panen')}}</th>
                            <th>{{__('Harga')}}</th>
                            <th>{{__('Permintaan')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($permintaan as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->periode}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>{{$p->luas_panen}} Ha</td>
                                <td>Rp. {{number_format($p->harga)}}</td>
                                <td>{{$p->permintaan}} Kw</td>
                                <td>
                                    <a href="{{ route('produksi.edit', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Ubah</a>
                                    <a href="{{ route('produksi.destroy', $p->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $p->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                                <?php $no++ ?>
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
    });

    var ctx = document.getElementById("chartPermintaan").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chart['label']),
            datasets: [{
                label: 'Statistics',
                data: @json($chart['data']),
                borderColor: '#6777ef',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                    }
                }],
                xAxes: [{
                    ticks: {
                        display: true
                    },
                    gridLines: {
                        display: true
                    }
                }]
            },
        }
    });
</script>
@endpush
@endsection
@include('import.datatable')
@include('import.chartjs')
