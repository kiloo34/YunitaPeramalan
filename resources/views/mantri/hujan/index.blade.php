@extends('layouts.myview')
@section('content')
{{-- <h1>masuk Index Produksi</h1> --}}
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Curah Hujan</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('hujan.create') }}" class="btn btn-sm btn-icon icon-left btn-primary float-right mb-3"><i class="far fa-plus"></i> Tambah</a>
                <div class="table-responsive">
                    <table id="curahHujan" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Bulan')}}</th>
                            <th>{{__('Tahun')}}</th>
                            <th>{{__('Nilai')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($hujan as $h)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$h->bulan}}</td>
                                <td>{{$h->tahun}}</td>
                                <td>{{$h->nilai}}</td>
                                <td>
                                    <a href="{{ route('hujan.edit', $h->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Ubah</a>
                                    <a href="{{ route('hujan.destroy', $h->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $h->id }}">
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
        $('#curahHujan').DataTable();
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
        var url = "{{ route('hujan.destroy', ":id") }}";
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
                        })
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
