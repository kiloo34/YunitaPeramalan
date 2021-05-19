@extends('layouts.myview')
@section('content')
<div class="row">
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'user', 'isi'=>count($kecamatan),
    'judul'=>'kecamatan', 'link'=>route('kecamatan.index')])
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'clock', 'isi'=>count($periode),
    'judul'=>'periode', 'link'=>route('periode.index')])
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kecamatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produksi" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Kecamatan')}}</th>
                            <th>{{__('Total Data')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($kecamatan as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ucfirst($k->nama)}}</td>
                                <td>{{count($produksi->where('kecamatan_id', $k->id))}}</td>
                                <td>
                                    <a href="{{ route('produksi.create', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-plus"></i> Tambah Data</a>
                                    @if (count($produksi->where('kecamatan_id', $k->id)) > 0)
                                    <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-chart-bar"></i> Produksi</a>
                                    <a href="{{ route('permintaan.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-chart-bar"></i> Permintaan</a>
                                    @endif
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
</script>
@endpush
@endsection
@include('import.datatable')
@include('import.chartjs')
