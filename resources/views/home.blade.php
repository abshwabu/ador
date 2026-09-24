@extends('layouts.app')

@section('title', $settings->meta_title ?? 'Adron Trading PLC | Design. Source. Deliver.')
@section('meta_description', $settings->meta_description ?? 'Adron Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.')

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
      <p>{{ $settings->hero_paragraph ?? 'Adron Trading PLC brings premium interior finishing, furnishing and building-material solutions to Ethiopia through local project expertise and trusted global sourcing partnerships.' }}</p>
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
      <div class="kicker">{{ $settings->about_kicker ?? 'About Adron Trading PLC' }}</div>
      <div class="section-head">
        <h2>{{ $settings->about_heading ?? 'A local partner with a global supply vision.' }}</h2>
        <p>{{ $settings->about_body ?? 'Adron Trading PLC is positioned as an Ethiopian interior finishing and design firm based in Addis Ababa, serving residential villas, commercial offices and multi-unit apartments.' }}</p>
      </div>
      <div class="checks">
        <div class="check"><i>✓</i><div><b>Project Management</b><br><span>Client engagement, site measurements, floor plans and coordination.</span></div></div>
        <div class="check"><i>✓</i><div><b>Interior Fitting & Installation</b><br><span>Local physical assembly and installation for completed projects.</span></div></div>
        <div class="check"><i>✓</i><div><b>Global Procurement</b><br><span>Factory sourcing, container consolidation and international supply coordination.</span></div></div>
      </div>
    </div>
  </div>
</section>

<section id="products" class="section alt">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Product Portfolio</div>
      <h2>Everything your project needs, coordinated in one place.</h2>
      <p>Our proposed portfolio is built around the categories identified in the {{ $settings->company_name }}–George Group partnership proposal.</p>
    </div>
    <div class="products">
      @forelse($products as $product)
        <article class="product">
          <div class="number">{{ $product->number_label ?? sprintf('%02d', $loop->iteration) }}</div>
          <h3>{{ $product->title }}</h3>
          <p>{{ $product->description }}</p>
        </article>
      @empty
        <article class="product"><div class="number">01</div><h3>Kitchen Cabinets</h3><p>Custom kitchen systems and project-ready cabinetry.</p></article>
        <article class="product"><div class="number">02</div><h3>Wardrobes & Closets</h3><p>Built-in wardrobe and storage solutions.</p></article>
        <article class="product"><div class="number">03</div><h3>Tiles & Surfaces</h3><p>Interior surface materials for residential and commercial projects.</p></article>
        <article class="product"><div class="number">04</div><h3>Sanitary Ware</h3><p>Bathroom fixtures and coordinated sanitary solutions.</p></article>
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
    <div class="partner">
      <div>
        <img src="{{ asset('images/solutions.jpg') }}" alt="Interior Solutions">
      </div>
      <div class="partner-card">
        <h3>One coordinated project journey.</h3>
        <p>We support luxury private villas, real-estate developer mock-up apartments, boutique hotels and commercial offices.</p>
        <a href="#contact" class="btn btn-gold">Discuss Your Project</a>
      </div>
    </div>

    @if($services->isNotEmpty())
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 40px;">
        @foreach($services as $service)
          <div style="padding: 24px; border: 1px solid var(--line); border-radius: 20px; background: #fff; box-shadow: 0 4px 20px rgba(7,26,58,.04);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(201,162,39,.12); color: var(--gold); display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
              @if($service->icon && str_starts_with($service->icon, 'heroicon-'))
                <x-dynamic-component :component="$service->icon" style="width: 24px; height: 24px;" />
              @else
                <svg style="width:24px;height:24px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              @endif
            </div>
            <h3 style="margin: 0 0 8px; color: var(--navy); font-size: 18px; font-weight: 750;">{{ $service->title }}</h3>
            <p style="margin: 0; font-size: 14px; color: var(--muted); line-height: 1.55;">{{ $service->description }}</p>
          </div>
        @endforeach
      </div>
    @endif
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
      <div class="kicker">Global Partnership</div>
      <h2>Built around a local-to-global partnership model.</h2>
      <p>{{ $settings->company_name }}’s proposal to George Group China in Foshan requests dedicated account management, factory-direct B2B pricing, sample kits and co-branding support.</p>
    </div>
    <div class="stats">
      <div class="stat"><b>Ethiopia</b><span>Client engagement, site work, customs and installation</span></div>
      <div class="stat"><b>Foshan</b><span>Manufacturing, design support and supply coordination</span></div>
      <div class="stat"><b>B2B</b><span>Wholesale sourcing and project-based procurement</span></div>
      <div class="stat"><b>Q4 2026</b><span>Proposed pilot project timeline</span></div>
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
    @if($galleryItems->isNotEmpty())
      @php
        $firstGallery = $galleryItems->first();
        $otherGalleries = $galleryItems->slice(1);
      @endphp
      <div class="gallery-grid">
        <div class="gallery-main">
          <img src="{{ $resolveImage($firstGallery->image, 'images/gallery-1.jpg') }}" alt="{{ $firstGallery->title }}">
          <div>
            @if($firstGallery->caption)<small>{{ $firstGallery->caption }}</small>@endif
            @if($firstGallery->description)<b>{{ $firstGallery->description }}</b>@endif
          </div>
        </div>
        <div class="gallery-side">
          @foreach($otherGalleries as $gallery)
            <div class="gallery-card">
              <img src="{{ $resolveImage($gallery->image, 'images/gallery-' . ($loop->iteration + 1) . '.jpg') }}" alt="{{ $gallery->title }}">
              @if($gallery->caption)<span>{{ $gallery->caption }}</span>@endif
            </div>
          @endforeach
        </div>
      </div>
    @else
      <div class="gallery-grid">
        <div class="gallery-main"><img src="{{ asset('images/gallery-1.jpg') }}" alt="Signature Interiors"><div><small>01 · SIGNATURE INTERIORS</small><b>Warm wood, marble and architectural lighting</b></div></div>
        <div class="gallery-side">
          <div class="gallery-card"><img src="{{ asset('images/gallery-2.jpg') }}" alt="Kitchen Solutions"><span>02 · KITCHEN SOLUTIONS</span></div>
          <div class="gallery-card"><img src="{{ asset('images/gallery-3.jpg') }}" alt="Showroom Experience"><span>03 · SHOWROOM EXPERIENCE</span></div>
        </div>
      </div>
    @endif
  </div>
</section>

<section id="contact" class="section">
  <div class="container contact-grid">
    <div>
      <div class="kicker">{{ $settings->contact_kicker ?? 'Start a Project' }}</div>
      <div class="section-head">
        <h2>{{ $settings->contact_heading ?? 'Tell us what you are building.' }}</h2>
        <p>{{ $settings->contact_intro ?? 'Send your project type, location, drawings or material requirements. Adron Trading PLC can coordinate the next step.' }}</p>
      </div>
      <div class="contact-card">
        <div class="contact-item"><small>Company</small><b>{{ $settings->contact_company ?? $settings->company_name }}</b></div>
        <div class="contact-item"><small>Location</small><b>{{ $settings->contact_address ?? 'Addis Ababa, Ethiopia' }}</b></div>
        <div class="contact-item"><small>Founders / Primary Contacts</small><b>Abdulhamid Sherefa Negashe<br>Ayub Nuredin Negashe</b></div>
        <div class="contact-item"><small>Phone / WhatsApp</small><span>{{ $settings->contact_phone ?? '+251 9… / +251 7…' }}</span></div>
        <div class="contact-item"><small>Email</small><span><a href="mailto:{{ $settings->contact_email ?? 'info@adrontrading.com' }}">{{ $settings->contact_email ?? 'info@adrontrading.com' }}</a></span></div>
      </div>
    </div>
    <div class="contact-card">
      <form onsubmit="event.preventDefault(); alert('Thank you for contacting Adron Trading PLC. We will reach out to you shortly.');">
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
