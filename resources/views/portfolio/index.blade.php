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
<meta name="description" content="Explore our portfolio of luxury residential villas, developer mock-up apartments, and commercial projects in Addis Ababa, Ethiopia.">
<title>Portfolio & Projects | {{ $settings->company_name ?? 'Adron Trading PLC' }}</title>
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

.page-hero{
  padding:170px 0 70px;
  background:
    radial-gradient(circle at 80% 20%,rgba(201,162,39,.14),transparent 30%),
    linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%);
  text-align:center;
}
.kicker{display:inline-flex;gap:10px;align-items:center;color:var(--gold);font-weight:800;letter-spacing:.18em;font-size:12px;text-transform:uppercase}
.kicker:before{content:"";width:34px;height:2px;background:var(--gold)}
h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(40px,5vw,64px);line-height:1.1;color:var(--navy);margin:14px 0}
.page-hero p{font-size:18px;color:#536071;max-width:720px;margin:0 auto 24px}

.section{padding:90px 0}
.portfolio-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:30px;
}
.project-card{
  background:#fff;
  border:1px solid var(--line);
  border-radius:22px;
  overflow:hidden;
  box-shadow:0 10px 30px rgba(7,26,58,.06);
  transition:transform .3s ease,box-shadow .3s ease;
  display:flex;
  flex-direction:column;
  position:relative;
}
.project-card:hover{
  transform:translateY(-6px);
  box-shadow:var(--shadow);
}
.project-img-wrap{
  position:relative;
  width:100%;
  aspect-ratio:16/10;
  background:linear-gradient(135deg,var(--navy),var(--navy2));
  overflow:hidden;
}
.project-img-wrap img{
  width:100%;
  height:100%;
  object-fit:cover;
  transition:transform .4s ease;
}
.project-card:hover .project-img-wrap img{
  transform:scale(1.04);
}
.project-badge{
  position:absolute;
  top:16px;
  left:16px;
  z-index:2;
  background:rgba(7,26,58,.88);
  backdrop-filter:blur(8px);
  color:#fff;
  font-size:11px;
  font-weight:800;
  letter-spacing:.08em;
  text-transform:uppercase;
  padding:5px 12px;
  border-radius:999px;
  border:1px solid rgba(255,255,255,.2);
}
.project-featured{
  position:absolute;
  top:16px;
  right:16px;
  z-index:2;
  background:var(--gold);
  color:#111;
  font-size:11px;
  font-weight:800;
  letter-spacing:.08em;
  text-transform:uppercase;
  padding:5px 12px;
  border-radius:999px;
}
.project-body{
  padding:26px;
  flex:1;
  display:flex;
  flex-direction:column;
}
.project-category{
  color:var(--gold);
  font-size:12px;
  font-weight:800;
  letter-spacing:.12em;
  text-transform:uppercase;
  margin-bottom:8px;
}
.project-title{
  color:var(--navy);
  font-family:Georgia,serif;
  font-size:22px;
  font-weight:700;
  margin:0 0 12px;
  line-height:1.25;
}
.project-title a:hover{
  color:var(--gold);
}
.project-excerpt{
  color:var(--muted);
  font-size:14px;
  line-height:1.6;
  margin:0 0 20px;
  flex:1;
}
.project-meta{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-top:auto;
  padding-top:16px;
  border-top:1px solid var(--line);
  font-size:13px;
  color:var(--muted);
}
.project-link{
  display:inline-flex;
  align-items:center;
  gap:6px;
  font-weight:750;
  color:var(--navy);
  font-size:13px;
  transition:color .2s ease;
}
.project-link:hover{
  color:var(--gold);
}

.cta-banner{
  background:linear-gradient(135deg,#071a3a,#0e397c);
  color:#fff;
  border-radius:28px;
  padding:55px 40px;
  text-align:center;
  margin-top:70px;
}
.cta-banner h2{font-family:Georgia,serif;font-size:38px;margin:0 0 14px;color:#fff}
.cta-banner p{color:#d6deea;max-width:640px;margin:0 auto 28px;font-size:16px}

.footer{background:#06152f;color:#c9d2e1;padding:55px 0 25px}
.footer-grid{display:grid;grid-template-columns:1.2fr .8fr .8fr;gap:40px}
.footer h3{color:#fff;margin-top:0}
.footer-logo{width:76px;border-radius:12px;margin-bottom:12px}
.footer a:hover{color:var(--gold2)}
.copyright{border-top:1px solid rgba(255,255,255,.12);margin-top:35px;padding-top:20px;font-size:12px;color:#8fa0b9}

@media(max-width:900px){
 .nav-links{display:none;position:absolute;top:78px;left:0;right:0;background:#fff;padding:20px;flex-direction:column;align-items:flex-start;border-bottom:1px solid var(--line)}
 .nav-links.open{display:flex}.menu{display:block}.nav .btn{display:none}
 .portfolio-grid{grid-template-columns:repeat(2,1fr);gap:20px}
 .footer-grid{grid-template-columns:1fr;gap:22px}
}
@media(max-width:560px){
 .page-hero{padding:130px 0 45px}
 .section{padding:50px 0}
 .portfolio-grid{grid-template-columns:1fr}
 .cta-banner{padding:35px 20px}
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
