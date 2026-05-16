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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-product">
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

                <x-notify />

                <div class="row row-cards">

                    <!-- CATEGORY -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">
                                    Product Categories
                                </h3>
                            </div>

                            <div class="card-body">
                                <!-- CREATE CATEGORY -->
                                <form action="{{ route('admin.products.categories.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Nama Category
                                        </label>
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Contoh: Pintu Aluminium">
                                            <button type="submit" class="btn btn-primary">
                                                Tambah
                                            </button>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </form>

                                <div class="hr-text">
                                    List Category
                                </div>

                                <!-- CATEGORY LIST -->
                                <div class="list-group list-group-flush">
                                    @forelse ($categories as $category)
                                        <div class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="fw-bold">
                                                        {{ $category->name }}
                                                    </div>
                                                    <div class="text-secondary small">
                                                        {{ $category->slug }}
                                                    </div>
                                                </div>

                                                <div class="dropdown">
                                                    <button class="btn-action dropdown-toggle"
                                                        data-bs-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- EDIT -->
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modal-edit-category-{{ $category->id }}">
                                                            Edit
                                                        </button>

                                                        <!-- DELETE -->
                                                        <form
                                                            action="{{ route('admin.products.categories.destroy', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT CATEGORY -->
                                        <div class="modal modal-blur fade" id="modal-edit-category-{{ $category->id }}"
                                            tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('admin.products.categories.update', $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Edit Category
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label required">
                                                                    Nama Category
                                                                </label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $category->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn me-auto"
                                                                data-bs-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-secondary text-center py-4">
                                            Belum ada category
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PRODUCTS -->
                    <div class="col-md-8">
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
                                                            <form
                                                                action="{{ route('admin.products.destroy', $product->id) }}"
                                                                method="POST">
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
                                            <div class="modal modal-blur fade"
                                                id="modal-edit-product-{{ $product->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.products.update', $product->id) }}"
                                                            method="POST" enctype="multipart/form-data">
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
                                                                            <select name="category_id"
                                                                                class="form-select">
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

                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->

    </div>

    <!-- CREATE PRODUCT MODAL -->
    <div class="modal modal-blur fade" id="modal-create-product" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tambah Product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label required">
                                        Product Name
                                    </label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">
                                        Category
                                    </label>
                                    <select name="category_id" class="form-select">
                                        <option value="">
                                            Pilih Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">
                                        Description
                                    </label>
                                    <textarea name="description" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Bagian ini otomatis tertutup rapi mengikuti struktur HTML Anda -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
