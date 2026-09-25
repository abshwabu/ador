<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#042641">
<meta name="description" content="@yield('meta_description', $settings->meta_description ?? 'Adorn Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.')">
<title>@yield('title', $settings->meta_title ?? 'Adorn Trading PLC | Design. Source. Deliver.')</title>

<!-- Favicons & Brand Marks -->
<link rel="icon" type="image/x-icon" href="{{ $settings->favicon ? $resolveImage($settings->favicon) : asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">

<!-- Social & Open Graph Meta Tags -->
<meta property="og:title" content="@yield('title', $settings->meta_title ?? 'Adorn Trading PLC | Design. Source. Deliver.')">
<meta property="og:description" content="@yield('meta_description', $settings->meta_description ?? 'Adorn Trading PLC — Global wholesale furnishing, interior finishing, procurement and project support in Addis Ababa, Ethiopia.')">
<meta property="og:image" content="{{ asset('images/logo.png') }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ asset('images/logo.png') }}">
<style>
:root{
  --navy:#042641;               /* Exact logo background: rgb(4, 38, 65) */
  --navy2:#083b64;              /* Complementary deeper navy hue (207°) */
  --navy-dark:#031b2e;          /* Base/footer deep navy */
  --navy-surface:#073357;       /* Card/stat/step surface on navy */
  --navy-surface-hover:#0b4270; /* Hover state for cards and controls */
  --navy-border:rgba(255,255,255,.08); /* Subtle border per Robi's guidelines */
  --gold:#c9a227;               /* Classic brand gold */
  --gold-bright:#e5b83b;        /* High-contrast CTA gold */
  --gold2:#f0cf63;              /* Tinted accent gold (10.16:1 AAA) */
  --coral:#ed9c39;              /* Logo warm amber accent */
  --rose:#d22f49;               /* Logo ruby/coral accent */
  --ink:#f3f6fa;                /* Primary heading & text (14.26:1 AAA) */
  --muted:#a4b8ce;              /* Secondary readable text (7.6:1 AAA) */
  --cream:#062f4f;              /* Subtle alt section background */
  --white:#fff;
  --line:rgba(255,255,255,.1);  /* Line dividers */
  --shadow:0 20px 60px rgba(0,0,0,.35);
  --radius:22px;
}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:var(--ink);background:var(--navy);line-height:1.6}
a{text-decoration:none;color:inherit}
img{max-width:100%;display:block}
.container{width:min(1180px,92%);margin:auto}

/* Navigation */
.nav{position:fixed;top:0;left:0;right:0;z-index:20;background:rgba(4,38,65,.92);backdrop-filter:blur(16px);border-bottom:1px solid rgba(255,255,255,.08);width:100%;transition:background .2s ease,box-shadow .2s ease}
.nav-inner{height:88px;display:flex;align-items:center;justify-content:space-between;min-height:74px}
.brand{display:flex;align-items:center;gap:14px;font-weight:800;letter-spacing:.08em}
.brand img{width:56px;height:56px;object-fit:contain;background:transparent}
.brand span{font-size:16px;color:#fff}
.nav-links{display:flex;gap:24px;align-items:center;font-size:14px;font-weight:650}
.nav-links a{color:var(--muted);transition:color .2s ease}
.nav-links a:hover, .nav-links a.active{color:var(--gold2)}
.btn{display:inline-flex;align-items:center;justify-content:center;padding:13px 20px;border-radius:999px;font-weight:750;font-size:14px;border:1px solid transparent;cursor:pointer;transition:.25s}
.btn-gold{background:var(--gold-bright);color:#042641;font-weight:800}
.btn-gold:hover{transform:translateY(-2px);background:var(--gold2);box-shadow:0 8px 20px rgba(240,207,99,.25)}
.btn-dark{background:var(--navy-surface);color:#fff;border:1px solid rgba(255,255,255,.18)}
.btn-dark:hover{background:var(--gold2);color:#042641;border-color:var(--gold2)}
.btn-outline{border-color:rgba(240,207,99,.5);color:var(--gold2)}
.btn-outline:hover{background:var(--gold2);color:#042641}
.menu{display:none;background:none;border:0;font-size:26px;min-width:46px;min-height:46px;border-radius:12px;color:#fff;cursor:pointer}

/* Shared Sections & Typography */
.kicker{display:inline-flex;gap:10px;align-items:center;color:var(--gold2);font-weight:800;letter-spacing:.18em;font-size:12px;text-transform:uppercase}
.kicker:before{content:"";width:34px;height:2px;background:var(--gold2)}
.section{padding:100px 0}
.section.alt{background:var(--cream)}
.section-head{max-width:760px;margin-bottom:42px}
.section-head h2{font-family:Georgia,serif;font-size:44px;line-height:1.1;color:#fff;margin:10px 0 14px}
.section-head p{color:var(--muted);font-size:17px}

/* Page Hero for Subpages */
.page-hero{
  padding:170px 0 70px;
  background:
    radial-gradient(circle at 80% 20%,rgba(237,156,57,.12),transparent 35%),
    linear-gradient(180deg,#042641 0%,#031c30 100%);
  text-align:center;
}
.page-hero h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(40px,5vw,64px);line-height:1.1;color:#fff;margin:14px 0}
.page-hero p{font-size:18px;color:var(--muted);max-width:720px;margin:0 auto 24px}

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
.breadcrumbs a{color:var(--muted)}
.breadcrumbs a:hover{color:var(--gold2)}

/* Home Hero */
.hero{padding:160px 0 90px;background:
 radial-gradient(circle at 80% 20%,rgba(237,156,57,.12),transparent 35%),
 radial-gradient(circle at 15% 85%,rgba(201,162,39,.08),transparent 35%),
 linear-gradient(180deg,#042641 0%,#031c30 100%)}
.hero-grid{display:grid;grid-template-columns:1.02fr .98fr;gap:54px;align-items:center}
h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(46px,6vw,78px);line-height:1.02;color:#fff;margin:18px 0}
.hero h1 span{color:var(--gold2)}
.hero p{font-size:18px;color:var(--muted);max-width:650px}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:28px}
.hero-card{border-radius:28px;overflow:hidden;box-shadow:var(--shadow);border:4px solid rgba(255,255,255,.12);position:relative}
.hero-card img{aspect-ratio:1.15/1;object-fit:cover}
.hero-badge{position:absolute;left:20px;bottom:20px;background:rgba(4,38,65,.94);color:#fff;padding:16px 18px;border-radius:16px;max-width:260px;border:1px solid rgba(255,255,255,.15);backdrop-filter:blur(10px)}
.hero-badge strong{display:block;color:var(--gold2);font-size:13px;margin-bottom:3px}

/* Stats */
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:36px}
.stat{padding:25px;border:1px solid var(--navy-border);border-radius:18px;background:var(--navy-surface)}
.stat b{display:block;font-size:28px;color:#fff}
.stat span{color:var(--muted);font-size:13px}

/* Products */
.products{display:grid;grid-template-columns:repeat(4,1fr);gap:24px}
.product{border-radius:20px;overflow:hidden;background:var(--navy-surface);border:1px solid var(--navy-border);box-shadow:0 8px 24px rgba(0,0,0,.18);transition:transform .3s ease,box-shadow .3s ease,border-color .3s ease;display:flex;flex-direction:column}
.product:hover{transform:translateY(-6px);box-shadow:0 16px 36px rgba(0,0,0,.35);border-color:rgba(240,207,99,.3)}
.product-img-wrap{position:relative;width:100%;aspect-ratio:16/11;overflow:hidden;background:#031b2e}
.product-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
.product:hover .product-img-wrap img{transform:scale(1.06)}
.product-number{position:absolute;top:12px;left:12px;background:rgba(4,38,65,.88);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.15);color:var(--gold2);padding:4px 10px;border-radius:10px;font-size:11px;font-weight:800;letter-spacing:.12em}
.product-body{padding:20px 22px 24px;flex:1;display:flex;flex-direction:column}
.product h3{margin:0 0 8px;font-size:18px;font-weight:750;color:#fff;line-height:1.3}
.product p{color:var(--muted);font-size:13.5px;line-height:1.55;margin:0}
.number{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.15em;margin-bottom:8px}

/* About */
.about-grid{display:grid;grid-template-columns:.9fr 1.1fr;gap:60px;align-items:center}
.about-image{border-radius:24px;overflow:hidden;box-shadow:var(--shadow);border:4px solid rgba(255,255,255,.1)}
.about-image img{aspect-ratio:1.1/1;object-fit:cover;object-position:left center}
.checks{display:grid;gap:14px;margin-top:25px}
.check{display:flex;gap:12px;align-items:flex-start}
.check i{width:26px;height:26px;border-radius:50%;display:grid;place-items:center;background:rgba(240,207,99,.15);color:var(--gold2);font-style:normal;font-weight:900}
.check b{color:#fff}
.check span{color:var(--muted)}

/* Process */
.process{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}
.step{background:var(--navy-surface);border:1px solid var(--navy-border);border-radius:18px;padding:22px}
.step b{display:block;color:var(--gold2);font-size:12px;letter-spacing:.12em;margin-bottom:8px}
.step h3{margin:0 0 8px;color:#fff;font-size:17px}
.step p{font-size:13px;color:var(--muted);margin:0}

/* Partner / Solutions */
.partner{display:grid;grid-template-columns:1fr;gap:30px;align-items:center}
.partner-card{padding:38px 42px;border-radius:24px;background:var(--navy-surface);border:1px solid var(--navy-border);color:#fff;box-shadow:var(--shadow);margin-bottom:30px}
.partner-card h3{font-family:Georgia,serif;font-size:30px;margin:0 0 10px;color:#fff}
.partner-card p{color:var(--muted);font-size:16px;line-height:1.6;margin:0;max-width:760px}
.partner-card-inner{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:24px}

/* Quote & CTA */
.quote{background:linear-gradient(135deg,#042641,#073357);border:1px solid rgba(255,255,255,.12);color:#fff;border-radius:28px;padding:55px}
.quote h2{font-family:Georgia,serif;font-size:42px;line-height:1.1;margin:0 0 14px;color:#fff}
.quote p{color:var(--muted);max-width:720px}
.cta-banner{
  background:linear-gradient(135deg,#042641,#073357);
  border:1px solid rgba(255,255,255,.12);
  color:#fff;
  border-radius:28px;
  padding:50px 36px;
  text-align:center;
  margin-top:60px;
}
.cta-banner h2{font-family:Georgia,serif;font-size:36px;margin:0 0 12px;color:#fff}
.cta-banner p{color:var(--muted);max-width:620px;margin:0 auto 24px}

/* Gallery Slideshow & Showcase */
.gallery-grid{display:grid;grid-template-columns:1.35fr .65fr;gap:20px;align-items:stretch}
.gallery-main{position:relative;overflow:hidden;border-radius:24px;background:#031b2e;border:1px solid var(--navy-border);box-shadow:var(--shadow);height:530px;cursor:pointer;user-select:none}
.gallery-slides{position:relative;width:100%;height:100%}
.gallery-slide{position:absolute;inset:0;opacity:0;visibility:hidden;transition:opacity .6s cubic-bezier(0.16,1,0.3,1),transform .6s cubic-bezier(0.16,1,0.3,1);transform:scale(1.02);z-index:1}
.gallery-slide.active{opacity:1;visibility:visible;transform:scale(1);z-index:2}
.gallery-slide img{width:100%;height:100%;object-fit:cover;transition:transform .5s cubic-bezier(0.16,1,0.3,1);display:block}
.gallery-main:hover .gallery-slide.active img{transform:scale(1.03)}
.gallery-slide:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(4,38,65,0.05) 0%,rgba(4,38,65,0.35) 45%,rgba(4,38,65,0.92) 100%);pointer-events:none}

.slide-info{position:absolute;z-index:3;left:32px;bottom:30px;right:130px;color:#fff;pointer-events:none}
.slide-kicker{display:inline-block;color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;margin-bottom:8px;text-shadow:0 2px 8px rgba(0,0,0,.6)}
.slide-title{font-family:Georgia,serif;font-size:30px;font-weight:700;color:#fff;margin:0 0 8px;line-height:1.2;text-shadow:0 2px 10px rgba(0,0,0,.7)}
.slide-desc{font-size:14px;color:rgba(248,250,252,.9);line-height:1.5;margin:0;max-width:560px;text-shadow:0 1px 6px rgba(0,0,0,.6)}

.slide-expand-pill{position:absolute;top:20px;right:20px;z-index:5;background:rgba(4,38,65,.85);backdrop-filter:blur(10px);border:1px solid rgba(240,207,99,.5);color:#fff;font-size:12px;font-weight:700;letter-spacing:.06em;padding:8px 16px;border-radius:999px;display:inline-flex;align-items:center;gap:8px;cursor:pointer;transition:all .25s ease;box-shadow:0 4px 14px rgba(0,0,0,.25)}
.slide-expand-pill:hover{background:var(--gold2);color:#042641;border-color:var(--gold2);transform:translateY(-2px)}
.slide-expand-pill svg{width:14px;height:14px}

.gallery-nav-btn{position:absolute;top:50%;transform:translateY(-50%);z-index:5;width:46px;height:46px;border-radius:50%;background:rgba(4,38,65,.75);backdrop-filter:blur(8px);border:1px solid rgba(240,207,99,.4);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .25s cubic-bezier(0.16,1,0.3,1);box-shadow:0 4px 16px rgba(0,0,0,.3)}
.gallery-nav-btn:hover{background:var(--gold2);color:#042641;border-color:var(--gold2);transform:translateY(-50%) scale(1.08)}
.gallery-nav-btn.prev{left:18px}
.gallery-nav-btn.next{right:18px}
.gallery-nav-btn svg{width:20px;height:20px}

.gallery-controls-bar{position:absolute;bottom:24px;right:28px;z-index:5;display:flex;align-items:center;gap:12px}
.gallery-dots{display:flex;gap:8px}
.gallery-dot{width:28px;height:4px;border-radius:2px;background:rgba(255,255,255,.3);border:none;cursor:pointer;transition:all .3s ease;padding:0}
.gallery-dot.active{background:var(--gold2);width:44px}
.gallery-counter{color:var(--gold2);font-size:13px;font-weight:800;letter-spacing:.08em}

/* Gallery Side Thumbnails */
.gallery-side{display:flex;flex-direction:column;gap:16px;justify-content:space-between}
.gallery-card{position:relative;overflow:hidden;border-radius:20px;background:#031b2e;border:1px solid var(--navy-border);height:162px;cursor:pointer;transition:all .3s cubic-bezier(0.16,1,0.3,1);box-shadow:var(--shadow)}
.gallery-card img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;display:block}
.gallery-card:hover img{transform:scale(1.05)}
.gallery-card:after{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(4,38,65,0.1) 0%,rgba(4,38,65,0.85) 100%);pointer-events:none}
.gallery-card.active{border:2px solid var(--gold2);box-shadow:0 0 20px rgba(240,207,99,.28);transform:translateX(-4px)}
.gallery-card .card-info{position:absolute;z-index:2;left:18px;bottom:14px;right:18px;color:#fff}
.gallery-card .card-caption{display:block;color:var(--gold2);font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:3px}
.gallery-card .card-title{display:block;font-size:16px;font-weight:750;color:#fff;line-height:1.25}
.gallery-card .card-active-tag{position:absolute;top:12px;right:12px;z-index:2;font-size:10px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;padding:3px 8px;border-radius:999px;background:var(--gold2);color:#042641;display:none}
.gallery-card.active .card-active-tag{display:inline-block}

/* Lightbox Modal */
.gallery-modal{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;padding:24px;opacity:0;visibility:hidden;transition:opacity .3s cubic-bezier(0.16,1,0.3,1),visibility .3s}
.gallery-modal.show{opacity:1;visibility:visible}
.gallery-modal-backdrop{position:absolute;inset:0;background:rgba(3,20,36,.94);backdrop-filter:blur(14px)}
.gallery-modal-dialog{position:relative;z-index:2;width:100%;max-width:1080px;max-height:90vh;background:#042641;border:1px solid rgba(240,207,99,.35);border-radius:26px;overflow:hidden;box-shadow:0 25px 60px rgba(0,0,0,.5);display:flex;flex-direction:column;transform:scale(.95);transition:transform .3s cubic-bezier(0.16,1,0.3,1)}
.gallery-modal.show .gallery-modal-dialog{transform:scale(1)}
.gallery-modal-close{position:absolute;top:18px;right:20px;z-index:10;width:40px;height:40px;border-radius:50%;background:rgba(4,38,65,.8);border:1px solid rgba(255,255,255,.2);color:#fff;font-size:24px;line-height:1;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s ease}
.gallery-modal-close:hover{background:var(--gold2);color:#042641;border-color:var(--gold2);transform:rotate(90deg)}
.modal-nav-btn{position:absolute;top:50%;transform:translateY(-50%);z-index:10;width:44px;height:44px;border-radius:50%;background:rgba(4,38,65,.85);backdrop-filter:blur(8px);border:1px solid rgba(240,207,99,.4);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s ease}
.modal-nav-btn:hover{background:var(--gold2);color:#042641}
.modal-nav-btn.prev{left:16px}
.modal-nav-btn.next{right:16px}
.modal-layout{display:grid;grid-template-columns:1.15fr .85fr;min-height:520px;max-height:calc(90vh - 40px);overflow-y:auto}
.modal-media{position:relative;background:#021422;display:flex;align-items:center;justify-content:center;overflow:hidden}
.modal-media img{width:100%;height:100%;object-fit:cover;max-height:600px;display:block}
.modal-counter-tag{position:absolute;bottom:20px;left:20px;background:rgba(4,38,65,.85);border:1px solid rgba(255,255,255,.2);color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.1em;padding:4px 12px;border-radius:999px}
.modal-content{padding:44px 38px;display:flex;flex-direction:column;overflow-y:auto;background:#042641}
.modal-kicker{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;margin-bottom:8px}
.modal-title{font-family:Georgia,serif;font-size:32px;font-weight:700;color:#fff;margin:0 0 12px;line-height:1.2}
.modal-desc{font-size:15px;color:var(--muted);line-height:1.6;margin-bottom:20px}
.modal-divider{height:1px;background:rgba(255,255,255,.1);margin-bottom:22px}
.modal-section-label{color:var(--gold2);font-size:11px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:10px}
.modal-explanation{font-size:15px;color:#f1f5f9;line-height:1.75;margin:0 0 24px;background:rgba(3,27,46,.6);padding:18px 20px;border-radius:14px;border:1px solid rgba(255,255,255,.08)}
.modal-highlights{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:28px}
.highlight-tag{font-size:11px;font-weight:700;color:#cbd5e1;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:5px 12px;border-radius:999px}
.modal-actions{margin-top:auto;padding-top:10px}

@media(max-width:900px){
  .gallery-grid{grid-template-columns:1fr;gap:16px}
  .gallery-main{height:420px}
  .gallery-side{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
  .gallery-card{height:140px}
  .gallery-card.active{transform:none;border-width:2px}
  .modal-layout{grid-template-columns:1fr;max-height:82vh}
  .modal-media{height:280px}
  .modal-content{padding:26px 22px}
  .modal-title{font-size:24px}
  .modal-nav-btn{display:none}
}
@media(max-width:600px){
  .gallery-side{grid-template-columns:1fr}
  .slide-info{right:20px;left:20px;bottom:65px}
  .slide-title{font-size:22px}
  .gallery-controls-bar{bottom:16px;right:18px}
  .slide-expand-pill{top:14px;right:14px;padding:6px 12px;font-size:11px}
}

/* Team */
.team-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.team-card{background:var(--navy-surface);border:1px solid var(--navy-border);border-radius:20px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.25);transition:transform .25s ease,box-shadow .25s ease;display:flex;flex-direction:column;position:relative}
.team-card:hover{transform:translateY(-5px);box-shadow:var(--shadow)}
.team-featured-badge{position:absolute;top:16px;right:16px;z-index:2;background:var(--gold2);color:#042641;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:4px 10px;border-radius:999px}
.team-img-wrap{position:relative;width:100%;aspect-ratio:1/1;background:linear-gradient(135deg,var(--navy),var(--navy-surface));overflow:hidden}
.team-img-wrap img{width:100%;height:100%;object-fit:cover}
.team-avatar-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-family:Georgia,serif;font-size:54px;font-weight:700;color:var(--gold2);background:linear-gradient(145deg,var(--navy),var(--navy-surface))}
.team-body{padding:26px;flex:1;display:flex;flex-direction:column}
.team-role{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:6px}
.team-name{color:#fff;font-size:20px;font-weight:750;margin:0 0 10px;line-height:1.25}
.team-bio{color:var(--muted);font-size:14px;line-height:1.6;margin:0 0 18px;flex:1}
.team-meta{display:flex;gap:14px;align-items:center;margin-top:auto;padding-top:16px;border-top:1px solid var(--line);font-size:13px}
.team-meta a{color:var(--gold2);font-weight:600;display:inline-flex;align-items:center;gap:6px}
.team-meta a:hover{color:#fff}

/* Portfolio */
.portfolio-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:30px}
.project-card{background:var(--navy-surface);border:1px solid var(--navy-border);border-radius:22px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.25);transition:transform .3s ease,box-shadow .3s ease;display:flex;flex-direction:column;position:relative}
.project-card:hover{transform:translateY(-6px);box-shadow:var(--shadow)}
.project-img-wrap{position:relative;width:100%;aspect-ratio:16/10;background:linear-gradient(135deg,var(--navy),var(--navy-surface));overflow:hidden}
.project-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.project-card:hover .project-img-wrap img{transform:scale(1.04)}
.project-badge{position:absolute;top:16px;left:16px;z-index:2;background:rgba(4,38,65,.9);backdrop-filter:blur(8px);color:#fff;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:5px 12px;border-radius:999px;border:1px solid rgba(255,255,255,.2)}
.project-featured{position:absolute;top:16px;right:16px;z-index:2;background:var(--gold2);color:#042641;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;padding:5px 12px;border-radius:999px}
.project-body{padding:26px;flex:1;display:flex;flex-direction:column}
.project-category{color:var(--gold2);font-size:12px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;margin-bottom:8px}
.project-title{color:#fff;font-family:Georgia,serif;font-size:22px;font-weight:700;margin:0 0 12px;line-height:1.25}
.project-title a{color:#fff}
.project-title a:hover{color:var(--gold2)}
.project-excerpt{color:var(--muted);font-size:14px;line-height:1.6;margin:0 0 20px;flex:1}
.project-meta{display:flex;justify-content:space-between;align-items:center;margin-top:auto;padding-top:16px;border-top:1px solid var(--line);font-size:13px;color:var(--muted)}
.project-link{display:inline-flex;align-items:center;gap:6px;font-weight:750;color:var(--gold2);font-size:13px;transition:color .2s ease}
.project-link:hover{color:#fff}

/* Project Detail */
.project-hero{padding:160px 0 45px;background:radial-gradient(circle at 80% 20%,rgba(237,156,57,.12),transparent 30%),linear-gradient(180deg,#042641 0%,#031c30 100%)}
h1.project-title{font-family:Georgia,"Times New Roman",serif;font-size:clamp(36px,5.5vw,56px);line-height:1.12;color:#fff;margin:12px 0 18px}
.project-lead{font-size:18px;color:var(--muted);max-width:820px;line-height:1.65;margin:0 0 32px}
.meta-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-top:24px}
.meta-item{padding:20px;background:var(--navy-surface);border:1px solid var(--navy-border);border-radius:18px;box-shadow:0 4px 15px rgba(0,0,0,.15)}
.meta-item small{display:block;color:var(--gold2);font-size:11px;text-transform:uppercase;letter-spacing:.12em;font-weight:700;margin-bottom:4px}
.meta-item b{display:block;font-size:16px;color:#fff}
.cover-wrapper{margin-top:40px;border-radius:26px;overflow:hidden;border:4px solid rgba(255,255,255,.1);box-shadow:var(--shadow);position:relative;background:#031b2e}
.cover-wrapper img{width:100%;max-height:580px;object-fit:cover}
.project-content-wrap{max-width:860px;margin:0 auto;font-size:17px;line-height:1.8;color:var(--muted)}
.project-content-wrap p{margin-bottom:24px}
.gallery-img-wrap{position:relative;width:100%;aspect-ratio:16/11;background:#031b2e;overflow:hidden}
.gallery-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
.gallery-card:hover .gallery-img-wrap img{transform:scale(1.04)}
.gallery-caption{padding:16px 20px;font-size:13px;font-weight:600;color:#fff;border-top:1px solid var(--line);background:var(--navy-surface)}
.related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px}
.related-card{background:var(--navy-surface);border:1px solid var(--navy-border);border-radius:20px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,.2);transition:transform .25s ease;display:flex;flex-direction:column}
.related-card:hover{transform:translateY(-4px);box-shadow:var(--shadow)}
.related-card img{width:100%;aspect-ratio:16/10;object-fit:cover}
.related-body{padding:20px;flex:1;display:flex;flex-direction:column}
.related-category{color:var(--gold2);font-size:11px;font-weight:800;letter-spacing:.1em;text-transform:uppercase;margin-bottom:6px}
.related-title{color:#fff;font-size:17px;font-weight:750;margin:0 0 8px}
.related-title a{color:#fff}
.related-title a:hover{color:var(--gold2)}

/* Contact & Forms */
.contact-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:35px}
.contact-card{padding:30px;border:1px solid var(--navy-border);border-radius:22px;background:var(--navy-surface)}
.contact-item{padding:16px 0;border-bottom:1px solid var(--line)}
.contact-item:last-child{border-bottom:0}
.contact-item small{display:block;color:var(--gold2);font-size:11px;text-transform:uppercase;letter-spacing:.14em}
.contact-item b{color:#fff}
.contact-item p{color:var(--muted)}
.contact-item a{color:var(--ink)}
.contact-item a:hover{color:var(--gold2)}
form{display:grid;gap:14px}
input,textarea,select{width:100%;padding:14px 16px;border:1px solid rgba(255,255,255,.15);border-radius:12px;font:inherit;background:#031b2e;color:#fff}
input:focus,textarea:focus,select:focus{border-color:var(--gold2);outline:none;box-shadow:0 0 0 3px rgba(240,207,99,.15)}
textarea{min-height:130px;resize:vertical}

/* Footer */
.footer{background:var(--navy-dark);color:var(--muted);padding:55px 0 25px;border-top:1px solid var(--navy-border)}
.footer-grid{display:grid;grid-template-columns:1.2fr .8fr .8fr;gap:40px}
.footer h3{color:#fff;margin-top:0}
.footer-logo{height:96px;width:auto;max-width:240px;object-fit:contain;margin-bottom:14px;background:transparent}
.footer p{color:var(--muted)}
.footer a{color:var(--muted);transition:color .2s ease}
.footer a:hover{color:var(--gold2)}
.copyright{border-top:1px solid rgba(255,255,255,.08);margin-top:35px;padding-top:20px;font-size:12px;color:var(--muted)}

/* Brand logo rules */
.brand{display:inline-flex;gap:14px;align-items:center;text-decoration:none}
.brand img{height:68px;width:auto;max-width:200px;object-fit:contain;background:transparent}
.brand span{font-size:16px;font-weight:850;color:#fff}

/* Responsive */
@media(max-width:900px){
  .container{width:min(94%,720px)}
  .nav-inner{height:78px;min-height:78px}
  .nav-links{display:none;position:absolute;top:78px;left:0;right:0;background:#031b2e;padding:20px;flex-direction:column;align-items:flex-start;border-bottom:1px solid var(--navy-border);box-shadow:0 18px 35px rgba(0,0,0,.4)}
  .nav-links.open{display:flex}
  .nav-links a{color:#f3f6fa}
  .menu{display:block}
  .nav .btn{display:none}
  .brand img{height:54px;width:auto}
  .brand span{font-size:14px}
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
  .nav-inner{height:72px;min-height:72px}
  .nav-links{top:72px}
  .brand{gap:10px;min-width:0}
  .brand img{height:46px;width:auto}
  .brand span{font-size:12px;line-height:1.15;max-width:145px}
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
  .brand img{height:40px;width:auto}
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
      <img src="{{ $resolveImage($settings->logo, 'images/logo.png') }}?v=2" alt="{{ $settings->company_name ?? 'Adorn Trading PLC' }}">
      <span>{{ $settings->company_name ?? 'Adorn Trading PLC' }}</span>
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
      <img class="footer-logo" src="{{ $resolveImage($settings->logo, 'images/logo.png') }}?v=2" alt="{{ $settings->company_name ?? 'Adorn Trading PLC' }}">
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
      <p><a href="mailto:{{ $settings->contact_email ?? 'info@adorntrading.com' }}">{{ $settings->contact_email ?? 'info@adorntrading.com' }}</a></p>
    </div>
  </div>
  <div class="container copyright">{{ $settings->footer_copyright ?? '© 2026 Adorn Trading PLC. All rights reserved.' }}</div>
</footer>

<script>
window.addEventListener('scroll',()=> {
  const n=document.querySelector('.nav');
  n.style.boxShadow=window.scrollY>10?'0 8px 30px rgba(0,0,0,.4)':'none';
});
document.querySelectorAll('.nav-links a').forEach(a=>a.addEventListener('click',()=>document.querySelector('.nav-links').classList.remove('open')));
</script>
@stack('scripts')
</body>
</html>
