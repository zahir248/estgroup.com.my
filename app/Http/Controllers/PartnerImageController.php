<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PartnerImageController extends Controller
{
    /**
     * Serve partner logo image from storage (works without public/storage symlink, e.g. on cPanel).
     */
    public function show(Request $request, string $path): Response|StreamedResponse
    {
        // Only allow paths under partners/ (security: no directory traversal)
        if (! str_starts_with($path, 'partners/') || str_contains($path, '..')) {
            abort(404);
        }

        if (! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        $mime = Storage::disk('public')->mimeType($path) ?: 'application/octet-stream';

        return response()->stream(function () use ($path) {
            $stream = Storage::disk('public')->readStream($path);
            if ($stream) {
                fpassthru($stream);
                fclose($stream);
            }
        }, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
