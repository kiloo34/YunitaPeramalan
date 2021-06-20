@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Curah Hujan")}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('rainfall.update', $rainfall->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Bulan")}}</label>
                                <input type="text" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" value="{{$rainfall->bulan}}" autofocus>
                                @error('bulan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Tahun")}}</label>
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror " value="{{$rainfall->tahun}}" autofocus>
                                @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Nilai Curah Hujan")}}</label>
                        <input name="nilai" type="text" class="form-control @error('nilai') is-invalid @enderror"
                            value="{{$rainfall->nilai}}" autocomplete="nilai" autofocus>
                        @error('nilai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Ubah">
                </form>
                <a href="{{ route('hujan.index') }}" class="btn icon-left btn-danger "> {{__("Kembali")}}</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $("#bulan").datepicker({
        autoclose: true,
        minViewMode: 1,
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

</script>
@endpush
@endsection
@include('import.datepicker')
