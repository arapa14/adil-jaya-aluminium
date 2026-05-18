<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PortfolioController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PortfolioCategory::latest()->get();

        $portfolios = Portfolio::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.portfolios.portfolios.index', compact('categories', 'portfolios'));
    }

    public function indexApi()
    {
        $data = Portfolio::with(['category', 'images'])
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($portfolio) {
                return '
                <img src="' . asset('storage/' . $portfolio->thumbnail) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('portfolio', function ($portfolio) {
                return '
                <div class="fw-bold">
                    ' . $portfolio->title . '
                </div>
                <div class="text-secondary small">
                    ' . $portfolio->slug . '
                </div>
            ';
            })
            ->addColumn('category', function ($portfolio) {
                return '
                <span class="badge bg-blue-lt">
                    ' . ($portfolio->category->name ?? '-') . '
                </span>
            ';
            })
            ->addColumn('status_badge', function ($portfolio) {
                if ($portfolio->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($portfolio) {
                $editUrl = route('portfolios.portfolios.edit', $portfolio->id);
                $deleteUrl = route('portfolios.portfolios.destroy', $portfolio->id);
                $modalId = 'modalDeletePortfolio-' . $portfolio->id;

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
                                        Hapus Portofolio
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Apakah Anda yakin ingin menghapus portfolio
                                        <strong>' . e($portfolio->title) . '</strong>?
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
                'portfolio',
                'category',
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
