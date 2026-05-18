@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Edit Produk
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <x-icon-back />
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    {{-- NAME --}}
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Product Name
                                        </label>

                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $product->name) }}">
                                    </div>

                                    {{-- SLUG --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Slug
                                        </label>

                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $product->slug) }}">
                                    </div>

                                    {{-- CATEGORY --}}
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Category
                                        </label>

                                        <select name="category_id" class="form-select">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                                                    {{ $category->name }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Description
                                        </label>

                                        <textarea name="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- SEO --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        SEO Settings
                                    </h3>
                                </div>

                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Title
                                        </label>

                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title', $product->meta_title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Description
                                        </label>

                                        <textarea name="meta_description" rows="4" class="form-control">{{ old('meta_description', $product->meta_description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Meta Keywords
                                        </label>

                                        <textarea name="meta_keywords" rows="3" class="form-control">{{ old('meta_keywords', $product->meta_keywords) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Focus Keyword
                                        </label>

                                        <input type="text" name="focus_keyword" class="form-control"
                                            value="{{ old('focus_keyword', $product->focus_keyword) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    {{-- THUMBNAIL --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Thumbnail
                                        </label>

                                        <input type="file" name="thumbnail" class="form-control">

                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                class="img-fluid rounded mt-2">
                                        @endif
                                    </div>

                                    {{-- OG IMAGE --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            OG Image
                                        </label>

                                        <input type="file" name="og_image" class="form-control">

                                        @if ($product->og_image)
                                            <img src="{{ asset('storage/' . $product->og_image) }}"
                                                class="img-fluid rounded mt-2">
                                        @endif
                                    </div>

                                    {{-- ALT IMAGE --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Alt Image
                                        </label>
                                        <input type="file" name="alt_image" class="form-control">

                                        @if ($product->alt_image)
                                            <img src="{{ asset('storage/' . $product->alt_image) }}"
                                                class="img-fluid rounded mt-2">
                                        @endif
                                    </div>

                                    {{-- GALLERY --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Gallery Images
                                        </label>
                                        <input type="file" name="images[]" multiple class="form-control">
                                    </div>

                                    {{-- EXISTING GALLERY --}}
                                    {{-- @if ($product->images->count())
                                        <div class="row">
                                            @foreach ($product->images as $image)
                                                <div class="col-6 mb-3">
                                                    <img src="{{ asset('storage/' . $image->image) }}"
                                                        class="img-fluid rounded border">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif --}}

                                    @if ($product->images->count())
                                        <div class="mb-3">
                                            <label class="form-label">
                                                Existing Gallery
                                            </label>

                                            <div class="row">
                                                @foreach ($product->images as $image)
                                                    <div class="col-6 mb-3">
                                                        <div class="card">
                                                            <div class="card-body p-2">

                                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                                    class="img-fluid rounded border mb-2"
                                                                    style="height: 150px; width:100%; object-fit:cover;">

                                                                <label class="form-check">
                                                                    <input type="checkbox" name="delete_images[]"
                                                                        value="{{ $image->id }}"
                                                                        class="form-check-input">

                                                                    <span class="form-check-label text-danger">
                                                                        Delete Image
                                                                    </span>
                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <small class="text-muted">
                                                Centang gambar yang ingin dihapus.
                                            </small>
                                        </div>
                                    @endif

                                    {{-- STATUS --}}
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>

                                        <select name="status" class="form-select">
                                            <option value="1"
                                                {{ old('status', $product->status) == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0"
                                                {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ti ti-device-floppy"></i>
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
