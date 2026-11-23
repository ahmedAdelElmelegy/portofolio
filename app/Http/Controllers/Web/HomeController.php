<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\VideoSection;
use App\Models\WorkProcess;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::where('is_active', true)->first() ?? Profile::first();
        $skills = Skill::ordered()->get()->groupBy('category');
        $experiences = Experience::ordered()->get()->groupBy('type');
        $processes = WorkProcess::ordered()->get();
        $projects = Project::with(['technologies', 'images'])
            ->published()
            ->ordered()
            ->get();
        $settings = Setting::pluck('value', 'key');
        $videoSection = VideoSection::with('items')->where('is_active', true)->first();

        return view('portfolio.home', compact(
            'profile', 'skills', 'experiences', 'processes', 'projects', 'settings', 'videoSection'
        ));
    }
}
