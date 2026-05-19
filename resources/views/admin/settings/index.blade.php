@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">Pengaturan</div>
                        <h2 class="page-title">Ubah Preferensi Website</h2>
                    </div>
                    <!-- Page title actions -->
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
            <div class="container-xl">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row row-cards">
                        <!-- Kolom 1: General Information -->
                        <div class="col-12 col-md-7">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title fw-bold">Informasi Umum</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Company Name -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Nama Perusahaan</label>
                                        <div class="col">
                                            <input type="text" name="company_name" class="form-control"
                                                placeholder="Company Name"
                                                value="{{ old('company_name', $setting->company_name ?? '') }}">
                                            @if ($errors->has('company_name'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('company_name') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Company Description -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Deskripsi Perusahaan</label>
                                        <div class="col">
                                            <textarea name="company_desc" class="form-control" rows="3" placeholder="Short description">{{ old('company_desc', $setting->company_desc ?? '') }}</textarea>
                                            @if ($errors->has('company_desc'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('company_desc') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Alamat Perusahaan</label>
                                        <div class="col">
                                            <input type="text" name="address" class="form-control" placeholder="Address"
                                                value="{{ old('address', $setting->address ?? '') }}">
                                            @if ($errors->has('address'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('address') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Vision -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Visi Perusahaan</label>
                                        <div class="col">
                                            <textarea id="tinymce-vision" name="visson" class="form-control" rows="2" placeholder="Vision">{{ old('visson', $setting->visson ?? '') }}</textarea>
                                            @if ($errors->has('visson'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('visson') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Mission -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Misi Perusahaan</label>
                                        <div class="col">
                                            <textarea id="tinymce-mission" name="mission" class="form-control" rows="3" placeholder="Mission">{{ old('mission', $setting->mission ?? '') }}</textarea>
                                            @if ($errors->has('mission'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('mission') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Logo -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Logo</label>
                                        <div class="col">
                                            @if ($errors->has('logo'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('logo') }}
                                                </div>
                                            @endif

                                            @if (!empty($setting->logo))
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($setting->logo) }}" alt="Logo"
                                                        class="img-fluid" style="max-height: 60px;">
                                                </div>
                                            @endif
                                            <input type="file" name="logo" class="mb-2 form-control">
                                        </div>
                                    </div>

                                    <!-- Favicon -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Favicon</label>
                                        <div class="col">
                                            @if ($errors->has('favicon'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('favicon') }}
                                                </div>
                                            @endif

                                            @if (!empty($setting->favicon))
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon"
                                                        class="img-fluid" style="max-height: 40px;">
                                                </div>
                                            @endif
                                            <input type="file" name="favicon" class="mb-2 form-control">
                                        </div>
                                    </div>

                                    {{-- Hero Image --}}
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Hero Image</label>
                                        <div class="col">
                                            @if ($errors->has('hero_image'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('hero_image') }}
                                                </div>
                                            @endif

                                            @if (!empty($setting->hero_image))
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($setting->hero_image) }}" alt="Hero Image"
                                                        class="img-fluid" style="max-height: 100px;">
                                                </div>
                                            @endif
                                            <input type="file" name="hero_image" class="mb-2 form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom 2: Social Media & Contact Info -->
                        <div class="col-12 col-md-5">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title fw-bold">Sosial Media & Kontak</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Whatsapp -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Nomor Whatsapp</label>
                                        <div class="col">
                                            <input type="text" name="whatsapp" class="form-control"
                                                placeholder="Whatsapp number"
                                                value="{{ old('whatsapp', $setting->whatsapp ?? '') }}">
                                            @if ($errors->has('whatsapp'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('whatsapp') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Email</label>
                                        <div class="col">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="contact@example.com"
                                                value="{{ old('email', $setting->email ?? '') }}">
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Facebook -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Facebook</label>
                                        <div class="col">
                                            <input type="text" name="facebook" class="form-control"
                                                placeholder="Facebook URL"
                                                value="{{ old('facebook', $setting->facebook ?? '') }}">
                                            @if ($errors->has('facebook'))
                                                <div class="invalid-feedback d-block">{{ $errors->first('facebook') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Instagram -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Instagram</label>
                                        <div class="col">
                                            <input type="text" name="instagram" class="form-control"
                                                placeholder="Instagram URL"
                                                value="{{ old('instagram', $setting->instagram ?? '') }}">
                                            @if ($errors->has('instagram'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('instagram') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Maps Embed -->
                                    <div class="mb-3 row">
                                        <label class="col-3 col-form-label required">Maps (iframe)</label>
                                        <div class="col">
                                            <textarea name="maps_embed" class="form-control" rows="4" placeholder="Paste maps iframe code">{{ old('maps_embed', $setting->maps_embed ?? '') }}</textarea>
                                            @if ($errors->has('maps_embed'))
                                                <div class="invalid-feedback d-block">
                                                    {{ $errors->first('maps_embed') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Action & Modal (Di Luar Baris Kolom) -->
                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-confirm"
                                class="btn btn-primary">
                                <x-icon-edit />
                                Ubah Pengaturan
                            </button>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi -->
                    <div class="modal modal-blur fade" id="modal-confirm" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin mengubah pengaturan ini?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-1" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Ya, Ubah Pengaturan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>
    <!-- BEGIN PAGE MODALS -->
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="example-text-input"
                            placeholder="Your report name" />
                    </div>
                    <label class="form-label">Report type</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1" class="form-selectgroup-input"
                                    checked />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Simple</span>
                                        <span class="d-block text-secondary">Provide only basic data needed for the
                                            report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1"
                                    class="form-selectgroup-input" />
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Advanced</span>
                                        <span class="d-block text-secondary">Insert charts and additional advanced
                                            analyses to be inserted in the report</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Report url</label>
                                <div class="input-group input-group-flat">
                                    <span class="input-group-text"> https://tabler.io/reports/ </span>
                                    <input type="text" class="form-control ps-0" value="report-01"
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Visibility</label>
                                <select class="form-select">
                                    <option value="1" selected>Private</option>
                                    <option value="2">Public</option>
                                    <option value="3">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Client name</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Reporting period</label>
                                <input type="date" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Additional information</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary btn-3" data-bs-dismiss="modal"> Cancel </a>
                    <a href="#" class="btn btn-primary btn-5 ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-2">
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Create new report
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE MODALS -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/libs/tinymce/tinymce.min.js') }}" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let options = {
                selector: "#tinymce-vision, #tinymce-mission",
                height: 150,
                menubar: false,
                statusbar: false,
                license_key: "gpl",
                plugins: [
                    "advlist",
                    "autolink",
                    "lists",
                    "link",
                    "image",
                    "charmap",
                    "preview",
                    "anchor",
                    "searchreplace",
                    "visualblocks",
                    "code",
                    "fullscreen",
                    "insertdatetime",
                    "media",
                    "table",
                    "code",
                    "help",
                    "wordcount",
                ],
                toolbar: "undo redo | formatselect | " +
                    "bold italic backcolor | alignleft aligncenter " +
                    "alignright alignjustify | bullist numlist outdent indent | " +
                    "removeformat",
                content_style: "body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }",
            };
            if (localStorage.getItem("tablerTheme") === "dark") {
                options.skin = "oxide-dark";
                options.content_css = "dark";
            }
            tinyMCE.init(options);
        });
    </script>
@endpush
