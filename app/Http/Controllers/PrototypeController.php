<?php

namespace App\Http\Controllers;

use App\Models\Prototype;
use Illuminate\Http\Response;

/**
 * PrototypeController
 *
 * Handles the public-facing preview of prototypes.
 * Renders HTML/CSS/JS code for a given slug as a full-page response.
 */
class PrototypeController extends Controller
{
    /**
     * Show the public preview for a prototype identified by its slug.
     *
     * Security notes:
     * - Returns 404 if the prototype does not exist.
     * - Returns 404 if the prototype is not marked as public (is_public = false).
     * - HTML/CSS/JS code is rendered as-is (intentional — content is admin-controlled).
     *   No user-submitted content reaches this endpoint.
     *
     * @param  string $slug  The unique slug from the URL /p/{slug}
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        // Find the prototype by slug; abort with 404 if not found
        $prototype = Prototype::where('slug', $slug)->first();

        // Return 404 if prototype doesn't exist or is not public
        if (!$prototype || !$prototype->is_public) {
            abort(404, 'Prototype not found or is not publicly accessible.');
        }

        // Render the full-page preview via Blade
        return view('prototype.preview', compact('prototype'));
    }
}
