@extends('layouts.landingpage')

@section('content')
    <section class="bg-dark text-white" style="background: url({{ Storage::url($hero_image) }}) center/cover no-repeat;">
        <div class="bg-dark bg-opacity-75">
            <div class="container py-5">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0 text-white-50">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-white-50">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Layanan Kami</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">Layanan Kami</h1>
                        <p class="lead mb-0 text-white-75">
                            Solusi lengkap untuk kebutuhan aluminium dan konstruksi modern Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section class="py-5">
        <div class="container">

            {{-- Heading --}}
            <div class="row justify-content-center text-center mb-5">

                <div class="col-lg-7">

                    <p class="text-primary fw-semibold text-uppercase mb-2">
                        Layanan Kami
                    </p>

                    <h2 class="fw-bold mb-3">
                        Solusi Lengkap Aluminium & Konstruksi Modern
                    </h2>

                    <p class="text-secondary">
                        Kami menghadirkan layanan profesional dengan hasil yang presisi,
                        estetik, dan tahan lama untuk berbagai kebutuhan hunian maupun komersial.
                    </p>

                </div>

            </div>

            {{-- Services List --}}
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden service-card">
                            {{-- Thumbnail --}}
                            <div class="position-relative overflow-hidden">
                                <img src="{{ Storage::url($service->thumbnail) }}" alt="{{ $service->name }}"
                                    class="card-img-top object-fit-cover service-image" style="height:240px;">
                            </div>

                            {{-- Content --}}
                            <div class="card-body p-4 d-flex flex-column">

                                {{-- Title --}}
                                <h4 class="fw-bold mb-3">
                                    {{ $service->title }}
                                </h4>

                                {{-- Desc --}}
                                <p class="text-secondary lh-lg mb-4">
                                    {{ Str::limit($service->description, 120) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                {{-- LEFT --}}
                <div class="col-lg-6">
                    <img src="{{ Storage::url($hero_image) }}" class="img-fluid rounded-4 shadow-sm"
                        alt="Why Choose Us">
                </div>

                {{-- RIGHT --}}
                <div class="col-lg-6">
                    <p class="text-primary fw-semibold text-uppercase mb-2">
                        Kenapa Memilih Kami
                    </p>
                    <h2 class="fw-bold mb-4">
                        Kualitas Pengerjaan Profesional & Modern
                    </h2>
                    <p class="text-secondary lh-lg mb-4">
                        Kami mengutamakan kualitas material, ketepatan pengerjaan,
                        dan kepuasan pelanggan untuk setiap project yang kami kerjakan.
                    </p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                <div class="text-primary mb-3">
                                    <i class="ti ti-award fs-1"></i>
                                </div>
                                <h5 class="fw-bold">
                                    Material Berkualitas
                                </h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                <div class="text-primary mb-3">
                                    <i class="ti ti-users fs-1"></i>
                                </div>
                                <h5 class="fw-bold">
                                    Tim Profesional
                                </h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                <div class="text-primary mb-3">
                                    <i class="ti ti-clock-hour-4 fs-1"></i>
                                </div>
                                <h5 class="fw-bold">
                                    Tepat Waktu
                                </h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                <div class="text-primary mb-3">
                                    <i class="ti ti-shield-check fs-1"></i>
                                </div>
                                <h5 class="fw-bold">
                                    Bergaransi
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="container my-5">
        <div class="card rounded-4 shadow-lg overflow-hidden font-poppins" style="background:#0B1F3A;">
            <div class="row g-0 align-items-center">
                <div class="col-12 col-md-7 p-4 p-md-5 text-white text-center text-md-start">
                    <h4 class="fw-bold mb-2 text-uppercase fs-5 fs-md-4">Siap mewujudkan proyek aluminium Anda?</h4>
                    <p class="mb-0 small">Konsultasikan kebutuhan Anda sekarang juga. Gratis survey & penawaran terbaik
                        untuk Anda.</p>
                </div>
                <div
                    class="col-12 col-md-5 p-3 p-md-4 d-flex flex-column flex-md-row gap-2 justify-content-center justify-content-md-end align-items-center">
                    <a href="https://wa.me/6282169049991" target="_blank" rel="noopener"
                        class="btn btn-light d-flex py-2 align-items-center gap-2 px-4 w-100 w-md-auto justify-content-center"
                        aria-label="Hubungi WhatsApp">
                        <i class="ti ti-brand-whatsapp"></i>
                        <span>Hubungi WhatsApp</span>
                    </a>
                    <a href="#"
                        class="btn btn-outline-light d-flex align-items-center gap-2 px-4 w-100 w-md-auto py-2 justify-content-center"
                        aria-label="Request Penawaran">
                        Request Penawaran
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .service-card {
            transition: all .3s ease;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .12) !important;
        }

        .service-image {
            transition: transform .5s ease;
        }

        .service-card:hover .service-image {
            transform: scale(1.05);
        }

        .min-vh-50 {
            min-height: 50vh;
        }
    </style>
@endpush
