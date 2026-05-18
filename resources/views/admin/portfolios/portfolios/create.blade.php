@extends('layouts.dashboard')
@section('title', 'Create Portfolio')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Tambah Portofolio
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('portfolios.portfolios.index') }}" class="btn btn-primary">
                            <x-icon-back />
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('portfolios.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Portfolio Title
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
                                        <small class="form-hint">Jika dikosongkan, akan dibuat otomatis dari nama.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Category
                                        </label>
                                        <select name="category_id" class="form-select">
                                            <option value="">
                                                Select Category
                                            </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Location
                                        </label>
                                        <input type="text" name="location" class="form-control"
                                            value="{{ old('location') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Description
                                        </label>
                                        <textarea name="description" rows="8" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>


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
                                        <input type="text" name="meta_title" class="form-control">
                                        <small class="form-hint">Jika dikosongkan, akan diambil dari nama.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Description
                                        </label>
                                        <textarea name="meta_description" rows="4" class="form-control"></textarea>
                                        <small class="form-hint">Jika dikosongkan, akan diambil dari deskripsi..</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Keywords
                                        </label>
                                        <textarea name="meta_keywords" rows="3" class="form-control"></textarea>
                                        <small class="form-hint">Jika dikosongkan, akan diambil dari nama.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Focus Keyword
                                        </label>
                                        <input type="text" name="focus_keyword" class="form-control">
                                        <small class="form-hint">Jika dikosongkan, akan diambil dari nama.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <small class="form-hint">Jika dikosongkan, akan digunakan thumbnail.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Alt Image
                                        </label>
                                        <input type="file" name="alt_image" class="form-control"
                                            value="{{ old('alt_image') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Gallery Images
                                        </label>
                                        <input type="file" name="images[]" multiple class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status" class="form-select">
                                            <option value="1">
                                                Active
                                            </option>
                                            <option value="0">
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <x-icon-save />
                                        Save Product
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
