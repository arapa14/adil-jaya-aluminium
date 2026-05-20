@extends('layouts.dashboard')
@section('title', 'Edit Testimonial')

@section('content')
    <div class="page-wrapper">

        {{-- PAGE HEADER --}}
        <div class="page-header d-print-none">
            <div class="container-xl">

                <div class="row g-2 align-items-center">

                    <div class="col">
                        <h2 class="page-title">
                            Edit Testimonial
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

        {{-- PAGE BODY --}}
        <div class="page-body">
            <div class="container-xl">

                <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

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
                                            value="{{ old('customer_name', $testimonial->customer_name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Jenis Project
                                        </label>

                                        <input type="text" name="project_type" class="form-control"
                                            value="{{ old('project_type', $testimonial->project_type) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Rating
                                        </label>

                                        <select name="rating" class="form-select">

                                            @for ($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}"
                                                    {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                                    {{ $i }} Star
                                                </option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Testimonial Message
                                        </label>

                                        <textarea name="message" rows="8" class="form-control">{{ old('message', $testimonial->message) }}</textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">

                            <div class="card">

                                <div class="card-body">

                                    {{-- CURRENT PHOTO --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Current Photo
                                        </label>

                                        <div>
                                            <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                                class="img-fluid rounded border"
                                                style="max-height: 250px; object-fit: cover;">
                                        </div>
                                    </div>

                                    {{-- NEW PHOTO --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Ganti Photo
                                        </label>

                                        <input type="file" name="photo" class="form-control">

                                        <small class="form-hint">
                                            Kosongkan jika tidak ingin mengganti photo.
                                        </small>
                                    </div>

                                    {{-- STATUS --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>

                                        <select name="status" class="form-select">

                                            <option value="1"
                                                {{ old('status', $testimonial->status) == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="0"
                                                {{ old('status', $testimonial->status) == '0' ? 'selected' : '' }}>
                                                Inactive
                                            </option>

                                        </select>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <x-icon-save />
                                        Update Testimonial
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
