@extends('layouts.dashboard')
@section('title', 'Testimonials Management')

@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                    <div class="col">
                        <div class="page-pretitle">
                            Manajemen Testimonial
                        </div>

                        <h2 class="page-title">
                            Kelola Testimonial Pelanggan
                        </h2>
                    </div>

                    <div class="col-auto ms-auto d-print-none">
                        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">
                            <x-icon-plus />
                            Tambah Testimonial
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

                                <table class="table table-vcenter card-table" id="testimonials-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Customer</th>
                                            <th>Rating</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th width="80">Action</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>

    <script>
        $(function() {

            $('#testimonials-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('testimonials.api') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'customer',
                        name: 'customer_name'
                    },
                    {
                        data: 'rating_badge',
                        name: 'rating'
                    },
                    {
                        data: 'message',
                        name: 'message'
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
