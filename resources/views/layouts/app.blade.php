<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="description" content="@yield('meta_description', $settings->meta_description ?? 'Adron Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.')">
<title>@yield('title', $settings->meta_title ?? 'Adron Trading PLC | Design. Source. Deliver.')</title>
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

/* Navigation */
.nav{position:fixed;top:0;left:0;right:0;z-index:20;background:rgba(255,255,255,.92);backdrop-filter:blur(14px);border-bottom:1px solid rgba(231,227,218,.8);width:100%}
.nav-inner{height:88px;display:flex;align-items:center;justify-content:space-between;min-height:74px}
.brand{display:flex;align-items:center;gap:16px;font-weight:800;letter-spacing:.08em}
.brand img{width:72px;height:72px;object-fit:contain;border-radius:12px}
.brand span{font-size:15px;color:var(--navy)}
.nav-links{display:flex;gap:24px;align-items:center;font-size:14px;font-weight:650}
.nav-links a{transition:color .2s ease}
.nav-links a:hover, .nav-links a.active{color:var(--gold)}
.btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 20px;border-radius:999px;font-weight:750;font-size:14px;border:1px solid transparent;cursor:pointer;transition:.25s}
.btn-gold{background:var(--gold);color:#111}
.btn-gold:hover{transform:translateY(-2px);background:var(--gold2)}
.btn-dark{background:var(--navy);color:#fff}
.btn-outline{border-color:rgba(7,26,58,.3);color:var(--navy)}
.btn-outline:hover{background:var(--navy);color:#fff}
.menu{display:none;background:none;border:0;font-size:26px;min-width:46px;min-height:46px;border-radius:12px;color:var(--navy);cursor:pointer}

/* Shared Sections & Typography */
.kicker{display:inline-flex;gap:10px;align-items:center;color:var(--gold);font-weight:800;letter-spacing:.18em;font-size:12px;text-transform:uppercase}
.kicker:before{content:"";width:34px;height:2px;background:var(--gold)}
.section{padding:100px 0}
.section.alt{background:var(--cream)}
.section-head{max-width:760px;margin-bottom:42px}
.section-head h2{font-family:Georgia,serif;font-size:44px;line-height:1.1;color:var(--navy);margin:10px 0 14px}
.section-head p{color:var(--muted);font-size:17px}

/* Page Hero for Subpages */
.page-hero{
  padding:170px 0 70px;
  background:
    radial-gradient(circle at 80% 20%,rgba(201,162,39,.14),transparent 30%),
    linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%);
  text-align:center;
}
.page-hero h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(40px,5vw,64px);line-height:1.1;color:var(--navy);margin:14px 0}
.page-hero p{font-size:18px;color:#536071;max-width:720px;margin:0 auto 24px}

/* Breadcrumbs */
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
.breadcrumbs a:hover{color:var(--gold)}

/* Home Hero */
.hero{padding:150px 0 90px;background:
 radial-gradient(circle at 80% 20%,rgba(201,162,39,.16),transparent 30%),
 linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%)}
.hero-grid{display:grid;grid-template-columns:1.02fr .98fr;gap:54px;align-items:center}
h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(46px,6vw,78px);line-height:1.02;color:var(--navy);margin:18px 0}
.hero h1 span{color:var(--gold)}
.hero p{font-size:18px;color:#536071;max-width:650px}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:28px}
.hero-card{border-radius:28px;overflow:hidden;box-shadow:var(--shadow);border:7px solid #fff;position:relative}
.hero-card img{aspect-ratio:1.15/1;object-fit:cover}
.hero-badge{position:absolute;left:20px;bottom:20px;background:rgba(7,26,58,.9);color:#fff;padding:16px 18px;border-radius:16px;max-width:260px}
.hero-badge strong{display:block;color:var(--gold2);font-size:13px;margin-bottom:3px}

/* Stats */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:36px}
.stat{padding:25px;border:1px solid var(--line);border-radius:18px;background:#fff}
.stat b{display:block;font-size:28px;color:var(--navy)}
.stat span{color:var(--muted);font-size:13px}

/* Products */
.products{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.product{min-height:210px;border-radius:20px;padding:24px;background:linear-gradient(145deg,var(--navy),var(--navy2));color:#fff;position:relative;overflow:hidden}
.product:after{content:"A";position:absolute;right:-8px;bottom:-30px;font:900 150px Georgia;color:rgba(255,255,255,.06)}
.product h3{margin:0 0 8px;font-size:19px}
.product p{color:#c8d3e5;font-size:14px;margin:0;max-width:230px}
.number{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.15em}

/* About */
.about-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:60px;align-items:center}
.about-image{border-radius:24px;overflow:hidden;box-shadow:var(--shadow)}
.about-image img{aspect-ratio:1.1/1;object-fit:cover;object-position:left center}
.checks{display:grid;gap:14px;margin-top:25px}
.check{display:flex;gap:12px;align-items:flex-start}
.check i{width:26px;height:26px;border-radius:50%;display:grid;place-items:center;background:rgba(201,162,39,.16);color:var(--gold);font-style:normal;font-weight:900}

/* Process */
.process{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
.step{background:#fff;border:1px solid var(--line);border-radius:18px;padding:22px}
.step b{display:block;color:var(--gold);font-size:12px;letter-spacing:.12em;margin-bottom:8px}
.step h3{margin:0 0 8px;color:var(--navy);font-size:17px}
.step p{font-size:13px;color:var(--muted);margin:0}

/* Partner / Solutions */
.partner{display:grid;grid-template-columns:1fr 1fr;gap:30px;align-items:center}
.partner-card{padding:38px;border-radius:24px;background:var(--navy);color:#fff;box-shadow:var(--shadow)}
.partner-card h3{font-family:Georgia,serif;font-size:30px;margin:0 0 12px}
.partner-card p{color:#d0d8e6}

/* Quote & CTA */
.quote{background:linear-gradient(135deg,#071a3a,#0e397c);color:#fff;border-radius:28px;padding:55px}
.quote h2{font-family:Georgia,serif;font-size:42px;line-height:1.1;margin:0 0 14px}
.quote p{color:#d6deea;max-width:720px}
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

/* Gallery */
.gallery-grid{display:grid;grid-template-columns:1.35fr .65fr;gap:18px}
.gallery-main,.gallery-card{position:relative;overflow:hidden;border-radius:22px;background:#111;box-shadow:var(--shadow)}
.gallery-main img{width:100%;height:520px;object-fit:cover}
.gallery-main:after,.gallery-card:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(5,15,32,.82) 100%)}
.gallery-main div{position:absolute;z-index:2;left:28px;bottom:25px;color:#fff}
.gallery-main small{display:block;color:var(--gold2);font-weight:800;letter-spacing:.14em;margin-bottom:7px}
.gallery-main b{font:28px Georgia,serif}
.gallery-side{display:grid;gap:18px}
.gallery-card img{width:100%;height:251px;object-fit:cover}
.gallery-card span{position:absolute;z-index:2;left:20px;bottom:18px;color:#fff;font-size:12px;font-weight:800;letter-spacing:.12em}

/* Team */
.team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.team-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(7,26,58,.06);transition:transform .25s ease,box-shadow .25s ease;display:flex;flex-direction:column;position:relative}
.team-card:hover{transform:translateY(-5px);box-shadow:var(--shadow)}
.team-featured-badge{position:absolute;top:16px;right:16px;z-index:2;background:var(--gold);color:#111;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:4px 10px;border-radius:999px}
.team-img-wrap{position:relative;width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,var(--navy),var(--navy2));overflow:hidden}
.team-img-wrap img{width:100%;height:100%;object-fit:cover}
.team-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;font-size:54px;font-weight:700;color:var(--gold2);background:linear-gradient(145deg,var(--navy),var(--navy2))}
.team-body{padding:26px;flex:1;display:flex;flex-direction:column}
.team-role{color:var(--gold);font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:6px}
.team-name{color:var(--navy);font-size:20px;font-weight:750;margin:0 0 10px;line-height:1.25}
.team-bio{color:var(--muted);font-size:14px;line-height:1.6;margin:0 0 18px;flex:1}
.team-meta{display:flex;gap:14px;align-items:center;margin-top:auto;padding-top:16px;border-top:1px solid var(--line);font-size:13px}
.team-meta a{color:var(--navy);font-weight:600;display:inline-flex;align-items:center;gap:6px}
.team-meta a:hover{color:var(--gold)}

/* Portfolio */
.portfolio-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
.project-card{background:#fff;border:1px solid var(--line);border-radius:22px;overflow:hidden;box-shadow:0 10px 30px rgba(7,26,58,.06);transition:transform .3s ease,box-shadow .3s ease;display:flex;flex-direction:column;position:relative}
.project-card:hover{transform:translateY(-6px);box-shadow:var(--shadow)}
.project-img-wrap{position:relative;width:100%;aspect-ratio:16/10;background:linear-gradient(135deg,var(--navy),var(--navy2));overflow:hidden}
.project-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.project-card:hover .project-img-wrap img{transform:scale(1.04)}
.project-badge{position:absolute;top:16px;left:16px;z-index:2;background:rgba(7,26,58,.88);backdrop-filter:blur(8px);color:#fff;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:5px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.2)}
.project-featured{position:absolute;top:16px;right:16px;z-index:2;background:var(--gold);color:#111;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:5px 12px;border-radius:999px}
.project-body{padding:26px;flex:1;display:flex;flex-direction:column}
.project-category{color:var(--gold);font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:8px}
.project-title{color:var(--navy);font-family:Georgia,serif;font-size:22px;font-weight:700;margin:0 0 12px;line-height:1.25}
.project-title a:hover{color:var(--gold)}
.project-excerpt{color:var(--muted);font-size:14px;line-height:1.6;margin:0 0 20px;flex:1}
.project-meta{display:flex;justify-content:space-between;align-items:center;margin-top:auto;padding-top:16px;border-top:1px solid var(--line);font-size:13px;color:var(--muted)}
.project-link{display:inline-flex;align-items:center;gap:6px;font-weight:750;color:var(--navy);font-size:13px;transition:color .2s ease}
.project-link:hover{color:var(--gold)}

/* Project Detail */
.project-hero{padding:160px 0 45px;background:radial-gradient(circle at 80% 20%,rgba(201,162,39,.12),transparent 30%),linear-gradient(135deg,#f8f7f2 0%,#fff 55%,#eef3fb 100%)}
h1.project-title{font-family:Georgia,"Times New Roman",serif;font-size:clamp(36px,5.5vw,56px);line-height:1.12;color:var(--navy);margin:12px 0 18px}
.project-lead{font-size:18px;color:#4a5568;max-width:820px;line-height:1.65;margin:0 0 32px}
.meta-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:24px}
.meta-item{padding:20px;background:#fff;border:1px solid var(--line);border-radius:18px;box-shadow:0 4px 15px rgba(7,26,58,.03)}
.meta-item small{display:block;color:var(--muted);font-size:11px;text-transform:uppercase;letter-spacing:.12em;font-weight:700;margin-bottom:4px}
.meta-item b{display:block;font-size:16px;color:var(--navy)}
.cover-wrapper{margin-top:40px;border-radius:26px;overflow:hidden;border:6px solid #fff;box-shadow:var(--shadow);position:relative;background:#071a3a}
.cover-wrapper img{width:100%;max-height:580px;object-fit:cover}
.project-content-wrap{max-width:860px;margin:0 auto;font-size:17px;line-height:1.8;color:#2d3748}
.project-content-wrap p{margin-bottom:24px}
.gallery-img-wrap{position:relative;width:100%;aspect-ratio:16/11;background:#071a3a;overflow:hidden}
.gallery-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.gallery-card:hover .gallery-img-wrap img{transform:scale(1.04)}
.gallery-caption{padding:16px 20px;font-size:13px;font-weight:600;color:var(--navy);border-top:1px solid var(--line);background:#fff}
.related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.related-card{background:#fff;border:1px solid var(--line);border-radius:20px;overflow:hidden;box-shadow:0 8px 24px rgba(7,26,58,.05);transition:transform .25s ease;display:flex;flex-direction:column}
.related-card:hover{transform:translateY(-4px);box-shadow:var(--shadow)}
.related-card img{width:100%;aspect-ratio:16/10;object-fit:cover}
.related-body{padding:20px;flex:1;display:flex;flex-direction:column}
.related-category{color:var(--gold);font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.related-title{color:var(--navy);font-size:17px;font-weight:750;margin:0 0 8px}
.related-title a:hover{color:var(--gold)}

/* Contact & Forms */
.contact-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:35px}
.contact-card{padding:30px;border:1px solid var(--line);border-radius:22px;background:#fff}
.contact-item{padding:16px 0;border-bottom:1px solid var(--line)}
.contact-item:last-child{border-bottom:0}
.contact-item small{display:block;color:var(--muted);font-size:11px;text-transform:uppercase;letter-spacing:.14em}
form{display:grid;gap:14px}
input,textarea,select{width:100%;padding:14px 16px;border:1px solid #d9d6cf;border-radius:12px;font:inherit;background:#fff}
textarea{min-height:130px;resize:vertical}

/* Footer */
.footer{background:#06152f;color:#c9d2e1;padding:55px 0 25px}
.footer-grid{display:grid;grid-template-columns:1.2fr .8fr .8fr;gap:40px}
.footer h3{color:#fff;margin-top:0}
.footer-logo{width:76px;border-radius:12px;margin-bottom:12px}
.footer a:hover{color:var(--gold2)}
.copyright{border-top:1px solid rgba(255,255,255,.12);margin-top:35px;padding-top:20px;font-size:12px;color:#8fa0b9}

/* Extra-large brand logo rules */
.brand{gap:16px !important;align-items:center !important}
.brand img{width:120px !important;height:120px !important;max-width:none !important;object-fit:contain !important;border-radius:14px !important}
.brand span{font-size:16px !important;font-weight:850 !important}
.nav-inner{min-height:130px !important;height:130px !important}
.nav-links{top:130px !important}

/* Responsive */
@media(max-width:900px){
  .container{width:min(94%,720px)}
  .nav-inner{height:108px !important;min-height:108px !important}
  .nav-links{display:none;position:absolute;top:108px !important;left:0;right:0;background:#fff;padding:20px;flex-direction:column;align-items:flex-start;border-bottom:1px solid var(--line);box-shadow:0 18px 35px rgba(7,26,58,.12)}
  .nav-links.open{display:flex}
  .menu{display:block}
  .nav .btn{display:none}
  .brand img{width:92px !important;height:92px !important}
  .brand span{font-size:14px !important}
  .hero-grid,.about-grid,.partner,.contact-grid{grid-template-columns:1fr}
  .stats{grid-template-columns:repeat(2,1fr)}
  .products{grid-template-columns:repeat(2,1fr)}
  .process{grid-template-columns:1fr 1fr}
  .team-grid{grid-template-columns:repeat(2,1fr)}
  .portfolio-grid{grid-template-columns:repeat(2,1fr);gap:20px}
  .meta-grid{grid-template-columns:repeat(2,1fr)}
  .related-grid{grid-template-columns:repeat(2,1fr)}
  .gallery-grid{grid-template-columns:1fr}
  .gallery-main img{height:380px}
  .footer-grid{grid-template-columns:1fr;gap:22px}
}

@media(max-width:560px){
  .container{width:92%}
  .nav-inner{height:94px !important;min-height:94px !important}
  .nav-links{top:94px !important}
  .brand{gap:9px !important;min-width:0}
  .brand img{width:76px !important;height:76px !important}
  .brand span{font-size:10px !important;line-height:1.15 !important;max-width:135px}
  .hero{padding-top:125px}
  .section{padding:58px 0}
  .page-hero{padding:130px 0 45px}
  .project-hero{padding:120px 0 35px}
  .stats,.products,.process,.team-grid,.portfolio-grid,.meta-grid,.related-grid,.gallery-grid{grid-template-columns:1fr}
  .section-head h2,.quote h2{font-size:32px}
  .cta-banner h2{font-size:28px}
  .hero-actions .btn{width:100%}
  .cover-wrapper{border-width:4px}
  .cta-banner{padding:30px 18px}
}

@media(max-width:380px){
  .brand img{width:68px !important;height:68px !important}
  .brand span{display:none}
  .products{grid-template-columns:1fr}
  .product{min-height:130px}
  .stats{grid-template-columns:1fr}
  h1{font-size:42px}
}

/* Image safety */
html,body{overflow-x:hidden}
img{height:auto;object-fit:cover;-webkit-user-drag:none}
button,a,input,textarea,select{-webkit-tap-highlight-color:transparent}
</style>
@stack('styles')
</head>
<body>

<header class="nav">
  <div class="container nav-inner">
    <a class="brand" href="{{ route('home') }}#home">
      <img src="{{ $resolveImage($settings->logo, 'images/logo.png') }}" alt="{{ $settings->company_name ?? 'Adron Trading PLC' }}">
      <span>{{ $settings->company_name ?? 'Adron Trading PLC' }}</span>
    </a>
    <button class="menu" aria-label="Open menu" onclick="document.querySelector('.nav-links').classList.toggle('open')">☰</button>
    <nav class="nav-links">
      <a href="{{ route('home') }}#about">About</a>
      <a href="{{ route('home') }}#products">Products</a>
      <a href="{{ route('home') }}#solutions">Solutions</a>
      <a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a>
      <a href="{{ route('home') }}#process">How We Work</a>
      <a href="{{ route('team.index') }}" class="{{ request()->routeIs('team.*') ? 'active' : '' }}">Team</a>
      <a href="{{ route('home') }}#showroom">Showroom</a>
      <a href="{{ route('home') }}#gallery">Gallery</a>
      <a href="{{ route('home') }}#contact" class="btn btn-dark">Request a Quote</a>
    </nav>
  </div>
</header>

<main>
  @yield('content')
</main>

<footer class="footer">
  <div class="container footer-grid">
    <div>
      <img class="footer-logo" src="{{ $resolveImage($settings->logo, 'images/logo.png') }}" alt="{{ $settings->company_name ?? 'Adron Trading PLC' }}">
      <p>{{ $settings->tagline ?? 'Design. Source. Deliver.' }}</p>
      <p>{{ $settings->footer_about ?? 'Premium interior finishing, procurement and project support for Ethiopia.' }}</p>
    </div>
    <div>
      <h3>Explore</h3>
      <p><a href="{{ route('home') }}#about">About</a></p>
      <p><a href="{{ route('home') }}#products">Products</a></p>
      <p><a href="{{ route('home') }}#solutions">Solutions</a></p>
      <p><a href="{{ route('portfolio.index') }}">Portfolio</a></p>
      <p><a href="{{ route('home') }}#process">How We Work</a></p>
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
@stack('scripts')
</body>
</html>
