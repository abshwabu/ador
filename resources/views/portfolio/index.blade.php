@extends('layouts.app')

@section('title', 'Portfolio & Projects | ' . ($settings->company_name ?? 'Adron Trading PLC'))
@section('meta_description', 'Explore our portfolio of luxury residential villas, developer mock-up apartments, and commercial projects in Addis Ababa, Ethiopia.')

@section('content')
<section class="page-hero">
  <div class="container">
    <div class="kicker">Featured Work & Case Studies</div>
    <h1>Crafted Spaces. Proven Delivery.</h1>
    <p>Explore our portfolio of bespoke private residences, commercial corporate offices, and developer apartment interior finishing across Ethiopia.</p>
    <div>
      <a href="{{ route('home') }}" class="btn btn-outline">&larr; Back to Home</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="portfolio-grid">
      @forelse($projects as $project)
        <article class="project-card">
          @if($project->featured)
            <span class="project-featured">Featured</span>
          @endif
          <div class="project-img-wrap">
            <img src="{{ $resolveImage($project->cover_image, 'images/hero.jpg') }}" alt="{{ $project->title }}" loading="lazy">
            @if($project->category)
              <span class="project-badge">{{ $project->category }}</span>
            @endif
          </div>
          <div class="project-body">
            <h2 class="project-title">
              <a href="{{ route('portfolio.show', $project->slug) }}">{{ $project->title }}</a>
            </h2>
            @if($project->excerpt)
              <p class="project-excerpt">{{ $project->excerpt }}</p>
            @endif
            <div class="project-meta">
              <span>{{ $project->location ?? 'Addis Ababa' }} · {{ $project->year ?? '2026' }}</span>
              <a href="{{ route('portfolio.show', $project->slug) }}" class="project-link">
                View Project
                <svg style="width:16px;height:16px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
              </a>
            </div>
          </div>
        </article>
      @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
          <p style="font-size: 18px; color: var(--muted);">No portfolio projects published yet.</p>
        </div>
      @endforelse
    </div>

    <div class="cta-banner">
      <h2>Have an Interior Project in Mind?</h2>
      <p>From architectural brief and factory procurement to container delivery and precision assembly in Ethiopia, we manage every milestone.</p>
      <a href="{{ route('home') }}#contact" class="btn btn-gold">Discuss Your Project</a>
    </div>
  </div>
</section>
@endsection
