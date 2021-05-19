<div class="section-header">
    <h1>{{ucfirst($title== 'hujan' ? 'curah Hujan' : $title)}}</h1>
    <div class="section-header-breadcrumb">
        @if (auth()->user()->role_id == 1)
        <div class="breadcrumb-item"><a href="{{ route('mantri.dashboard') }}">SIMPELAN</a></div>
        @else
        <div class="breadcrumb-item"><a href="{{ route('holtikultura.dashboard') }}">SIMPELAN</a></div>
        @endif
        @if ($subtitle == null)
        <div class="breadcrumb-item active"><a
                href="{{ route(auth()->user()->role->nama.'.dashboard') }}">{{ucfirst($title == 'hujan' ? 'curah Hujan' : $title)}}</a>
        </div>
        @else
        @if ($title == 'dashboard')
        <div class="breadcrumb-item"><a href="#">{{ucfirst($title)}}</a></div>
        @else
        <div class="breadcrumb-item"><a href="{{ route($title.'.index', $id ?? '') }}">{{ucfirst($title)}}</a></div>
        @endif
        <div class="breadcrumb-item active">{{ucfirst($subtitle)}}</div>
        @endif
    </div>
</div>
