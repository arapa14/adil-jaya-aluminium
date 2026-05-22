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
                            Produk Kami
                        </li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <h1 class="display-6 fw-bold mb-2">
                            Produk Kami
                        </h1>

                        <p class="lead mb-0 text-white-75">
                            Temukan berbagai produk aluminium dan kaca berkualitas tinggi
                            yang kami tawarkan untuk memenuhi kebutuhan hunian,
                            ruko, kantor, dan proyek komersial Anda.
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
                    Produk Kami
                </p>

                <h2 class="fw-bold lh-base">
                    Produk Aluminium Berkualitas
                </h2>
            </div>

            <div class="col-lg-12">
                <div class="d-flex flex-wrap gap-2 justify-content-lg-start">

                    <button class="btn btn-primary rounded-pill category-btn active" data-category="">
                        Semua
                    </button>

                    @foreach ($categories as $category)
                        <button class="btn btn-outline-primary rounded-pill category-btn" data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="row g-4" id="product-wrapper">

            @foreach ($data as $product)
                <div class="col-6 col-md-3">
                    <div class="card rounded-4 shadow-sm overflow-hidden border-0 h-100">

                        <div class="ratio ratio-16x9">
                            <img src="{{ Storage::url($product->thumbnail) }}" class="card-img-top object-fit-cover"
                                alt="{{ $product->name }}">
                        </div>

                        <div class="card-body pt-5 text-center bg-white position-relative">

                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto position-absolute top-0 start-50 translate-middle"
                                style="width:56px; height:56px;">
                                <i class="ti ti-window" style="font-size:1.25rem;"></i>
                            </div>

                            <span class="badge bg-light text-dark mb-2">
                                {{ $product->category->name ?? '-' }}
                            </span>

                            <h5 class="card-title fw-bold mb-2">
                                {{ $product->name }}
                            </h5>

                            <p class="card-text text-secondary small mb-0">
                                {{ Str::limit($product->description, 80) }}
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
    <!-- End Produk -->
@endsection

@push('scripts')
    <script>
        const buttons = document.querySelectorAll('.category-btn');
        const wrapper = document.getElementById('product-wrapper');

        buttons.forEach(button => {

            button.addEventListener('click', async function() {

                // Active Button
                buttons.forEach(btn => {
                    btn.classList.remove('btn-primary', 'active');
                    btn.classList.add('btn-outline-primary');
                });

                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-primary', 'active');

                const category = this.dataset.category;

                try {

                    let url = `/api/products`;

                    if (category) {
                        url += `?category=${category}`;
                    }

                    const response = await fetch(url);
                    const products = await response.json();

                    wrapper.innerHTML = '';

                    if (products.length === 0) {
                        wrapper.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-light border text-center rounded-4 py-4">
                                Tidak ada produk tersedia
                            </div>
                        </div>
                    `;
                        return;
                    }

                    products.forEach(product => {

                        wrapper.innerHTML += `
                        <div class="col-6 col-md-3">
                            <div class="card rounded-4 shadow-sm overflow-hidden border-0 h-100">

                                <div class="ratio ratio-16x9">
                                    <img src="/storage/${product.thumbnail}"
                                        class="card-img-top object-fit-cover"
                                        alt="${product.name}">
                                </div>

                                <div class="card-body pt-5 text-center bg-white position-relative">

                                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto position-absolute top-0 start-50 translate-middle"
                                        style="width:56px; height:56px;">
                                        <i class="ti ti-window" style="font-size:1.25rem;"></i>
                                    </div>

                                    <span class="badge bg-light text-dark mb-2">
                                        ${product.category?.name ?? '-'}
                                    </span>

                                    <h5 class="card-title fw-bold mb-2">
                                        ${product.name}
                                    </h5>

                                    <p class="card-text text-secondary small mb-0">
                                        ${product.description ?? ''}
                                    </p>

                                </div>
                            </div>
                        </div>
                    `;
                    });

                } catch (error) {
                    console.error(error);
                }

            });

        });
    </script>
@endpush
