@extends('layouts.auth')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <!-- BEGIN NAVBAR LOGO -->
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ Storage::url($logo) }}" width="150" alt="{{ config('app.name') . ' Logo' }}">
                </a>
                <!-- END NAVBAR LOGO -->
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <a href="{{ route('home') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg> Back to Home</a>
                    <h2 class="h2 text-center mb-4 mt-5">Login to your account</h2>
                    <form action="{{ route('login.submit') }}" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="your@email.com"
                                autocomplete="off" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="#">I forgot password</a>
                                </span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input id="password" type="password" name="password" class="form-control" placeholder="Your password" autocomplete="off" />
                                <span class="input-group-text p-0">
                                    <button type="button" class="btn btn-icon" id="togglePassword" aria-label="Show password" style="border:0;background:transparent;">
                                        <!-- eye (visible by default) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-eye" aria-hidden="true">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                        <!-- eye-off (hidden by default) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-eye-off" aria-hidden="true" style="display:none;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                                            <path d="M3 3l18 18" />
                                        </svg>
                                    </button>
                                </span>
                            </div>

                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var pwd = document.getElementById('password');
                                var btn = document.getElementById('togglePassword');
                                if (!pwd || !btn) return;
                                var eye = btn.querySelector('.icon-tabler-eye');
                                var eyeOff = btn.querySelector('.icon-tabler-eye-off');

                                btn.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    var isPassword = pwd.getAttribute('type') === 'password';
                                    pwd.setAttribute('type', isPassword ? 'text' : 'password');
                                    if (eye) eye.style.display = isPassword ? 'none' : '';
                                    if (eyeOff) eyeOff.style.display = isPassword ? '' : 'none';
                                    btn.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
                                });
                            });
                            </script>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">CMS Version {{ config('app.version') }}</div></div>
        </div>
    </div>
@endsection
