@extends('layouts.landingpage')
@section('content')
    <section class="bg-dark text-white" style="background: url({{ Storage::url($hero_image) }}) center/cover no-repeat;">
        <div class="bg-dark bg-opacity-75">
            <div class="container py-5">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb mb-0 text-white-50">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-white-50">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active text-white" aria-current="page">/</li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">Tentang Kami</h1>
                        <p class="lead mb-0 text-white-75">Berpengalaman, Profesional, dan Terpercaya — Adil Jaya Aluminium
                            menyediakan solusi aluminium dan kaca berkualitas untuk hunian, ruko, kantor, dan proyek
                            komersial di Tangerang & Jabodetabek.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Hero / Breadcrumb -->

    <!-- Start About Content -->
    <section class="container my-5">
        <div class="row g-4 align-items-center">
            <div class="col-12 col-md-7">
                <div class="mb-3 small text-primary fw-semibold">Siapa Kami</div>
                <h2 class="fw-bold mb-3">Berpengalaman, Profesional, dan Terpercaya</h2>
                <p class="text-muted mb-3">Adil Jaya Aluminium berdiri dengan semangat memberikan produk dan layanan
                    aluminium berkualitas tinggi yang mengutamakan ketepatan, kekuatan, dan keindahan. Kami melayani proyek
                    kecil hingga besar dengan dukungan tim profesional dan peralatan modern.</p>

                <div class="row gy-2">
                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <span class="badge bg-primary rounded-pill p-2"><i class="ti ti-check text-white"></i></span>
                            <div>
                                <div class="fw-semibold">Material Berkualitas</div>
                                <div class="small text-muted">Bahan standar pabrik & tahan lama</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <span class="badge bg-primary rounded-pill p-2"><i class="ti ti-check text-white"></i></span>
                            <div>
                                <div class="fw-semibold">Desain Modern</div>
                                <div class="small text-muted">Sesuai tren & kebutuhan bangunan</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <span class="badge bg-primary rounded-pill p-2"><i class="ti ti-check text-white"></i></span>
                            <div>
                                <div class="fw-semibold">Pengerjaan Presisi</div>
                                <div class="small text-muted">Tukang berpengalaman & rapih</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="d-flex align-items-start gap-2">
                            <span class="badge bg-primary rounded-pill p-2"><i class="ti ti-check text-white"></i></span>
                            <div>
                                <div class="fw-semibold">Garansi Pekerjaan</div>
                                <div class="small text-muted">Komitmen mutu & aftersales</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="btn btn-primary px-4 py-2">
                        Konsultasi Gratis
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-5">
                <div class="card rounded-4 shadow-sm overflow-hidden">
                    <img src="{{ Storage::url($hero_image) }}" class="img-fluid w-100" alt="Proyek Adil Jaya Aluminium"
                        style="object-fit:cover; height:100%;">
                </div>
            </div>
        </div>
    </section>
    <!-- End About Content -->

    <!-- Start Stats -->
    <section class="container mb-5">
        <div class="card rounded-4 shadow-sm px-3 py-4">
            <div class="row text-center ">
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="fs-1 fw-bold text-primary">7+</div>
                    <div class="small text-muted">Tahun Pengalaman</div>
                </div>
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="fs-1 fw-bold text-primary">300+</div>
                    <div class="small text-muted">Proyek Selesai</div>
                </div>
                <div class="col-6 col-md-3 mb-3 mb-md-0">
                    <div class="fs-1 fw-bold text-primary">98%</div>
                    <div class="small text-muted">Kepuasan Klien</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="fs-1 fw-bold text-primary">50+</div>
                    <div class="small text-muted">Tim Profesional</div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Stats -->

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
