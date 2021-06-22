@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kecamatan</h4>
                <div class="card-header-action">
                    <a href="{{ route('mantri.dashboard') }}" class="btn btn-danger">Kembali </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kecamatan" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Nama')}}</th>
                            {{-- <th>{{__('Aksi')}}</th> --}}
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($kecamatan as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$k->nama}}</td>
                                {{-- <td>
                                    <a href="{{ route('kecamatan.edit', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Ubah</a>
                                    <a href="{{ route('kecamatan.destroy', $k->id) }}"
                                        class="btn btn-sm btn-danger hapus" data-toggle="tooltip" data-placement="top"
                                        title="Hapus Data" data-id="{{ $k->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td> --}}
                                <?php $no++ ?>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
