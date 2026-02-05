<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerLogo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'section' => ['required', 'string', 'in:accreditation,strategic,financial'],
            'alt' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp,svg', 'max:2048'],
        ]);

        $file = $request->file('image');
        $path = $file->store('partners', 'public');
        $sortOrder = (int) PartnerLogo::where('section', $request->section)->max('sort_order') + 1;
        $imagePath = 'storage/' . $path;

        PartnerLogo::create([
            'section' => $request->section,
            'image' => $imagePath,
            'alt' => $request->input('alt'),
            'sort_order' => $sortOrder,
        ]);

        return redirect()->route('admin.pages.home')->with('success', 'Partner logo added.');
    }

    public function destroy(PartnerLogo $partner): RedirectResponse
    {
        if (str_starts_with($partner->image, 'storage/')) {
            $path = str_replace('storage/', '', $partner->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $partner->delete();
        return redirect()->route('admin.pages.home')->with('success', 'Partner logo removed.');
    }
}
