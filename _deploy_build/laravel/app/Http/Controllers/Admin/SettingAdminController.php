<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'copyright_year' => ['nullable', 'string', 'max:10'],
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings saved.');
    }
}
