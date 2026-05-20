@extends('layouts.dashboard')
@section('title', 'Edit Service')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Layanan
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <x-icon-back />
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('services.update', $service->id) }}" method="POST"
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
                                            Service Title
                                        </label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $service->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Slug (Opsional)
                                        </label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $service->slug) }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan dibuat otomatis dari title.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Description
                                        </label>
                                        <textarea name="description" rows="10" class="form-control">{{ old('description', $service->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- SEO --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        SEO Settings
                                    </h3>
                                </div>

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Title
                                        </label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title', $service->meta_title) }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari title.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description', $service->meta_description) }}</textarea>
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari description.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Keywords
                                        </label>
                                        <textarea name="meta_keywords" rows="3" class="form-control">{{ old('meta_keywords', $service->meta_keywords) }}</textarea>
                                        <small class="form-hint">
                                            Pisahkan keyword menggunakan koma.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Focus Keyword
                                        </label>
                                        <input type="text" name="focus_keyword" class="form-control"
                                            value="{{ old('focus_keyword', $service->focus_keyword) }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari title.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{-- Thumbnail Preview --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Thumbnail Saat Ini
                                        </label>
                                        <img src="{{ asset('storage/' . $service->thumbnail) }}"
                                            class="img-fluid rounded border">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Thumbnail Baru
                                        </label>
                                        <input type="file" name="thumbnail" class="form-control">
                                        <small class="form-hint">
                                            Kosongkan jika tidak ingin mengganti thumbnail.
                                        </small>
                                    </div>

                                    {{-- OG Image Preview --}}
                                    @if ($service->og_image)
                                        <div class="mb-3">
                                            <label class="form-label">
                                                OG Image Saat Ini
                                            </label>
                                            <img src="{{ asset('storage/' . $service->og_image) }}"
                                                class="img-fluid rounded border">
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">
                                            OG Image Baru
                                        </label>
                                        <input type="file" name="og_image" class="form-control">
                                        <small class="form-hint">
                                            Kosongkan jika tidak ingin mengganti OG image.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status" class="form-select">
                                            <option value="1"
                                                {{ old('status', $service->status) == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $service->status) == '0' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <x-icon-save />
                                        Update Service
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