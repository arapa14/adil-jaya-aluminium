@extends('layouts.dashboard')
@section('title', 'SEO Pages')
@section('content')
    <div class="page-wrapper">

        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            SEO Pages
                        </div>
                        <h2 class="page-title">
                            Search Engine Optimization
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title fw-bold">Daftar Halaman</h3>
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="w-1">#</th>
                                                <th>OG Image</th>
                                                <th>Nama Halaman</th>
                                                <th>Slug</th>
                                                <th>Meta Title</th>
                                                <th>Focus Keyword</th>
                                                <th>Meta Description</th>
                                                <th class="text-center">Robots</th>
                                                <th class="w-1 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pages as $page)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        @if ($page->og_image)
                                                            <img src="{{ Storage::url($page->og_image) }}"
                                                                alt="{{ $page->page_name }}" class="img-thumbnail"
                                                                style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="strong text-secondary">{{ $page->page_name }}</td>
                                                    <td>
                                                        <code class="text-primary">{{ $page->slug }}</code>
                                                    </td>
                                                    <td>
                                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                            title="{{ $page->meta_title }}">
                                                            {{ $page->meta_title ?? '-' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if ($page->focus_keyword)
                                                            <span
                                                                class="badge bg-purple-lt">{{ $page->focus_keyword }}</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="text-muted" title="{{ $page->meta_description }}">
                                                            {{ Str::limit($page->meta_description, 50, '...') ?? '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex gap-1 justify-content-center align-items-center">
                                                            <span
                                                                class="badge {{ $page->robots_index === 'index' ? 'bg-green text-green-fg' : 'bg-red text-red-fg' }} badge-sm"
                                                                title="Index Status">
                                                                {{ $page->robots_index === 'index' ? 'index' : 'noindex' }}
                                                            </span>
                                                            <span
                                                                class="badge {{ $page->robots_follow === 'follow' ? 'bg-blue text-blue-fg' : 'bg-secondary text-secondary-fg' }} badge-sm"
                                                                title="Follow Status">
                                                                {{ $page->robots_follow === 'follow' ? 'follow' : 'nofollow' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-2 justify-content-center">
                                                            <a href="{{ route('seo.edit', $page->id) }}"
                                                                class="btn btn-primary" title="Edit Halaman">
                                                                <x-icon-edit /> Edit
                                                            </a>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalDeletePage-{{ $page->id }}"
                                                                title="Hapus Halaman">
                                                                <x-icon-delete /> Hapus
                                                            </button>

                                                            {{-- MODAL DELETE PAGE --}}
                                                            <div class="modal modal-blur fade"
                                                                id="modalDeletePage-{{ $page->id }}"
                                                                tabindex="-1">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Hapus Halaman SEO
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah Anda yakin ingin menghapus kategori
                                                                                ini?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-1"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <form
                                                                                action="{{ route('seo.destroy', $page->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center text-secondary py-5">
                                                        <div class="empty">
                                                            <p class="empty-title">Belum ada data SEO halaman</p>
                                                            <p class="empty-subtitle text-muted">
                                                                Silahkan tambah data SEO baru untuk memulai optimasi website
                                                                Anda.
                                                            </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer">
                                {{-- {{ $categories->links() }} --}}
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY -->

                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>
@endsection
