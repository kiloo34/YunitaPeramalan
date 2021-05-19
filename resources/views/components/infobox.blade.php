<div class="<?=$col?>">
    <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-<?=$icon?>"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4 class="mb-2">Total {{$judul}}</h4>
            </div>
            <div class="card-body">
                @if ($isi == 0)
                <a href="{{ route($judul.'.create') }}" class="btn btn-icon icon-left btn-primary">
                    <i class="far fa-edit"></i>
                    Tambah
                    {{$judul}}
                </a>
                @else
                {{$isi}}
                @isset($link)
                <a href="{{ $link }}" class="btn float-right">Detail</a>
                @endisset
                @endif
            </div>
        </div>
    </div>
</div>
