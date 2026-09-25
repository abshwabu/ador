@extends('layouts.app')

@section('title', 'Our Team | ' . ($settings->company_name ?? 'Adorn Trading PLC'))
@section('meta_description', 'Meet the leadership and team behind ' . ($settings->company_name ?? 'Adorn Trading PLC') . '. Design. Source. Deliver.')

@section('content')
<section class="page-hero">
  <div class="container">
    <div class="kicker">{{ $settings->team_kicker ?? 'Leadership & Partners' }}</div>
    <h1>{{ $settings->team_heading ?? 'Our Leadership & Team' }}</h1>
    <p>{{ $settings->team_intro ?? 'Local Ethiopian project execution combined with direct international manufacturing partnerships.' }}</p>
    <div>
      <a href="{{ route('home') }}" class="btn btn-outline">&larr; Back to Home</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="team-grid">
      @forelse($teamMembers as $member)
        <div class="team-card">
          @if($member->featured)
            <span class="team-featured-badge">Featured</span>
          @endif
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
      @empty
        <p>No team members listed at this time.</p>
      @endforelse
    </div>

    <div class="cta-banner">
      <h2>Start a Project with Us</h2>
      <p>Whether you're developing luxury villas, multi-unit apartments, or commercial spaces, our team is ready to bring your vision to life.</p>
      <a href="{{ route('home') }}#contact" class="btn btn-gold">Discuss Your Project</a>
    </div>
  </div>
</section>
@endsection
