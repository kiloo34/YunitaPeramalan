@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('produksi.update', $produksi->id) }}" id="form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Periode</label>
                                <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ $produksi->periode->periode }}" autofocus readonly>
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
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror " value="{{ $produksi->periode->tahun }}" autofocus readonly>
                                @error('tahun')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input name="kecamatan" type="text" class="form-control @error('produksi') is-invalid @enderror"
                            value="{{ $produksi->kecamatan->nama }}" autocomplete="produksi" autofocus readonly>
                        @error('produksi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="section-title">Produksi</div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Jumlah Produksi (KW)</label>
                                <input name="produksi" type="text" class="form-control @error('produksi') is-invalid @enderror"
                                    value="{{ $produksi->produksi }}" autocomplete="produksi" autofocus>
                                @error('produksi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Luas Lahan (HA)</label>
                                <input name="luas" type="text" class="form-control @error('luas') is-invalid @enderror"
                                    value="{{$produksi->luas_panen}}" autocomplete="luas" autofocus>
                                @error('luas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Jumlah Permintaan (KW)</label>
                                <input name="permintaan" type="text" class="form-control @error('permintaan') is-invalid @enderror"
                                    value="{{$permintaan->permintaan}}" autocomplete="permintaan" autofocus>
                                @error('permintaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp.
                                </div>
                            </div>
                            <input name="harga" id="harga" type="text" class="form-control @error('harga') is-invalid @enderror"
                            value="{{$produksi->harga}}" autocomplete="harga" autofocus>
                            @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Ubah">
                </form>
                <a href="{{ route('produksi.show', $kecamatan->id) }}" class="btn icon-left btn-danger "> Kembali</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function(){
        new Cleave('#harga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralPositiveOnly: true,

        });
    });
</script>
@endpush
@endsection
@include('import.cleave')
