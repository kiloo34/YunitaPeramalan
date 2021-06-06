@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ucfirst($title)}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('permintaan.update', $permintaan->id) }}" id="form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Periode</label>
                                <input type="text" name="periode" id="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ $permintaan->periode->periode }}" autofocus readonly>
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
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror " value="{{ $permintaan->periode->tahun }}" autofocus readonly>
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
                        <input name="kecamatan" type="text" class="form-control @error('permintaan') is-invalid @enderror"
                            value="{{ $permintaan->kecamatan->nama }}" autocomplete="permintaan" autofocus readonly>
                        @error('permintaan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="section-title">permintaan</div>

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
                    <input type="submit" class="btn btn-primary float-right" value="Ubah">
                </form>
                <a href="{{ route('permintaan.show', $kecamatan->id) }}" class="btn icon-left btn-danger "> Kembali</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
</script>
@endpush
@endsection

