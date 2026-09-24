<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = Setting::instance();
        $products = Product::where('is_active', true)->orderBy('sort_order')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        $processSteps = ProcessStep::where('is_active', true)->orderBy('sort_order')->get();
        $teamMembers = TeamMember::where('is_active', true)->where('featured', true)->orderBy('sort_order')->get();
        $galleryItems = GalleryItem::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact(
            'settings',
            'products',
            'services',
            'processSteps',
            'teamMembers',
            'galleryItems'
        ));
    }
}
