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
        $rules = [
            'page_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'focus_keyword' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'canonical_url' => 'nullable|url|max:2048',
            'robots_index' => 'sometimes|boolean',
            'robots_follow' => 'sometimes|boolean',
            'schema_markup' => 'nullable|string',
        ];

        // validate first (let validation exceptions be handled by Laravel)
        $validated = $request->validate($rules);

        try {
            // prepare data
            $data = $validated;

            // generate slug from input or page_name
            $slugSource = $request->filled('slug') ? $request->input('slug') : $request->input('page_name');
            $slug = Str::slug($slugSource);

            // ensure unique slug
            $base = $slug;
            $counter = 1;
            while (SeoPage::where('slug', $slug)->exists()) {
                $slug = $base . '-' . $counter++;
            }
            $data['slug'] = $slug;

            // normalize boolean checkboxes
            $data['robots_index'] = $request->has('robots_index') ? 1 : 0;
            $data['robots_follow'] = $request->has('robots_follow') ? 1 : 0;

            // handle og_image upload
            if ($request->hasFile('og_image')) {
                $path = $request->file('og_image')->store('seo', 'public');
                $data['og_image'] = $path;
            }

            // create record
            SeoPage::create($data);

            flash()->success('Halaman SEO berhasil dibuat.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('SEO store error: ' . $e->getMessage(), ['exception' => $e]);
            flash()->error('Gagal menyimpan halaman SEO. Silakan coba lagi.');
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
                'page_name', 'meta_title', 'meta_description', 'meta_keywords',
                'focus_keyword', 'og_title', 'og_description', 'canonical_url', 'schema_markup'
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
        //
    }
}
