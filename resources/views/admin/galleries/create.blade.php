@extends('layouts.dashboard')
@section('title', 'Create Gallery')

@section('content')
    <div class="page-wrapper">
        {{-- PAGE HEADER --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Tambah Gallery
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('galleries.index') }}" class="btn btn-primary">
                            <x-icon-back />
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAGE BODY --}}
        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- LEFT --}}
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Caption
                                        </label>
                                        <input type="text" name="caption" class="form-control"
                                            value="{{ old('caption') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Alt Text
                                        </label>
                                        <input type="text" name="alt_text" class="form-control"
                                            value="{{ old('alt_text') }}">
                                        <small class="form-hint">
                                            Jika dikosongkan, akan diambil dari caption.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">
                                            Image
                                        </label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            Status
                                        </label>
                                        <select name="status" class="form-select">
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <x-icon-save />
                                        Save Gallery
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
