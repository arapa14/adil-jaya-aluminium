<?php

namespace App\Http\Controllers;

use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class PortfolioCategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PortfolioCategory::paginate(10);
        return view('admin.portfolios.category.index', compact('categories'));
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio_categories,slug'
        ]);

        try {
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
                $original = $data['slug'];
                $i = 1;
                while (PortfolioCategory::where('slug', $data['slug'])->exists()) {
                    $data['slug'] = $original . '-' . $i++;
                }
            }

            PortfolioCategory::create($data);

            flash()->success('Kategori portfolio berhasil dibuat.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Portfolio Category store error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat menyimpan kategori.');
            return redirect()->back()->withInput();
        }
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio_categories,slug,' . $id
        ]);

        try {
            $category = PortfolioCategory::findOrFail($id);
            $category->update($data);

            flash()->success('Kategori portfolio berhasil diperbarui.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Portfolio Category update error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat memperbarui kategori.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = PortfolioCategory::findOrFail($id);
            $category->delete();

            flash()->success('Kategori portofolio berhasil dihapus.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Portfolio Category destroy error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat menghapus kategori.');
            return redirect()->back();
        }
    }
}
