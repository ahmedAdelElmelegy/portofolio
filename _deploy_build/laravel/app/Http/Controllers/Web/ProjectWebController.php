<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectWebController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::with(['images', 'technologies', 'features'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('portfolio.project', compact('project'));
    }
}
