<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerLogo;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomePageController extends Controller
{
    private const STATS_KEY = 'home_energy_stats';

    private function defaultStats(): array
    {
        return [
            ['number' => '20', 'suffix' => '+', 'label' => 'Successfully Project Finished'],
            ['number' => '5', 'suffix' => '+', 'label' => 'Year of experience with Proud'],
            ['number' => '30', 'suffix' => '+', 'label' => 'Revenue (Million) & Investment'],
            ['number' => '50', 'suffix' => '', 'label' => 'Colleagues and Counting'],
        ];
    }

    /**
     * Show the home page content form.
     */
    public function edit(): View
    {
        $json = Setting::get(self::STATS_KEY);
        $stats = $json ? (json_decode($json, true) ?: $this->defaultStats()) : $this->defaultStats();
        // Ensure we have exactly 4 items
        $stats = array_slice(array_replace($this->defaultStats(), $stats), 0, 4);

        $partners = PartnerLogo::orderBy('section')->orderBy('sort_order')->orderBy('id')->get()->groupBy('section');
        $sections = PartnerLogo::sections();
        foreach (array_keys($sections) as $key) {
            if (!isset($partners[$key])) {
                $partners[$key] = collect();
            }
        }

        return view('admin.pages.home', [
            'stats' => $stats,
            'partners' => $partners,
            'sections' => $sections,
        ]);
    }

    /**
     * Update home page content.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'stats' => ['required', 'array', 'size:4'],
            'stats.*.number' => ['required', 'string', 'max:20'],
            'stats.*.suffix' => ['nullable', 'string', 'max:10'],
            'stats.*.label' => ['required', 'string', 'max:255'],
        ]);

        $stats = [];
        foreach ($request->input('stats') as $row) {
            $stats[] = [
                'number' => $row['number'],
                'suffix' => $row['suffix'] ?? '',
                'label' => $row['label'],
            ];
        }

        Setting::set(self::STATS_KEY, json_encode($stats));

        return redirect()->route('admin.pages.home')->with('success', 'Home page stats updated successfully.');
    }
}
