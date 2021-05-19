@extends('layouts.myview')
@section('content')
<div class="row">
    @include('components.infobox', ['col'=>'col-md-12', 'icon'=>'clock', 'isi'=>count($periode),
    'judul'=>'periode'])
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar {{ucfirst($title)}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('produksi.index') }}" class="btn btn-danger">Kembali </a>
                    <a href="{{ route('periode.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="periode" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Periode')}}</th>
                            <th>{{__('Tahun')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($periode as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->periode}}</td>
                                <td>{{$p->tahun}}</td>
                                <td>
                                    <a href="{{ route('periode.edit', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Ubah</a>
                                    <a href="{{ route('periode.destroy', $p->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $p->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                    {{-- <a href="#" class="btn btn-sm btn-icon icon-left btn-danger"><i class="far fa-trash"></i> Hapus</a> --}}
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
        $('#periode').DataTable();
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
        var url = "{{ route('periode.destroy', ":id") }}";
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
