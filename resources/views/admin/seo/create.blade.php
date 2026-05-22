@extends('layouts.dashboard')
@section('title', 'SEO Pages')
@section('content')
    <div class="page-wrapper">

        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            SEO Pages
                        </div>
                        <h2 class="page-title">
                            Search Engine Optimization
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('seo.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row g-4">

                        {{-- LEFT --}}
                        <div class="col-lg-8">

                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title fw-bold">
                                        Tambah Konfigurasi SEO
                                    </h3>
                                </div>

                                <div class="card-body">

                                    {{-- Page Name --}}
                                    <div class="mb-4">

                                        <label class="form-label required">
                                            Nama Halaman
                                        </label>

                                        <input type="text" name="page_name" id="page_name"
                                            class="form-control @error('page_name') is-invalid @enderror"
                                            value="{{ old('page_name') }}" placeholder="Contoh: Halaman Tentang Kami">

                                        @error('page_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- Slug --}}
                                    <div class="mb-4">

                                        <label class="form-label required">
                                            Slug
                                        </label>

                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}" placeholder="slug-halaman">

                                        <small class="form-hint">
                                            Kosongkan untuk generate otomatis.
                                        </small>

                                    </div>

                                    {{-- Meta Title --}}
                                    <div class="mb-4">

                                        <div class="d-flex justify-content-between mb-1">

                                            <label class="form-label mb-0 required">
                                                Meta Title
                                            </label>

                                            <small class="text-muted">
                                                <span id="metaTitleCount">0</span>/60
                                            </small>

                                        </div>

                                        <input type="text" name="meta_title" id="meta_title"
                                            class="form-control @error('meta_title') is-invalid @enderror"
                                            value="{{ old('meta_title') }}" placeholder="Judul SEO halaman">

                                        @error('meta_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- Meta Description --}}
                                    <div class="mb-4">

                                        <div class="d-flex justify-content-between mb-1">

                                            <label class="form-label mb-0 required">
                                                Meta Description
                                            </label>

                                            <small class="text-muted">
                                                <span id="metaDescriptionCount">0</span>/160
                                            </small>

                                        </div>

                                        <textarea name="meta_description" id="meta_description" rows="4"
                                            class="form-control @error('meta_description') is-invalid @enderror" placeholder="Deskripsi SEO halaman">{{ old('meta_description') }}</textarea>

                                        @error('meta_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Keywords --}}
                                    <div class="mb-4">

                                        <label class="form-label required">
                                            Meta Keywords
                                        </label>

                                        <input type="text" name="meta_keywords"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2">

                                        @error('meta_keywords')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- Focus Keyword --}}
                                    <div class="mb-4">

                                        <label class="form-label required">
                                            Focus Keyword
                                        </label>

                                        <input type="text" name="focus_keyword"
                                            class="form-control @error('focus_keyword') is-invalid @enderror"
                                            value="{{ old('focus_keyword') }}" placeholder="Kata kunci utama">

                                        @error('focus_keyword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- Schema --}}
                                    <div>

                                        <label class="form-label">
                                            Schema Markup (JSON-LD)
                                        </label>

                                        <textarea name="schema_markup" rows="8" class="form-control font-monospace"
                                            placeholder='{"@@context":"https://schema.org"}'>{{ old('schema_markup') }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- RIGHT --}}
                        <div class="col-lg-4">

                            {{-- Publish --}}
                            <div class="card mb-4">

                                <div class="card-header">
                                    <h3 class="card-title fw-bold">
                                        Publish
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <button type="submit" class="btn btn-primary w-100">

                                        Simpan SEO

                                    </button>

                                </div>

                            </div>

                            {{-- OG CONFIG --}}
                            <div class="card mb-4">

                                <div class="card-header">
                                    <h3 class="card-title fw-bold">
                                        Open Graph
                                    </h3>
                                </div>

                                <div class="card-body">

                                    {{-- OG Title --}}
                                    <div class="mb-3">

                                        <label class="form-label required">
                                            OG Title
                                        </label>

                                        <input type="text" name="og_title"
                                            class="form-control @error('og_title') is-invalid @enderror"
                                            value="{{ old('og_title') }}">

                                        @error('og_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- OG Desc --}}
                                    <div class="mb-3">

                                        <label class="form-label required">
                                            OG Description
                                        </label>

                                        <textarea name="og_description" rows="3" class="form-control @error('og_description') is-invalid @enderror">{{ old('og_description') }}</textarea>

                                        @error('og_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                    {{-- OG Image --}}
                                    <div>

                                        <label class="form-label required">
                                            OG Image
                                        </label>

                                        <input type="file" name="og_image"
                                            class="form-control @error('og_image') is-invalid @enderror"
                                            id="ogImageInput">

                                        <small class="form-hint">
                                            1200x630px • Max 300KB
                                        </small>

                                        <img id="ogPreview" class="img-fluid rounded mt-3 d-none">

                                    </div>

                                </div>

                            </div>

                            {{-- ROBOTS --}}
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title fw-bold">
                                        Robots Settings
                                    </h3>
                                </div>

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label required">
                                            Robots Index
                                        </label>

                                        <select name="robots_index"
                                            class="form-select @error('robots_index') is-invalid @enderror">

                                            <option value="1">
                                                Index
                                            </option>

                                            <option value="0">
                                                No Index
                                            </option>

                                        </select>

                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label required">
                                            Robots Follow
                                        </label>

                                        <select name="robots_follow"
                                            class="form-select @error('robots_follow') is-invalid @enderror">

                                            <option value="1">
                                                Follow
                                            </option>

                                            <option value="0">
                                                No Follow
                                            </option>

                                        </select>

                                    </div>

                                    <div>

                                        <label class="form-label required">
                                            Canonical URL
                                        </label>

                                        <input type="url" name="canonical_url"
                                            class="form-control @error('canonical_url') is-invalid @enderror"
                                            placeholder="https://domain.com/page">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>
@endsection

@push('scripts')
    <script>
        /*
                |--------------------------------------------------------------------------
                | Meta Counter
                |--------------------------------------------------------------------------
                */
        const metaTitle = document.getElementById('meta_title');
        const metaDescription = document.getElementById('meta_description');

        metaTitle.addEventListener('input', () => {
            document.getElementById('metaTitleCount').innerText =
                metaTitle.value.length;
        });

        metaDescription.addEventListener('input', () => {
            document.getElementById('metaDescriptionCount').innerText =
                metaDescription.value.length;
        });

        /*
        |--------------------------------------------------------------------------
        | OG Preview
        |--------------------------------------------------------------------------
        */
        document.getElementById('ogImageInput')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(event) {

                    const preview = document.getElementById('ogPreview');

                    preview.src = event.target.result;
                    preview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            });
    </script>
@endpush
