<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Digital Office Management System — Inauguration</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;600;700&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  :root {
    --gold: #d4af37;
    --gold-light: #f4d160;
    --gold-deep: #b8860b;
    --gold-shadow: #8a6d1f;
    --red: #c8102e;
    --red-deep: #8b0a1e;
    --red-light: #ff3b5c;
    --ink: #0d1b2a;
    --accent: #1a237e;
  }

  html, body { width: 100%; height: 100%; }

  body {
    min-height: 100vh;
    background: radial-gradient(ellipse at 50% 30%, #1b263b 0%, #0d1b2a 55%, #050a14 100%);
    font-family: 'Cinzel', 'Noto Sans Bengali', 'Georgia', serif;
    color: #fff;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
  }

  body::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
      radial-gradient(1px 1px at 20% 30%, rgba(212,175,55,0.45), transparent),
      radial-gradient(1px 1px at 80% 70%, rgba(212,175,55,0.30), transparent),
      radial-gradient(1px 1px at 40% 80%, rgba(255,255,255,0.20), transparent),
      radial-gradient(1px 1px at 60% 20%, rgba(212,175,55,0.30), transparent),
      radial-gradient(1.5px 1.5px at 90% 40%, rgba(255,255,255,0.30), transparent),
      radial-gradient(1px 1px at 10% 60%, rgba(212,175,55,0.30), transparent);
    background-size: 600px 600px;
    pointer-events: none;
    z-index: 0;
  }

  .stage {
    position: relative;
    width: min(900px, 95vw);
    height: min(560px, 80vh);
    z-index: 1;
  }

  .title {
    position: absolute;
    top: 3%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    z-index: 5;
    width: 92%;
    opacity: 0;
    animation: titleIn 1.2s ease 0.2s forwards;
  }
  @keyframes titleIn {
    from { opacity: 0; transform: translate(-50%, -10px); }
    to   { opacity: 1; transform: translate(-50%, 0); }
  }
  .title h1 {
    font-family: 'Cinzel', serif;
    font-size: clamp(1.1rem, 2.8vw, 1.9rem);
    font-weight: 700;
    letter-spacing: 0.16em;
    background: linear-gradient(180deg, #fff 0%, var(--gold-light) 50%, var(--gold-deep) 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 20px rgba(212, 175, 55, 0.2);
    text-transform: uppercase;
  }
  .title .sub {
    margin-top: 4px;
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: clamp(0.85rem, 1.6vw, 1.05rem);
    letter-spacing: 0.04em;
    color: rgba(255,255,255,0.75);
  }

  .pillar {
    position: absolute;
    bottom: 16%;
    width: 28px;
    height: 48%;
    background: linear-gradient(90deg, var(--gold-shadow) 0%, var(--gold) 30%, var(--gold-light) 50%, var(--gold) 70%, var(--gold-shadow) 100%);
    border-radius: 6px 6px 2px 2px;
    box-shadow: 0 0 24px rgba(212, 175, 55, 0.3);
    z-index: 3;
    opacity: 0;
    animation: pillarIn 0.8s ease forwards;
  }
  .pillar.left  { left: 13%;  animation-delay: 0.6s; }
  .pillar.right { right: 13%; animation-delay: 0.8s; }
  @keyframes pillarIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  .pillar::before {
    content: '';
    position: absolute;
    top: -12px; left: -7px; right: -7px;
    height: 16px;
    background: linear-gradient(90deg, var(--gold-shadow) 0%, var(--gold) 30%, var(--gold-light) 50%, var(--gold) 70%, var(--gold-shadow) 100%);
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
    transition: box-shadow 0.6s;
  }
  .pillar::after {
    content: '';
    position: absolute;
    bottom: -10px; left: -12px; right: -12px;
    height: 18px;
    background: linear-gradient(180deg, var(--gold-deep), var(--gold-shadow));
    border-radius: 3px;
  }
  .stage.celebrating .pillar::before { box-shadow: 0 0 24px rgba(212, 175, 55, 0.75); }

  .floor {
    position: absolute;
    bottom: 12%;
    left: 6%; right: 6%;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.6), transparent);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
    z-index: 2;
    opacity: 0;
    animation: fadeIn 0.6s ease 0.9s forwards;
  }
  .floor::after {
    content: '';
    position: absolute;
    top: 2px; left: 0; right: 0;
    height: 60px;
    background: linear-gradient(180deg, rgba(212, 175, 55, 0.06), transparent);
  }
  @keyframes fadeIn { to { opacity: 1; } }

  .ribbon-wrap {
    position: absolute;
    top: 44%;
    left: 13%; right: 13%;
    height: 64px;
    z-index: 4;
    opacity: 0;
    animation: fadeIn 0.7s ease 1.0s forwards;
  }
  .ribbon {
    position: absolute;
    top: 0;
    height: 100%;
    width: 50%;
    background: linear-gradient(180deg,
      var(--red-deep) 0%,
      var(--red) 18%,
      var(--red-light) 50%,
      var(--red) 82%,
      var(--red-deep) 100%);
    box-shadow:
      inset 0 0 14px rgba(0,0,0,0.35),
      0 4px 14px rgba(0,0,0,0.4);
    overflow: hidden;
  }
  .ribbon::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,
      transparent 0%,
      rgba(255,255,255,0.15) 35%,
      rgba(255,255,255,0.40) 50%,
      rgba(255,255,255,0.15) 65%,
      transparent 100%);
    pointer-events: none;
  }
  .ribbon.left  { left: 0;  border-radius: 4px 0 0 4px; }
  .ribbon.right { right: 0; border-radius: 0 4px 4px 0; }

  .ribbon.left.cut  { animation: fallLeft  1.4s cubic-bezier(0.55, 0.10, 0.70, 0.90) forwards; }
  .ribbon.right.cut { animation: fallRight 1.4s cubic-bezier(0.55, 0.10, 0.70, 0.90) forwards; }
  @keyframes fallLeft {
    0%   { transform: translate(0, 0) rotate(0);            opacity: 1; }
    20%  { transform: translate(-15px, 10px) rotate(-8deg); }
    100% { transform: translate(-90px, 340px) rotate(-170deg); opacity: 0; }
  }
  @keyframes fallRight {
    0%   { transform: translate(0, 0) rotate(0);           opacity: 1; }
    20%  { transform: translate(15px, 10px) rotate(8deg);  }
    100% { transform: translate(90px, 340px) rotate(170deg); opacity: 0; }
  }

  .bow {
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 130px; height: 90px;
    z-index: 5;
    pointer-events: none;
  }
  .bow-loop {
    position: absolute;
    top: 5px;
    width: 58px; height: 75px;
    background: linear-gradient(180deg, var(--red-deep), var(--red) 30%, var(--red-light) 55%, var(--red), var(--red-deep));
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    box-shadow: inset 0 0 12px rgba(0,0,0,0.35), 0 4px 12px rgba(0,0,0,0.4);
  }
  .bow-loop.left  { left: 0;  transform: rotate(-18deg);            transform-origin: right center; }
  .bow-loop.right { right: 0; transform: rotate(18deg) scaleX(-1);  transform-origin: left center;  }
  .bow-knot {
    position: absolute;
    top: 22px; left: 50%;
    transform: translateX(-50%);
    width: 24px; height: 32px;
    background: linear-gradient(180deg, var(--red-deep), var(--red) 50%, var(--red-deep));
    border-radius: 5px;
    box-shadow: inset 0 0 8px rgba(0,0,0,0.45), 0 2px 8px rgba(0,0,0,0.5);
    z-index: 2;
  }
  .bow.fall { animation: bowFall 1.6s ease-in forwards; }
  @keyframes bowFall {
    0%   { transform: translate(-50%, -50%) scale(1)    rotate(0);     opacity: 1; }
    25%  { transform: translate(-50%, -20%) scale(1.05)  rotate(20deg); }
    100% { transform: translate(-30%, 260px) scale(0.4)  rotate(220deg); opacity: 0; }
  }

  .scissors {
    position: absolute;
    top: 44%;
    left: 50%;
    margin-left: -22px;
    margin-top:  32px;
    width: 240px; height: 90px;
    transform: translateY(-50%);
    opacity: 0;
    z-index: 6;
    pointer-events: none;
  }
  .scissors.fly-in  { animation: flyIn  0.9s cubic-bezier(0.2, 0.8, 0.3, 1) forwards; }
  .scissors.fly-out { animation: flyOut 0.7s ease-in forwards; }
  @keyframes flyIn {
    0%   { transform: translateY(-50%) translateX(500px) rotate(-12deg); opacity: 0; }
    35%  { opacity: 1; }
    100% { transform: translateY(-50%) translateX(0)    rotate(0);     opacity: 1; }
  }
  @keyframes flyOut {
    0%   { transform: translateY(-50%) translateX(0)    rotate(0);    opacity: 1; }
    100% { transform: translateY(-50%) translateX(560px) rotate(12deg); opacity: 0; }
  }
  .blade-top, .blade-bottom {
    transform-box: view-box;
    transform-origin: 160px 45px;
    transition: transform 0.18s ease;
  }
  .blade-top    { transform: rotate(-10deg); }
  .blade-bottom { transform: rotate( 10deg); }
  .scissors.snip .blade-top    { transform: rotate(0deg); }
  .scissors.snip .blade-bottom { transform: rotate(0deg); }

  .scissors.ready {
    pointer-events: auto;
    cursor: pointer;
    animation: floatBob 2.2s ease-in-out infinite;
  }
  @keyframes floatBob {
    0%, 100% { transform: translateY(-50%) translateX(0) rotate(0); }
    50%      { transform: translateY(-52%) translateX(0) rotate(-3deg); }
  }
  .scissors.ready:hover { filter: drop-shadow(0 0 12px rgba(212, 175, 55, 0.8)); }

  .cut-flash {
    position: absolute;
    top: calc(44% + 32px);
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 160px; height: 160px;
    background: radial-gradient(circle, #fff 0%, rgba(255,255,255,0.7) 25%, rgba(255,215,100,0.3) 55%, transparent 75%);
    border-radius: 50%;
    z-index: 7;
    opacity: 0;
    pointer-events: none;
    filter: blur(2px);
  }
  .cut-flash.boom { animation: flash 0.6s ease-out forwards; }
  @keyframes flash {
    0%   { opacity: 0; transform: translate(-50%, -50%) scale(0);   }
    25%  { opacity: 1; transform: translate(-50%, -50%) scale(1.3); }
    100% { opacity: 0; transform: translate(-50%, -50%) scale(2.2); }
  }

  .guests {
    position: absolute;
    bottom: 6%;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 16px;
    z-index: 6;
    flex-wrap: wrap;
    justify-content: center;
    width: 90%;
  }
  .guest-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(212, 175, 55, 0.45);
    border-radius: 12px;
    padding: 12px 22px;
    min-width: 220px;
    max-width: 360px;
    text-align: center;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    opacity: 0;
    transform: translateY(15px);
    animation: cardIn 0.7s ease forwards;
  }
  .guest-card.chief   { animation-delay: 1.4s; }
  .guest-card.special { animation-delay: 1.6s; }
  @keyframes cardIn { to { opacity: 1; transform: translateY(0); } }

  .guest-card .role {
    font-family: 'Cinzel', serif;
    font-size: 0.7rem;
    letter-spacing: 0.2em;
    color: var(--gold-light);
    text-transform: uppercase;
    margin-bottom: 4px;
  }
  .guest-card .role-bn {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 0.85rem;
    color: rgba(212, 175, 55, 0.85);
    margin-bottom: 6px;
    font-weight: 600;
  }
  .guest-card .name {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: clamp(0.95rem, 1.7vw, 1.15rem);
    font-weight: 700;
    color: #fff;
    letter-spacing: 0.02em;
  }
  .guest-card .designation {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 0.82rem;
    color: rgba(255,255,255,0.7);
    margin-top: 2px;
  }
  .guest-card.chief { border-color: rgba(244, 209, 96, 0.6); box-shadow: 0 0 18px rgba(212, 175, 55, 0.15); }
  .guest-card.special { border-color: rgba(200, 16, 46, 0.5); }

  .reveal {
    position: absolute;
    top: calc(44% + 32px);
    left: 50%;
    transform: translate(-50%, -50%) scale(0.7);
    text-align: center;
    z-index: 8;
    opacity: 0;
    pointer-events: none;
    width: 90%;
  }
  .reveal.show { animation: revealIn 1.2s cubic-bezier(0.2, 0.8, 0.3, 1) forwards; }
  @keyframes revealIn {
    0%   { opacity: 0; transform: translate(-50%, -30%) scale(0.7);  }
    60%  { opacity: 1; transform: translate(-50%, -50%) scale(1.05); }
    100% { opacity: 1; transform: translate(-50%, -50%) scale(1);    }
  }
  .reveal h2 {
    font-family: 'Cinzel', serif;
    font-size: clamp(1.4rem, 4vw, 2.6rem);
    font-weight: 700;
    letter-spacing: 0.22em;
    background: linear-gradient(180deg, #fff 0%, var(--gold-light) 45%, var(--gold) 75%, var(--gold-deep) 100%);
    -webkit-background-clip: text; background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 4px 30px rgba(212, 175, 55, 0.4);
  }
  .reveal .bn {
    margin-top: 6px;
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: clamp(0.95rem, 2.2vw, 1.35rem);
    font-weight: 700;
    letter-spacing: 0.05em;
    color: rgba(255,255,255,0.92);
  }
  .reveal .tag {
    margin-top: 10px;
    font-family: 'Cinzel', serif;
    font-size: clamp(0.65rem, 1.3vw, 0.85rem);
    letter-spacing: 0.28em;
    color: rgba(212, 175, 55, 0.85);
    text-transform: uppercase;
  }

  .redirect-notice {
    position: absolute;
    bottom: 2%;
    left: 50%;
    transform: translateX(-50%);
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 0.78rem;
    color: rgba(255,255,255,0.5);
    z-index: 10;
    opacity: 0;
    text-align: center;
  }
  .redirect-notice.show { animation: fadeIn 0.5s ease forwards; }
  .redirect-notice .dots::after {
    content: '...';
    display: inline-block;
    animation: dots 1.4s steps(4) infinite;
    width: 1em;
    text-align: left;
  }
  @keyframes dots {
    0%   { content: ''; }
    25%  { content: '.'; }
    50%  { content: '..'; }
    75%  { content: '...'; }
    100% { content: ''; }
  }

  .confetti {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 9;
    overflow: hidden;
  }
  .confetti-piece {
    position: absolute;
    top: calc(44% + 32px);
    left: 50%;
    width: 10px; height: 14px;
    opacity: 0;
    will-change: transform, opacity;
  }

  @keyframes confettiFly {
    0%   { opacity: 1; transform: translate(-50%, -50%) rotate(0deg); }
    35%  { opacity: 1; transform: translate(calc(-50% + var(--dx)), calc(-50% + var(--dy))) rotate(calc(var(--rot) * 0.35)); }
    100% { opacity: 0; transform: translate(calc(-50% + var(--dx) * 0.55), calc(-50% + var(--dy) + var(--fall))) rotate(var(--rot)); }
  }

  @media (max-width: 600px) {
    .pillar { width: 22px; }
    .scissors { width: 200px; height: 75px; margin-left: -18px; }
    .bow { width: 110px; height: 76px; }
    .guests { gap: 10px; }
    .guest-card { min-width: 0; flex: 1 1 240px; padding: 10px 14px; }
  }

  @media (prefers-reduced-motion: reduce) {
    * { animation-duration: 0.3s !important; transition-duration: 0.2s !important; }
  }
</style>
</head>
<body>
<div class="stage" id="stage">
  <div class="title">
    <h1>Digital Office Management System</h1>
    <div class="sub">ডিজিটাল অফিস ব্যবস্থাপনা সিস্টেম</div>
  </div>

  <div class="floor"></div>
  <div class="pillar left"></div>
  <div class="pillar right"></div>

  <div class="ribbon-wrap">
    <div class="ribbon left"  id="ribbonLeft"></div>
    <div class="ribbon right" id="ribbonRight"></div>
    <div class="bow" id="bow">
      <div class="bow-loop left"></div>
      <div class="bow-loop right"></div>
      <div class="bow-knot"></div>
    </div>
  </div>

  <svg class="scissors" id="scissors" viewBox="0 0 240 90" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="bladeGrad" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0"   stop-color="#f5f7fa"/>
        <stop offset="0.5" stop-color="#cbd5e0"/>
        <stop offset="1"   stop-color="#7d8a99"/>
      </linearGradient>
      <linearGradient id="handleGrad" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#f4d160"/>
        <stop offset="1" stop-color="#8a6d1f"/>
      </linearGradient>
    </defs>
    <g class="blade-bottom">
      <line x1="200" y1="65" x2="160" y2="45" stroke="url(#bladeGrad)" stroke-width="6" stroke-linecap="round"/>
      <path d="M 160 38 L 160 52 L 22 45 Z" fill="url(#bladeGrad)" stroke="#5a6877" stroke-width="0.5"/>
      <ellipse cx="200" cy="65" rx="14" ry="16" fill="none" stroke="url(#handleGrad)" stroke-width="7"/>
    </g>
    <g class="blade-top">
      <line x1="200" y1="25" x2="160" y2="45" stroke="url(#bladeGrad)" stroke-width="6" stroke-linecap="round"/>
      <path d="M 160 38 L 160 52 L 22 45 Z" fill="url(#bladeGrad)" stroke="#5a6877" stroke-width="0.5"/>
      <ellipse cx="200" cy="25" rx="14" ry="16" fill="none" stroke="url(#handleGrad)" stroke-width="7"/>
    </g>
    <circle cx="160" cy="45" r="5" fill="#5a6877"/>
    <circle cx="160" cy="45" r="2" fill="#2d3748"/>
  </svg>

  <div class="cut-flash" id="flash"></div>

  <div class="reveal" id="reveal">
    <h2>INAUGURATED</h2>
    <div class="bn">উদ্বোধন সম্পন্ন</div>
    <div class="tag">System is now live</div>
  </div>

  <div class="guests" id="guests">
    <div class="guest-card chief" id="cardChief">
      <div class="role">Chief Guest</div>
      <div class="role-bn">প্রধান অতিথি</div>
      <div class="name" id="chiefName">লিয়াকত আলী মোল্লা</div>
      <div class="designation" id="chiefDesignation">সচিব, আইন ও বিচার বিভাগ</div>
    </div>
    <div class="guest-card special" id="cardSpecial">
      <div class="role">Special Guest</div>
      <div class="role-bn">বিশেষ অতিথি</div>
      <div class="name" id="specialName">মোঃ খাদেম উল কায়েস</div>
      <div class="designation" id="specialDesignation">অতিরিক্ত সচিব, আইন ও বিচার বিভাগ</div>
    </div>
  </div>

  <div class="confetti" id="confetti"></div>

  <div class="redirect-notice" id="notice">
    <span>সিস্টেমে প্রবেশ করা হচ্ছে</span><span class="dots"></span>
  </div>
</div>

<script>
(function () {
  // ============================================================
  //  CONFIG — change these or pass them via URL query params:
  //    ?chiefName=...&chiefDesignation=...&specialName=...
  //    &specialDesignation=...&redirect=URL
  //
  //  LARAVEL USAGE:
  //  The redirect URL is generated by Blade using the named route.
  //  Your login route: Route::get('/login', [infoimp::class, 'index'])->name('login');
  //  So {{ route('login') }} resolves to /login automatically.
  // ============================================================
  const params = new URLSearchParams(location.search);

  const chiefName         = params.get('chiefName')         || 'লিয়াকত আলী মোল্লা';
  const chiefDesignation  = params.get('chiefDesignation')  || 'সচিব, আইন ও বিচার বিভাগ';
  const specialName       = params.get('specialName')       || 'মোঃ খাদেম উল কায়েস';
  const specialDesignation= params.get('specialDesignation')|| 'অতিরিক্ত সচিব, আইন ও বিচার বিভাগ';

  // Where to go after the animation finishes.
  // Blade outputs the login URL here at render time.
  // Override at runtime with ?redirect=/other-path
  const REDIRECT_URL = params.get('redirect') || 'http://127.0.0.1:8000/login';

  // How long after the reveal to wait before redirecting (ms)
  const REDIRECT_DELAY = 2200;

  document.getElementById('chiefName').textContent        = chiefName;
  document.getElementById('chiefDesignation').textContent = chiefDesignation;
  document.getElementById('specialName').textContent       = specialName;
  document.getElementById('specialDesignation').textContent = specialDesignation;
  document.getElementById('notice').querySelector('span').textContent =
    'সিস্টেমে প্রবেশ করা হচ্ছে';

  // ============================================================
  //  Animation orchestration — cut is triggered by CLICKING the scissors
  // ============================================================
  const stage      = document.getElementById('stage');
  const scissors   = document.getElementById('scissors');
  const ribbonL    = document.getElementById('ribbonLeft');
  const ribbonR    = document.getElementById('ribbonRight');
  const bow        = document.getElementById('bow');
  const flash      = document.getElementById('flash');
  const reveal     = document.getElementById('reveal');
  const confetti   = document.getElementById('confetti');
  const notice     = document.getElementById('notice');

  let cutTriggered = false;

  const COLORS = ['#d4af37', '#f4d160', '#c8102e', '#ff3b5c', '#ffffff', '#2b6cb0', '#2f855a', '#ff8c42'];

  function makeConfetti(count) {
    confetti.innerHTML = '';
    const frag = document.createDocumentFragment();
    for (let i = 0; i < count; i++) {
      const p = document.createElement('div');
      p.className = 'confetti-piece';
      p.style.background = COLORS[(Math.random() * COLORS.length) | 0];

      const angle    = Math.random() * Math.PI * 2;
      const distance = 90 + Math.random() * 320;
      const dx       = Math.cos(angle) * distance;
      const dy       = Math.sin(angle) * distance - 80 - Math.random() * 120;
      const fall     = 500 + Math.random() * 300;
      const delay    = Math.random() * 0.25;
      const dur      = 1.8 + Math.random() * 1.6;
      const rot      = (360 + Math.random() * 720) * (Math.random() > 0.5 ? 1 : -1);

      p.style.setProperty('--dx',   dx + 'px');
      p.style.setProperty('--dy',   dy + 'px');
      p.style.setProperty('--fall', fall + 'px');
      p.style.setProperty('--rot',  rot + 'deg');

      p.style.width  = (6  + Math.random() * 8) + 'px';
      p.style.height = (10 + Math.random() * 8) + 'px';
      if (Math.random() > 0.5) p.style.borderRadius = '50%';

      p.style.animation = 'confettiFly ' + dur + 's cubic-bezier(0.2, 0.6, 0.4, 1) ' + delay + 's forwards';
      frag.appendChild(p);
    }
    confetti.appendChild(frag);
  }

  // 1) Scissors fly in (auto)
  setTimeout(function () { scissors.classList.add('fly-in'); }, 1700);

  // 2) Make scissors clickable
  setTimeout(function () { scissors.classList.add('ready'); }, 2600);

  // 3) On click → run the cut sequence
  function performCut() {
    if (cutTriggered) return;
    cutTriggered = true;

    scissors.classList.remove('ready');
    scissors.classList.add('snip');

    setTimeout(function () {
      ribbonL.classList.add('cut');
      ribbonR.classList.add('cut');
      bow.classList.add('fall');
      flash.classList.add('boom');
      stage.classList.add('celebrating');
      makeConfetti(110);
    }, 180);

    setTimeout(function () {
      scissors.classList.add('fly-out');
      scissors.classList.remove('snip');
    }, 400);

    setTimeout(function () { reveal.classList.add('show'); }, 800);

    setTimeout(function () { notice.classList.add('show'); }, 3000);

    setTimeout(function () {
      window.location.href = REDIRECT_URL;
    }, 3000 + REDIRECT_DELAY);
  }

  scissors.addEventListener('click', performCut);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Enter' || e.key === ' ') {
      if (!cutTriggered && scissors.classList.contains('ready')) {
        e.preventDefault();
        performCut();
      }
    }
  });
})();
</script>
</body>
</html>