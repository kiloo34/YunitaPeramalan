@extends('layouts.myview')
@section('content')
<h2 class="section-title">Hi, {{auth()->user()->holtikultura->nama_depan}}</h2>
<p class="section-lead">
    Ubah Informasi mengenai data diri di Halaman ini.
</p>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
    <div class="card profile-widget">
        <div class="profile-widget-header">

            <img alt="image" src="{{auth()->user()->holtikultura->avatar}}" class="rounded-circle profile-widget-picture">
        </div>
        <div class="profile-widget-description">
            <div class="profile-widget-name">{{auth()->user()->holtikultura->nama_depan}} {{auth()->user()->holtikultura->nama_belakang}}
                <div class="text-muted d-inline font-weight-normal">
                    <div class="slash"></div>
                    {{ucfirst(auth()->user()->role->nama)}}</div>
                </div>
        </div>
    </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <form action="{{ route('holtikultura.update', auth()->user()->id) }}" method="post" class="needs-validation" novalidate="">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama_depan">Nama Depan</label>
                            <input id="nama_depan" type="text"
                                class="form-control @error('nama_depan') is-invalid @enderror" name="nama_depan"
                                value="{{ auth()->user()->holtikultura->nama_depan }}" autocomplete="nama_depan" autofocus>
                            @error('nama_Depan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input id="nama_belakang" type="text"
                                class="form-control @error('nama_belakan') is-invalid @enderror" name="nama_belakang"
                                value="{{ auth()->user()->holtikultura->nama_belakang }}" autocomplete="nama_belakang" autofocus>
                            @error('nama_belakang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nip">{{ __('NIP') }}</label>
                        <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror"
                            name="nip" value="{{ auth()->user()->nip }}" tabindex="1" autocomplete="nip" autofocus>
                        @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username">{{ __('Username') }}</label>
                        <input id="username" type="username" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ auth()->user()->username }}" tabindex="1" autocomplete="username" autofocus>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="d-block">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="current-password" tabindex="2">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="password2" class="d-block">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"> Ubah Profil</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
