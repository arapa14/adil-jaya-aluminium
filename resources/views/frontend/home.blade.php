@extends('layouts.landingpage')
@section('content')
    <!-- Start Hero -->
    <div class="p-5 py-5 text-white font-poppins" id="hero"
        style="background-image:url({{ Storage::url($hero_image) }}); background-size:cover; background-position:center; position:relative; overflow:hidden; height:35rem;">
        <div class="container col">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold">SOLUSI ALUMINIUM MODERN UNTUK BANGUNAN ANDA</h1>
                <p class="col-md-8 lh-base py-3">Spesialis kusen aluminium, kaca, ACP, canopy, partisi dan railing
                    berkualitas untuk
                    hunian, kantor, ruko, dan bangunan komersial di area Tangerang & Jabodetabek.</p>
                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="btn btn-primary fw-semibold px-3 py-2 m-2"
                    type="button"><i class="ti ti-brand-whatsapp"></i>
                    KONSULTASI
                    GRATIS</a>
                <a href="{{ route('products') }}" class="btn btn-light fw-semibold px-3 py-2 m-2 text-uppercase"
                    type="button">Lihat Produk <i class="ti ti-arrow-narrow-right"></i></a>
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Section Count (menggantung setelah hero) -->
    <div class="container font-poppins text-primary" style="position:relative; z-index:3;">
        <div class="card shadow mx-auto rounded-4 " style="max-width:1100px; margin-top:-3rem; position:relative;">
            <div class="container py-3">
                <div class="row justify-content-around">
                    <div class="col-md-auto col-12 p-4 d-flex align-items-center text-start">
                        <i class="ti ti-shield" style="font-size:70px; color:#0B1F3A;"></i>
                        <div class="ps-3">
                            <h4 class="fw-bold text-primary mb-1">16+</h2>
                                <p class="small text-uppercase mb-0">Tahun <br> Pengalaman</p>
                        </div>
                    </div>
                    <div class="col-md-auto col-12 p-4 d-flex align-items-center text-start">
                        <i class="ti ti-buildings" style="font-size:70px; color:#0B1F3A;"></i>
                        <div class="ps-3">
                            <h4 class="fw-bold text-primary mb-1">300+</h2>
                                <p class="small text-uppercase mb-0">Proyek <br> Selesai</p>
                        </div>
                    </div>
                    <div class="col-md-auto col-12 p-4 d-flex align-items-center text-start">
                        <i class="ti ti-map-pin-pin" style="font-size:70px; color:#0B1F3A;"></i>
                        <div class="ps-3">
                            <h4 class="fw-bold text-primary mb-1">JABODETABEK</h2>
                                <p class="small text-uppercase mb-0">Layanan Area <br> Jakarta & Sekitarnya</p>
                        </div>
                    </div>
                    <div class="col-md-auto col-12 p-4 d-flex align-items-center text-start">
                        <i class="ti ti-users-group" style="font-size:70px; color:#0B1F3A;"></i>
                        <div class="ps-3">
                            <h4 class="fw-bold text-primary mb-1">TIM</h2>
                                <p class="small text-uppercase mb-0">Profesional & <br> Berpengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Section Count -->

    <!-- Start Tentang Kami -->
    <div class="container mt-5 font-poppins">
        <div class="row">
            <div class="col-md-5 col-12">
                <p class="text-blue fw-bold text-uppercase">
                    Tentang Kami
                </p>
                <h2 class="fw-bold lh-base">
                    Adil Jaya Aluminium Solusi Tepat Untuk Kebutuhan Aluminium & Kaca Anda
                </h2>
                <p>
                    Kami adalah perushaan spesialis di bidang aluminium dan kaca dengan komitmen memberikan produk
                    berkualitas, desain modern, dan pelayanan terbaik untuk setiap proyek.
                    <br>
                    Dengan pengalaman bertahun-tahun, kami siap membantu mewujudkan hunian atau bangunan impian Anda
                    menjadi kenyataan.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary px-3 text-uppercase">Selengkapnya Tentang Kami</a>
            </div>
            <div class="col-md-7 col-12">
                <div class="row g-3 align-items-stretch h-100">
                    <div class="col-12 col-md-8 d-flex">
                        <div class="ratio ratio-1x1 rounded-4 overflow-hidden flex-fill">
                            <img src="{{ Storage::url($hero_image) }}" alt="Large product" class="w-100 h-100"
                                style="object-fit:cover;">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 d-flex flex-column gap-3">
                        <div class="ratio ratio-1x1 rounded-4 overflow-hidden">
                            <img src="{{ Storage::url($hero_image) }}" alt="Product 1" class="w-100 h-100"
                                style="object-fit:cover;">
                        </div>
                        <div class="ratio ratio-1x1 rounded-4 overflow-hidden">
                            <img src="{{ Storage::url($hero_image) }}" alt="Product 2" class="w-100 h-100"
                                style="object-fit:cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Tentang Kami -->

    <!-- Start Produk kami -->
    <div class="container mt-5 font-poppins">
        <div class="row">
            <div class="">
                <p class="text-blue fw-bold text-uppercase">
                    Produk Kami
                </p>
                <h2 class="fw-bold lh-base">
                    Produk Aluminium Berkualitas
                </h2>
            </div>
            <div class="row justify-content-center">
                @forelse ($data as $product)
                    <div class="col-6 col-md-3">
                        <div class="card rounded-4 shadow-sm overflow-hidden">
                            <div class="ratio ratio-16x9">
                                <img src="{{ Storage::url($product->thumbnail) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="card-body pt-5 text-center bg-white">
                                <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto"
                                    style="width:56px; height:56px; margin-top:-28px; margin-bottom:12px; z-index:2;">
                                    <i class="ti ti-window" style="font-size:1.25rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-2">{{ $product->name }}</h5>
                                <p class="card-text text-secondary small mb-0">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada produk yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- End Produk kami -->

    <!-- Start Portfolio -->
    <section class="bg-primary p-4 mt-5">
        <div class="container my-5 font-poppins">
            <div class="row align-items-center mb-4">
                <div class="col-md-3">
                    <p class="text-light fw-semibold text-uppercase mb-1">Portofolio Kami</p>
                    <h2 class="fw-bold text-light pb-3">Proyek Terbaru</h2>
                    <p class="text-light">Berbagai proyek telah kami selesaikan dengan hasil rapi, presisi, dan
                        sesuai
                        kebutuhan klien.</p>
                    <a href="{{ route('portfolio') }}" class="btn btn-outline-light text-uppercase my-4">Lihat Semua
                        Portofolio</a>
                </div>

                <div class="col-md-9">
                    <div class="row g-3">
                        @forelse($portofolios as $portofolio)
                            <div class="col-6 col-md-3">
                                <div class="card border-0 rounded-3 shadow-sm overflow-hidden">
                                    <div class="ratio ratio-1x1 overflow-hidden rounded-top">
                                        <img src="{{ Storage::url($portofolio->thumbnail) }}" alt="Rumah Tinggal Modern"
                                            class="w-100 h-100" style="object-fit:cover;">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="mb-1 fw-bold">{{ $portofolio->title }}</h6>
                                        <small class="text-secondary">{{ $portofolio->location }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">Belum ada portofolio yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio -->

    <!-- Start Komitmen -->
    <section class="bg-light py-5">
        <div class="container font-poppins">
            <div class="text-center mb-4">
                <p class="text-blue fw-semibold text-uppercase mb-1">Kenapa Memilih Kami?</p>
                <h3 class="fw-bold">Komitmen Kami Untuk Kepuasan Anda</h3>
            </div>

            <div class="commitment-features w-100">
                <div class="row g-3 justify-content-center">
                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-box text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Material Berkualitas</h6>
                        <small class="text-muted d-block">Bahan teruji</small>
                    </div>

                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-tools text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Pengerjaan Presisi</h6>
                        <small class="text-muted d-block">Detail rapi</small>
                    </div>

                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-user-check text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Tim Berpengalaman</h6>
                        <small class="text-muted d-block">Profesional</small>
                    </div>

                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-shield-check text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Garansi Pekerjaan</h6>
                        <small class="text-muted d-block">Tenang & aman</small>
                    </div>

                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-cash text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Harga Kompetitif</h6>
                        <small class="text-muted d-block">Nilai terbaik</small>
                    </div>

                    <div class="col-6 col-md-2 text-center feature-item">
                        <div class="mb-3">
                            <i class="ti ti-phone text-primary fs-1"></i>
                        </div>
                        <h6 class="fw-semibold">Survey & Konsultasi</h6>
                        <small class="text-muted d-block">Gratis</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Komitmen -->

    <!-- Start Proses Kerja -->
    <section class="container my-5 font-poppins">
        <div class="text-center mb-4">
            <p class="fw-semibold text-uppercase text-blue mb-1">Cara Kerja Kami</p>
            <h3 class="fw-bold">Proses Mudah & Terstruktur</h3>
        </div>

        <div class="timeline">
            <div class="timeline-row">
                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-phone" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Konsultasi</p>
                        <small class="desc">Diskusi kebutuhan</small>
                    </div>
                </div>

                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-map-pin" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Survey Lokasi</p>
                        <small class="desc">Ukuran & kondisi</small>
                    </div>
                </div>

                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-layout-grid" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Desain & Penawaran</p>
                        <small class="desc">Desain & estimasi</small>
                    </div>
                </div>

                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-box" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Produksi</p>
                        <small class="desc">Pembuatan material</small>
                    </div>
                </div>

                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-car-crane" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Instalasi</p>
                        <small class="desc">Pemasangan oleh tim</small>
                    </div>
                </div>

                <div class="timeline-step flex-fill">
                    <div class="timeline-marker" aria-hidden="true">
                        <i class="ti ti-flag" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <p class="title mb-0">Finishing</p>
                        <small class="desc">Serah terima proyek</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Proses Kerja -->

    <!-- Start Testimoni -->
    <section class="bg-white py-5">
        <div class="container font-poppins">
            <div class="text-center mb-4">
                <p class="text-blue fw-semibold text-uppercase mb-1">Testimoni Klien</p>
                <h3 class="fw-bold">Apa Kata Klien Kami?</h3>
            </div>

            <div class="row g-3">
                @forelse($testimonials as $testimonial)
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ Storage::url($testimonial->photo) }}" alt="Avatar"
                                    class="rounded-circle me-3" style="width:48px;height:48px;object-fit:cover;">
                                <div>
                                    <strong>{{ $testimonial->customer_name }}</strong>
                                    <div class="small text-muted">{{ $testimonial->project_type }}</div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <span class="text-warning">{{ str_repeat('★', $testimonial->rating) }}</span>
                            </div>
                            <p class="text-muted small mb-0">{{ $testimonial->message }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada testimoni dari klien.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- End Testimoni -->

    <x-cta-component />
@endsection
