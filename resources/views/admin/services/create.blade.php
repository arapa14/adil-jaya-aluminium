@extends('layouts.dashboard')
@section('title', 'Create Service')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Tambah Layanan
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
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                            value="{{ old('title') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Slug (Opsional)
                                        </label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug') }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan dibuat otomatis dari title.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Description
                                        </label>
                                        <textarea name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
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
                                            value="{{ old('meta_title') }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari title.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description') }}</textarea>
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari description.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Keywords
                                        </label>
                                        <textarea name="meta_keywords" rows="3" class="form-control">{{ old('meta_keywords') }}</textarea>
                                        <small class="form-hint">
                                            Pisahkan keyword menggunakan koma.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Focus Keyword
                                        </label>
                                        <input type="text" name="focus_keyword" class="form-control"
                                            value="{{ old('focus_keyword') }}">
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
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Thumbnail
                                        </label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            OG Image
                                        </label>
                                        <input type="file" name="og_image" class="form-control">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan menggunakan thumbnail.
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
                                        Save Service
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
