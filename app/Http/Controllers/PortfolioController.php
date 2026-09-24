<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Setting;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolio projects.
     */
    public function index(): View
    {
        $settings = Setting::instance();
        $projects = Project::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.index', compact('settings', 'projects'));
    }

    /**
     * Display the specified portfolio project.
     */
    public function show(Project $project): View
    {
        abort_unless($project->is_active, 404);

        $project->load(['images' => fn ($query) => $query->orderBy('sort_order')]);
        $settings = Setting::instance();
        $relatedProjects = Project::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('portfolio.show', compact('settings', 'project', 'relatedProjects'));
    }
}
