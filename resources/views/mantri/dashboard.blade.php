@extends('layouts.myview')
@section('content')
<div class="row">
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'user', 'isi'=>count($kecamatan),
    'judul'=>'kecamatan', 'link'=>route('kecamatan.index')])
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'clock', 'isi'=>count($periode),
    'judul'=>'periode', 'link'=>route('periode.index')])
</div>
<h1>masuk dashboard mantri</h1>
@endsection
