@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Curah Hujan")}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('mantriTani.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Depan")}}</label>
                                <input type="text" name="nama_depan" id="nama_depan" class="form-control @error('nama_depan') is-invalid @enderror" value="{{ old('nama_depan') }}" autofocus>
                                @error('nama_depan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Belakang")}}</label>
                                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror " value="{{ old('nama_belakang') }}" autofocus>
                                @error('nama_belakang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Kecamatan")}}</label>
                        <select name="kecamatan" id="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror">
                            <option value="" selected>Pilih Data</option>
                            @foreach ($kecamatan as $k)
                                <option value="{{$k->id}}">{{$k->nama}}</option>
                            @endforeach
                        </select>
                        @error('periode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Tambah">
                </form>
                <a href="{{ route('mantriTani.index') }}" class="btn icon-left btn-danger "> {{__("Kembali")}}</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $("#bulan").datepicker({
            autoclose: true,
            minViewMode: 1,
            language: 'id',
            format: 'MM',
            onSelect: function(month) {
                $('#bulan').text(month);
            }
        });
        $("#tahun").datepicker({
            autoclose: true,
            format: "yyyy",
            minViewMode: "years",
        });
        $("#kecamatan").select2({
            // placeholder: "Pilih Kecamatan",
            // allowClear: true
        });
    })
</script>
@endpush
@endsection
@include('import.datepicker')
@include('import.select2')
