{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('admin.layouts.guest')

@section('content')
    <div class="auth-basic-wrapper d-flex align-items-center justify-content-center">
        <div class="container-fluid my-5 my-lg-0">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
                    <div class="card rounded-4 mb-0 border-4 border-primary border-gradient-1">
                        <div class="card-body p-5">
                            <img src="{{ asset('storage/images/logo/hyunglobal_logo.png') }}" class="mb-4" width="145"
                                alt="">
                            <h4 class="fw-bold">Admin Login</h4>
                            <p class="mb-0">Daxil olmaq üçün məlumatlarınızı daxil edin</p>

                            <div class="form-body my-5">
                                <form method="POST" action="{{ route('admin.login') }}" class="row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <label required autofocus for="inputEmailAddress" class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" id="inputEmailAddress"
                                            placeholder="my@example.com">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Şifrə</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input required name="password" type="password" class="form-control border-end-0"
                                                id="inputChoosePassword" value="" placeholder="Şifrənizi daxil edin">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input name="remember" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Yadda saxla</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button style="color: white" type="submit" class="btn btn-grd-primary">Login</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>

    
@endsection
