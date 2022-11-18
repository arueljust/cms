@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-outline card-warning">
                    <div class="card-header"><strong>{{ __('Verifikasi Email') }}</strong></div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Verifikasi Email telah dikirim ulang') }}
                        </div>
                        @endif

                        {{ __('Sebelum melanjutkan,Silahkan verifikasi email anda terlebih dahulu.') }} <br>
                        {{ __('Tidak mendapat Verifikasi ?') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kirim ulang') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
