@extends('layouts.myview')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Data Permitaan</h4>
            </div>
            <div class="card-body">
                <canvas id="chartproduksi"></canvas>
            </div>
        </div>
    </div>
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
                                    {{-- <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info" id="produksiModal" data-produksi="{{$k->id}}"><i class="far fa-chart-bar"></i> Produksi</a> --}}
                                    {{-- <a href="{{ route('produksi.chart', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-chart-bar"></i> produksi</a> --}}
                                    <a href="{{ route('produksi.show', $k->id) }}" class="btn btn-sm btn-icon icon-left btn-info"><i class="far fa-info-circle"></i> Detail</a>
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

{{-- <form action="{{ route('produksi.chart', $k->id) }}" class="modal-part" id="formProduksi">
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
</form> --}}

@push('scripts')
<script>
    $(document).ready(function() {
        $('#produksi').DataTable();

        // $("#produksiModal").fireModal({
        //     title: 'Data Produksi',
        //     body: $("#formProduksi"),
        //     footerClass: 'bg-whitesmoke',
        //     autoFocus: false,
        //     onFormSubmit: function(modal, e, form) {
        //         // Form Data
        //         let form_data = $(e.target).serialize();
        //         console.log(form_data)

        //         // DO AJAX HERE
        //         let submit = setTimeout(function() {
        //             form.stopProgress();
        //             modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')
        //             clearInterval(submit);
        //         }, 5000);

        //         e.preventDefault();
        //     },
        //     shown: function(modal, form) {
        //         console.log(form)
        //     },
        //     buttons: [
        //         {
        //             text: 'Hitung',
        //             submit: true,
        //             class: 'btn btn-primary btn-shadow',
        //             handler: function(modal) {

        //             }
        //         }
        //     ]
        // });

        var ctx = document.getElementById("chartproduksi").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($label),
                datasets: [
                    @foreach ($chart as $c)
                    {
                        label: @json($c['kecamatan']) ,
                        data: @json($c['data']),
                        borderColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        backgroundColor: '#'+Math.floor(Math.random()*16777215).toString(16),
                        pointRadius: 4
                    },
                    @endforeach
                ]
            },
            options: {
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: true
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    });
</script>
@endpush
@endsection
@include('import.datatable')
@include('import.chartjs')
