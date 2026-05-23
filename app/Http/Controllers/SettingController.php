<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;

class SettingController
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_desc' => 'nullable|string',
            'address' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'maps_embed' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'favicon' => 'nullable|mimes:png,ico,svg,webp,jpeg,jpg',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
        ]);

        $setting = Setting::first() ?: new Setting();
        $dir = 'settings';
        $newFiles = [];

        try {
            // Handle logo upload: store first, then delete old
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '_logo.' . $file->getClientOriginalExtension();

                $path = $file->storeAs($dir, $filename, 'public');
                $data['logo'] = $path;
                $newFiles[] = $path;

                // delete old logo if exists
                if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                    Storage::disk('public')->delete($setting->logo);
                }
            }

            // Handle favicon upload: store first, then delete old
            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $filename = time() . '_favicon.' . $file->getClientOriginalExtension();

                $path = $file->storeAs($dir, $filename, 'public');
                $data['favicon'] = $path;
                $newFiles[] = $path;

                // delete old favicon if exists
                if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                    Storage::disk('public')->delete($setting->favicon);
                }
            }

            // Handle hero_image upload: store first, then delete old
            if ($request->hasFile('hero_image')) {
                $file = $request->file('hero_image');
                $filename = time() . '_hero.' . $file->getClientOriginalExtension();

                $path = $file->storeAs($dir, $filename, 'public');
                $data['hero_image'] = $path;
                $newFiles[] = $path;

                // delete old hero_image if exists
                if ($setting->hero_image && Storage::disk('public')->exists($setting->hero_image)) {
                    Storage::disk('public')->delete($setting->hero_image);
                }
            }

            $setting->fill($data);
            $setting->save();

            flash()->success('Pengaturan berhasil diperbarui.');
            return back();
        } catch (\Exception $e) {
            // remove any newly uploaded files to avoid orphan files
            foreach ($newFiles as $f) {
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
            }

            // optional: log the error
            Log::error('Failed updating settings: ' . $e->getMessage());

            flash()->error('Terjadi kesalahan saat memperbarui pengaturan.');
            return back()->withInput();
        }
    }
}
