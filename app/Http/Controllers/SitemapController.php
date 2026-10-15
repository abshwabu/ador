<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate the XML sitemap for search engines.
     */
    public function index(): Response
    {
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => now()->startOfDay()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('portfolio.index'),
                'lastmod' => now()->startOfDay()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('team.index'),
                'lastmod' => now()->startOfDay()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ],
        ];

        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        foreach ($projects as $project) {
            $urls[] = [
                'loc' => route('portfolio.show', $project->slug),
                'lastmod' => ($project->updated_at ?? now())->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
