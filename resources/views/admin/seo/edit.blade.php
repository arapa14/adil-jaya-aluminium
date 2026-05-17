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
                <div class="row row-cards">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Edit Konfigurasi Halaman</h3>
                                <div class="ms-auto">
                                    <a href="{{ route('seo.index') }}" class="btn btn-1">
                                        <x-icon-chevron-left /> Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('seo.update', $page->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label required">Nama Halaman</label>
                                        <input type="text" class="form-control" name="page_name" placeholder="Masukkan nama halaman" value="{{ $page->page_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">Slug (Opsional)</label>
                                        <input type="text" class="form-control cursor-not-allowed" name="slug" placeholder="Masukkan slug halaman" value="{{ $page->slug }}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" placeholder="Judul meta" value="{{ $page->meta_title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" rows="3" placeholder="Deskripsi meta">{{ $page->meta_description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords" placeholder="keyword1, keyword2" value="{{ $page->meta_keywords }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Focus Keyword</label>
                                        <input type="text" class="form-control" name="focus_keyword" placeholder="Kata kunci fokus" value="{{ $page->focus_keyword }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Title</label>
                                        <input type="text" class="form-control" name="og_title" placeholder="Judul Open Graph" value="{{ $page->og_title }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Description</label>
                                        <textarea class="form-control" name="og_description" rows="2" placeholder="Deskripsi Open Graph">{{ $page->og_description }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Image (1200 x 630 piksel) maks: 300kb</label>
                                        <input type="file" class="form-control" name="og_image">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Canonical URL</label>
                                        <input type="text" class="form-control" name="canonical_url" placeholder="https://example.com/page" value="{{ $page->canonical_url }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Robots Index</label>
                                        <select class="form-select" name="robots_index">
                                            <option value="1" {{ old('robots_index') == '1' ? 'selected' : '' }}>Index</option>
                                            <option value="0" {{ old('robots_index') == '0' ? 'selected' : '' }}>Noindex</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Robots Follow</label>
                                        <select class="form-select" name="robots_follow">
                                            <option value="1" {{ old('robots_follow') == '1' ? 'selected' : '' }}>Follow</option>
                                            <option value="0" {{ old('robots_follow') == '0' ? 'selected' : '' }}>Nofollow</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Schema Markup (JSON-LD)</label>
                                        <textarea class="form-control" name="schema_markup" rows="4" placeholder='{"@@context":"https://schema.org", ...}'>{{ old('schema_markup') }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>
@endsection
