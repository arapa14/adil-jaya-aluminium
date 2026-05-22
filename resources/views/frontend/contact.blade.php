@extends('layouts.landingpage')

@section('content')
    {{-- HERO --}}
    <section class="position-relative overflow-hidden bg-dark text-white"
        style="background:url('{{ Storage::url($hero_image) }}') center/cover no-repeat; min-height: 60vh;">

        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>

        <div class="container position-relative z-1 py-5 d-flex align-items-center" style="min-height: 60vh;">

            <div class="row">

                <div class="col-lg-7">

                    {{-- Breadcrumb --}}
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb mb-0">

                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-decoration-none text-white-50">
                                    Beranda
                                </a>
                            </li>

                            <li class="breadcrumb-item active text-white" aria-current="page">
                                Contact
                            </li>

                        </ol>
                    </nav>

                    <span class="badge rounded-pill bg-light text-dark px-3 py-2 mb-4 fw-semibold">
                        CONTACT US
                    </span>

                    <h1 class="display-4 fw-bold lh-sm mb-4">
                        Konsultasikan
                        Kebutuhan Project Anda
                    </h1>

                    <p class="lead text-white-50 mb-0">
                        Kami siap membantu kebutuhan aluminium dan konstruksi modern
                        dengan layanan profesional, pengerjaan berkualitas,
                        dan konsultasi cepat melalui WhatsApp.
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- CONTACT SECTION --}}
    <section class="py-5 py-lg-6">

        <div class="container">

            <div class="row g-4 g-lg-5">

                {{-- LEFT --}}
                <div class="col-lg-4">

                    <div class="sticky-top" style="top:120px;">

                        <p class="text-primary fw-semibold text-uppercase mb-2">
                            Informasi Kontak
                        </p>

                        <h2 class="fw-bold mb-4">
                            Hubungi Tim Kami
                        </h2>

                        <p class="text-secondary lh-lg mb-5">
                            Silakan hubungi kami untuk konsultasi,
                            penawaran harga, maupun informasi layanan lainnya.
                        </p>

                        {{-- Contact Cards --}}
                        <div class="d-flex flex-column gap-3">

                            {{-- Address --}}
                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body p-4">

                                    <div class="d-flex gap-3">

                                        <div class="flex-shrink-0">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:56px;height:56px;">

                                                <i class="ti ti-map-pin fs-4"></i>

                                            </div>
                                        </div>

                                        <div>

                                            <p class="small text-uppercase text-secondary fw-semibold mb-1">
                                                Office
                                            </p>

                                            <h6 class="fw-bold mb-2">
                                                Alamat Kantor
                                            </h6>

                                            <p class="text-secondary mb-0 small lh-lg">
                                                Jl. Contoh Alamat No.123,
                                                Jakarta, Indonesia
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- Whatsapp --}}
                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body p-4">

                                    <div class="d-flex gap-3">

                                        <div class="flex-shrink-0">
                                            <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:56px;height:56px;">

                                                <i class="ti ti-brand-whatsapp fs-4"></i>

                                            </div>
                                        </div>

                                        <div>

                                            <p class="small text-uppercase text-secondary fw-semibold mb-1">
                                                WhatsApp
                                            </p>

                                            <h6 class="fw-bold mb-2">
                                                Customer Support
                                            </h6>

                                            <a href="https://wa.me/6281234567890" target="_blank"
                                                class="text-decoration-none text-dark fw-semibold">

                                                +62 812 3456 7890

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- Email --}}
                            <div class="card border-0 shadow-sm rounded-4">

                                <div class="card-body p-4">

                                    <div class="d-flex gap-3">

                                        <div class="flex-shrink-0">
                                            <div class="bg-danger bg-opacity-10 text-danger rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:56px;height:56px;">

                                                <i class="ti ti-mail fs-4"></i>

                                            </div>
                                        </div>

                                        <div>

                                            <p class="small text-uppercase text-secondary fw-semibold mb-1">
                                                Email
                                            </p>

                                            <h6 class="fw-bold mb-2">
                                                Business Inquiry
                                            </h6>

                                            <a href="mailto:info@company.com"
                                                class="text-decoration-none text-dark fw-semibold">

                                                info@company.com

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm rounded-5 overflow-hidden">

                        <div class="row g-0">

                            {{-- IMAGE --}}
                            <div class="col-lg-5 d-none d-lg-block">

                                <div class="h-100 position-relative"
                                    style="background:url('{{ asset('assets/images/contact.jpg') }}') center/cover no-repeat; min-height: 100%;">

                                    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50">
                                    </div>

                                    <div
                                        class="position-relative z-1 text-white p-5 d-flex flex-column justify-content-end h-100">

                                        <span class="badge bg-success rounded-pill px-3 py-2 mb-3 w-auto">
                                            Available 24/7
                                        </span>

                                        <h3 class="fw-bold mb-3">
                                            Fast Response &
                                            Professional Consultation
                                        </h3>

                                        <p class="text-white-50 mb-0">
                                            Tim kami siap membantu Anda
                                            dengan solusi terbaik untuk setiap project.
                                        </p>

                                    </div>

                                </div>

                            </div>

                            {{-- CONTENT --}}
                            <div class="col-lg-7">

                                <div class="p-4 p-lg-5">

                                    <p class="text-primary fw-semibold text-uppercase mb-2">
                                        Quick Consultation
                                    </p>

                                    <h2 class="fw-bold mb-4">
                                        Hubungi via WhatsApp
                                    </h2>

                                    <p class="text-secondary lh-lg mb-5">
                                        Klik tombol di bawah untuk langsung terhubung
                                        dengan tim kami melalui WhatsApp.
                                        Kami akan membantu konsultasi kebutuhan project Anda.
                                    </p>

                                    {{-- Features --}}
                                    <div class="row g-3 mb-5">

                                        <div class="col-md-6">

                                            <div class="border rounded-4 p-3 h-100">

                                                <div class="d-flex align-items-center gap-2 mb-2">

                                                    <i class="ti ti-check text-success"></i>

                                                    <span class="fw-semibold">
                                                        Fast Response
                                                    </span>

                                                </div>

                                                <small class="text-secondary">
                                                    Respon cepat dan profesional.
                                                </small>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-4 p-3 h-100">

                                                <div class="d-flex align-items-center gap-2 mb-2">

                                                    <i class="ti ti-check text-success"></i>

                                                    <span class="fw-semibold">
                                                        Free Consultation
                                                    </span>

                                                </div>

                                                <small class="text-secondary">
                                                    Konsultasi tanpa biaya tambahan.
                                                </small>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-4 p-3 h-100">

                                                <div class="d-flex align-items-center gap-2 mb-2">

                                                    <i class="ti ti-check text-success"></i>

                                                    <span class="fw-semibold">
                                                        Professional Team
                                                    </span>

                                                </div>

                                                <small class="text-secondary">
                                                    Dikerjakan oleh tim berpengalaman.
                                                </small>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-4 p-3 h-100">

                                                <div class="d-flex align-items-center gap-2 mb-2">

                                                    <i class="ti ti-check text-success"></i>

                                                    <span class="fw-semibold">
                                                        Best Quality
                                                    </span>

                                                </div>

                                                <small class="text-secondary">
                                                    Material dan hasil berkualitas tinggi.
                                                </small>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- CTA --}}
                                    <a href="https://wa.me/6281234567890?text=Halo%20saya%20ingin%20konsultasi%20project"
                                        target="_blank"
                                        class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-semibold d-inline-flex align-items-center gap-2">

                                        <i class="ti ti-brand-whatsapp fs-4"></i>

                                        Chat WhatsApp

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- MAP --}}
    <section class="pb-5">

        <div class="container">

            <div class="card border-0 shadow-sm rounded-5 overflow-hidden">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18..." width="100%" height="500"
                    style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>

            </div>

        </div>

    </section>
@endsection
