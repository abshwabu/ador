@php
    $resolveImage = function (?string $path, string $fallback = '') {
        if (! $path) return $fallback ? asset($fallback) : '';
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
<meta name="description" content="{{ $settings->meta_description ?? 'Adron Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.' }}">
<title>{{ $settings->meta_title ?? 'Adron Trading PLC | Design. Source. Deliver.' }}</title>
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
.btn-outline{border-color:rgba(255,255,255,.45);color:#fff}
.menu{display:none;background:none;border:0;font-size:26px}
.hero{padding:150px 0 90px;background:
 radial-gradient(circle at 80% 20%,rgba(201,162,39,.16),transparent 30%),
 linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%)}
.hero-grid{display:grid;grid-template-columns:1.02fr .98fr;gap:54px;align-items:center}
.kicker{display:inline-flex;gap:10px;align-items:center;color:var(--gold);font-weight:800;letter-spacing:.18em;font-size:12px;text-transform:uppercase}
.kicker:before{content:"";width:34px;height:2px;background:var(--gold)}
h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(46px,6vw,78px);line-height:1.02;color:var(--navy);margin:18px 0}
.hero h1 span{color:var(--gold)}
.hero p{font-size:18px;color:#536071;max-width:650px}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:28px}
.hero-card{border-radius:28px;overflow:hidden;box-shadow:var(--shadow);border:7px solid #fff;position:relative}
.hero-card img{aspect-ratio:1.15/1;object-fit:cover}
.hero-badge{position:absolute;left:20px;bottom:20px;background:rgba(7,26,58,.9);color:#fff;padding:16px 18px;border-radius:16px;max-width:260px}
.hero-badge strong{display:block;color:var(--gold2);font-size:13px;margin-bottom:3px}
.section{padding:100px 0}
.section.alt{background:var(--cream)}
.section-head{max-width:760px;margin-bottom:42px}
.section-head h2{font-family:Georgia,serif;font-size:44px;line-height:1.1;color:var(--navy);margin:10px 0 14px}
.section-head p{color:var(--muted);font-size:17px}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:36px}
.stat{padding:25px;border:1px solid var(--line);border-radius:18px;background:#fff}
.stat b{display:block;font-size:28px;color:var(--navy)}
.stat span{color:var(--muted);font-size:13px}
.products{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.product{min-height:210px;border-radius:20px;padding:24px;background:linear-gradient(145deg,var(--navy),var(--navy2));color:#fff;position:relative;overflow:hidden}
.product:after{content:"A";position:absolute;right:-8px;bottom:-30px;font:900 150px Georgia;color:rgba(255,255,255,.06)}
.product h3{margin:0 0 8px;font-size:19px}
.product p{color:#c8d3e5;font-size:14px;margin:0;max-width:230px}
.number{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.15em}
.about-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:60px;align-items:center}
.about-image{border-radius:24px;overflow:hidden;box-shadow:var(--shadow)}
.about-image img{aspect-ratio:1.1/1;object-fit:cover;object-position:left center}
.checks{display:grid;gap:14px;margin-top:25px}
.check{display:flex;gap:12px;align-items:flex-start}
.check i{width:26px;height:26px;border-radius:50%;display:grid;place-items:center;background:rgba(201,162,39,.16);color:var(--gold);font-style:normal;font-weight:900}
.process{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
.step{background:#fff;border:1px solid var(--line);border-radius:18px;padding:22px}
.step b{display:block;color:var(--gold);font-size:12px;letter-spacing:.12em;margin-bottom:8px}
.step h3{margin:0 0 8px;color:var(--navy);font-size:17px}
.step p{font-size:13px;color:var(--muted);margin:0}
.partner{display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:center}
.partner-card{padding:38px;border-radius:24px;background:var(--navy);color:#fff;box-shadow:var(--shadow)}
.partner-card h3{font-family:Georgia,serif;font-size:30px;margin:0 0 12px}
.partner-card p{color:#d0d8e6}
.quote{background:linear-gradient(135deg,#071a3a,#0e397c);color:#fff;border-radius:28px;padding:55px}
.quote h2{font-family:Georgia,serif;font-size:42px;line-height:1.1;margin:0 0 14px}
.quote p{color:#d6deea;max-width:720px}

.gallery-grid{display:grid;grid-template-columns:1.35fr .65fr;gap:18px}.gallery-main,.gallery-card{position:relative;overflow:hidden;border-radius:22px;background:#111;box-shadow:var(--shadow)}.gallery-main img{width:100%;height:520px;object-fit:cover}.gallery-main:after,.gallery-card:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(5,15,32,.82) 100%)}.gallery-main div{position:absolute;z-index:2;left:28px;bottom:25px;color:#fff}.gallery-main small{display:block;color:var(--gold2);font-weight:800;letter-spacing:.14em;margin-bottom:7px}.gallery-main b{font:28px Georgia,serif}.gallery-side{display:grid;gap:18px}.gallery-card img{width:100%;height:251px;object-fit:cover}.gallery-card span{position:absolute;z-index:2;left:20px;bottom:18px;color:#fff;font-size:12px;font-weight:800;letter-spacing:.12em}@media(max-width:900px){.gallery-grid{grid-template-columns:1fr}.gallery-main img{height:380px}}

.team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.team-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(7,26,58,.06);transition:transform .25s ease,box-shadow .25s ease;display:flex;flex-direction:column}
.team-card:hover{transform:translateY(-4px);box-shadow:var(--shadow)}
.team-img-wrap{position:relative;width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,var(--navy),var(--navy2));overflow:hidden}
.team-img-wrap img{width:100%;height:100%;object-fit:cover}
.team-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;font-size:54px;font-weight:700;color:var(--gold2);background:linear-gradient(145deg,var(--navy),var(--navy2))}
.team-body{padding:24px;flex:1;display:flex;flex-direction:column}
.team-role{color:var(--gold);font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:6px}
.team-name{color:var(--navy);font-size:20px;font-weight:750;margin:0 0 10px;line-height:1.25}
.team-bio{color:var(--muted);font-size:14px;line-height:1.55;margin:0 0 18px;flex:1}
.team-meta{display:flex;gap:14px;align-items:center;margin-top:auto;padding-top:14px;border-top:1px solid var(--line);font-size:13px}
.team-meta a{color:var(--navy);font-weight:600;display:inline-flex;align-items:center;gap:6px}
.team-meta a:hover{color:var(--gold)}

.contact-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:35px}
.contact-card{padding:30px;border:1px solid var(--line);border-radius:22px;background:#fff}
.contact-item{padding:16px 0;border-bottom:1px solid var(--line)}
.contact-item:last-child{border-bottom:0}
.contact-item small{display:block;color:var(--muted);font-size:11px;text-transform:uppercase;letter-spacing:.14em}
form{display:grid;gap:14px}
input,textarea,select{width:100%;padding:14px 16px;border:1px solid #d9d6cf;border-radius:12px;font:inherit;background:#fff}
textarea{min-height:130px;resize:vertical}
.footer{background:#06152f;color:#c9d2e1;padding:55px 0 25px}
.footer-grid{display:grid;grid-template-columns:1.2fr .8fr .8fr;gap:40px}
.footer h3{color:#fff;margin-top:0}
.footer-logo{width:76px;border-radius:12px;margin-bottom:12px}
.footer a:hover{color:var(--gold2)}
.copyright{border-top:1px solid rgba(255,255,255,.12);margin-top:35px;padding-top:20px;font-size:12px;color:#8fa0b9}
@media(max-width:900px){
 .nav-links{display:none;position:absolute;top:78px;left:0;right:0;background:#fff;padding:20px;flex-direction:column;align-items:flex-start;border-bottom:1px solid var(--line)}
 .nav-links.open{display:flex}.menu{display:block}.nav .btn{display:none}
 .hero-grid,.about-grid,.partner,.contact-grid{grid-template-columns:1fr}
 .stats{grid-template-columns:repeat(2,1fr)}
 .products{grid-template-columns:repeat(2,1fr)}
 .process{grid-template-columns:1fr 1fr}
 .team-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:560px){
 .hero{padding-top:125px}.section{padding:70px 0}
 .stats,.products,.process,.team-grid{grid-template-columns:1fr}
 .section-head h2,.quote h2{font-size:35px}
 .hero-actions .btn{width:100%}
 .brand span{font-size:12px}
}

/* ===== Adron Trading PLC MOBILE-FIRST ENHANCEMENTS ===== */
html, body { overflow-x:hidden; }
img { height:auto; }
button, a, input, textarea, select { -webkit-tap-highlight-color: transparent; }
.nav { width:100%; }
.nav-inner { min-height:74px; }
.menu { min-width:46px; min-height:46px; border-radius:12px; color:var(--navy); }
@media (max-width: 900px) {
  .container { width:min(94%, 720px); }
  .nav-inner { height:82px; }
  .brand img { width:60px; height:60px; }
  .nav-links {
    top:72px;
    padding:14px 5%;
    gap:6px;
    box-shadow:0 18px 35px rgba(7,26,58,.12);
  }
  .nav-links a {
    width:100%;
    padding:13px 8px;
    border-radius:10px;
  }
  .nav-links .btn { width:100%; margin-top:6px; }
  .hero { padding:108px 0 58px; }
  .hero-grid { gap:30px; }
  .hero-card { border-width:4px; }
  .hero-card img { aspect-ratio:1/1; }
  .hero-badge { left:12px; right:12px; bottom:12px; max-width:none; padding:12px 14px; }
  .hero p { font-size:16px; }
  .stats { gap:10px; margin-top:24px; }
  .stat { padding:18px 14px; }
  .stat b { font-size:23px; }
  .products { gap:12px; }
  .product { min-height:175px; padding:19px; }
  .about-grid, .partner, .contact-grid { gap:28px; }
  .about-image img { aspect-ratio:16/11; }
  .section-head { margin-bottom:28px; }
  .section-head h2 { font-size:38px; }
  .quote { padding:35px 25px; }
  .contact-card { padding:22px; }
}
@media (max-width: 560px) {
  .container { width:92%; }
  .nav-inner { height:76px; }
  .nav-links { top:76px; }
  .brand { gap:10px; }
  .brand img { width:52px; height:52px; }
  .brand span { font-size:10px; letter-spacing:.05em; }
  .menu { font-size:23px; }
  .hero { padding:94px 0 48px; }
  .kicker { font-size:10px; letter-spacing:.13em; }
  h1 { font-size:clamp(42px,14vw,60px); }
  .hero p { font-size:15px; line-height:1.55; }
  .hero-actions { display:grid; grid-template-columns:1fr; gap:10px; }
  .hero-actions .btn { width:100%; min-height:48px; }
  .hero-card { margin-top:4px; }
  .hero-card img { aspect-ratio:4/3; }
  .hero-badge { font-size:12px; }
  .stats { grid-template-columns:1fr 1fr; }
  .stat { min-height:94px; }
  .stat b { font-size:21px; }
  .stat span { font-size:11px; line-height:1.35; }
  .section { padding:58px 0; }
  .section-head h2, .quote h2 { font-size:32px; }
  .section-head p { font-size:15px; }
  .products { grid-template-columns:1fr 1fr; }
  .product { min-height:145px; padding:16px; }
  .product h3 { font-size:15px; }
  .product p { font-size:12px; line-height:1.4; }
  .product:after { font-size:100px; }
  .process { grid-template-columns:1fr; gap:10px; }
  .step { padding:18px; }
  .partner-card h3 { font-size:26px; }
  .quote { border-radius:20px; padding:30px 20px; }
  .quote h2 { font-size:30px; }
  .contact-item { font-size:14px; }
  input, textarea, select { font-size:16px; }
  textarea { min-height:145px; }
  .footer-grid { grid-template-columns:1fr; gap:22px; }
  .footer { padding:42px 0 22px; }
}
@media (max-width: 380px) {
  .products { grid-template-columns:1fr; }
  .product { min-height:130px; }
  .stats { grid-template-columns:1fr; }
  h1 { font-size:42px; }
}

/* ===== Adron Trading PLC SELF-CONTAINED IMAGE SAFETY ===== */
img {
  display:block;
  max-width:100%;
  height:auto;
  object-fit:cover;
  -webkit-user-drag:none;
}
.hero-card img, .about-image img { width:100%; }
@media (max-width: 900px) {
  .hero-card img { width:100%; height:auto; min-height:0; }
}
@media (max-width: 560px) {
  .hero-card img { aspect-ratio:4/3; object-fit:cover; }
}

/* ===== Adron Trading PLC EXTRA-LARGE BRAND LOGO ===== */
.brand {
  gap: 16px !important;
  align-items: center !important;
}
.brand img {
  width: 120px !important;
  height: 120px !important;
  max-width: none !important;
  object-fit: contain !important;
  border-radius: 14px !important;
}
.brand span {
  font-size: 16px !important;
  font-weight: 850 !important;
}
.nav-inner {
  min-height: 130px !important;
  height: 130px !important;
}
.nav-links {
  top: 130px !important;
}
@media (max-width: 900px) {
  .nav-inner {
    min-height: 108px !important;
    height: 108px !important;
  }
  .nav-links { top: 108px !important; }
  .brand img {
    width: 92px !important;
    height: 92px !important;
  }
  .brand span { font-size: 14px !important; }
}
@media (max-width: 560px) {
  .nav-inner {
    min-height: 94px !important;
    height: 94px !important;
  }
  .nav-links { top: 94px !important; }
  .brand {
    gap: 9px !important;
    min-width: 0;
  }
  .brand img {
    width: 76px !important;
    height: 76px !important;
  }
  .brand span {
    font-size: 10px !important;
    line-height: 1.15 !important;
    max-width: 135px;
  }
}
@media (max-width: 380px) {
  .brand img {
    width: 68px !important;
    height: 68px !important;
  }
  .brand span { display:none; }
}
</style>
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
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
      <a href="#about">About</a>
      <a href="#products">Products</a>
      <a href="#solutions">Solutions</a>
      <a href="#process">How We Work</a>
      <a href="#team">Team</a>
      <a href="#showroom">Showroom</a>
      <a href="#gallery">Gallery</a>
      <a href="#contact" class="btn btn-dark">Request a Quote</a>
    </nav>
  </div>
</header>

<main>
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
              <div class="team-avatar-placeholder">
                {{ strtoupper(substr($member->name, 0, 1)) }}
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
      <p><a href="#about">About</a></p>
      <p><a href="#products">Products</a></p>
      <p><a href="#solutions">Solutions</a></p>
      <p><a href="#process">How We Work</a></p>
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
