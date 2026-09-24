<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        $settings = Setting::instance();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('sort_order')->get();

        return view('team', compact('settings', 'teamMembers'));
    }
}
