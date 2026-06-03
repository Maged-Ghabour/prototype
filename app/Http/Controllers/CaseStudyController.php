<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function show($slug)
    {
        $caseStudy = CaseStudy::where('slug', $slug)
            ->where('is_published', true)
            ->with('prototype')
            ->firstOrFail();

        return view('pages.case-study', compact('caseStudy'));
    }
}
