@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Curah {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('hujan.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bulan</label>
                                <input type="text" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan') }}" autofocus>
                                @error('bulan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    </div>
                    <div class="form-group">
                        <label>Nilai Curah Hujan</label>
                        <input name="nilai" type="text" class="form-control @error('nilai') is-invalid @enderror"
                            value="{{ old('nilai') }}" autocomplete="nilai" autofocus>
                        @error('nilai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Tambah">
                </form>
                <a href="{{ route('hujan.index') }}" class="btn icon-left btn-danger "> Kembali</a>
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
    })
</script>
@endpush
@endsection
@include('import.datepicker')
