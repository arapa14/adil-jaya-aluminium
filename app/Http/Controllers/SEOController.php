<?php

namespace App\Http\Controllers;

use App\Models\SeoPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class SEOController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = SeoPage::paginate(10);
        return view('admin.seo.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.seo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'page_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:500',
            'meta_keywords' => 'required|string|max:500',
            'focus_keyword' => 'required|string|max:255',
            'og_title' => 'required|string|max:255',
            'og_description' => 'required|string|max:500',
            'og_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:300',
            'canonical_url' => 'required|url|max:2048',
            'robots_index' => 'required|boolean',
            'robots_follow' => 'required|boolean',
            'schema_markup' => 'nullable|json',
        ]);

        try {

            $data = $validated;

            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */
            $slugSource = $request->filled('slug')
                ? $request->slug
                : $request->page_name;

            $slug = Str::slug($slugSource);

            $originalSlug = $slug;
            $counter = 1;

            while (SeoPage::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Upload OG Image
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('og_image')) {

                $data['og_image'] = $request
                    ->file('og_image')
                    ->store('seo', 'public');
            }

            SeoPage::create($data);

            flash()->success('Konfigurasi SEO berhasil ditambahkan.');

            return redirect()
                ->route('seo.index');

        } catch (\Throwable $e) {

            Log::error('SEO Store Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            flash()->error('Terjadi kesalahan saat menyimpan data.');

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
        $page = SeoPage::findOrFail($id);
        return view('admin.seo.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = SeoPage::findOrFail($id);

        $rules = [
            'page_name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|nullable|string|max:255',
            'meta_title' => 'sometimes|nullable|string|max:255',
            'meta_description' => 'sometimes|nullable|string',
            'meta_keywords' => 'sometimes|nullable|string',
            'focus_keyword' => 'sometimes|nullable|string',
            'og_title' => 'sometimes|nullable|string|max:255',
            'og_description' => 'sometimes|nullable|string',
            'og_image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'canonical_url' => 'sometimes|nullable|url|max:2048',
            'robots_index' => 'sometimes|boolean',
            'robots_follow' => 'sometimes|boolean',
            'schema_markup' => 'sometimes|nullable|string',
        ];

        // validate first (let validation exceptions be handled by Laravel)
        $validated = $request->validate($rules);

        try {
            // prepare data only from fields present in the request
            $data = [];

            // map validated input into $data (preserve unchanged fields by not including them)
            $fields = [
                'page_name',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'focus_keyword',
                'og_title',
                'og_description',
                'canonical_url',
                'schema_markup'
            ];
            foreach ($fields as $f) {
                if (array_key_exists($f, $validated)) {
                    $data[$f] = $validated[$f];
                }
            }

            // handle slug only if explicitly provided (do NOT auto-generate from page_name)
            if ($request->filled('slug')) {
                $slug = Str::slug($request->input('slug'));
                // ensure unique slug (exclude current record)
                $base = $slug;
                $counter = 1;
                while (SeoPage::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
                    $slug = $base . '-' . $counter++;
                }
                $data['slug'] = $slug;
            }

            // normalize boolean checkboxes only when present in the request
            if ($request->has('robots_index')) {
                $data['robots_index'] = $request->has('robots_index') ? 1 : 0;
            }
            if ($request->has('robots_follow')) {
                $data['robots_follow'] = $request->has('robots_follow') ? 1 : 0;
            }

            // handle og_image upload if a new file is provided
            if ($request->hasFile('og_image')) {
                $path = $request->file('og_image')->store('seo', 'public');

                // delete old image if exists
                if ($page->og_image && Storage::disk('public')->exists($page->og_image)) {
                    Storage::disk('public')->delete($page->og_image);
                }

                $data['og_image'] = $path;
            }

            // if there's anything to update, perform update
            if (!empty($data)) {
                $page->update($data);
                flash()->success('Halaman SEO berhasil diperbarui.');
            } else {
                flash()->info('Tidak ada perubahan untuk disimpan.');
            }

            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('SEO update error: ' . $e->getMessage(), ['exception' => $e, 'id' => $id]);
            flash()->error('Gagal memperbarui halaman SEO. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = SeoPage::findOrFail($id);
        $page->delete();
        flash()->success('Halaman SEO berhasil dihapus.');
        return redirect()->back();
    }
}
