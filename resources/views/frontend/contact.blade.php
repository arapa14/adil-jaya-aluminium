@extends('layouts.landingpage')

@section('content')
    <section class="bg-dark text-white" style="background: url({{ Storage::url($hero_image) }}) center/cover no-repeat;">
        <div class="bg-dark bg-opacity-75">
            <div class="container py-5">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0 text-white-50">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-white-50">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Kontak</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">Kontak Kami</h1>
                        <p class="lead mb-0 text-white-75">
                            Silakan hubungi kami untuk konsultasi, penawaran harga, maupun informasi layanan lainnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="py-5 py-lg-6">
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-4">
                    <div>
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
                                            <div class="bg-primary bg-opacity-10 text-white rounded-3 d-flex align-items-center justify-content-center"
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
                                                {{ $address }}
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
                                            <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                                                class="text-decoration-none text-dark fw-semibold">
                                                +{{ $whatsapp }}
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
                                            <a href="mailto:{{ $email }}"
                                                class="text-decoration-none text-dark fw-semibold">
                                                {{ $email }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="container">
                        <div class="card border-0 shadow-sm rounded-5 overflow-hidden">
                            {!! $embed_map !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
