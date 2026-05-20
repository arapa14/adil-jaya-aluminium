@extends('layouts.dashboard')
@section('title', 'Create Testimonial')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Tambah Testimonial
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('testimonials.index') }}" class="btn btn-primary">
                            <x-icon-back />
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Nama Customer
                                        </label>
                                        <input type="text" name="customer_name" class="form-control"
                                            value="{{ old('customer_name') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Jenis Project
                                        </label>
                                        <input type="text" name="project_type" class="form-control"
                                            value="{{ old('project_type') }}"
                                            placeholder="Contoh: Pemasangan Kusen Aluminium">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Rating
                                        </label>
                                        <select name="rating" class="form-select">
                                            <option value="">-- Pilih Rating --</option>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('rating') == $i ? 'selected' : '' }}>
                                                    {{ $i }} Star
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Testimonial Message
                                        </label>
                                        <textarea name="message" rows="8" class="form-control">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Photo Customer
                                        </label>
                                        <input type="file" name="photo" class="form-control">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan menggunakan foto default.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status" class="form-select">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <x-icon-save />
                                        Save Testimonial
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
