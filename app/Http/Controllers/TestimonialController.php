<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestimonialController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.testimonials.index');
    }

    public function indexApi()
    {
        $testimonials = Testimonial::latest();

        return DataTables::of($testimonials)
            ->addIndexColumn()

            ->addColumn('photo', function ($testimonial) {
                return '
                <img src="' . asset('storage/' . $testimonial->photo) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })

            ->addColumn('customer', function ($testimonial) {
                return '
                <div class="fw-bold">
                    ' . e($testimonial->customer_name) . '
                </div>

                <div class="text-secondary small">
                    ' . e($testimonial->project_type) . '
                </div>
            ';
            })

            ->addColumn('rating_badge', function ($testimonial) {
                return '
                <span class="badge bg-yellow text-dark">
                    ⭐ ' . $testimonial->rating . '/5
                </span>
            ';
            })

            ->addColumn('message', function ($testimonial) {
                return '
                <span class="badge bg-blue-lt">
                    ' . \Illuminate\Support\Str::limit($testimonial->message ?? '-', 50) . '
                </span>
            ';
            })

            ->addColumn('status_badge', function ($testimonial) {
                if ($testimonial->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })

            ->addColumn('action', function ($testimonial) {
                $editUrl = route('testimonials.edit', $testimonial->id);
                $deleteUrl = route('testimonials.destroy', $testimonial->id);
                $modalId = 'modalDeleteTestimonial-' . $testimonial->id;

                return '
                <div class="d-flex gap-2 justify-content-center">
                    <a href="' . $editUrl . '" class="btn btn-primary">
                        <i class="ti ti-edit"></i>
                        Edit
                    </a>

                    <button type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#' . $modalId . '">
                        <i class="ti ti-trash"></i>
                        Hapus
                    </button>
                </div>

                <!-- Modal Delete -->
                <div class="modal modal-blur fade"
                    id="' . $modalId . '"
                    tabindex="-1">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Hapus Testimonial
                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>
                                    Apakah Anda yakin ingin menghapus testimonial dari
                                    <strong>' . e($testimonial->customer_name) . '</strong>?
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                    Batal
                                </button>

                                <form action="' . $deleteUrl . '" method="POST">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '

                                    <button type="submit"
                                        class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            ';
            })

            ->rawColumns([
                'photo',
                'customer',
                'rating_badge',
                'message',
                'status_badge',
                'action'
            ])

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
