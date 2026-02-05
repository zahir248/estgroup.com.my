<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function edit(): View
    {
        $members = TeamMember::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.pages.about', ['members' => $members]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
        ]);

        $file = $request->file('image');
        $path = $file->store('team', 'public');
        $imagePath = 'storage/' . $path;
        $sortOrder = (int) TeamMember::max('sort_order') + 1;

        TeamMember::create([
            'image' => $imagePath,
            'name' => $request->name,
            'title' => $request->input('title'),
            'bio' => $request->input('bio'),
            'sort_order' => $sortOrder,
        ]);

        return redirect()->route('admin.pages.about')->with('success', 'Team member added.');
    }

    public function editMember(TeamMember $teamMember): View
    {
        return view('admin.pages.about-edit-member', ['member' => $teamMember]);
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
        ]);

        $data = [
            'name' => $request->name,
            'title' => $request->input('title'),
            'bio' => $request->input('bio'),
        ];

        if ($request->hasFile('image')) {
            if (str_starts_with($teamMember->image, 'storage/')) {
                $path = str_replace('storage/', '', $teamMember->image);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            $file = $request->file('image');
            $path = $file->store('team', 'public');
            $data['image'] = 'storage/' . $path;
        }

        $teamMember->update($data);

        return redirect()->route('admin.pages.about')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        if (str_starts_with($teamMember->image, 'storage/')) {
            $path = str_replace('storage/', '', $teamMember->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $teamMember->delete();
        return redirect()->route('admin.pages.about')->with('success', 'Team member removed.');
    }
}
