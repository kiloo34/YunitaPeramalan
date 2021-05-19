@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Ubah {{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ $kecamatan->nama }}" autocomplete="nama" autofocus>
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-primary float-right" value="Ubah">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
