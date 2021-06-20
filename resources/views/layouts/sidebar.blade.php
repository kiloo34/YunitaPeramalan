<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{__("SIMPELAN")}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{__("SPL")}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $active == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ auth()->user()->role_id == 1 ? route('mantri.dashboard') : route('holtikultura.dashboard') }}">
                    <i class="far fa-home"></i>
                    <span>{{__('Dashboard')}}</span>
                </a>
            </li>
            <li class="menu-header">Menu</li>
            @if (auth()->user()->role_id == 1)
            <li class="nav-item dropdown {{ $active == 'produksi' || $active == 'permintaan' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-seedling"></i><span>Buah Naga</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $active == 'produksi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('produksi.index') }}">{{__('Produksi')}}</a>
                    </li>
                    <li class="{{ $active == 'permintaan' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('permintaan.index') }}">{{__('Permintaan')}}</a>
                    </li>
                </ul>
            </li>
            <li class="{{ $active == 'hujan' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('hujan.index') }}">
                    <i class="far fa-tint"></i>
                    <span>{{__('Curah Hujan')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'forePro' || $active == 'forePer' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Peramalan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $active == 'forePro' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('forecast.produksi.index') }}">Produksi</a>
                    </li>
                    <li class="{{ $active == 'forePer' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('forecast.permintaan.index') }}">Permintaan</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="nav-item dropdown {{ $active == 'profil' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mantri.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Profil')}}</span>
                </a>
            </li>
            @else
            <li class="nav-item dropdown {{ $active == 'kecamatan' ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('holtikulturia.produksi.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Kecamatan')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'periode' ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('holtikulturia.produksi.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Periode')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'rainfall' ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('rainfall.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Curah Hujan')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'produksi' ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('holtikulturia.produksi.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Produksi')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'permintaan' ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('holtikulturia.produksi.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Permintaan')}}</span>
                </a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="nav-item dropdown {{ $active == 'profil' ? 'active' : '' }}">
                <a class="{{ $active == 'profil' ? 'active' : '' }}" nav-link" href="{{ route('holtikultura.index') }}">
                    <i class="far fa-cogs"></i>
                    <span>{{__('Profil')}}</span>
                </a>
            </li>
            @endif
        </ul>
    </aside>
</div>
