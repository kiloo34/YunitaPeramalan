@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permintaan.store') }}" id="form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror " value="{{ old('tahun') }}" autofocus>
                                @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Periode</label>
                                <select name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror"></select>
                                @error('periode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input name="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" value="{{$kecamatan->nama}}" autocomplete="kecamatan" autofocus readonly>
                        @error('kecamatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jumlah Permintaan (KW)</label>
                        <input name="permintaan" type="text" class="form-control @error('permintaan') is-invalid @enderror"
                            value="{{ old('permintaan') }}" autocomplete="permintaan" autofocus>
                        @error('permintaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Tambah">
                </form>
                <a href="{{ route('permintaan.index') }}" class="btn icon-left btn-danger "> Kembali</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        $("#tahun").datepicker({
            autoclose: true,
            format: "yyyy",
            minViewMode: "years",
        });

        $("#kecamatan").select2({
            placeholder: "Pilih Kecamatan",
            allowClear: true
        });

        $("#periode").select2({
            placeholder: "Pilih Periode",
            allowClear: true
        });
    });

    $(function() {
        $('#tahun').change(function() {
            var target = $(this).val();

            var url = '{{ route("produksi.getPeriode", ':tahun') }}';
            url = url.replace(':tahun', target);
            console.log(url, target)
            $.get(url, function(data) {
                var select = $('#periode');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + value.id + '>' + value.periode + '</option>');
                });
            });
        });
    });
</script>
@endpush
@endsection
@include('import.datepicker')
@include('import.select2')
@include('import.cleave')
