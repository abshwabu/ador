@php
    $resolveImage = function (?string $path, string $fallback = 'images/hero.jpg') {
        if (! $path) return asset($fallback);
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'data:')) return $path;
        if (str_starts_with($path, 'images/')) return asset($path);
        return asset('storage/' . $path);
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="description" content="{{ $project->excerpt ?? ($project->title . ' — Project by ' . ($settings->company_name ?? 'Adron Trading PLC')) }}">
<title>{{ $project->title }} | {{ $settings->company_name ?? 'Adron Trading PLC' }}</title>
@if($settings->favicon)
<link rel="icon" href="{{ $resolveImage($settings->favicon) }}">
@endif
<style>
:root{
  --navy:#071a3a;
  --navy2:#0b2d63;
  --gold:#c9a227;
  --gold2:#f0cf63;
  --ink:#111827;
  --muted:#667085;
  --cream:#f7f4ed;
  --white:#fff;
  --line:#e7e3da;
  --shadow:0 20px 60px rgba(7,26,58,.12);
  --radius:22px;
}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:var(--ink);background:#fff;line-height:1.6}
a{text-decoration:none;color:inherit}
img{max-width:100%;display:block}
.container{width:min(1180px,92%);margin:auto}
.nav{position:fixed;top:0;left:0;right:0;z-index:20;background:rgba(255,255,255,.92);backdrop-filter:blur(14px);border-bottom:1px solid rgba(231,227,218,.8)}
.nav-inner{height:88px;display:flex;align-items:center;justify-content:space-between}
.brand{display:flex;align-items:center;gap:12px;font-weight:800;letter-spacing:.08em}
.brand img{width:72px;height:72px;object-fit:contain;border-radius:12px}
.brand span{font-size:15px;color:var(--navy)}
.nav-links{display:flex;gap:28px;align-items:center;font-size:14px;font-weight:650}
.nav-links a:hover{color:var(--gold)}
.btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 20px;border-radius:999px;font-weight:750;font-size:14px;border:1px solid transparent;cursor:pointer;transition:.25s}
.btn-gold{background:var(--gold);color:#111}
.btn-gold:hover{transform:translateY(-2px);background:var(--gold2)}
.btn-dark{background:var(--navy);color:#fff}
.btn-outline{border-color:rgba(7,26,58,.3);color:var(--navy)}
.btn-outline:hover{background:var(--navy);color:#fff}
.menu{display:none;background:none;border:0;font-size:26px}

.project-hero{
  padding:160px 0 45px;
  background:
    radial-gradient(circle at 80% 20%,rgba(201,162,39,.12),transparent 30%),
    linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%);
}
.breadcrumbs{
  font-size:13px;
  font-weight:600;
  color:var(--muted);
  margin-bottom:20px;
  display:flex;
  align-items:center;
  gap:8px;
  flex-wrap:wrap;
}
.breadcrumbs a:hover{
  color:var(--gold);
}
.kicker{display:inline-flex;gap:10px;align-items:center;color:var(--gold);font-weight:800;letter-spacing:.18em;font-size:12px;text-transform:uppercase}
.kicker:before{content:"";width:34px;height:2px;background:var(--gold)}
h1.project-title{
  font-family:Georgia,"Times New Roman",serif;
  font-size:clamp(36px,5.5vw,56px);
  line-height:1.12;
  color:var(--navy);
  margin:12px 0 18px;
}
.project-lead{
  font-size:18px;
  color:#4a5568;
  max-width:820px;
  line-height:1.65;
  margin:0 0 32px;
}

.meta-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:16px;
  margin-top:24px;
}
.meta-item{
  padding:20px;
  background:#fff;
  border:1px solid var(--line);
  border-radius:18px;
  box-shadow:0 4px 15px rgba(7,26,58,.03);
}
.meta-item small{
  display:block;
  color:var(--muted);
  font-size:11px;
  text-transform:uppercase;
  letter-spacing:.12em;
  font-weight:700;
  margin-bottom:4px;
}
.meta-item b{
  display:block;
  font-size:16px;
  color:var(--navy);
}

.cover-wrapper{
  margin-top:40px;
  border-radius:26px;
  overflow:hidden;
  border:6px solid #fff;
  box-shadow:var(--shadow);
  position:relative;
  background:#071a3a;
}
.cover-wrapper img{
  width:100%;
  max-height:580px;
  object-fit:cover;
}

.section{padding:80px 0}
.section.alt{background:var(--cream)}
.section-head{max-width:760px;margin-bottom:36px}
.section-head h2{font-family:Georgia,serif;font-size:38px;line-height:1.15;color:var(--navy);margin:10px 0 12px}
.section-head p{color:var(--muted);font-size:16px}

.project-content-wrap{
  max-width:860px;
  margin:0 auto;
  font-size:17px;
  line-height:1.8;
  color:#2d3748;
}
.project-content-wrap p{
  margin-bottom:24px;
}

.gallery-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(340px,1fr));
  gap:24px;
}
.gallery-card{
  background:#fff;
  border-radius:20px;
  overflow:hidden;
  border:1px solid var(--line);
  box-shadow:0 10px 30px rgba(7,26,58,.05);
  transition:transform .3s ease,box-shadow .3s ease;
  display:flex;
  flex-direction:column;
}
.gallery-card:hover{
  transform:translateY(-4px);
  box-shadow:var(--shadow);
}
.gallery-img-wrap{
  position:relative;
  width:100%;
  aspect-ratio:16/11;
  background:#071a3a;
  overflow:hidden;
}
.gallery-img-wrap img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:transform .4s ease;
}
.gallery-card:hover .gallery-img-wrap img{
  transform:scale(1.04);
}
.gallery-caption{
  padding:16px 20px;
  font-size:13px;
  font-weight:600;
  color:var(--navy);
  border-top:1px solid var(--line);
  background:#fff;
}

.related-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:26px;
}
.related-card{
  background:#fff;
  border:1px solid var(--line);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 8px 24px rgba(7,26,58,.05);
  transition:transform .25s ease;
  display:flex;
  flex-direction:column;
}
.related-card:hover{
  transform:translateY(-4px);
  box-shadow:var(--shadow);
}
.related-card img{
  width:100%;
  aspect-ratio:16/10;
  object-fit:cover;
}
.related-body{
  padding:20px;
  flex:1;
  display:flex;
  flex-direction:column;
}
.related-category{
  color:var(--gold);
  font-size:11px;
  font-weight:800;
  letter-spacing:.1em;
  text-transform:uppercase;
  margin-bottom:6px;
}
.related-title{
  color:var(--navy);
  font-size:17px;
  font-weight:750;
  margin:0 0 8px;
}
.related-title a:hover{
  color:var(--gold);
}

.cta-banner{
  background:linear-gradient(135deg,#071a3a,#0e397c);
  color:#fff;
  border-radius:28px;
  padding:50px 36px;
  text-align:center;
  margin-top:60px;
}
.cta-banner h2{font-family:Georgia,serif;font-size:36px;margin:0 0 12px;color:#fff}
.cta-banner p{color:#d6deea;max-width:620px;margin:0 auto 24px}

.footer{background:#06152f;color:#c9d2e1;padding:55px 0 25px}
.footer-grid{display:grid;grid-template-columns:1.2fr .8fr .8fr;gap:40px}
.footer h3{color:#fff;margin-top:0}
.footer-logo{width:76px;border-radius:12px;margin-bottom:12px}
.footer a:hover{color:var(--gold2)}
.copyright{border-top:1px solid rgba(255,255,255,.12);margin-top:35px;padding-top:20px;font-size:12px;color:#8fa0b9}

@media(max-width:900px){
 .nav-links{display:none;position:absolute;top:78px;left:0;right:0;background:#fff;padding:20px;flex-direction:column;align-items:flex-start;border-bottom:1px solid var(--line)}
 .nav-links.open{display:flex}.menu{display:block}.nav .btn{display:none}
 .meta-grid{grid-template-columns:repeat(2,1fr)}
 .related-grid{grid-template-columns:repeat(2,1fr)}
 .footer-grid{grid-template-columns:1fr;gap:22px}
}
@media(max-width:560px){
 .project-hero{padding:120px 0 35px}
 .section{padding:50px 0}
 .meta-grid,.related-grid,.gallery-grid{grid-template-columns:1fr}
 .cover-wrapper{border-width:4px}
 .cta-banner{padding:30px 18px}
 .cta-banner h2{font-size:28px}
}

/* Extra-large brand logo rules */
.brand { gap: 16px !important; align-items: center !important; }
.brand img { width: 120px !important; height: 120px !important; max-width: none !important; object-fit: contain !important; border-radius: 14px !important; }
.brand span { font-size: 16px !important; font-weight: 850 !important; }
.nav-inner { min-height: 130px !important; height: 130px !important; }
.nav-links { top: 130px !important; }
@media (max-width: 900px) {
  .nav-inner { min-height: 108px !important; height: 108px !important; }
  .nav-links { top: 108px !important; }
  .brand img { width: 92px !important; height: 92px !important; }
  .brand span { font-size: 14px !important; }
}
@media (max-width: 560px) {
  .nav-inner { min-height: 94px !important; height: 94px !important; }
  .nav-links { top: 94px !important; }
  .brand { gap: 9px !important; min-width: 0; }
  .brand img { width: 76px !important; height: 76px !important; }
  .brand span { font-size: 10px !important; line-height: 1.15 !important; max-width: 135px; }
}
@media (max-width: 380px) {
  .brand img { width: 68px !important; height: 68px !important; }
  .brand span { display:none; }
}
</style>
</head>
<body>

<header class="nav">
  <div class="container nav-inner">
    <a class="brand" href="{{ route('home') }}#home">
      <img src="{{ $resolveImage($settings->logo, 'images/logo.png') }}" alt="{{ $settings->company_name }}">
      <span>{{ $settings->company_name }}</span>
    </a>
    <button class="menu" aria-label="Open menu" onclick="document.querySelector('.nav-links').classList.toggle('open')">☰</button>
    <nav class="nav-links">
      <a href="{{ route('home') }}#about">About</a>
      <a href="{{ route('home') }}#products">Products</a>
      <a href="{{ route('home') }}#solutions">Solutions</a>
      <a href="{{ route('portfolio.index') }}" style="color: var(--gold);">Portfolio</a>
      <a href="{{ route('home') }}#process">How We Work</a>
      <a href="{{ route('team.index') }}">Team</a>
      <a href="{{ route('home') }}#showroom">Showroom</a>
      <a href="{{ route('home') }}#contact" class="btn btn-dark">Request a Quote</a>
    </nav>
  </div>
</header>

<main>
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
</main>

<footer class="footer">
  <div class="container footer-grid">
    <div>
      <img class="footer-logo" src="{{ $resolveImage($settings->logo, 'images/logo.png') }}" alt="{{ $settings->company_name }}">
      <p>{{ $settings->tagline ?? 'Design. Source. Deliver.' }}</p>
      <p>{{ $settings->footer_about ?? 'Premium interior finishing, procurement and project support for Ethiopia.' }}</p>
    </div>
    <div>
      <h3>Explore</h3>
      <p><a href="{{ route('home') }}#about">About</a></p>
      <p><a href="{{ route('home') }}#products">Products</a></p>
      <p><a href="{{ route('home') }}#solutions">Solutions</a></p>
      <p><a href="{{ route('portfolio.index') }}">Portfolio</a></p>
      <p><a href="{{ route('team.index') }}">Team</a></p>
    </div>
    <div>
      <h3>Contact</h3>
      <p>{{ $settings->contact_address ?? 'Addis Ababa, Ethiopia' }}</p>
      <p>{{ $settings->contact_phone ?? '+251 9… / +251 7…' }}</p>
      <p><a href="mailto:{{ $settings->contact_email ?? 'info@adrontrading.com' }}">{{ $settings->contact_email ?? 'info@adrontrading.com' }}</a></p>
    </div>
  </div>
  <div class="container copyright">{{ $settings->footer_copyright ?? '© 2026 Adron Trading PLC. All rights reserved.' }}</div>
</footer>

<script>
window.addEventListener('scroll',()=> {
  const n=document.querySelector('.nav');
  n.style.boxShadow=window.scrollY>10?'0 8px 30px rgba(7,26,58,.08)':'none';
});
document.querySelectorAll('.nav-links a').forEach(a=>a.addEventListener('click',()=>document.querySelector('.nav-links').classList.remove('open')));
</script>
</body>
</html>
