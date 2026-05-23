@extends('layouts.landingpage')

@section('content')

    {{-- HERO --}}
    <section class="bg-dark text-white" style="background: url({{ Storage::url($hero_image) }}) center/cover no-repeat;">
        <div class="bg-dark bg-opacity-75">
            <div class="container py-5">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">
                            {{ $portofolio->title }}
                        </h1>

                        <p class="lead mb-0 text-white-75">
                            {{ $portofolio->meta_description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DETAIL --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                {{-- LEFT CONTENT --}}
                <div class="col-lg-8">
                    {{-- Main Image --}}
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <img src="{{ Storage::url($portofolio->thumbnail) }}" alt="{{ $portofolio->name }}"
                            class="img-fluid w-100 object-fit-cover" style="max-height:550px;">
                    </div>

                    @if ($portofolio->images->count())
                        <div class="card border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-body p-4 p-lg-5">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                                    <div>
                                        <p class="text-primary fw-semibold text-uppercase small mb-2">
                                            Gallery Project
                                        </p>
                                        <h3 class="fw-bold mb-0">
                                            Dokumentasi Pengerjaan
                                        </h3>
                                    </div>
                                    <span class="badge text-bg-primary rounded-pill px-4 py-3 fw-semibold">
                                        {{ $portofolio->images->count() }} Foto
                                    </span>
                                </div>
                                <div class="row g-3">
                                    @foreach ($portofolio->images as $image)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="gallery-card rounded-4 overflow-hidden shadow-sm bg-body-tertiary">
                                                <div class="gallery-image-wrapper">
                                                    <img src="{{ Storage::url($image->image) }}"
                                                        alt="{{ $portofolio->name }}" class="img-fluid gallery-image">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Description --}}
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">

                        <div class="mb-4">
                            <p class="text-primary fw-semibold text-uppercase small mb-2">
                                Detail Project
                            </p>

                            <h2 class="fw-bold">
                                Tentang Project
                            </h2>
                        </div>
                        <div class="text-secondary lh-lg">
                            {!! nl2br(e($portofolio->description)) !!}
                        </div>
                    </div>
                </div>
                {{-- SIDEBAR --}}
                <div class="col-lg-4">
                    {{-- Info Card --}}
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">
                                Informasi Project
                            </h5>
                            <div class="d-flex justify-content-between py-3 border-bottom">
                                <span class="text-secondary">
                                    Kategori
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ $portofolio->category->name ?? '-' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between py-3 border-bottom">
                                <span class="text-secondary">
                                    Dibuat
                                </span>

                                <span class="fw-semibold text-dark">
                                    {{ $portofolio->created_at->format('d M Y') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between py-3">
                                <span class="text-secondary">
                                    Status
                                </span>

                                <span class="badge text-bg-success rounded-pill px-3">
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="card border-0 bg-dark text-white rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-lg-5">
                            <div class="mb-4">
                                <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:64px;height:64px;">
                                    <i class="ti ti-phone-call fs-3"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3">
                                Tertarik Dengan Project Ini?
                            </h4>
                            <p class="text-white-50 mb-4">
                                Hubungi kami untuk konsultasi dan pengerjaan project aluminium terbaik untuk kebutuhan Anda.
                            </p>
                            <a href="https://wa.me/628123456789"
                                class="btn btn-light rounded-pill px-4 py-3 fw-semibold w-100">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- RELATED PROJECT --}}
    @if ($relatedPortfolios->count())
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row mb-4 align-items-end">
                    <div class="col-lg-6">
                        <p class="text-primary fw-semibold text-uppercase small mb-2">
                            Project Lainnya
                        </p>
                        <h2 class="fw-bold mb-0">
                            Portofolio Terkait
                        </h2>
                    </div>
                </div>
                <div class="row g-4">
                    @foreach ($relatedPortfolios as $item)
                        <div class="col-6 col-lg-3">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 portfolio-card">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->name }}"
                                        class="card-img-top object-fit-cover portfolio-image" style="height:220px;">
                                    <div class="position-absolute bottom-0 start-0 m-3">
                                        <span class="badge text-bg-light rounded-pill px-3 py-2">
                                            {{ $item->category->name ?? 'Project' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <h5 class="fw-bold mb-3">
                                        {{ $item->name }}
                                    </h5>
                                    <p class="text-secondary small mb-4">
                                        {{ Str::limit($item->description, 80) }}
                                    </p>
                                    <div class="mt-auto">
                                        <a href="{{ route('portfolio.show', $item->slug) }}"
                                            class="btn btn-dark rounded-pill px-4 py-2">
                                            View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@push('styles')
    <style>
        .gallery-card {
            cursor: zoom-in;
            transition: all .3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .12) !important;
        }

        .gallery-image {
            aspect-ratio: 1 / 1;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.04);
        }

        .medium-zoom-overlay {
            z-index: 9998;
            backdrop-filter: blur(4px);
        }

        .medium-zoom-image--opened {
            z-index: 9999;
            border-radius: 1rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.1.0/dist/medium-zoom.min.js"></script>
    <script>
        mediumZoom('.gallery-image', {
            margin: 40,
            background: 'rgba(0,0,0,0.9)',
            scrollOffset: 0,
        });
    </script>
@endpush
