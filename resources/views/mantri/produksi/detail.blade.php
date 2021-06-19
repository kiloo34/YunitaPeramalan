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
                            <th>{{__('Luas Lahan')}}</th>
                            <th>{{__('Produksi')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($produksi as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>{{$p->periode}}</td>
                                <td>{{$p->luas_panen}}</td>
                                <td>{{number_format($p->produksi)}}</td>
                                <td>
                                    <a href="{{ route('produksi.edit', [$kecamatan->id, $p->id]) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> {{__("Edit Data")}}</a>
                                    <a href="{{ route('produksi.destroy', $p->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $p->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
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
    $('.hapus').on('click', function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).data("id");
        // var url = $('.hapus').attr('href');
        var url = "{{ route('produksi.destroy', ":id") }}";
        url = url.replace(':id', id);
        $object=$(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "Yakin ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {id: id},
                    success: function (response) {
                        $($object).parents('tr').remove();
                        Swal.fire({
                            title: "Data Dihapus!",
                            text: response.message,
                            icon: 'success',
                        });
                        location.reload();
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Data Gagal Dihapus!",
                            icon: 'error',
                        })
                    }
                });
            }
        });
    })
</script>
@endpush
@endsection
@include('import.datatable')
@include('import.chartjs')
