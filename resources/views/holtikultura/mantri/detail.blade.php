@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Mantri")}}</h4>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Depan")}}</label>
                                <input type="text" value="{{$mantri->nama_depan}}" id="nama_depan" class="form-control @error('nama_depan') is-invalid @enderror" value="{{ old('nama_depan') }}" autofocus readonly >
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
                                <input type="text" value="{{$mantri->nama_belakang}}" id="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror " value="{{ old('nama_belakang') }}" autofocus readonly>
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
                        <input type="text" value="{{$mantri->namaKecamatan}}" id="nama_belakang" class="form-control @error('nama_belakang') is-invalid @enderror " value="{{ old('nama_belakang') }}" autofocus readonly>
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Tambah">
                </form>
                <a href="{{ route('mantriTani.index') }}" class="btn icon-left btn-danger "> {{__("Kembali")}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
