@extends('layouts.app')

@section('title', $project->title . ' | ' . ($settings->company_name ?? 'Adron Trading PLC'))
@section('meta_description', $project->excerpt ?? ($project->title . ' — Project by ' . ($settings->company_name ?? 'Adron Trading PLC')))

@section('content')
<section class="project-hero">
  <div class="container">
    <nav class="breadcrumbs" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>&rsaquo;</span>
      <a href="{{ route('portfolio.index') }}">Portfolio</a>
      <span>&rsaquo;</span>
      <span>{{ $project->title }}</span>
    </nav>

    @if($project->category)
      <div class="kicker">{{ $project->category }}</div>
    @endif

    <h1 class="project-title">{{ $project->title }}</h1>

    @if($project->excerpt)
      <p class="project-lead">{{ $project->excerpt }}</p>
    @endif

    <div class="meta-grid">
      <div class="meta-item">
        <small>Client</small>
        <b>{{ $project->client ?? 'Private Client' }}</b>
      </div>
      <div class="meta-item">
        <small>Location</small>
        <b>{{ $project->location ?? 'Addis Ababa, Ethiopia' }}</b>
      </div>
      <div class="meta-item">
        <small>Year</small>
        <b>{{ $project->year ?? '2026' }}</b>
      </div>
      <div class="meta-item">
        <small>Category</small>
        <b>{{ $project->category ?? 'Interior Finishing' }}</b>
      </div>
    </div>

    <div class="cover-wrapper">
      <img src="{{ $resolveImage($project->cover_image, 'images/hero.jpg') }}" alt="{{ $project->title }}">
    </div>
  </div>
</section>

@if($project->body)
  <section class="section">
    <div class="container">
      <div class="project-content-wrap">
        <div class="kicker" style="margin-bottom: 12px;">Project Scope & Execution</div>
        <h2 style="font-family: Georgia, serif; font-size: 32px; color: var(--navy); margin-top: 0; margin-bottom: 24px;">Project Overview</h2>
        {!! nl2br(e($project->body)) !!}
      </div>
    </div>
  </section>
@endif

@if($project->images && $project->images->isNotEmpty())
  <section class="section alt">
    <div class="container">
      <div class="section-head">
        <div class="kicker">Visual Gallery</div>
        <h2>Craftsmanship In Every Angle</h2>
        <p>Detailed view of finishes, materials, custom casework, and spatial installation for this project.</p>
      </div>

      <div class="gallery-grid">
        @foreach($project->images as $image)
          <div class="gallery-card">
            <div class="gallery-img-wrap">
              <img src="{{ $resolveImage($image->image_path, 'images/gallery-1.jpg') }}" alt="{{ $image->caption ?? ($project->title . ' gallery image') }}" loading="lazy">
            </div>
            @if($image->caption)
              <div class="gallery-caption">{{ $image->caption }}</div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif

@if(isset($relatedProjects) && $relatedProjects->isNotEmpty())
  <section class="section">
    <div class="container">
      <div class="section-head">
        <div class="kicker">Explore More Work</div>
        <h2>Related Projects</h2>
        <p>See how we bring luxury finishing and project procurement to diverse residential and commercial spaces.</p>
      </div>

      <div class="related-grid">
        @foreach($relatedProjects as $related)
          <article class="related-card">
            <img src="{{ $resolveImage($related->cover_image, 'images/hero.jpg') }}" alt="{{ $related->title }}" loading="lazy">
            <div class="related-body">
              @if($related->category)
                <span class="related-category">{{ $related->category }}</span>
              @endif
              <h3 class="related-title">
                <a href="{{ route('portfolio.show', $related->slug) }}">{{ $related->title }}</a>
              </h3>
              @if($related->excerpt)
                <p style="font-size: 13px; color: var(--muted); margin: 0 0 12px; line-height: 1.5; flex: 1;">{{ Str::limit($related->excerpt, 90) }}</p>
              @endif
              <a href="{{ route('portfolio.show', $related->slug) }}" style="color: var(--navy); font-weight: 700; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: auto;">
                View Case Study &rarr;
              </a>
            </div>
          </article>
        @endforeach
      </div>

      <div class="cta-banner">
        <h2>Ready to Begin Your Project?</h2>
        <p>Get in touch with our team to discuss project requirements, 3D designs, BOQ estimates, and container delivery.</p>
        <a href="{{ route('home') }}#contact" class="btn btn-gold">Request a Consultation</a>
      </div>
    </div>
  </section>
@endif
@endsection
