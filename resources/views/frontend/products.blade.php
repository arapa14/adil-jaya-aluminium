@extends('layouts.landingpage')
@section('content')
<!-- Hero / Breadcrumb -->
    <div class="p-5 py-5 text-white font-poppins" id="hero">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.html" class="text-decoration-none text-white-50">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Produk</li>
                </ol>
            </nav>
            <div class="col-md-7">
                <h1 class="display-6 fw-bold mb-2">Produk Kami</h1>
                <p class="lead mb-0" style="color:rgba(255,255,255,.8);">Temukan berbagai solusi aluminium dan kaca berkualitas tinggi untuk hunian, ruko, kantor, dan proyek komersial di Tangerang &amp; Jabodetabek.</p>
            </div>
        </div>
    </div>

    <!-- Filter & Product Grid -->
    <section class="container my-5 font-poppins">

        <!-- Filter -->
        <div class="mb-4">
            <p class="text-blue fw-bold text-uppercase mb-3">Filter Kategori</p>
            <div class="d-flex flex-wrap gap-2" id="filterTabs">
                <span class="filter-tab active" data-cat="semua">Semua</span>
                <span class="filter-tab" data-cat="kusen">Kusen Aluminium</span>
                <span class="filter-tab" data-cat="pintu">Pintu</span>
                <span class="filter-tab" data-cat="jendela">Jendela</span>
                <span class="filter-tab" data-cat="kaca">Kaca</span>
                <span class="filter-tab" data-cat="acp">ACP &amp; Fasad</span>
                <span class="filter-tab" data-cat="canopy">Canopy</span>
                <span class="filter-tab" data-cat="railing">Railing</span>
                <span class="filter-tab" data-cat="lainnya">Lainnya</span>
            </div>
        </div>

        <!-- Grid -->
        <div class="row g-4" id="productGrid">

            <!-- Kusen Aluminium -->
            <div class="col-6 col-md-3 product-item" data-cat="kusen">
                <div class="card product-card h-100 border-0 position-relative">
                    <span class="badge bg-warning text-dark badge-product">Terlaris</span>
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Kusen Aluminium">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-layout-sidebar"></i></div>
                        <h5 class="card-title fw-bold mb-1">Kusen Aluminium</h5>
                        <p class="card-text text-secondary small">Kusen presisi berbagai profil, tahan karat, ringan, dan cocok untuk semua jenis bangunan.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Kusen Aluminium" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Pintu Aluminium -->
            <div class="col-6 col-md-3 product-item" data-cat="pintu">
                <div class="card product-card h-100 border-0 position-relative">
                    <span class="badge bg-primary badge-product">Populer</span>
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Pintu Aluminium">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-door"></i></div>
                        <h5 class="card-title fw-bold mb-1">Pintu Aluminium</h5>
                        <p class="card-text text-secondary small">Model swing, sliding, dan folding dengan finishing powder coating aneka warna pilihan.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Pintu Aluminium" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Jendela Sliding -->
            <div class="col-6 col-md-3 product-item" data-cat="jendela">
                <div class="card product-card h-100 border-0">
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Jendela Sliding">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-window"></i></div>
                        <h5 class="card-title fw-bold mb-1">Jendela Sliding</h5>
                        <p class="card-text text-secondary small">Jendela geser sistem rel presisi, hemat ruang, dan memaksimalkan sirkulasi udara alami.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Jendela Sliding" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Partisi Kaca -->
            <div class="col-6 col-md-3 product-item" data-cat="kaca">
                <div class="card product-card h-100 border-0">
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Partisi Kaca">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-layout-columns"></i></div>
                        <h5 class="card-title fw-bold mb-1">Partisi Kaca</h5>
                        <p class="card-text text-secondary small">Partisi kaca frameless maupun berframing untuk kantor dan ruang komersial yang modern.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Partisi Kaca" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- ACP Exterior -->
            <div class="col-6 col-md-3 product-item" data-cat="acp">
                <div class="card product-card h-100 border-0 position-relative">
                    <span class="badge bg-danger badge-product">Premium</span>
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="ACP Exterior">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-building-skyscraper"></i></div>
                        <h5 class="card-title fw-bold mb-1">ACP Exterior</h5>
                        <p class="card-text text-secondary small">Aluminium Composite Panel untuk fasad bangunan, ringan, tahan cuaca, dan tampil modern.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang ACP Exterior" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Canopy -->
            <div class="col-6 col-md-3 product-item" data-cat="canopy">
                <div class="card product-card h-100 border-0">
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Canopy">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-home-2"></i></div>
                        <h5 class="card-title fw-bold mb-1">Canopy</h5>
                        <p class="card-text text-secondary small">Kanopi aluminium untuk carport, teras, dan pintu masuk dengan atap polycarbonate atau kaca.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Canopy" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Railing Tangga -->
            <div class="col-6 col-md-3 product-item" data-cat="railing">
                <div class="card product-card h-100 border-0">
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Railing Tangga">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-stairs"></i></div>
                        <h5 class="card-title fw-bold mb-1">Railing Tangga</h5>
                        <p class="card-text text-secondary small">Railing aluminium &amp; kaca untuk tangga, balkon, dan rooftop. Aman, estetis, mudah dirawat.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Railing Tangga" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

            <!-- Shower Box -->
            <div class="col-6 col-md-3 product-item" data-cat="lainnya">
                <div class="card product-card h-100 border-0">
                    <img src="assets/img/hero-section.jpeg" class="card-img-top" alt="Shower Box">
                    <div class="card-body position-relative">
                        <div class="product-icon"><i class="ti ti-droplet"></i></div>
                        <h5 class="card-title fw-bold mb-1">Shower Box</h5>
                        <p class="card-text text-secondary small">Shower box kaca tempered frameless, mewah, tahan air, mudah dibersihkan, dan anti jamur.</p>
                    </div>
                    <div class="card-footer border-0">
                        <a href="#" class="btn-lihat">Lihat Detail <i class="ti ti-arrow-right"></i></a>
                        <a href="https://wa.me/6282169049991?text=Halo, saya ingin tanya tentang Shower Box" target="_blank" class="btn-wa-sm"><i class="ti ti-brand-whatsapp"></i> Tanya</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Empty state -->
        <div id="emptyState" class="text-center py-5 d-none">
            <i class="ti ti-search-off" style="font-size:48px; color:#cbd5e1;"></i>
            <p class="text-muted mt-2">Tidak ada produk di kategori ini.</p>
        </div>

    </section>
@endsection
