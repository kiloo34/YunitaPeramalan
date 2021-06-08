@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('periode.update', $periode->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Periode</label>
                                <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ $periode->periode }}" autofocus>
                                @error('periode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror " value="{{ $periode->tahun }}" autofocus>
                                @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Ubah">
                </form>
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
        })
    })
</script>
@endpush
@endsection
@include('import.datepicker')
