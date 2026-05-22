@extends('layouts.landingpage')

@section('content')
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
                            Portofolio Kami
                        </li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">
                            Portofolio Kami
                        </h1>

                        <p class="lead mb-0 text-white-75">
                            Temukan berbagai proyek portofolio kami yang menunjukkan kualitas dan inovasi dalam bidang
                            aluminium.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Produk -->
    <div class="container mt-5 font-poppins">

        <div class="row mb-4">
            <div class="col-lg-12">
                <p class="text-blue fw-bold text-uppercase mb-2">
                    Portofolio Kami
                </p>

                <h2 class="fw-bold lh-base">
                    Portofolio
                </h2>
            </div>

            <div class="col-lg-12">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-start">

                    <button class="btn btn-primary rounded-pill category-btn active" data-category="">
                        Semua
                    </button>

                    @foreach ($categories as $category)
                        <button class="btn btn-outline-primary rounded-pill category-btn"
                            data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="row g-4" id="product-wrapper">
            @foreach ($portofolios as $portofolio)
                <div class="col-6 col-lg-3">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative portfolio-card">

                        {{-- Thumbnail --}}
                        <div class="position-relative overflow-hidden">

                            <img src="{{ Storage::url($portofolio->thumbnail) }}" alt="{{ $portofolio->name }}"
                                class="card-img-top object-fit-cover portfolio-image" style="height: 240px;">

                            {{-- Overlay --}}
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25">
                            </div>

                            {{-- Floating Icon --}}
                            <div class="position-absolute top-0 end-0 m-3">
                                <div class="bg-white bg-opacity-25 backdrop-blur rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width:48px; height:48px;">
                                    <i class="ti ti-layout-grid text-white fs-5"></i>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="position-absolute bottom-0 start-0 m-3">
                                <span class="badge rounded-pill text-bg-light px-3 py-2 fw-semibold">
                                    {{ $portofolio->category->name ?? 'Project' }}
                                </span>
                            </div>

                        </div>

                        {{-- Content --}}
                        <div class="card-body d-flex flex-column p-4">

                            <h5 class="fw-bold mb-3 text-dark lh-sm">
                                {{ $portofolio->name }}
                            </h5>

                            <p class="text-secondary small mb-4 lh-lg">
                                {{ Str::limit($portofolio->description, 90) }}
                            </p>

                            {{-- CTA --}}
                            <div class="mt-auto">
                                <a href="{{ route('portfolio.show', $portofolio->slug) }}"
                                    class="btn btn-dark rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 fw-semibold">

                                    View Project

                                    <i class="ti ti-arrow-up-right"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
            @endforeach
        </div>

        <style>
            .portfolio-card {
                transition: all .3s ease;
            }

            .portfolio-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 1rem 3rem rgba(0, 0, 0, .12) !important;
            }

            .portfolio-image {
                transition: transform .5s ease;
            }

            .portfolio-card:hover .portfolio-image {
                transform: scale(1.05);
            }
        </style>
    </div>
    <!-- End Produk -->
@endsection

@push('scripts')
@endpush
