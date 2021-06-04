@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permintaan.store') }}" id="form" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input name="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" value="" autocomplete="kecamatan" autofocus readonly>
                        @error('kecamatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Tambah">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

