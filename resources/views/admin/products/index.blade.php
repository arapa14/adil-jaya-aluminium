{{-- TASK: buat form untuk CRUD category dan product --}}

@extends('layouts.dashboard')
@section('title', 'Products Management')
@section('content')
    <div class="page-wrapper">

        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Product Management
                        </div>
                        <h2 class="page-title">
                            Kelola Product & Category
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateProduct">
                            <x-icon-plus />
                            Tambah Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">
                                    Product List
                                </h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Thumbnail</th>
                                            <th>Product</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="rounded"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    <div class="fw-bold">
                                                        {{ $product->name }}
                                                    </div>
                                                    <div class="text-secondary small">
                                                        {{ $product->slug }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-blue-lt">
                                                        {{ $product->category->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($product->status)
                                                        <span class="badge bg-green">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge bg-red">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn-action dropdown-toggle"
                                                            data-bs-toggle="dropdown"></button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-product-{{ $product->id }}">
                                                                Edit
                                                            </button>
                                                            <form action="#" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- MODAL EDIT PRODUCT -->
                                            <div class="modal modal-blur fade" id="modal-edit-product-{{ $product->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="#" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    Edit Product
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="mb-3">
                                                                            <label class="form-label required">
                                                                                Product Name
                                                                            </label>
                                                                            <input type="text" name="name"
                                                                                class="form-control"
                                                                                value="{{ $product->name }}">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label required">
                                                                                Category
                                                                            </label>
                                                                            <select name="category_id" class="form-select">
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        @selected($product->category_id == $category->id)>
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label required">
                                                                                Description
                                                                            </label>
                                                                            <textarea name="description" rows="6" class="form-control">{{ $product->description }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">
                                                                                Thumbnail
                                                                            </label>
                                                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                                class="img-fluid rounded mb-2">
                                                                            <input type="file" name="thumbnail"
                                                                                class="form-control">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">
                                                                                OG Image
                                                                            </label>
                                                                            <input type="file" name="og_image"
                                                                                class="form-control">
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label class="form-label">
                                                                                Status
                                                                            </label>
                                                                            <select name="status" class="form-select">
                                                                                <option value="1"
                                                                                    @selected($product->status)>
                                                                                    Active
                                                                                </option>
                                                                                <option value="0"
                                                                                    @selected(!$product->status)>
                                                                                    Inactive
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn me-auto"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update Product
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-secondary py-5">
                                                    Belum ada product
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY -->

                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->

    </div>

    <!-- CREATE PRODUCT MODAL -->
    <div class="modal modal-blur fade" id="modalCreateProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label required">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Produk">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug (opsional)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="slug-produk">
                            <small class="form-hint">Jika dikosongkan, akan dibuat otomatis dari nama.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Kategori</label>
                            <div class="mb-3 form-selectgroup-boxes row">
                                @foreach ($categories as $category)
                                    <div class="col-lg-4">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="category_id" value="{{ $category->id }}"
                                                class="form-selectgroup-input" @checked(old('category_id') == $category->id)>
                                            <span class="p-3 form-selectgroup-label d-flex align-items-center">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span class="form-selectgroup-label-content">
                                                    <span class="mb-1 form-selectgroup-title strong">{{ $category->name }}</span>
                                                    @if(!empty($category->description))
                                                        <span class="d-block text-secondary">{{ $category->description }}</span>
                                                    @endif
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Deskripsi produk">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Content</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">OG Image</label>
                                        <input type="file" name="og_image" class="form-control" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alt Image</label>
                                        <input type="text" name="alt_image" class="form-control" value="{{ old('alt_image') }}" placeholder="Alt text untuk gambar">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="1" @selected(old('status', 1) == 1)>Active</option>
                                            <option value="0" @selected(old('status', 1) == 0)>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Alt Preview</label>
                                        <div class="text-muted small">Preview teks alt akan membantu aksesibilitas dan SEO gambar.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">SEO Settings</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Meta title">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Focus Keyword</label>
                                        <input type="text" name="focus_keyword" class="form-control" value="{{ old('focus_keyword') }}" placeholder="Focus keyword">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Meta Description</label>
                                        <textarea name="meta_description" rows="6" class="form-control" placeholder="Meta description">{{ old('meta_description') }}</textarea>
                                        <div class="form-hint">Gunakan ringkasan singkat (maks ~160 karakter).</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <x-icon-plus />
                            Tambah Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
