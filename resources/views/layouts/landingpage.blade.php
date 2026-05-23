<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adil Jaya Aluminium - Solusi Aluminium Terpercaya</title>
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($favicon) }}" />
    <meta name="title" content="{{ $seo->meta_title ?? 'Adil Jaya Aluminium - Solusi Aluminium Terpercaya' }}">
    <meta name="description"
        content="{{ $seo->meta_description ?? 'Solusi aluminium berkualitas untuk hunian, kantor, dan bangunan komersial di area Tangerang & Jabodetabek.' }}">
    <meta name="keywords"
        content="{{ $seo->meta_keywords ?? 'aluminium, kaca, ACP, canopy, partisi, railing, Tangerang, Jabodetabek' }}">
    <meta name="robots" content="{{ $seo->robots_index }},{{ $seo->robots_follow }}">
    <meta property="og:title" content="{{ $seo->og_title ?? 'Adil Jaya Aluminium - Solusi Aluminium Terpercaya' }}">
    <meta property="og:description"
        content="{{ $seo->og_description ?? 'Solusi aluminium berkualitas untuk hunian, kantor, dan bangunan komersial di area Tangerang & Jabodetabek.' }}">
    <meta property="og:image"
        content="{{ Storage::url($seo->og_image) ? Storage::url($seo->og_image) : asset('assets/frontend/images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <link href="{{ asset('assets/frontend/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.35.0/tabler-icons.min.css"
        integrity="sha512-gzw5zNP2TRq+DKyAqZfDclaTG4dOrGJrwob2Fc8xwcJPDPVij0HowLIMZ8c1NefFM0OZZYUUUNoPfcoI5jqudw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
</head>

<body>
    <!-- Start Top Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="p-2"><i class="ti ti-map-pin"></i> {{ $address }}
                </div>
                <div class="p-2"><i class="ti ti-clock"></i> Senin - Sabtu: 08.00 - 17.00</div>
            </div>
        </div>
    </div>
    <!-- End Top Bar -->

    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light font-poppins py-3 sticky-top">
        <div class="container-fluid px-3 px-lg-5 ">
            <a class="navbar-brand" href="#">
                <img src="{{ Storage::url($logo) }}" alt="Logo" class="img-fluid" style="max-height:45px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 px-3 gap-4 text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                            href="{{ route('about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}"
                            href="{{ route('products') }}">Produk Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery*') ? 'active' : '' }}"
                            href="{{ route('gallery') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.landing*') ? 'active' : '' }}"
                            href="{{ route('services.landing') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}"
                            href="{{ route('portfolio') }}">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
                <a class="btn btn-primary px-3 ms-3 text-uppercase" href="https://wa.me/{{ $whatsapp }}" target="_blank"
                    role="button"><i class="ti ti-brand-whatsapp"></i>
                    Konsultasi Gratis</a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    @yield('content')

    <footer class="bg-primary text-light font-poppins pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3">
                    <a href="#" class="d-inline-block mb-4">
                        <img src="{{ Storage::url($logo) }}" alt="Adil Jaya Aluminium"
                            style="max-height: 48px; filter: grayscale(1) brightness(0) invert(1);">
                    </a>
                    <p class="small text-light-50">
                        Spesialis aluminium & kaca untuk hunian, komersial, dan industri. Solusi modern,
                        berkualitas,
                        dan terpercaya.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                            class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width:36px;height:36px;" aria-label="WhatsApp">
                            <i class="ti ti-brand-whatsapp"></i>
                        </a>
                        <a href="{{ $facebook }}" target="_blank"
                            class="btn btn-outline-light btn-sm rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width:36px;height:36px;" aria-label="Facebook">
                            <i class="ti ti-brand-facebook"></i>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-2">
                    <h6 class="fw-semibold text-uppercase">Quick Link</h6>
                    <ul class="list-unstyled small mb-0">
                        <li><a class="text-decoration-none text-white" href="{{ route('home') }}">Beranda</a></li>
                        <li><a class="text-decoration-none text-white" href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a class="text-decoration-none text-white" href="{{ route('products') }}">Produk</a></li>
                        <li><a class="text-decoration-none text-white" href="{{ route('gallery') }}">Galeri</a></li>
                        <li><a class="text-decoration-none text-white" href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2">
                    <h6 class="fw-semibold text-uppercase">Kategori Produk</h6>
                    <ul class="list-unstyled small mb-0">
                        @php
                            $product = \DB::table('product_categories')->limit(5)->get();
                        @endphp
                        @foreach ($product as $p)
                            <li><a class="text-decoration-none text-white"
                                    href="{{ route('products') }}">{{ $p->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-3">
                    <h6 class="fw-semibold text-uppercase">Kontak Kami</h6>
                    <address class="small text-light-50 mb-2">
                        <i class="ti ti-map-pin me-2"></i>{{ $address }}<br>
                    </address>
                    <div class="small text-light-50">
                        <div>
                            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="text-decoration-none text-white">
                                <i class="ti ti-brand-whatsapp me-2"></i>{{ $whatsapp }}
                            </a>
                        </div>
                        <div>
                            <a href="mailto:{{ $email }}" class="text-decoration-none text-white">
                                <i class="ti ti-mail me-2"></i>{{ $email }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <h6 class="fw-semibold text-uppercase">Area Layanan</h6>
                    <ul class="list-unstyled small mb-0 text-light-50">
                        <li>Jakarta</li>
                        <li>Bogor</li>
                        <li>Depok</li>
                        <li>Tangerang</li>
                        <li>Bekasi & Sekitarnya</li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4 pt-3 border-top border-light-10">
                <div class="col-md-6 text-center text-md-start small text-light-50 mb-2 mb-md-0">
                    <a href="#" class="text-decoration-none text-white me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-decoration-none text-white">Syarat & Ketentuan</a>
                </div>
                <div class="col-md-6 text-center text-md-end small text-light-50">
                    © <span id="year"></span> Adil Jaya Aluminium.
                    All
                    Rights
                    Reserved.</div>
            </div>
        </div>

        <script>
            document.getElementById('year')?.replaceWith(document.createTextNode(new Date().getFullYear()));
        </script>
    </footer>

    <!-- CTA Whatsapp -->
    <a href="https://wa.me/{{ $whatsapp }}"
        class="btn-floating d-flex align-items-center justify-content-center text-decoration-none" target="_blank"
        rel="noopener noreferrer" aria-label="Hubungi via WhatsApp" title="Hubungi via WhatsApp">
        <i class="ti ti-brand-whatsapp text-white fs-2"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    @stack('scripts')
</body>
