@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
    <div class="page-wrapper">

        {{-- PAGE HEADER --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Akun
                        </div>

                        <h2 class="page-title">
                            Pengaturan Profile
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAGE BODY --}}
        <div class="page-body">
            <div class="container-xl">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div>
                            {{ session('success') }}
                        </div>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row row-cards">

                        <div class="col-12">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title fw-bold">
                                        Informasi Profile
                                    </h3>
                                </div>

                                <div class="card-body">

                                    {{-- Name --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">
                                            Nama
                                        </label>

                                        <div class="col">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Nama lengkap" value="{{ old('name', $user->name) }}">

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">
                                            Email
                                        </label>

                                        <div class="col">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email', $user->email) }}">

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label">
                                            Password Baru
                                        </label>

                                        <div class="col">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Kosongkan jika tidak ingin mengganti password">

                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label">
                                            Konfirmasi Password
                                        </label>

                                        <div class="col">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi password baru">
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label">
                                            Role
                                        </label>

                                        <div class="col">
                                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}"
                                                disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-end">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-confirm">
                                        <x-icon-edit />
                                        Update Profile
                                    </button>

                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- Modal Confirm --}}
                    <div class="modal modal-blur fade" id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Konfirmasi
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    Apakah Anda yakin ingin memperbarui profile?
                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Batal
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        Ya, Update
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
