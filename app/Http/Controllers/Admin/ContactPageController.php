<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactPageController extends Controller
{
    public function edit(): View
    {
        return view('admin.pages.contact', [
            'contactAddress' => Setting::get('contact_address', '17-1, Jalan Bazaar P U8/P, Trivio Bukit Jelutong, 40150 Shah Alam, Selangor Darul Ehsan.'),
            'contactEmail' => Setting::get('contact_email', config('mail.from.address', 'info@estgroup.com.my')),
            'contactPhone' => Setting::get('contact_phone', '+603 7734 1711'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'contact_address' => ['nullable', 'string', 'max:500'],
            'contact_email' => ['required', 'email'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
        ]);

        Setting::set('contact_address', $validated['contact_address'] ?? '');
        Setting::set('contact_email', $validated['contact_email']);
        Setting::set('contact_phone', $validated['contact_phone'] ?? '');

        return redirect()->route('admin.pages.contact')->with('success', 'Contact page content saved successfully.');
    }
}
