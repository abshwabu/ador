@extends('layouts.app')

@section('title', $project->title . ' | ' . ($settings->company_name ?? 'Adorn Trading PLC'))
@section('meta_description', $project->excerpt ?? ($project->title . ' — Project by ' . ($settings->company_name ?? 'Adorn Trading PLC')))

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
        <h2 style="font-family: Georgia, serif; font-size: 32px; color: #fff; margin-top: 0; margin-bottom: 24px;">Project Overview</h2>
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

      <div class="project-gallery-grid">
        @foreach($project->images as $index => $image)
          <div class="project-gallery-item" onclick="openProjectLightbox({{ $index }})" onkeydown="if(event.key==='Enter'||event.key===' ') { openProjectLightbox({{ $index }}); event.preventDefault(); }" role="button" tabindex="0" aria-label="View photo {{ $index + 1 }}: {{ $image->caption ?? $project->title }} in full size">
            <div class="project-gallery-media">
              <img src="{{ $resolveImage($image->image_path, 'images/gallery-1.jpg') }}" alt="{{ $image->caption ?? ($project->title . ' gallery image ' . ($index + 1)) }}" loading="lazy">
              <div class="project-gallery-hover-overlay">
                <span class="project-gallery-zoom-badge">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                  Enlarge Photo
                </span>
              </div>
            </div>
            <div class="project-gallery-info">
              <div class="project-gallery-meta">
                <span class="project-gallery-counter">Photo {{ sprintf('%02d', $index + 1) }} of {{ sprintf('%02d', count($project->images)) }}</span>
              </div>
              <p class="project-gallery-caption">{{ $image->caption ?? ($project->title . ' — Detail View') }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Interactive Project Lightbox Modal -->
  <div id="projectLightbox" class="project-lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="{{ $project->title }} Image Viewer">
    <div class="project-lightbox-backdrop" onclick="closeProjectLightbox()"></div>
    <div class="project-lightbox-dialog">
      <button type="button" class="project-lightbox-close" onclick="closeProjectLightbox()" aria-label="Close image viewer">&times;</button>
      
      <div class="project-lightbox-stage">
        @if(count($project->images) > 1)
          <button type="button" class="project-lightbox-nav project-lightbox-prev" onclick="prevLightboxSlide()" aria-label="Previous image">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
          </button>
        @endif

        <img id="lightboxMainImg" src="{{ $resolveImage($project->images->first()->image_path, 'images/gallery-1.jpg') }}" alt="{{ $project->images->first()->caption ?? $project->title }}">

        @if(count($project->images) > 1)
          <button type="button" class="project-lightbox-nav project-lightbox-next" onclick="nextLightboxSlide()" aria-label="Next image">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
          </button>
        @endif
      </div>

      <div class="project-lightbox-footer">
        <p class="project-lightbox-caption" id="lightboxCaption">{{ $project->images->first()->caption ?? $project->title }}</p>
        <div class="project-lightbox-counter" id="lightboxCounter">Photo 01 of {{ sprintf('%02d', count($project->images)) }}</div>
      </div>

      @if(count($project->images) > 1)
        <div class="project-lightbox-thumbs">
          @foreach($project->images as $idx => $img)
            <button type="button" class="project-lightbox-thumb {{ $idx === 0 ? 'active' : '' }}" onclick="goToLightboxSlide({{ $idx }})" aria-label="View photo {{ $idx + 1 }}">
              <img src="{{ $resolveImage($img->image_path, 'images/gallery-1.jpg') }}" alt="">
            </button>
          @endforeach
        </div>
      @endif
    </div>
  </div>

  <script>
    const projectGalleryData = [
      @foreach($project->images as $img)
        {
          src: "{{ $resolveImage($img->image_path, 'images/gallery-1.jpg') }}",
          caption: "{{ addslashes($img->caption ?? $project->title) }}"
        },
      @endforeach
    ];

    let currentLightboxIndex = 0;
    const lightboxModal = document.getElementById('projectLightbox');
    const lightboxImg = document.getElementById('lightboxMainImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxThumbs = document.querySelectorAll('.project-lightbox-thumb');

    function updateLightbox(index) {
      if (!projectGalleryData || !projectGalleryData.length) return;
      currentLightboxIndex = (index + projectGalleryData.length) % projectGalleryData.length;
      const item = projectGalleryData[currentLightboxIndex];
      
      lightboxImg.style.opacity = '0';
      lightboxImg.style.transform = 'scale(0.97)';
      
      setTimeout(() => {
        lightboxImg.src = item.src;
        lightboxImg.alt = item.caption;
        lightboxCaption.textContent = item.caption;
        lightboxCounter.textContent = `Photo ${String(currentLightboxIndex + 1).padStart(2, '0')} of ${String(projectGalleryData.length).padStart(2, '0')}`;
        
        lightboxThumbs.forEach((thumb, i) => {
          thumb.classList.toggle('active', i === currentLightboxIndex);
          if (i === currentLightboxIndex) {
            thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
          }
        });
        
        lightboxImg.style.opacity = '1';
        lightboxImg.style.transform = 'scale(1)';
      }, 120);
    }

    function openProjectLightbox(index) {
      currentLightboxIndex = index;
      updateLightbox(index);
      lightboxModal.classList.add('active');
      lightboxModal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }

    function closeProjectLightbox() {
      lightboxModal.classList.remove('active');
      lightboxModal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    function nextLightboxSlide() {
      updateLightbox(currentLightboxIndex + 1);
    }

    function prevLightboxSlide() {
      updateLightbox(currentLightboxIndex - 1);
    }

    function goToLightboxSlide(index) {
      updateLightbox(index);
    }

    document.addEventListener('keydown', function(e) {
      if (!lightboxModal || !lightboxModal.classList.contains('active')) return;
      if (e.key === 'Escape') closeProjectLightbox();
      if (e.key === 'ArrowRight') nextLightboxSlide();
      if (e.key === 'ArrowLeft') prevLightboxSlide();
    });
  </script>
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
              <a href="{{ route('portfolio.show', $related->slug) }}" style="color: var(--gold2); font-weight: 700; font-size: 13px; display: inline-flex; align-items: center; gap: 4px; margin-top: auto;">
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
