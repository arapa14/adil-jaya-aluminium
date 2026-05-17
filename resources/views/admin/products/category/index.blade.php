@extends('layouts.dashboard')
@section('title', 'Kategori Produk')
@section('content')
    <div class="page-wrapper">

        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Manajemen Kategori Produk
                        </div>
                        <h2 class="page-title">
                            Kelola Kategori Produk Anda
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->

        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Tambah Kategori</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('category.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label required">Nama Kategori</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Masukkan nama kategori">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug (Opsional)</label>
                                        <input type="text" class="form-control" name="slug"
                                            placeholder="Masukkan slug kategori">
                                        <small class="form-hint">Jika dikosongkan, akan dibuat otomatis dari nama.</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Daftar Kategori Produk</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th class="w-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <div class="fw-bold">
                                                        {{ $category->name }}
                                                    </div>
                                                    <div class="text-secondary small">
                                                        {{ $category->slug }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditCategory-{{ $category->id }}">
                                                            <x-icon-edit /> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modalDeleteCategory-{{ $category->id }}">
                                                            <x-icon-delete /> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
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
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY -->

                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->

    </div>

    @forelse($categories as $category)
    {{-- MODAL EDIT CATEGORY --}}
        <div class="modal modal-blur fade" id="modalEditCategory-{{ $category->id }}" tabindex="-1">
            <div class="modal-dialog modal modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kategori Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label required">Nama
                                    Kategori</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukkan nama kategori" value="{{ $category->name ?? old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug (Opsional)</label>
                                <input type="text" class="form-control" name="slug"
                                    placeholder="Masukkan slug kategori" value="{{ $category->slug ?? old('slug') }}">
                                <small class="form-hint">Jika dikosongkan, akan
                                    dibuat
                                    otomatis dari nama.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL DELETE CATEGORY --}}
        <div class="modal modal-blur fade" id="modalDeleteCategory-{{ $category->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kategori Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-1" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
    @endforelse
@endsection
