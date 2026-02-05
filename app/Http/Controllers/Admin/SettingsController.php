<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Show the settings form.
     */
    public function index(): View
    {
        return view('admin.settings', [
            'siteName' => Setting::get('site_name', config('app.name')),
            'maintenanceMode' => Setting::get('maintenance_mode', '0') === '1',
        ]);
    }

    /**
     * Update settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'maintenance_mode' => ['nullable', 'boolean'],
        ]);

        Setting::set('site_name', $validated['site_name']);
        Setting::set('maintenance_mode', $request->boolean('maintenance_mode') ? '1' : '0');

        return redirect()->route('admin.settings')->with('success', 'Settings saved successfully.');
    }
}
