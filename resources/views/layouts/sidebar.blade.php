<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">{{__("SIMPELAN")}}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">{{__("SPL")}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ $active == 'dashboard' ? 'active' : null }}"">
                @if (auth()->user()->role_id == 1)
                <a class=" nav-link" href="{{ route('mantri.dashboard') }}">
                @else
                <a class="nav-link" href="{{ route('holtikultura.dashboard') }}">
                    @endif
                    <i class="fa fa-home"></i>
                    <span>{{__('Dashboard')}}</span>
                </a>
            </li>
            <li class="menu-header">Menu</li>
            @if (auth()->user()->role_id == 1)
            <li class="nav-item dropdown {{ $active == 'produksi' ? 'active' : '' }}">
                <a class="{{ $active == 'produksi' ? 'active' : '' }}" nav-link" href="{{ route('produksi.index') }}">
                    <i class="fa fa-cogs"></i>
                    <span>{{__('Produksi')}}</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $active == 'hujan' ? 'active' : '' }}">
                <a class="{{ $active == 'produksi' ? 'active' : '' }}" nav-link" href="{{ route('hujan.index') }}">
                    <i class="fa fa-tint"></i>
                    <span>{{__('Curah Hujan')}}</span>
                </a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="nav-item dropdown {{ $active == 'profil' ? 'active' : '' }}">
                <a class="{{ $active == 'profil' ? 'active' : '' }}" nav-link" href="{{ route('mantri.index') }}">
                    <i class="fa fa-cogs"></i>
                    <span>{{__('Profil')}}</span>
                </a>
            </li>
            @else
            <li class="nav-item dropdown {{ $active == 'produksi' ? 'active' : '' }}">
                <a class="{{ $active == 'produksi' ? 'active' : '' }}" nav-link"
                    href="{{ route('holtikulturia.produksi.index') }}">
                    <i class="fa fa-cogs"></i>
                    <span>{{__('Produksi')}}</span>
                </a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class="nav-item dropdown {{ $active == 'profil' ? 'active' : '' }}">
                <a class="{{ $active == 'profil' ? 'active' : '' }}" nav-link" href="{{ route('holtikultura.index') }}">
                    <i class="fa fa-cogs"></i>
                    <span>{{__('Profil')}}</span>
                </a>
            </li>
            @endif
        </ul>
    </aside>
</div>
