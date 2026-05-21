@extends('layouts.dashboard')
@section('title', 'Gallery Management')

@section('content')
    <div class="page-wrapper">
        {{-- PAGE HEADER --}}
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Manajemen Gallery
                        </div>
                        <h2 class="page-title">
                            Kelola Gallery Website
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('galleries.create') }}" class="btn btn-primary">
                            <x-icon-plus />
                            Tambah Gallery
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAGE BODY --}}
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table" id="galleries-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Gallery Info</th>
                                            <th>Status</th>
                                            <th width="80">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#galleries-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('galleries.api') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image_preview',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'gallery_info',
                        name: 'caption'
                    },
                    {
                        data: 'status_badge',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endsection
