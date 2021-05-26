@extends('layouts.myview')
@section('content')
<div class="row">
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'user', 'isi'=>count($kecamatan),
    'judul'=>'kecamatan', 'link'=>route('kecamatan.index')])
    @include('components.infobox', ['col'=>'col-md-4 col-sm-6', 'icon'=>'clock', 'isi'=>count($periode),
    'judul'=>'periode', 'link'=>route('periode.index')])
</div>

<div class="row">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Kecamatan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="produksi" class="table table-striped">
                        <thead>
                            <th>{{__('No')}}</th>
                            <th>{{__('Kecamatan')}}</th>
                            <th>{{__('Total Data')}}</th>
                            <th>{{__('Aksi')}}</th>
                        </thead>
                        <tbody>
                            <?php $no=1 ?>
                            @foreach ($kecamatan as $k)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{ucfirst($k->nama)}}</td>
                                <td>{{count($produksi->where('kecamatan_id', $k->id))}}</td>
                                <td>
                                    <a href="{{ route('produksi.create', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-plus"></i> Tambah Data</a>
                                    @if (count($produksi->where('kecamatan_id', $k->id)) > 0)
                                    <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info" id="produksiModal" data-produksi="{{$k->id}}"><i class="far fa-chart-bar"></i> Produksi</a>
                                    <a href="{{ route('permintaan.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-chart-bar"></i> Permintaan</a>
                                    @endif
                                </td>
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

<form action="{{ route('produksi.chart', $k->id) }}" class="modal-part" id="formProduksi">
    @csrf
    <div class="form-group">
        <label>{{__('Luas Panen')}}</label>
        <input type="text" name="luas" id="luas" class="form-control @error('luas') is-invalid @enderror " value="{{ old('luas') }}" autofocus>
        @error('luas')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label>{{__('Curah Hujan')}}</label>
        <input type="text" name="curah_hujan" id="curah_hujan" class="form-control @error('curah_hujan') is-invalid @enderror " value="{{ old('curah_hujan') }}" autofocus>
        @error('curah_hujan')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    {{-- <input type="hidden" name="kecamatan" class="kecamatan" value="{{$k->id}}"> --}}
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#produksi').DataTable();

        $("#produksiModal").fireModal({
            title: 'Data Produksi',
            body: $("#formProduksi"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                // Form Data
                let form_data = $(e.target).serialize();
                console.log(form_data)

                // DO AJAX HERE
                let submit = setTimeout(function() {
                    form.stopProgress();
                    modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')
                    clearInterval(submit);
                }, 5000);

                e.preventDefault();
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [
                {
                    text: 'Hitung',
                    submit: true,
                    class: 'btn btn-primary btn-shadow',
                    handler: function(modal) {

                    }
                }
            ]
        });

    });
</script>
@endpush
@endsection
@include('import.datatable')
@include('import.chartjs')
{{-- $("#produksiModal").fireModal({
    title: 'Data Produksi',
    body: $("#formProduksi"),
    footerClass: 'bg-whitesmoke',
    autoFocus: false,
    onFormSubmit: function(modal, e, form) {
        // Form Data
        let form_data = $(e.target).serialize();
        console.log(form_data)

        // var id = $('#produksiModal').data("produksi");
        // var url = "{{ route('produksi.chart', ":id") }}";
        // url = url.replace(':id', id);

        // DO AJAX HERE
        let submit = setTimeout(function() {
            form.stopProgress();
            console.log(url, id);
            window.location.href = url;
            // modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')
            clearInterval(submit);
        }, 5000);

        e.preventDefault();
    },
    shown: function(modal, form) {
        console.log(form)
    },
    buttons: [
        {
            text: 'Hitung',
            submit: true,
            class: 'btn btn-primary btn-shadow',
            handler: function(modal) {

            }
        }
    ]
}); --}}
