@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Chart Produksi {{$kecamatan->nama}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('produksi.index') }}" class="btn btn-danger">Kembali</a>
                    <a href="{{ route('produksi.proses', $kecamatan->id) }}" class="btn btn-primary">Hitung Prediksi</a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="chartProduksi"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Produksi Kecamatan {{$kecamatan->nama}}</h4>
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
                            <th>{{__('Produksi')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($produksi as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->periode}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>{{$p->luas_panen}} Ha</td>
                                <td>Rp. {{number_format($p->harga)}}</td>
                                <td>{{$p->produksi}} Kw</td>
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

    var ctx = document.getElementById("chartProduksi").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chart['label']),
            datasets: [
            {
                label: 'Aktual',
                data: @json($chart['data']),
                borderColor: '#6777ef',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            },
            {
                label: 'Prediksi',
                data: @json($chart['data2']),
                borderColor: '#34ebd2',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }
            ]
        },
        options: {
            legend: {
                display: true
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: true,
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
