@extends('layouts.landingpage')

@section('content')
    {{-- HERO --}}
    <section class="bg-dark text-white" style="background: url({{ Storage::url($hero_image) }}) center/cover no-repeat;">
        <div class="bg-dark bg-opacity-75">
            <div class="container py-5">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0 text-white-50">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-decoration-none text-white-50">
                                Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">
                            Galeri
                        </li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-3">
                            Galeri Projek
                        </h1>
                        <p class="lead mb-0 text-white-75">
                            Dokumentasi berbagai hasil pengerjaan aluminium dan kaca
                            dari Adil Jaya Aluminium untuk hunian, kantor,
                            ruko, hingga proyek komersial.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="container my-5">
        <div class="row align-items-end mb-4 g-3">
            <div class="col-lg-7">
                <p class="text-primary fw-semibold text-uppercase small mb-2">
                    Gallery Kami
                </p>
                <h2 class="fw-bold mb-3">
                    Hasil Pengerjaan & Dokumentasi Projek
                </h2>
                <p class="text-secondary mb-0">
                    Menampilkan berbagai projek aluminium dan kaca dengan kualitas
                    pengerjaan profesional dan desain modern.
                </p>
            </div>
        </div>

        {{-- GRID --}}
        <div class="row g-3">
            @foreach ($galleries as $gallery)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="gallery-card rounded-4 overflow-hidden shadow-sm position-relative bg-body-tertiary">
                        <div class="gallery-image-wrapper">
                            <img src="{{ Storage::url($gallery->image) }}" alt="Gallery Adil Jaya Aluminium"
                                class="img-fluid gallery-image">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <x-cta-component />
@endsection

@push('styles')
    <style>
        .gallery-card {
            cursor: zoom-in;
            transition: all .3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, .12) !important;
        }

        .gallery-image-wrapper {
            background: #f8f9fa;
            min-height: 220px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform .5s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.03);
        }

        .medium-zoom-overlay {
            z-index: 9998;
            backdrop-filter: blur(6px);
            background: rgba(0, 0, 0, .88) !important;
        }

        .medium-zoom-image--opened {
            z-index: 9999 !important;

            border-radius: 1rem;

            width: auto !important;
            height: auto !important;

            max-width: calc(100vw - 160px) !important;
            max-height: calc(100vh - 160px) !important;

            object-fit: contain !important;

            box-shadow: 0 1.5rem 4rem rgba(0, 0, 0, .35);
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.1.0/dist/medium-zoom.min.js"></script>

    <script>
        mediumZoom('.gallery-image', {
            margin: 150,
            background: 'rgba(0,0,0,.88)',
            scrollOffset: 0
        });
    </script>
@endpush
