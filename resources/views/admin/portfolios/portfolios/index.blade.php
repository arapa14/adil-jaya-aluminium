@extends('layouts.dashboard')
@section('title', 'Portfolio Management')
@section('content')
    <div class="page-wrapper">

        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Manajemen Portolio
                        </div>
                        <h2 class="page-title">
                            Kelola Portofolio Anda
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('portfolios.portfolios.create') }}" class="btn btn-primary">
                            <x-icon-plus />
                            Tambah Portofolio
                        </a>
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
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table" id="portfolios-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Portfolio</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th width="80">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- CATEGORY -->
                </div>
            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>

    <script>
        $(function() {

            $('#portfolios-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('portfolios.portfolios.api') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'portfolio',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category.name'
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
