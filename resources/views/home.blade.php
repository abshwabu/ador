@extends('layouts.app')

@section('title', $settings->meta_title ?? 'Adorn Trading PLC | Design. Source. Deliver.')
@section('meta_description', $settings->meta_description ?? 'Adorn Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.')

@section('content')
<section id="home" class="hero">
  <div class="container hero-grid">
    <div>
      <div class="kicker">{{ $settings->hero_kicker ?? 'Global Wholesale Furnishing' }}</div>
      <h1>
        {{ $settings->hero_heading_line1 ?? 'Design.' }}<br>
        <span>{{ $settings->hero_heading_line2 ?? 'Source.' }}</span><br>
        {{ $settings->hero_heading_line3 ?? 'Deliver.' }}
      </h1>
      <p>{{ $settings->hero_paragraph ?? 'Adorn Trading PLC brings premium interior finishing, furnishing and building-material solutions to Ethiopia through local project expertise and trusted global sourcing partnerships.' }}</p>
      <div class="hero-actions">
        <a class="btn btn-gold" href="{{ $settings->hero_primary_button_link ?? '#products' }}">{{ $settings->hero_primary_button_text ?? 'Explore Products' }}</a>
        <a class="btn btn-dark" href="{{ $settings->hero_secondary_button_link ?? '#contact' }}">{{ $settings->hero_secondary_button_text ?? 'Request a Quote' }}</a>
      </div>
      <div class="stats">
        <div class="stat"><b>01</b><span>One-stop interior solutions</span></div>
        <div class="stat"><b>02</b><span>Global sourcing model</span></div>
        <div class="stat"><b>03</b><span>Local installation</span></div>
        <div class="stat"><b>04</b><span>Project-focused support</span></div>
      </div>
    </div>
    <div class="hero-card">
      <img src="{{ $resolveImage($settings->hero_image, 'images/hero.jpg') }}" alt="{{ $settings->company_name }}">
      <div class="hero-badge">
        <strong>{{ $settings->hero_badge_title ?? 'ADDIS ABABA · ETHIOPIA' }}</strong>
        {{ $settings->hero_badge_text ?? 'Interior finishing • Procurement • Project management' }}
      </div>
    </div>
  </div>
</section>

<section id="about" class="section">
  <div class="container about-grid">
    <div class="about-image">
      <img src="{{ $resolveImage($settings->about_image, 'images/about.jpg') }}" alt="About {{ $settings->company_name }}">
    </div>
    <div>
      <div class="kicker">{{ $settings->about_kicker ?? 'About Adorn Trading PLC' }}</div>
      <div class="section-head">
        <h2>{{ $settings->about_heading ?? 'A local partner with a global supply vision.' }}</h2>
        <p>{{ $settings->about_body ?? 'Adorn Trading PLC is positioned as an Ethiopian interior finishing and design firm based in Addis Ababa, serving residential villas, commercial offices and multi-unit apartments.' }}</p>
      </div>
      <div class="checks">
        @if($services->isNotEmpty())
          @foreach($services->take(3) as $service)
            <div class="check"><i>✓</i><div><b>{{ $service->title }}</b><br><span>{{ $service->description }}</span></div></div>
          @endforeach
        @else
          <div class="check"><i>✓</i><div><b>Project Management</b><br><span>Client engagement, site measurements, floor plans and coordination.</span></div></div>
          <div class="check"><i>✓</i><div><b>Interior Fitting & Installation</b><br><span>Local physical assembly and installation for completed projects.</span></div></div>
          <div class="check"><i>✓</i><div><b>Global Procurement</b><br><span>Factory sourcing, container consolidation and international supply coordination.</span></div></div>
        @endif
      </div>
    </div>
  </div>
</section>

<section id="products" class="section alt">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Product Portfolio</div>
      <h2>Everything your project needs, coordinated in one place.</h2>
      <p>Our comprehensive portfolio is built around premium architectural finishes and building materials tailored for modern residential and commercial developments.</p>
    </div>
    <div class="products">
      @forelse($products as $product)
        <article class="product">
          @if($product->image)
            <div class="product-img-wrap">
              <img src="{{ $resolveImage($product->image, 'images/products/kitchen-cabinets.jpg') }}" alt="{{ $product->title }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/products/kitchen-cabinets.jpg') }}';">
              <span class="product-number">{{ $product->number_label ?? sprintf('%02d', $loop->iteration) }}</span>
            </div>
          @else
            <div class="number">{{ $product->number_label ?? sprintf('%02d', $loop->iteration) }}</div>
          @endif
          <div class="product-body">
            <h3>{{ $product->title }}</h3>
            <p>{{ $product->description }}</p>
          </div>
        </article>
      @empty
        <article class="product">
          <div class="product-img-wrap">
            <img src="{{ asset('images/products/kitchen-cabinets.jpg') }}" alt="Kitchen Cabinets" loading="lazy">
            <span class="product-number">01</span>
          </div>
          <div class="product-body">
            <h3>Kitchen Cabinets</h3>
            <p>Custom kitchen systems and project-ready cabinetry.</p>
          </div>
        </article>
        <article class="product">
          <div class="product-img-wrap">
            <img src="{{ asset('images/products/wardrobes-closets.jpg') }}" alt="Wardrobes & Closets" loading="lazy">
            <span class="product-number">02</span>
          </div>
          <div class="product-body">
            <h3>Wardrobes & Closets</h3>
            <p>Built-in wardrobe and storage solutions.</p>
          </div>
        </article>
        <article class="product">
          <div class="product-img-wrap">
            <img src="{{ asset('images/products/tiles-surfaces.jpg') }}" alt="Tiles & Surfaces" loading="lazy">
            <span class="product-number">03</span>
          </div>
          <div class="product-body">
            <h3>Tiles & Surfaces</h3>
            <p>Interior surface materials for residential and commercial projects.</p>
          </div>
        </article>
        <article class="product">
          <div class="product-img-wrap">
            <img src="{{ asset('images/products/sanitary-ware.jpg') }}" alt="Sanitary Ware" loading="lazy">
            <span class="product-number">04</span>
          </div>
          <div class="product-body">
            <h3>Sanitary Ware</h3>
            <p>Bathroom fixtures and coordinated sanitary solutions.</p>
          </div>
        </article>
      @endforelse
    </div>
  </div>
</section>

<section id="solutions" class="section">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Interior Solutions</div>
      <h2>From project brief to installation.</h2>
      <p>Our model combines Ethiopian client engagement and site execution with international design, manufacturing and supply-chain support.</p>
    </div>
    @if($services->isNotEmpty())
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 36px;">
        @foreach($services as $service)
          <div style="padding: 24px; border: 1px solid var(--navy-border); border-radius: 20px; background: var(--navy-surface); box-shadow: 0 4px 20px rgba(0,0,0,.25);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(240,207,99,.15); color: var(--gold2); display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
              @if($service->icon && str_starts_with($service->icon, 'heroicon-'))
                <x-dynamic-component :component="$service->icon" style="width: 24px; height: 24px;" />
              @else
                <svg style="width:24px;height:24px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              @endif
            </div>
            <h3 style="margin: 0 0 8px; color: #fff; font-size: 18px; font-weight: 750;">{{ $service->title }}</h3>
            <p style="margin: 0; font-size: 14px; color: var(--muted); line-height: 1.55;">{{ $service->description }}</p>
          </div>
        @endforeach
      </div>
    @endif

    <div class="partner-card" style="margin-top: 36px; margin-bottom: 0;">
      <div class="partner-card-inner">
        <div>
          <h3 style="margin-top: 0;">One coordinated project journey.</h3>
          <p style="margin: 0; font-size: 16px; line-height: 1.6;">We support luxury private villas, real-estate developer mock-up apartments, boutique hotels and commercial offices with dedicated architectural consultation, material selection, and end-to-end execution.</p>
        </div>
        <div>
          <a href="#contact" class="btn btn-gold" style="white-space: nowrap;">Discuss Your Project &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="process" class="section alt">
  <div class="container">
    <div class="section-head">
      <div class="kicker">{{ $settings->process_kicker ?? 'How We Work' }}</div>
      <h2>{{ $settings->process_heading ?? 'A clear five-step workflow.' }}</h2>
      @if($settings->process_intro)
        <p>{{ $settings->process_intro }}</p>
      @endif
    </div>
    <div class="process">
      @forelse($processSteps as $step)
        <div class="step">
          <b>{{ $step->step_label ?? sprintf('STEP %02d', $loop->iteration) }}</b>
          <h3>{{ $step->title }}</h3>
          <p>{{ $step->description }}</p>
        </div>
      @empty
        <div class="step"><b>STEP 01</b><h3>Project Brief</h3><p>Architectural layouts, site measurements and design briefs are shared.</p></div>
        <div class="step"><b>STEP 02</b><h3>Design & Quotation</h3><p>3D renderings, production drawings, itemized BOQ and pricing.</p></div>
        <div class="step"><b>STEP 03</b><h3>Samples & Agreement</h3><p>Materials are reviewed and approved before order confirmation.</p></div>
        <div class="step"><b>STEP 04</b><h3>Production & QC</h3><p>Manufacturing, photo/video QC, export packing and container loading.</p></div>
        <div class="step"><b>STEP 05</b><h3>Delivery & Installation</h3><p>Customs clearance, transport and on-site installation in Ethiopia.</p></div>
      @endforelse
    </div>
  </div>
</section>

<!-- Meet the Team Section -->
<section id="team" class="section">
  <div class="container">
    <div class="section-head">
      <div class="kicker">{{ $settings->team_kicker ?? 'Leadership & Partners' }}</div>
      <h2>{{ $settings->team_heading ?? 'Local leadership with global execution.' }}</h2>
      <p>{{ $settings->team_intro ?? 'Founded by Abdulhamid Sherefa Negashe and Ayub Nuredin Negashe, combining on-the-ground Ethiopian project execution with direct international manufacturing partnerships.' }}</p>
    </div>

    <div class="team-grid">
      @foreach($teamMembers as $member)
        <div class="team-card">
          <div class="team-img-wrap">
            @if($member->photo)
              <img src="{{ $resolveImage($member->photo) }}" alt="{{ $member->name }}">
            @else
              @php
                $initials = collect(explode(' ', $member->name))
                  ->filter()
                  ->map(fn($part) => strtoupper(substr($part, 0, 1)))
                  ->take(2)
                  ->implode('');
              @endphp
              <div class="team-avatar-placeholder">
                {{ $initials ?: 'A' }}
              </div>
            @endif
          </div>
          <div class="team-body">
            <span class="team-role">{{ $member->role }}</span>
            <h3 class="team-name">{{ $member->name }}</h3>
            <p class="team-bio">{{ $member->bio }}</p>
            @if($member->email || $member->linkedin_url)
              <div class="team-meta">
                @if($member->email)
                  <a href="mailto:{{ $member->email }}">
                    <svg style="width:16px;height:16px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Email
                  </a>
                @endif
                @if($member->linkedin_url)
                  <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener noreferrer">
                    <svg style="width:16px;height:16px" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    LinkedIn
                  </a>
                @endif
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <div style="text-align: center; margin-top: 40px;">
      <a href="{{ route('team.index') }}" class="btn btn-dark">Meet Our Full Team &rarr;</a>
    </div>
  </div>
</section>

<section id="showroom" class="section">
  <div class="container">
    <div class="quote">
      <div class="kicker">{{ $settings->quote_kicker ?? 'Showroom & Design Hub' }}</div>
      <h2>{{ $settings->quote_heading ?? 'Experience the materials before you build.' }}</h2>
      <p>{{ $settings->quote_text ?? 'Our Addis Ababa showroom concept is designed to bring kitchens, wardrobes, tiles, sanitary ware, aluminium systems, lighting, furniture and material samples together with consultation and design support.' }}</p>
      <a class="btn btn-gold" href="{{ $settings->quote_button_link ?? '#contact' }}">{{ $settings->quote_button_text ?? 'Plan a Showroom Visit' }}</a>
    </div>
  </div>
</section>

<section class="section alt">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Global Supply Network</div>
      <h2>Built around a local-to-global delivery model.</h2>
      <p>{{ $settings->company_name }} connects Ethiopian builders and developers with direct global manufacturing, securing factory-direct B2B pricing, dedicated account management, material sample kits, and end-to-end supply coordination.</p>
    </div>
    <div class="stats">
      <div class="stat"><b>Ethiopia</b><span>Client engagement, site work, customs and installation</span></div>
      <div class="stat"><b>Global</b><span>Manufacturing, design support and supply coordination</span></div>
      <div class="stat"><b>B2B</b><span>Wholesale sourcing and project-based procurement</span></div>
      <div class="stat"><b>Turnkey</b><span>Full-scope delivery from sourcing to installation</span></div>
    </div>
  </div>
</section>

<section class="section alt" id="gallery">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Visual Inspiration</div>
      <h2>Elegant spaces. Refined details.</h2>
      <p>A premium visual direction for the {{ $settings->company_name }} brand, from luxury kitchens and living spaces to showroom presentation.</p>
    </div>

    @php
      $itemsToDisplay = $galleryItems->isNotEmpty() ? $galleryItems : collect([
        (object)[
          'title' => 'Signature Interiors',
          'caption' => '01 · SIGNATURE INTERIORS',
          'description' => 'Warm wood, marble and architectural lighting in open luxury living spaces.',
          'explanation' => 'Bespoke interior finishing designed for high-end residential villas and luxury apartments. Featuring book-matched Italian marble feature walls, architectural timber acoustic paneling, and layered ambient LED lighting tailored for modern Ethiopian living.',
          'image' => 'images/gallery-1.jpg'
        ],
        (object)[
          'title' => 'Kitchen Solutions',
          'caption' => '02 · KITCHEN SOLUTIONS',
          'description' => 'Premium custom cabinetry, integrated islands, and coordinated kitchen surfaces.',
          'explanation' => 'Turnkey German and Italian inspired kitchen systems crafted with scratch-resistant quartz waterfall countertops, soft-close hardware, integrated hidden appliances, and custom pantry joinery directly sourced from premier manufacturers.',
          'image' => 'images/gallery-2.jpg'
        ],
        (object)[
          'title' => 'Showroom Experience',
          'caption' => '03 · SHOWROOM EXPERIENCE',
          'description' => 'Material sample displays, architectural profiles, and personalized design consultation.',
          'explanation' => 'Our Addis Ababa design hub and showroom brings physical material samples, sanitary fixtures, thermal-break aluminium window profiles, and luxury tile collections together for hands-on evaluation, 3D render review, and consultation before procurement.',
          'image' => 'images/gallery-3.jpg'
        ]
      ]);

      $galleryJson = $itemsToDisplay->values()->map(function($item, $idx) use ($resolveImage) {
        return [
          'index' => $idx,
          'title' => $item->title ?? '',
          'caption' => $item->caption ?? '',
          'description' => $item->description ?? '',
          'explanation' => !empty($item->explanation) ? $item->explanation : ($item->description ?? ''),
          'image' => $resolveImage($item->image ?? 'images/gallery-'.($idx + 1).'.jpg', 'images/gallery-'.($idx + 1).'.jpg')
        ];
      });
    @endphp

    <div class="gallery-grid">
      <!-- Main Slideshow Viewport (Automatic, Clickable to Enlarge) -->
      <div class="gallery-main" id="galleryMain" onclick="openGalleryModal(currentGalleryIndex)" title="Click to enlarge image and view details">
        <div class="gallery-slides">
          @foreach($itemsToDisplay as $item)
            @php
              $imgUrl = $resolveImage($item->image ?? 'images/gallery-'.($loop->iteration).'.jpg', 'images/gallery-'.($loop->iteration).'.jpg');
            @endphp
            <div class="gallery-slide {{ $loop->first ? 'active' : '' }}" data-index="{{ $loop->index }}">
              <img src="{{ $imgUrl }}" alt="{{ $item->title }}">
              <div class="slide-info">
                @if(!empty($item->caption))<small class="slide-kicker">{{ $item->caption }}</small>@endif
                <h3 class="slide-title">{{ $item->title }}</h3>
                @if(!empty($item->description))<p class="slide-desc">{{ $item->description }}</p>@endif
              </div>
            </div>
          @endforeach
        </div>

        <!-- Enlarge / Story Button -->
        <button type="button" class="slide-expand-pill" onclick="event.stopPropagation(); openGalleryModal(currentGalleryIndex);" title="Enlarge image & view explanation">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
          <span>Enlarge &amp; Story</span>
        </button>

        <!-- Previous & Next Arrow Buttons to change image -->
        <button type="button" class="gallery-nav-btn prev" onclick="event.stopPropagation(); prevGallerySlide();" aria-label="Previous Slide">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button type="button" class="gallery-nav-btn next" onclick="event.stopPropagation(); nextGallerySlide();" aria-label="Next Slide">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>

        <!-- Slideshow Indicators & Counter -->
        <div class="gallery-controls-bar">
          <div class="gallery-dots">
            @foreach($itemsToDisplay as $item)
              <button type="button" class="gallery-dot {{ $loop->first ? 'active' : '' }}" onclick="event.stopPropagation(); goToGallerySlide({{ $loop->index }});" aria-label="Go to slide {{ $loop->iteration }}"></button>
            @endforeach
          </div>
          <span class="gallery-counter"><b id="gallerySlideCurrent">01</b> / <small>0{{ count($itemsToDisplay) }}</small></span>
        </div>
      </div>

      <!-- Side Thumbnail Strip -->
      <div class="gallery-side">
        @foreach($itemsToDisplay as $item)
          @php
            $imgUrl = $resolveImage($item->image ?? 'images/gallery-'.($loop->iteration).'.jpg', 'images/gallery-'.($loop->iteration).'.jpg');
          @endphp
          <div class="gallery-card {{ $loop->first ? 'active' : '' }}" data-index="{{ $loop->index }}" onclick="goToGallerySlide({{ $loop->index }})" role="button" tabindex="0" aria-label="View {{ $item->title }}">
            <img src="{{ $imgUrl }}" alt="{{ $item->title }}">
            <span class="card-active-tag">Active</span>
            <div class="card-info">
              @if(!empty($item->caption))<span class="card-caption">{{ $item->caption }}</span>@endif
              <strong class="card-title">{{ $item->title }}</strong>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Gallery Lightbox Modal with Full Image & Detailed Explanation -->
    <div id="galleryModal" class="gallery-modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" tabindex="-1">
      <div class="gallery-modal-backdrop" onclick="closeGalleryModal()"></div>
      <div class="gallery-modal-dialog">
        <button type="button" class="gallery-modal-close" onclick="closeGalleryModal()" aria-label="Close dialog">&times;</button>
        <button type="button" class="modal-nav-btn prev" onclick="prevModalSlide()" aria-label="Previous">&lsaquo;</button>
        <button type="button" class="modal-nav-btn next" onclick="nextModalSlide()" aria-label="Next">&rsaquo;</button>

        <div class="modal-layout">
          <div class="modal-media">
            <img id="modalImg" src="" alt="Enlarged gallery presentation">
            <span class="modal-counter-tag" id="modalCounterTag">01 / 03</span>
          </div>
          <div class="modal-content">
            <div class="modal-kicker" id="modalKicker">01 · SIGNATURE INTERIORS</div>
            <h3 class="modal-title" id="modalTitle">Signature Interiors</h3>
            <div class="modal-desc" id="modalDesc">Warm wood, marble and architectural lighting in open luxury living spaces.</div>
            
            <div class="modal-divider"></div>
            
            <div class="modal-section-label">Design &amp; Material Story</div>
            <p class="modal-explanation" id="modalExplanation">Detailed explanation of the interior architectural finishings, custom joinery, imported surfaces, and turnkey installation executed by Adorn Trading PLC.</p>

            <div class="modal-highlights">
              <span class="highlight-tag">Architectural Grade</span>
              <span class="highlight-tag">Bespoke Manufacturing</span>
              <span class="highlight-tag">Direct B2B Pricing</span>
              <span class="highlight-tag">Turnkey Execution</span>
            </div>

            <div class="modal-actions">
              <a href="#contact" class="btn btn-gold modal-cta" onclick="closeGalleryModal()">Inquire About This Style For Your Project &rarr;</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function() {
    const galleryItems = {!! json_encode($galleryJson) !!};

    let currentSlide = 0;
    let autoplayInterval = null;
    const AUTOPLAY_DELAY = 5000;

    const slides = document.querySelectorAll('.gallery-slide');
    const cards = document.querySelectorAll('.gallery-side .gallery-card');
    const dots = document.querySelectorAll('.gallery-dot');
    const counterEl = document.getElementById('gallerySlideCurrent');
    const mainContainer = document.getElementById('galleryMain');

    const modal = document.getElementById('galleryModal');
    const modalImg = document.getElementById('modalImg');
    const modalCounterTag = document.getElementById('modalCounterTag');
    const modalKicker = document.getElementById('modalKicker');
    const modalTitle = document.getElementById('modalTitle');
    const modalDesc = document.getElementById('modalDesc');
    const modalExplanation = document.getElementById('modalExplanation');

    window.currentGalleryIndex = 0;

    function updateSlideView(index) {
      currentSlide = (index + galleryItems.length) % galleryItems.length;

      slides.forEach((s, idx) => {
        s.classList.toggle('active', idx === currentSlide);
      });

      cards.forEach((c, idx) => {
        c.classList.toggle('active', idx === currentSlide);
      });

      dots.forEach((d, idx) => {
        d.classList.toggle('active', idx === currentSlide);
      });

      if (counterEl) {
        counterEl.textContent = String(currentSlide + 1).padStart(2, '0');
      }

      window.currentGalleryIndex = currentSlide;
    }

    window.goToGallerySlide = function(idx) {
      updateSlideView(idx);
      resetAutoplay();
    };

    window.nextGallerySlide = function() {
      updateSlideView(currentSlide + 1);
      resetAutoplay();
    };

    window.prevGallerySlide = function() {
      updateSlideView(currentSlide - 1);
      resetAutoplay();
    };

    function startAutoplay() {
      if (autoplayInterval) clearInterval(autoplayInterval);
      autoplayInterval = setInterval(() => {
        updateSlideView(currentSlide + 1);
      }, AUTOPLAY_DELAY);
    }

    function stopAutoplay() {
      if (autoplayInterval) {
        clearInterval(autoplayInterval);
        autoplayInterval = null;
      }
    }

    function resetAutoplay() {
      stopAutoplay();
      startAutoplay();
    }

    if (mainContainer) {
      mainContainer.addEventListener('mouseenter', stopAutoplay);
      mainContainer.addEventListener('mouseleave', startAutoplay);
    }

    // Modal Lightbox Functions
    function syncModalContent(idx) {
      const item = galleryItems[idx];
      if (!item) return;

      if (modalImg) {
        modalImg.src = item.image;
        modalImg.alt = item.title;
      }
      if (modalCounterTag) {
        modalCounterTag.textContent = `${String(idx + 1).padStart(2, '0')} / ${String(galleryItems.length).padStart(2, '0')}`;
      }
      if (modalKicker) modalKicker.textContent = item.caption || `0${idx + 1} · SHOWCASE`;
      if (modalTitle) modalTitle.textContent = item.title;
      if (modalDesc) modalDesc.textContent = item.description;
      if (modalExplanation) modalExplanation.textContent = item.explanation || item.description;
    }

    window.openGalleryModal = function(idx) {
      const targetIdx = typeof idx === 'number' ? idx : currentSlide;
      updateSlideView(targetIdx);
      syncModalContent(targetIdx);
      stopAutoplay();

      if (modal) {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
      }
    };

    window.closeGalleryModal = function() {
      if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
      }
      startAutoplay();
    };

    window.nextModalSlide = function() {
      const nextIdx = (currentSlide + 1) % galleryItems.length;
      updateSlideView(nextIdx);
      syncModalContent(nextIdx);
    };

    window.prevModalSlide = function() {
      const prevIdx = (currentSlide - 1 + galleryItems.length) % galleryItems.length;
      updateSlideView(prevIdx);
      syncModalContent(prevIdx);
    };

    // Keyboard support: Escape closes modal, Arrow keys navigate
    document.addEventListener('keydown', function(e) {
      if (modal && modal.classList.contains('show')) {
        if (e.key === 'Escape') {
          closeGalleryModal();
        } else if (e.key === 'ArrowRight') {
          nextModalSlide();
        } else if (e.key === 'ArrowLeft') {
          prevModalSlide();
        }
      }
    });

    // Initialize
    updateSlideView(0);
    startAutoplay();
  })();
</script>

<section id="contact" class="section">
  <div class="container contact-grid">
    <div>
      <div class="kicker">{{ $settings->contact_kicker ?? 'Start a Project' }}</div>
      <div class="section-head">
        <h2>{{ $settings->contact_heading ?? 'Tell us what you are building.' }}</h2>
        <p>{{ $settings->contact_intro ?? 'Send your project type, location, drawings or material requirements. Adorn Trading PLC can coordinate the next step.' }}</p>
      </div>
      <div class="contact-card">
        <div class="contact-item"><small>Company</small><b>{{ $settings->contact_company ?? $settings->company_name }}</b></div>
        <div class="contact-item"><small>Location</small><b>{{ $settings->contact_address ?? 'Addis Ababa, Ethiopia' }}</b></div>
        @php
          $primaryContacts = $teamMembers->where('featured', true)->take(2);
        @endphp
        <div class="contact-item">
          <small>Founders / Primary Contacts</small>
          <b>
            @if($primaryContacts->isNotEmpty())
              {!! $primaryContacts->pluck('name')->implode('<br>') !!}
            @else
              Abdulhamid Sherefa Negashe<br>Ayub Nuredin Negashe
            @endif
          </b>
        </div>
        <div class="contact-item"><small>Phone / WhatsApp</small><span>{{ $settings->contact_phone ?? '+251 9… / +251 7…' }}</span></div>
        <div class="contact-item"><small>Email</small><span><a href="mailto:{{ $settings->contact_email ?? 'info@adorntrading.com' }}">{{ $settings->contact_email ?? 'info@adorntrading.com' }}</a></span></div>
      </div>
    </div>
    <div class="contact-card">
      <form onsubmit="event.preventDefault(); alert('Thank you for contacting Adorn Trading PLC. We will reach out to you shortly.');">
        <input required placeholder="Full name">
        <input type="text" placeholder="Company / organization">
        <input required type="tel" placeholder="Phone / WhatsApp">
        <select><option>Project type</option><option>Private Villa</option><option>Apartment / Real Estate</option><option>Hotel</option><option>Commercial Office</option><option>Other</option></select>
        <textarea required placeholder="Tell us what you need — kitchen, wardrobe, tiles, sanitary ware, lighting, furniture, full interior finishing, etc."></textarea>
        <button class="btn btn-gold" type="submit">Request a Consultation</button>
      </form>
    </div>
  </div>
</section>
@endsection
