@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Mantri")}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('mantriTani.update', $mantri->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Depan")}}</label>
                                <input type="text" value="{{$mantri->nama_depan}}" name="nama_depan" id="nama_depan" class="form-control @error('nama_depan') is-invalid @enderror" value="{{ old('nama_depan') }}" autofocus>
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
                                <input type="text" value="{{$mantri->nama_belakang}}" name="nama_belakang" id="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror " value="{{ old('nama_belakang') }}" autofocus>
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
                            <option value="{{$mantri->kecamatan->id}}" selected>{{$mantri->kecamatan->nama}}</option>
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
        $("#kecamatan").select2({
            // placeholder: "Pilih Kecamatan",
            // allowClear: true
        });
    })
</script>
@endpush
@endsection
@include('import.select2')
