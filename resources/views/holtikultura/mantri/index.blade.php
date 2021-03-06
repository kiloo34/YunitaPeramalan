@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Daftar Mantri")}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('mantriTani.create') }}" class="btn btn-primary">{{__("Tambah")}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mantri" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Nama Depan')}}</th>
                            <th>{{__('Nama Belakang')}}</th>
                            <th>{{__('Username')}}</th>
                            <th>{{__('Kecamatan')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($mantri as $p)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$p->nama_depan}}</td>
                                <td>{{$p->nama_belakang}}</td>
                                <td>{{$p->usernameMantri}}</td>
                                <td>{{$p->namaKecamatan}}</td>
                                <td>
                                    <a href="{{ route('mantriTani.edit', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> {{__("Ubah")}}</a>
                                    <a href="{{ route('mantriTani.show', $p->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-info"></i> {{__("Detail")}}</a>
                                    <a href="{{ route('mantriTani.destroy', $p->id) }}"class="btn btn-sm btn-danger hapus" title="Hapus Data" data-id="{{ $p->id }}"><i class="fa fa-trash"></i>  {{__("Hapus")}}</a>
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
        $('#mantri').DataTable();
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
        var url = "{{ route('mantriTani.destroy', ":id") }}";
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
