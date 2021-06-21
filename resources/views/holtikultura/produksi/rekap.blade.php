@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{__("Rekapitulasi Data Produksi")}}</h4>
                <div class="card-header-action">
                    <a href="{{ route('production.index') }}" class="btn btn-danger">{{__("Kembali")}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <th style="text-align: center">Periode</th>
                            <th style="text-align: center">Produksi (Y)</th>
                            <th style="text-align: center">Luas Panen (X1)</th>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($data); $i++)
                            <tr>
                                <td style="text-align: center">{{$data[$i]['periode']}}</td>
                                <td style="text-align: center">{{$data[$i]['produksi']}}</td>
                                <td style="text-align: center">{{$data[$i]['luas_lahan']}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
