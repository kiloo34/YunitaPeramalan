@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <table id="kecamatan" class="table table-striped">
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
                                <a href="#" class="btn btn-sm btn-icon icon-left btn-primary modalKecamatan" id="modalKecamatan-{{$k->id}}" data-id="{{$k->id}}" data-name="{{$k->nama}}"></i> {{__("Ramal Data")}}</a>
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
@endsection

@section('modal')
@foreach ($kecamatan as $k)
<form method="POST" action="{{ route('forecast.produksi.proses', $k->id) }}" class="modal-part" id="formProduksiKecamatan-{{$k->id}}">
    @csrf
    <div class="form-group">
        <label>Kecamatan</label>
        <input type="text" class="form-control" value="{{ucfirst($k->nama)}}" autofocus readonly>
        <input type="hidden" name="kecamatan" value="{{$k->id}}">
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Luas Panen</label>
                <input type="text" name="luas_panen" id="luas_panen" class="form-control @error('luas_panen') is-invalid @enderror " value="{{ old('luas_panen') }}" autofocus>
                @error('luas_panen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label>Curah Hujan</label>
                <input type="text" name="curah_hujan" id="curah_hujan" class="form-control @error('curah_hujan') is-invalid @enderror " value="{{ old('curah_hujan') }}" autofocus>
                {{-- <select name="curah_hujan" id="curah_hujan" class="form-control @error('curah_hujan') is-invalid @enderror"></select> --}}
                @error('curah_hujan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
</form>
@endforeach
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kecamatan').DataTable();
        $('.modalKecamatan').click(function () {

            var id = $(this).attr('data-id');
            var nama = $(this).attr('data-name');
            console.log(id);
            console.log(nama);

            $("#modalKecamatan-"+id).fireModal({
                title: 'Form Peramalan Produksi',
                body: $("#formProduksiKecamatan-"+id),
                footerClass: 'bg-whitesmoke',
                autoFocus: false,
                onFormSubmit: function(modal, e, form) {
                    // Form Data
                    let form_data = $(e.target).serialize();
                    console.log(form_data)

                    e.preventDefault();
                    e.currentTarget.submit();
                },
                shown: function(modal, form) {
                    console.log(form)
                },
                buttons: [
                    {
                        text: 'Ramal',
                        submit: true,
                        class: 'btn btn-primary btn-shadow',
                        handler: function(modal) {

                        }
                    }
                ]
            });
        });
    });

</script>
@endpush
@include('import.datatable')
