<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }


    public function indexApi()
    {
        $services = Service::latest();

        return DataTables::of($services)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($services) {
                return '
                <img src="' . asset('storage/' . $services->thumbnail) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('service', function ($services) {
                return '
                <div class="fw-bold">
                    ' . $services->title . '
                </div>
                <div class="text-secondary small">
                    ' . $services->slug . '
                </div>
            ';
            })
            ->addColumn('description', function ($services) {
                return '
                <span class="badge bg-blue-lt">
                    ' . ($services->description ?? '-') . '
                </span>
            ';
            })
            ->addColumn('status_badge', function ($services) {
                if ($services->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($services) {
                $editUrl = route('services.edit', $services->id);
                $deleteUrl = route('services.destroy', $services->id);
                $modalId = 'modalDeleteServices-' . $services->id;

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
                                        Hapus Service
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Apakah Anda yakin ingin menghapus service
                                        <strong>' . e($services->title) . '</strong>?
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
                'thumbnail',
                'service',
                'description',
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
