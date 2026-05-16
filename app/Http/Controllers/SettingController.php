<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'visson' => 'nullable|string',
            'mission' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp',
            'favicon' => 'nullable|image|mimes:png,ico,svg,webp,jpeg,jpg',
        ]);

        $setting = Setting::first() ?: new \App\Models\Setting();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
