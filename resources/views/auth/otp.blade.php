@extends('layouts.auth')
@php
    $settings = settings();
@endphp
@section('tab-title')
    {{ __('Login') }}
@endsection
@push('script-page')
@endpush
@section('content')
<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex justify-content-center">
                        <div class="auth-header">
                            <h2 class="text-secondary"><b>{{ __('Welcome to ') }}{{ env('APP_NAME') }}!</b></h2>
                            <h4 class="mx-2"><b>{{ __('Enter your 2FA Verification Code (OTP)') }}</b></h4>
                        </div>
                    </div>
                </div>
                {{ Form::open(['route' => 'otp.check', 'method' => 'post', 'id' => 'loginForm', 'class' => 'login-form']) }}
                @if (session('error'))
                    <div class="alert alert-danger mb-0" role="alert">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success mb-0" role="alert">{{ session('success') }}</div>
                @endif
                <div class="row text-center">
                    <input type="number" class="form-control w-100 mx-2 mt-3 text-center" name="otp" min="0" max="999999" />
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-secondary p-2">{{ __('Continue') }}</button>
                </div>
                {{ Form::close() }}

            </div>
        </div>

@endsection
