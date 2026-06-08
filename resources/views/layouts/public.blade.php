<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>فكرتك الرقمية — وكالة تسويق رقمي | جدة</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Tajawal', 'sans-serif'],
                },
                colors: {
                    primary: {
                        50: '#FEF2EA',
                        100: '#FDDEC8',
                        200: '#F7924A',
                        300: '#F26522',
                        400: '#F26522',
                        500: '#F26522',
                        600: '#D95A1E',
                        700: '#BF4F1B',
                        800: '#A64517',
                        900: '#8C3A13',
                    }
                }
            }
        }
    }
</script>
<style>
html{scroll-behavior:smooth}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  --or:      #F26522;
  --or-l:    #F7924A;
  --or-pale: #FEF2EA;
  --or-mid:  #FDDEC8;
  --bl:      #1B3F72;
  --bl-m:    #2B5BA8;
  --bl-l:    #4A7FC1;
  --bl-pale: #EBF2FB;
  --wh:      #FFFFFF;
  --bg:      #F6F8FC;
  --bg2:     #EFF3FA;
  --dk:      #0D1A2E;
  --mid:     #334869;
  --muted:   #7A8FA8;
  --border:  #DDE5F0;
  --bord2:   #C8D6EA;
  --ss:      0 1px 3px rgba(13,26,46,.05), 0 2px 8px rgba(13,26,46,.06);
  --sm:      0 4px 16px rgba(13,26,46,.09), 0 1px 4px rgba(13,26,46,.05);
  --lg:      0 12px 40px rgba(13,26,46,.13), 0 4px 12px rgba(13,26,46,.07);
  --xl:      0 24px 64px rgba(13,26,46,.16), 0 8px 20px rgba(13,26,46,.08);
}

html{scroll-behavior:smooth}
body{font-family:'Tajawal',sans-serif;background:var(--wh);color:var(--dk);direction:rtl;overflow-x:hidden}

/* ══════════════════════════
   HEADER
══════════════════════════ */
.hdr{
  position:sticky;top:0;z-index:200;
  background:rgba(255,255,255,.92);
  backdrop-filter:blur(18px);
  -webkit-backdrop-filter:blur(18px);
  border-bottom:1px solid var(--border);
  box-shadow:0 1px 0 rgba(13,26,46,.04);
}

.hdr-inner{
  max-width:1280px;
  margin:0 auto;
  padding:0 40px;
  height:72px;
  display:flex;
  align-items:center;
  gap:32px;
}

/* LOGO */
.hdr-logo{
  display:flex;align-items:center;gap:12px;
  flex-shrink:0;text-decoration:none;
}

.hdr-logo-img{
  height:38px;
  display:block;
  object-fit:contain;
}

.hdr-logo-fb{
  display:none;
  align-items:center;gap:10px;
}

.hdr-logo-icon{
  width:38px;height:38px;
  border-radius:10px;
  background:linear-gradient(135deg,var(--or),var(--or-l));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:17px;font-weight:900;
  box-shadow:0 3px 10px rgba(242,101,34,.35);
}

.hdr-logo-text{font-size:16px;font-weight:900;color:var(--bl);}
.hdr-logo-en{font-size:10px;color:var(--muted);font-weight:400;margin-top:1px;}

/* NAV */
.hdr-nav{
  display:flex;align-items:center;gap:2px;
  flex:1;
}

.hdr-nav-item{
  display:flex;align-items:center;gap:7px;
  padding:8px 14px;
  border-radius:10px;
  font-size:13px;font-weight:600;
  color:var(--mid);
  text-decoration:none;
  white-space:nowrap;
  transition:background .15s,color .15s;
  cursor:pointer;
  border:none;background:none;font-family:'Tajawal',sans-serif;
}

.hdr-nav-item:hover{background:var(--bl-pale);color:var(--bl);}
.hdr-nav-item:hover .nav-dot{background:var(--bl-m);}

.nav-dot{
  width:6px;height:6px;
  border-radius:50%;
  background:var(--or);
  flex-shrink:0;
  transition:background .15s;
}

/* WA BUTTON */
.hdr-wa{
  display:flex;align-items:center;gap:9px;
  margin-right:auto;
  padding:10px 20px;
  border-radius:12px;
  background:linear-gradient(135deg,#25D366,#1DA851);
  color:#fff;
  font-size:13px;font-weight:700;
  text-decoration:none;
  white-space:nowrap;
  box-shadow:0 3px 12px rgba(37,211,102,.30);
  transition:transform .18s,box-shadow .18s;
  border:none;font-family:'Tajawal',sans-serif;
  cursor:pointer;
  flex-shrink:0;
}

.hdr-wa:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(37,211,102,.40);}

.wa-icon{
  width:20px;height:20px;
  flex-shrink:0;
}

/* ══════════════════════════
   ABOUT HERO
══════════════════════════ */
.about{
  background:var(--wh);
  padding:96px 6vw 88px;
  position:relative;
  overflow:hidden;
}

.about-grid-bg{
  position:absolute;inset:0;
  background-image:
    linear-gradient(rgba(27,63,114,.04) 1px,transparent 1px),
    linear-gradient(90deg,rgba(27,63,114,.04) 1px,transparent 1px);
  background-size:48px 48px;
  mask-image:radial-gradient(ellipse 80% 70% at 50% 50%,black 40%,transparent 100%);
  pointer-events:none;
}

.about-blob1{
  position:absolute;top:-160px;left:-160px;
  width:560px;height:560px;
  background:radial-gradient(circle,rgba(242,101,34,.06) 0%,transparent 65%);
  border-radius:50%;pointer-events:none;
}

.about-blob2{
  position:absolute;bottom:-100px;right:-100px;
  width:400px;height:400px;
  background:radial-gradient(circle,rgba(27,63,114,.05) 0%,transparent 65%);
  border-radius:50%;pointer-events:none;
}

.about-inner{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:1fr 440px;
  gap:72px;align-items:center;
  position:relative;z-index:1;
}

.about-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--or-pale);border:1px solid var(--or-mid);
  color:var(--or);font-size:12.5px;font-weight:700;
  padding:6px 16px;border-radius:30px;
  margin-bottom:28px;letter-spacing:.04em;
}

.badge-pulse{
  width:7px;height:7px;border-radius:50%;background:var(--or);
  animation:pulse 2s ease-in-out infinite;
}

@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.5)}}

.about-logo-wrap{margin-bottom:30px;}

.about-logo-img{
  height:50px;display:block;
  object-fit:contain;object-position:right;
}

.about-logo-fb{
  display:none;align-items:center;gap:12px;
}

.about-logo-icon{
  width:50px;height:50px;border-radius:14px;
  background:linear-gradient(135deg,var(--or),var(--or-l));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:22px;font-weight:900;
  box-shadow:0 4px 14px rgba(242,101,34,.3);
}

.about-logo-name{font-size:20px;font-weight:900;color:var(--bl);}
.about-logo-en2{font-size:12px;color:var(--muted);margin-top:2px;}

.about-h1{
  font-size:clamp(30px,4.2vw,52px);
  font-weight:900;line-height:1.22;
  color:var(--dk);margin-bottom:24px;
  letter-spacing:-.01em;
}

.about-h1 .c-or{color:var(--or);}
.about-h1 .c-bl{color:var(--bl);}

.about-body{
  font-size:17px;line-height:1.9;
  color:var(--mid);margin-bottom:40px;
  max-width:540px;font-weight:400;
}

.about-stats{display:flex;gap:0;}

.stat-divider{width:1px;background:var(--border);margin:0 28px;align-self:stretch;}

.stat-item{}

.stat-num{
  font-size:34px;font-weight:900;
  color:var(--or);line-height:1;
  margin-bottom:5px;
}

.stat-lbl{font-size:12.5px;color:var(--muted);font-weight:500;}

/* RIGHT PANEL */
.about-panel{
  background:var(--bg);
  border:1.5px solid var(--border);
  border-radius:24px;
  padding:34px;
  box-shadow:var(--lg);
  position:relative;overflow:hidden;
}

.about-panel::before{
  content:'';position:absolute;
  top:0;right:0;width:140px;height:140px;
  background:linear-gradient(135deg,rgba(242,101,34,.07),transparent);
  border-radius:0 24px 0 140px;
  pointer-events:none;
}

.panel-label{
  font-size:11px;letter-spacing:.1em;text-transform:uppercase;
  font-weight:700;color:var(--muted);
  margin-bottom:18px;
  display:flex;align-items:center;gap:8px;
}

.panel-label::after{content:'';flex:1;height:1px;background:var(--border);}

.svc-list{display:flex;flex-direction:column;gap:10px;}

.svc-item{
  display:flex;align-items:center;gap:14px;
  padding:13px 14px;
  border-radius:12px;
  background:var(--wh);
  border:1px solid var(--border);
  transition:border-color .18s,box-shadow .18s,transform .18s;
}

.svc-item:hover{
  border-color:var(--or);
  box-shadow:0 3px 12px rgba(242,101,34,.10);
  transform:translateX(-3px);
}

.svc-icon-box{
  width:38px;height:38px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}

.svc-icon-box svg{width:20px;height:20px;}

.si-or{background:var(--or-pale);border:1px solid var(--or-mid);}
.si-bl{background:var(--bl-pale);border:1px solid #C5D6EC;}

.svc-name{font-size:13.5px;font-weight:600;color:var(--mid);}

.panel-cta{
  margin-top:20px;padding-top:18px;
  border-top:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
}

.panel-cta-text{font-size:12px;color:var(--muted);}

.panel-cta-link{
  font-size:13px;font-weight:700;
  color:var(--bl-m);text-decoration:none;
  display:flex;align-items:center;gap:5px;
}

.panel-cta-link:hover{color:var(--or);}

/* ══════════════════════════
   SERVICES ICONS SECTION
══════════════════════════ */
.svcs-section{
  background:var(--bg);
  padding:80px 6vw;
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
}

.svcs-inner{max-width:1200px;margin:0 auto;}

.sec-head{text-align:center;margin-bottom:56px;}

.sec-eyebrow{
  display:inline-block;
  font-size:11.5px;font-weight:700;letter-spacing:.1em;
  color:var(--or);text-transform:uppercase;
  background:var(--or-pale);border:1px solid var(--or-mid);
  padding:5px 15px;border-radius:20px;margin-bottom:16px;
}

.sec-h2{
  font-size:clamp(24px,3.2vw,38px);
  font-weight:900;color:var(--dk);
  line-height:1.3;margin-bottom:12px;
}

.sec-h2 span{color:var(--or);}

.sec-body{font-size:15.5px;color:var(--muted);line-height:1.75;max-width:520px;margin:0 auto;}

.svcs-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
}

.svc-card{
  background:var(--wh);
  border:1.5px solid var(--border);
  border-radius:20px;
  padding:28px 22px;
  text-align:center;
  box-shadow:var(--ss);
  transition:all .22s cubic-bezier(.4,0,.2,1);
  position:relative;overflow:hidden;
  cursor:default;
}

.svc-card::after{
  content:'';position:absolute;inset:0;
  border-radius:20px;
  background:linear-gradient(135deg,var(--or-pale),transparent 60%);
  opacity:0;transition:opacity .22s;
}

.svc-card:hover{
  transform:translateY(-6px);
  box-shadow:var(--xl);
  border-color:var(--or);
}

.svc-card:hover::after{opacity:1;}

.svc-card-icon{
  width:60px;height:60px;
  border-radius:16px;
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 18px;
  position:relative;z-index:1;
  transition:transform .22s;
}

.svc-card:hover .svc-card-icon{transform:scale(1.08);}

.svc-card-icon svg{width:28px;height:28px;}

.icon-or{background:linear-gradient(135deg,var(--or-pale),var(--or-mid));border:1.5px solid var(--or-mid);}
.icon-bl{background:linear-gradient(135deg,var(--bl-pale),#D4E5F5);border:1.5px solid #C5D6EC;}

.svc-card-name{
  font-size:14px;font-weight:700;color:var(--dk);
  line-height:1.4;margin-bottom:8px;
  position:relative;z-index:1;
}

.svc-card-desc{
  font-size:12px;color:var(--muted);line-height:1.6;
  position:relative;z-index:1;
}

/* ══════════════════════════
   TICKER
══════════════════════════ */
.ticker-section{
  background:var(--bl);
  padding:20px 0;overflow:hidden;position:relative;
}

.ticker-badge{
  position:absolute;right:0;top:0;bottom:0;
  width:110px;z-index:10;
  background:var(--or);
  display:flex;align-items:center;justify-content:center;
  flex-direction:column;gap:3px;
}

.ticker-badge-line1{font-size:10px;font-weight:900;color:#fff;letter-spacing:.06em;}
.ticker-badge-line2{font-size:9px;color:rgba(255,255,255,.7);font-weight:500;}

.ticker-fr{position:absolute;right:110px;top:0;bottom:0;width:70px;background:linear-gradient(to left,var(--bl),transparent);z-index:5;pointer-events:none;}
.ticker-fl{position:absolute;left:0;top:0;bottom:0;width:70px;background:linear-gradient(to right,var(--bl),transparent);z-index:5;pointer-events:none;}

.ticker-track{display:flex;width:max-content;animation:tick 42s linear infinite;padding-right:120px;}
.ticker-track:hover{animation-play-state:paused;}

@keyframes tick{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

.t-item{
  display:flex;align-items:center;gap:10px;
  padding:0 26px;white-space:nowrap;
  border-left:1px solid rgba(255,255,255,.1);
}

.t-icon{
  width:28px;height:28px;
  border-radius:7px;
  background:rgba(255,255,255,.1);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}

.t-icon svg{width:14px;height:14px;fill:rgba(255,255,255,.8);}

.t-name{font-size:13.5px;font-weight:600;color:rgba(255,255,255,.85);}

.t-dot{width:4px;height:4px;border-radius:50%;background:var(--or);flex-shrink:0;}

/* ══════════════════════════
   CASE STUDIES
══════════════════════════ */
.cases-section{background:var(--bg);padding:80px 6vw 90px;}

.cases-grid{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:22px;
}

.case-card{
  background:var(--wh);
  border:1.5px solid var(--border);
  border-radius:22px;
  overflow:hidden;
  box-shadow:var(--ss);
  transition:transform .24s cubic-bezier(.4,0,.2,1),box-shadow .24s,border-color .24s;
  text-decoration:none;color:inherit;
  display:flex;flex-direction:column;
}

.case-card:hover{transform:translateY(-6px);box-shadow:var(--xl);border-color:var(--or);}

.case-top{
  padding:20px 22px 0;
  display:flex;align-items:flex-start;justify-content:space-between;
  gap:10px;
}

.niche-pill{
  display:inline-flex;align-items:center;gap:6px;
  font-size:11px;font-weight:700;
  padding:5px 12px;border-radius:20px;border:1px solid;
  letter-spacing:.03em;
}

.np-or{background:var(--or-pale);color:var(--or);border-color:var(--or-mid);}
.np-bl{background:var(--bl-pale);color:var(--bl-m);border-color:#C5D6EC;}
.np-tl{background:#E5F8F6;color:#0A8A7A;border-color:#B2E8E3;}
.np-pu{background:#F2EFFE;color:#6D28D9;border-color:#DDD6FE;}

.case-arrow-icon{
  width:32px;height:32px;border-radius:8px;
  background:var(--bg);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;transition:background .18s,border-color .18s;
}

.case-arrow-icon svg{width:14px;height:14px;stroke:var(--muted);transition:stroke .18s;}
.case-card:hover .case-arrow-icon{background:var(--or);border-color:var(--or);}
.case-card:hover .case-arrow-icon svg{stroke:#fff;}

.case-body{padding:16px 22px 22px;flex:1;display:flex;flex-direction:column;}

.case-avatar-row{display:flex;align-items:center;gap:12px;margin-bottom:16px;}

.case-avatar{
  width:46px;height:46px;border-radius:13px;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;border:1.5px solid var(--border);
}

.case-avatar svg{width:24px;height:24px;}

.case-client{font-size:18px;font-weight:900;color:var(--dk);}
.case-sub{font-size:12px;color:var(--muted);margin-top:2px;}

.case-divider{height:1px;background:var(--border);margin-bottom:14px;}

.results-grid{
  display:grid;grid-template-columns:repeat(2,1fr);
  gap:8px;margin-bottom:16px;flex:1;
}

.r-chip{
  background:var(--bg);border:1px solid var(--border);
  border-radius:10px;padding:10px 12px;
}

.r-val{font-size:17px;font-weight:900;color:var(--dk);line-height:1;}
.r-lbl{font-size:11px;color:var(--muted);margin-top:3px;line-height:1.3;}

.stags{display:flex;flex-wrap:wrap;gap:5px;padding-top:14px;border-top:1px solid var(--border);}

.stag{
  font-size:11px;font-weight:600;
  padding:4px 10px;border-radius:6px;
  background:var(--bg2);color:var(--mid);border:1px solid var(--border);
}

/* ══════════════════════════
   FOOTER
══════════════════════════ */
.footer{
  background:var(--dk);
  color:rgba(255,255,255,.75);
  padding:72px 6vw 0;
  position:relative;
  overflow:hidden;
}

/* subtle top border accent */
.footer::before{
  content:'';
  position:absolute;top:0;left:0;right:0;
  height:3px;
  background:linear-gradient(90deg,var(--or),var(--or-l),var(--bl-l),var(--bl));
}

/* faint grid texture */
.footer::after{
  content:'';
  position:absolute;inset:0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),
    linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px);
  background-size:52px 52px;
  pointer-events:none;
}

.footer-inner{
  max-width:1200px;margin:0 auto;
  display:grid;
  grid-template-columns:260px 1fr 1fr 260px;
  gap:56px;
  padding-bottom:60px;
  position:relative;z-index:1;
}

/* ── col 1 : brand ── */
.ft-brand{}

.ft-logo-img{
  height:42px;display:block;
  object-fit:contain;object-position:right;
  margin-bottom:18px;
  filter:brightness(0) invert(1);
  opacity:.92;
}

.ft-logo-fb{
  display:none;align-items:center;gap:10px;margin-bottom:18px;
}

.ft-logo-icon{
  width:42px;height:42px;border-radius:11px;
  background:linear-gradient(135deg,var(--or),var(--or-l));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:18px;font-weight:900;
}

.ft-logo-name{color:#fff;font-size:16px;font-weight:900;}
.ft-logo-en{color:rgba(255,255,255,.45);font-size:11px;margin-top:2px;}

.ft-tagline{
  font-size:13.5px;line-height:1.8;
  color:rgba(255,255,255,.5);
  margin-bottom:24px;
  max-width:220px;
}

.ft-socials{display:flex;gap:8px;}

.ft-social{
  width:36px;height:36px;border-radius:9px;
  border:1px solid rgba(255,255,255,.12);
  background:rgba(255,255,255,.06);
  display:flex;align-items:center;justify-content:center;
  transition:background .18s,border-color .18s;
  text-decoration:none;
  cursor:pointer;
}

.ft-social:hover{background:var(--or);border-color:var(--or);}
.ft-social svg{width:16px;height:16px;fill:rgba(255,255,255,.7);}
.ft-social:hover svg{fill:#fff;}

/* ── col headers ── */
.ft-col-title{
  font-size:12px;letter-spacing:.1em;text-transform:uppercase;
  font-weight:700;color:rgba(255,255,255,.35);
  margin-bottom:22px;
  display:flex;align-items:center;gap:8px;
}

.ft-col-title::after{
  content:'';flex:1;height:1px;
  background:rgba(255,255,255,.08);
}

/* ── links ── */
.ft-links{display:flex;flex-direction:column;gap:4px;}

.ft-link{
  display:flex;align-items:center;gap:10px;
  padding:8px 10px;border-radius:8px;
  font-size:13.5px;color:rgba(255,255,255,.6);
  text-decoration:none;
  transition:background .15s,color .15s,padding-right .15s;
  cursor:pointer;
}

.ft-link:hover{
  background:rgba(255,255,255,.06);
  color:rgba(255,255,255,.95);
  padding-right:14px;
}

.ft-link-dot{
  width:5px;height:5px;border-radius:50%;
  background:var(--or);flex-shrink:0;
  opacity:.5;transition:opacity .15s;
}

.ft-link:hover .ft-link-dot{opacity:1;}

/* ── col 4 : contact ── */
.ft-contact{}

.ft-info-item{
  display:flex;align-items:flex-start;gap:12px;
  padding:12px 0;
  border-bottom:1px solid rgba(255,255,255,.07);
}

.ft-info-item:last-of-type{border-bottom:none;}

.ft-info-icon{
  width:34px;height:34px;border-radius:9px;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;margin-top:1px;
}

.ft-info-icon svg{width:15px;height:15px;stroke:rgba(255,255,255,.6);fill:none;stroke-width:1.8;}

.ft-info-label{font-size:11px;color:rgba(255,255,255,.35);margin-bottom:3px;font-weight:600;letter-spacing:.05em;}
.ft-info-val{font-size:13.5px;color:rgba(255,255,255,.75);font-weight:500;direction:ltr;text-align:right;}
.ft-info-val a{color:inherit;text-decoration:none;}

.ft-wa-btn{
  display:flex;align-items:center;justify-content:center;gap:10px;
  margin-top:20px;
  padding:13px 20px;
  border-radius:12px;
  background:linear-gradient(135deg,#25D366,#1DA851);
  color:#fff;font-size:14px;font-weight:700;
  text-decoration:none;
  box-shadow:0 4px 16px rgba(37,211,102,.25);
  transition:transform .18s,box-shadow .18s;
  font-family:'Tajawal',sans-serif;
}

.ft-wa-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(37,211,102,.35);}
.ft-wa-btn svg{width:19px;height:19px;fill:#fff;flex-shrink:0;}

/* ── copyright bar ── */
.ft-bar{
  border-top:1px solid rgba(255,255,255,.08);
  padding:18px 0;
  position:relative;z-index:1;
  max-width:1200px;margin:0 auto;
  display:flex;align-items:center;justify-content:space-between;
  gap:12px;flex-wrap:wrap;
}

.ft-bar-text{font-size:12.5px;color:rgba(255,255,255,.35);}
.ft-bar-text span{color:var(--or);}

.ft-bar-links{display:flex;gap:16px;}
.ft-bar-link{font-size:12px;color:rgba(255,255,255,.3);text-decoration:none;transition:color .15s;}
.ft-bar-link:hover{color:rgba(255,255,255,.7);}

/* ══════════════════════════
   SCROLL REVEAL
══════════════════════════ */
.reveal{opacity:0;transform:translateY(24px);transition:opacity .6s ease,transform .6s ease;}
.reveal.visible{opacity:1;transform:none;}

/* ══════════════════════════
   MOBILE NAV DRAWER
══════════════════════════ */
.mob-toggle{
  display:none;
  width:40px;height:40px;border-radius:10px;
  background:var(--bg);border:1.5px solid var(--border);
  align-items:center;justify-content:center;
  cursor:pointer;flex-shrink:0;margin-right:auto;
}

.mob-toggle svg{width:18px;height:18px;stroke:var(--mid);stroke-width:2;fill:none;}

.mob-drawer{
  display:none;
  position:fixed;inset:0;z-index:500;
}

.mob-overlay{
  position:absolute;inset:0;
  background:rgba(13,26,46,.55);
  backdrop-filter:blur(4px);
  -webkit-backdrop-filter:blur(4px);
}

.mob-panel{
  position:absolute;top:0;right:0;bottom:0;
  width:min(320px,85vw);
  background:var(--wh);
  box-shadow:var(--xl);
  display:flex;flex-direction:column;
  transform:translateX(100%);
  transition:transform .3s cubic-bezier(.4,0,.2,1);
  overflow-y:auto;
}

.mob-panel.open{transform:translateX(0);}

.mob-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:20px 20px 16px;
  border-bottom:1px solid var(--border);
}

.mob-logo-img{height:32px;object-fit:contain;object-position:right;}

.mob-logo-fb{
  display:none;align-items:center;gap:8px;
}

.mob-logo-fb-icon{
  width:32px;height:32px;border-radius:8px;
  background:linear-gradient(135deg,var(--or),var(--or-l));
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:14px;font-weight:900;
}

.mob-logo-fb-name{font-size:14px;font-weight:900;color:var(--bl);}

.mob-close{
  width:36px;height:36px;border-radius:9px;
  background:var(--bg);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;flex-shrink:0;
}

.mob-close svg{width:16px;height:16px;stroke:var(--mid);stroke-width:2;fill:none;}

.mob-nav{padding:12px 12px 20px;flex:1;}

.mob-nav-label{
  font-size:10px;letter-spacing:.1em;text-transform:uppercase;
  font-weight:700;color:var(--muted);
  padding:0 8px;margin:16px 0 6px;
}

.mob-nav-item{
  display:flex;align-items:center;gap:10px;
  padding:13px 12px;border-radius:10px;
  font-size:14px;font-weight:600;color:var(--mid);
  text-decoration:none;
  border:1px solid transparent;
  transition:background .15s,color .15s,border-color .15s;
  margin-bottom:3px;
}

.mob-nav-item:hover,
.mob-nav-item:active{background:var(--bl-pale);color:var(--bl);border-color:var(--border);}

.mob-nav-dot{
  width:7px;height:7px;border-radius:50%;
  background:var(--or);flex-shrink:0;
}

.mob-wa{
  margin:0 12px 24px;
  display:flex;align-items:center;justify-content:center;gap:10px;
  padding:14px;border-radius:12px;
  background:linear-gradient(135deg,#25D366,#1DA851);
  color:#fff;font-size:14px;font-weight:700;
  text-decoration:none;
  box-shadow:0 4px 14px rgba(37,211,102,.3);
  font-family:'Tajawal',sans-serif;
}

.mob-wa svg{width:19px;height:19px;fill:#fff;flex-shrink:0;}

/* ══════════════════════════
   RESPONSIVE — TABLET 1100px
══════════════════════════ */
@media(max-width:1100px){
  .svcs-grid{grid-template-columns:repeat(3,1fr);}
  .cases-grid{grid-template-columns:repeat(2,1fr);}
  .footer-inner{grid-template-columns:1fr 1fr;gap:40px;}
}

/* ══════════════════════════
   RESPONSIVE — MOBILE 768px
══════════════════════════ */
@media(max-width:768px){

  /* ── header ── */
  .hdr-inner{padding:0 16px;height:60px;gap:12px;}
  .hdr-nav{display:none;}
  .hdr-wa{display:none;}
  .mob-toggle{display:flex;}
  .hdr-logo-img{height:30px;}
  .mob-drawer{display:block;}

  /* ── about ── */
  .about{padding:52px 20px 48px;}
  .about-inner{grid-template-columns:1fr;gap:32px;}
  .about-panel{display:none;}
  .about-grid-bg{display:none;}
  .about-blob1,.about-blob2{display:none;}
  .about-h1{font-size:28px;line-height:1.3;}
  .about-body{font-size:15px;line-height:1.8;margin-bottom:28px;}
  .about-badge{font-size:11px;padding:5px 12px;margin-bottom:20px;}
  .about-logo-img{height:38px;}
  .about-logo-wrap{margin-bottom:20px;}
  .about-stats{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:16px;
  }
  .stat-divider{display:none;}
  .stat-num{font-size:26px;}
  .stat-lbl{font-size:11.5px;}

  /* ── services section ── */
  .svcs-section{padding:52px 20px;}
  .svcs-grid{grid-template-columns:repeat(2,1fr);gap:12px;}
  .svc-card{padding:20px 16px;}
  .svc-card-icon{width:50px;height:50px;border-radius:14px;margin-bottom:14px;}
  .svc-card-icon svg{width:24px;height:24px;}
  .svc-card-name{font-size:13px;}
  .svc-card-desc{font-size:11px;}

  /* ── section headers ── */
  .sec-head{margin-bottom:32px;}
  .sec-h2{font-size:24px;}
  .sec-body{font-size:14px;}

  /* ── ticker ── */
  .ticker-section{padding:16px 0;}
  .ticker-badge{width:80px;}
  .ticker-badge-line1{font-size:9px;}
  .ticker-badge-line2{font-size:8px;}
  .ticker-fr{right:80px;width:50px;}
  .ticker-fl{width:50px;}
  .ticker-track{padding-right:90px;animation-duration:28s;}
  .t-item{padding:0 18px;}
  .t-name{font-size:12px;}
  .t-icon{width:24px;height:24px;}
  .t-icon svg{width:12px;height:12px;}

  /* ── case studies ── */
  .cases-section{padding:52px 20px 60px;}
  .cases-grid{grid-template-columns:1fr;gap:16px;}
  .case-card:hover{transform:none;}
  .case-client{font-size:16px;}
  .results-grid{grid-template-columns:repeat(2,1fr);gap:7px;}
  .r-val{font-size:15px;}

  /* ── footer ── */
  .footer{padding:52px 20px 0;}
  .footer-inner{
    grid-template-columns:1fr;
    gap:36px;
    padding-bottom:40px;
  }
  .ft-logo-img{height:34px;}
  .ft-tagline{font-size:13px;max-width:100%;}
  .ft-col-title{margin-bottom:14px;}
  .ft-link{font-size:13px;}
  .ft-wa-btn{padding:14px;font-size:13.5px;}
  .ft-bar{
    flex-direction:column;
    text-align:center;
    gap:8px;
    padding:16px 0;
  }
  .ft-bar-links{justify-content:center;flex-wrap:wrap;gap:12px;}
  .ft-bar-text{font-size:11.5px;}
}

/* ══════════════════════════
   RESPONSIVE — SMALL 400px
══════════════════════════ */
@media(max-width:400px){
  .about-h1{font-size:24px;}
  .svcs-grid{grid-template-columns:1fr 1fr;}
  .svc-card{padding:16px 12px;}
  .svc-card-name{font-size:12px;}
  .svc-card-desc{display:none;}
  .cases-grid{gap:12px;}
  .stat-num{font-size:22px;}
  .about-stats{grid-template-columns:repeat(2,1fr);gap:12px;}
}

/* ══════════════════════════
   TOUCH IMPROVEMENTS
══════════════════════════ */
@media(hover:none){
  .svc-card:hover{transform:none;box-shadow:var(--ss);}
  .case-card:hover{transform:none;box-shadow:var(--ss);}
  .hdr-wa:hover{transform:none;}
  .ft-wa-btn:hover{transform:none;}
  .svc-item:hover{transform:none;}
  /* active states for touch */
  .svc-card:active{border-color:var(--or);box-shadow:var(--sm);}
  .case-card:active{border-color:var(--or);box-shadow:var(--sm);}
  .mob-nav-item:active{background:var(--bl-pale);color:var(--bl);}
}
</style>
</head>
<body>

<!-- ══════════════════════════════════
     HEADER
══════════════════════════════════ -->
<header class="hdr">
  <div class="hdr-inner">

    <a href="/" class="hdr-logo">
      <img src="https://fkretk.com/wp-content/uploads/2026/02/download-1-2.png"
           alt="فكرتك الرقمية" class="hdr-logo-img"
           onerror="this.style.display='none';document.getElementById('hdr-fb').style.display='flex'">
      <div id="hdr-fb" class="hdr-logo-fb">
        <div class="hdr-logo-icon">ف</div>
        <div>
          <div class="hdr-logo-text">فكرتك الرقمية</div>
          <div class="hdr-logo-en">Fkretk Digital Agency</div>
        </div>
      </div>
    </a>

    <nav class="hdr-nav">
      @foreach($categories as $category)
        <a class="hdr-nav-item" href="{{ route('category.show', $category->slug) }}">
          <span class="nav-dot"></span>{{ $category->name }}
        </a>
      @endforeach
    </nav>

    <a class="hdr-wa" href="https://api.whatsapp.com/send/?phone=966541744116&text&type=phone_number" target="_blank">
      <svg class="wa-icon" viewBox="0 0 24 24" fill="currentColor">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
      </svg>
      تواصل عبر واتساب
    </a>

    <!-- MOBILE HAMBURGER -->
    <button class="mob-toggle" id="mobToggle" aria-label="القائمة">
      <svg viewBox="0 0 24 24" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>

  </div>
</header>

<!-- ══════════════════════════════════
     MOBILE NAV DRAWER
══════════════════════════════════ -->
<div class="mob-drawer" id="mobDrawer">
  <div class="mob-overlay" id="mobOverlay"></div>
  <div class="mob-panel" id="mobPanel">

    <div class="mob-head">
      <a href="/" style="display:flex; align-items:center; text-decoration:none;">
        <img src="https://fkretk.com/wp-content/uploads/2026/02/download-1-2.png"
             alt="فكرتك" class="mob-logo-img"
             onerror="this.style.display='none';document.getElementById('mob-fb').style.display='flex'">
        <div id="mob-fb" class="mob-logo-fb">
          <div class="mob-logo-fb-icon">ف</div>
          <div class="mob-logo-fb-name">فكرتك الرقمية</div>
        </div>
      </a>
      <button class="mob-close" id="mobClose">
        <svg viewBox="0 0 24 24" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
      </button>
    </div>

    <div class="mob-nav">
      <div class="mob-nav-label">التصنيفات</div>
      @foreach($categories as $category)
        <a class="mob-nav-item" href="{{ route('category.show', $category->slug) }}">
          <span class="mob-nav-dot"></span>{{ $category->name }}
        </a>
      @endforeach

      <div class="mob-nav-label">صفحات الموقع</div>
      <a class="mob-nav-item" href="https://fkretk.com/" target="_blank" onclick="closeDrawer()">
        <span class="mob-nav-dot"></span>الرئيسية
      </a>
      <a class="mob-nav-item" href="https://fkretk.com/%d8%ae%d8%af%d9%85%d8%a7%d8%aa%d9%86%d8%a7/" target="_blank" onclick="closeDrawer()">
        <span class="mob-nav-dot"></span>خدماتنا
      </a>
      <a class="mob-nav-item" href="https://fkretk.com/%d9%85%d9%86-%d9%86%d8%ad%d9%86/" target="_blank" onclick="closeDrawer()">
        <span class="mob-nav-dot"></span>من نحن
      </a>
      <a class="mob-nav-item" href="https://fkretk.com/%d8%aa%d9%88%d8%a7%d8%b5%d9%84-%d9%85%d8%b9%d9%86%d8%a7/" target="_blank" onclick="closeDrawer()">
        <span class="mob-nav-dot"></span>تواصل معنا
      </a>
    </div>

    <a class="mob-wa"
       href="https://api.whatsapp.com/send/?phone=966541744116&text&type=phone_number"
       target="_blank">
      <svg viewBox="0 0 24 24" fill="#fff" width="19" height="19">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
      </svg>
      تواصل عبر واتساب الآن
    </a>

  </div>
</div>

<main class="flex-grow">
    @yield('content')
</main>

<script>
/* ─── MOBILE DRAWER ─── */
const drawer=document.getElementById('mobDrawer');
const panel=document.getElementById('mobPanel');
const overlay=document.getElementById('mobOverlay');

function openDrawer(){
  if(drawer && panel) {
    drawer.style.display='block';
    document.body.style.overflow='hidden';
    setTimeout(()=>panel.classList.add('open'),10);
  }
}

function closeDrawer(){
  if(panel && drawer) {
    panel.classList.remove('open');
    document.body.style.overflow='';
    setTimeout(()=>{ drawer.style.display='none'; },300);
  }
}

const mobToggle = document.getElementById('mobToggle');
if(mobToggle) mobToggle.addEventListener('click',openDrawer);

const mobClose = document.getElementById('mobClose');
if(mobClose) mobClose.addEventListener('click',closeDrawer);

if(overlay) overlay.addEventListener('click',closeDrawer);

/* ─── SCROLL REVEAL ─── */
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);}});
},{threshold:.08});
document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));
</script>
<!-- ══════════════════════════════════
     FOOTER
══════════════════════════════════ -->
<footer class="footer">
  <div class="footer-inner">

    <!-- COL 1 : BRAND -->
    <div class="ft-brand">
      <a href="/" style="display:block; text-decoration:none;">
        <img src="https://fkretk.com/wp-content/uploads/2026/02/download-1-2.png"
             alt="فكرتك الرقمية" class="ft-logo-img"
             onerror="this.style.display='none';document.getElementById('ft-fb').style.display='flex'">
        <div id="ft-fb" class="ft-logo-fb">
          <div class="ft-logo-icon">ف</div>
          <div>
            <div class="ft-logo-name">فكرتك الرقمية</div>
            <div class="ft-logo-en">Fkretk Digital Agency</div>
          </div>
        </div>
      </a>

      <p class="ft-tagline">
        وكالة تسويق رقمي سعودية — نحوّل فكرتك إلى نتائج حقيقية
        تُقاس بالأرقام.
      </p>

      <div class="ft-socials">
        <!-- Instagram -->
        <a class="ft-social" href="https://fkretk.com" target="_blank" title="Instagram">
          <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
        </a>
        <!-- TikTok -->
        <a class="ft-social" href="https://fkretk.com" target="_blank" title="TikTok">
          <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.77 1.52V6.73a4.85 4.85 0 01-1-.04z"/></svg>
        </a>
        <!-- X (Twitter) -->
        <a class="ft-social" href="https://fkretk.com" target="_blank" title="X">
          <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
        <!-- Snapchat -->
        <a class="ft-social" href="https://fkretk.com" target="_blank" title="Snapchat">
          <svg viewBox="0 0 24 24"><path d="M12.206.793c.99 0 4.347.276 5.93 3.821.529 1.193.403 3.219.299 4.847l.003.06c-.012.071.19.07.467-.002.145-.036.397-.098.695-.298.4-.207.97-.594 1.687-.594.84 0 1.104.586 1.104.912 0 .7-.823 1.35-1.92 1.63.022.103.047.203.063.28.131.58.296 1.32-.226 1.99-.344.43-.92.73-1.755.91-.61.13-1.143.26-1.403.53-.26.27-.41.674-.52.982-.113.302-.21.574-.314.735-.103.16-.26.24-.412.24-.34 0-.7-.262-.95-.42-.46-.288-1.065-.667-1.764-.667-.62 0-1.197.308-1.66.72-.461.41-.763.72-1.064.72s-.614-.31-1.044-.723c-.418-.405-.987-.717-1.61-.717-.699 0-1.303.378-1.762.666-.252.158-.612.42-.95.42-.152 0-.31-.08-.412-.24-.105-.16-.201-.433-.314-.735-.11-.308-.26-.712-.52-.982-.262-.27-.793-.4-1.404-.53-.833-.18-1.41-.48-1.754-.91-.522-.67-.357-1.41-.226-1.99.017-.077.04-.177.064-.28-1.097-.28-1.92-.93-1.92-1.63 0-.326.264-.912 1.104-.912.717 0 1.288.387 1.687.594.298.2.55.262.695.298.276.072.478.073.467.002l.003-.06c-.104-1.628-.23-3.654.299-4.847C7.859 1.069 11.216.793 12.206.793z"/></svg>
        </a>
      </div>
    </div>

    <!-- COL 2 : SERVICES -->
    <div>
      <div class="ft-col-title">خدماتنا</div>
      <div class="ft-links">
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d8%af%d8%a7%d8%b1%d8%a9-%d8%a7%d9%84%d8%ad%d9%85%d9%84%d8%a7%d8%aa-%d8%a7%d9%84%d8%a5%d8%b9%d9%84%d8%a7%d9%86%d9%8a%d8%a9/" target="_blank">
          <span class="ft-link-dot"></span>إدارة الحملات الإعلانية
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%aa%d8%ad%d8%b3%d9%8a%d9%86-%d9%85%d8%ad%d8%b1%d9%83%d8%a7%d8%aa-%d8%a7%d9%84%d8%a8%d8%ad%d8%ab-seo/" target="_blank">
          <span class="ft-link-dot"></span>تحسين محركات البحث SEO
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d9%86%d8%b4%d8%a7%d8%a1-%d9%85%d8%aa%d8%ac%d8%b1-%d8%a5%d9%84%d9%83%d8%aa%d8%b1%d9%88%d9%86%d9%8a/" target="_blank">
          <span class="ft-link-dot"></span>إنشاء المتاجر الإلكترونية
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d8%af%d8%a7%d8%b1%d8%a9-%d8%ad%d8%b3%d8%a7%d8%a8%d8%a7%d8%aa-%d8%a7%d9%84%d8%b3%d9%88%d8%b4%d9%8a%d8%a7%d9%84-%d9%85%d9%8a%d8%af%d9%8a%d8%a7/" target="_blank">
          <span class="ft-link-dot"></span>إدارة السوشيال ميديا
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%aa%d8%b5%d9%85%d9%8a%d9%85-%d8%a7%d9%84%d8%ac%d8%b1%d8%a7%d9%81%d9%8a%d9%83/" target="_blank">
          <span class="ft-link-dot"></span>الهوية البصرية والجرافيك
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a7%d9%84%d9%85%d9%88%d9%86%d8%aa%d8%a7%d8%ac-%d9%88%d8%a7%d9%84%d9%85%d9%88%d8%b4%d9%86-%d8%ac%d8%b1%d8%a7%d9%81%d9%8a%d9%83/" target="_blank">
          <span class="ft-link-dot"></span>المونتاج والموشن جرافيك
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a7%d9%84%d8%aa%d8%b3%d9%88%d9%8a%d9%82-%d8%b9%d8%a8%d8%b1-%d8%a7%d9%84%d9%85%d8%a4%d8%ab%d8%b1%d9%8a%d9%86/" target="_blank">
          <span class="ft-link-dot"></span>التسويق عبر المؤثرين
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d9%86%d8%b4%d8%a7%d8%a1-%d8%aa%d8%b7%d8%a8%d9%8a%d9%82-%d9%85%d8%aa%d8%ac%d8%b1-%d8%a5%d9%84%d9%83%d8%aa%d8%b1%d9%88%d9%86%d9%8a/" target="_blank">
          <span class="ft-link-dot"></span>إنشاء تطبيقات الجوال
        </a>
      </div>
    </div>

    <!-- COL 3 : PAGES -->
    <div>
      <div class="ft-col-title">صفحات الموقع</div>
      <div class="ft-links">
        <a class="ft-link" href="https://fkretk.com/" target="_blank">
          <span class="ft-link-dot"></span>الرئيسية
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%ae%d8%af%d9%85%d8%a7%d8%aa%d9%86%d8%a7/" target="_blank">
          <span class="ft-link-dot"></span>خدماتنا
        </a>
        <a class="ft-link" href="https://fkretk.com/%d9%85%d9%86-%d9%86%d8%ad%d9%86/" target="_blank">
          <span class="ft-link-dot"></span>من نحن
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a7%d9%84%d9%85%d8%af%d9%88%d9%86%d8%a9-2/" target="_blank">
          <span class="ft-link-dot"></span>المدونة
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%aa%d9%88%d8%a7%d8%b5%d9%84-%d9%85%d8%b9%d9%86%d8%a7/" target="_blank">
          <span class="ft-link-dot"></span>تواصل معنا
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d9%86%d8%b4%d8%a7%d8%a1-%d9%85%d8%aa%d8%ac%d8%b1-%d8%a5%d9%84%d9%83%d8%aa%d8%b1%d9%88%d9%86%d9%8a/" target="_blank">
          <span class="ft-link-dot"></span>إنشاء متجر إلكتروني
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%a5%d8%af%d8%a7%d8%b1%d8%a9-%d8%a7%d9%84%d8%ad%d9%85%d9%84%d8%a7%d8%aa-%d8%a7%d9%84%d8%a5%d8%b9%d9%84%d8%a7%d9%86%d9%8a%d8%a9/" target="_blank">
          <span class="ft-link-dot"></span>إدارة الحملات الإعلانية
        </a>
        <a class="ft-link" href="https://fkretk.com/%d8%aa%d8%ad%d8%b3%d9%8a%d9%86-%d9%85%d8%ad%d8%b1%d9%83%d8%a7%d8%aa-%d8%a7%d9%84%d8%a8%d8%ad%d8%ab-seo/" target="_blank">
          <span class="ft-link-dot"></span>خدمة SEO
        </a>
      </div>
    </div>

    <!-- COL 4 : CONTACT -->
    <div class="ft-contact">
      <div class="ft-col-title">تواصل معنا</div>

      <div class="ft-info-item">
        <div class="ft-info-icon">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0112 2a8 8 0 018 8.2c0 7.3-8 11.8-8 11.8z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <div>
          <div class="ft-info-label">العنوان</div>
          <div class="ft-info-val">جدة، المملكة العربية السعودية</div>
        </div>
      </div>

      <div class="ft-info-item">
        <div class="ft-info-icon">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.89 11.4a19.79 19.79 0 01-3.07-8.68A2 2 0 012.81 2.7h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 10.09a16 16 0 006 6l1.56-1.56a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0121.28 17z"/>
          </svg>
        </div>
        <div>
          <div class="ft-info-label">رقم الجوال</div>
          <div class="ft-info-val">
            <a href="tel:+966541744116">+966 54 174 4116</a>
          </div>
        </div>
      </div>

      <div class="ft-info-item">
        <div class="ft-info-icon">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
        </div>
        <div>
          <div class="ft-info-label">الموقع الرسمي</div>
          <div class="ft-info-val">
            <a href="https://fkretk.com" target="_blank">fkretk.com</a>
          </div>
        </div>
      </div>

      <a class="ft-wa-btn"
         href="https://api.whatsapp.com/send/?phone=966541744116&text&type=phone_number"
         target="_blank">
        <svg viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        تواصل عبر واتساب
      </a>
    </div>

  </div><!-- /footer-inner -->

  <!-- COPYRIGHT BAR -->
  <div class="ft-bar">
    <p class="ft-bar-text">
      © <span id="yr"></span> جميع الحقوق محفوظة لشركة
      <span>فكرتك الرقمية</span> — Fkretk Digital Agency
    </p>
    <div class="ft-bar-links">
      <a class="ft-bar-link" href="https://fkretk.com" target="_blank">سياسة الخصوصية</a>
      <a class="ft-bar-link" href="https://fkretk.com" target="_blank">الشروط والأحكام</a>
      <a class="ft-bar-link" href="https://fkretk.com" target="_blank">fkretk.com</a>
    </div>
  </div>

</footer>

<script>document.getElementById('yr').textContent=new Date().getFullYear();</script>
</body>
</html>
