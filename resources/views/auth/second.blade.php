<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Digital Office Management — Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  :root {
    --green: #006a4e;
    --green-dark: #004d38;
    --red: #f42a41;
    --blue: #1a3c6e;
    --gold: #c9a227;
    --ink: #1f2937;
    --muted: #6b7280;
    --line: #e5e7eb;
    --bg: #f4f6f8;
  }

  body {
    font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
    color: var(--ink);
    background: var(--bg);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* ---------- Site heading ---------- */
  .site-heading {
    background: #fff;
    border-bottom: 4px solid var(--green);
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
  }
  .site-heading .inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 22px 20px;
    text-align: center;
  }
  .site-heading h1 {
    font-size: clamp(1.3rem, 2.6vw, 1.8rem);
    font-weight: 700;
    color: var(--green);
    letter-spacing: 0.03em;
    line-height: 1.3;
  }
  .site-heading .division {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: clamp(0.95rem, 1.8vw, 1.15rem);
    font-weight: 600;
    color: var(--ink);
    margin-top: 6px;
  }
  .site-heading .division-bn {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 0.85rem;
    color: var(--muted);
    margin-top: 2px;
  }

  /* ---------- Main content ---------- */
  main {
    flex: 1;
    max-width: 1180px;
    width: 100%;
    margin: 0 auto;
    padding: 48px 20px 40px;
  }

  .intro {
    text-align: center;
    margin-bottom: 36px;
  }
  .intro h2 {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 1.4rem;
    color: var(--ink);
    font-weight: 700;
  }
  .intro p {
    font-family: 'Noto Sans Bengali', sans-serif;
    color: var(--muted);
    margin-top: 8px;
    font-size: 0.95rem;
  }

  /* ---------- Card grid ---------- */
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
  }

  .portal-card {
    display: block;
    text-decoration: none;
    color: inherit;
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 6px;
    overflow: hidden;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
  }
  .portal-card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    transform: translateY(-2px);
  }

  .card-banner {
    height: 6px;
    background: var(--green);
  }
  .portal-card.meeting .card-banner { background: var(--blue); }

  .card-body {
    padding: 32px 28px;
    text-align: center;
  }

  .icon-wrap {
    width: 72px;
    height: 72px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: #f0f9f5;
    border: 2px solid var(--green);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .meeting .icon-wrap {
    background: #eef3fb;
    border-color: var(--blue);
  }
  .icon-wrap svg { width: 38px; height: 38px; }

  .card-title-en {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--ink);
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .card-title-bn {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--green);
    margin-top: 6px;
  }
  .meeting .card-title-bn { color: var(--blue); }

  .card-desc {
    font-family: 'Noto Sans Bengali', sans-serif;
    font-size: 0.88rem;
    color: var(--muted);
    line-height: 1.6;
    margin-top: 12px;
    padding-top: 14px;
    border-top: 1px solid var(--line);
  }

  .enter-btn {
    display: inline-block;
    margin-top: 18px;
    padding: 10px 28px;
    background: var(--green);
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    border-radius: 4px;
    transition: background 0.2s ease;
  }
  .meeting .enter-btn { background: var(--blue); }
  .portal-card:hover .enter-btn { background: var(--green-dark); }
  .meeting.portal-card:hover .enter-btn { background: #15315a; }

  /* ---------- Footer bottom ---------- */
  .footer-bottom {
    background: var(--green-dark);
    text-align: center;
    padding: 12px 20px;
    font-size: 0.78rem;
    color: rgba(255,255,255,0.7);
    font-family: 'Noto Sans Bengali', sans-serif;
  }

  /* ---------- Mobile ---------- */
  @media (max-width: 720px) {
    .grid { grid-template-columns: 1fr; }
    main { padding: 40px 20px 24px; }
  }
</style>
</head>
<body>

<!-- Site heading -->
<div class="site-heading">
  <div class="inner">
    <h1>Digital Office Management System</h1>
    <div class="division">আইন, বিচার ও সংসদ বিষয়ক মন্ত্রণালয়</div>
    <div class="division-bn">আইন ও বিচার বিভাগ</div>
  </div>
</div>

<!-- Main content -->
<main>
  <div class="intro">
    <h2>আপনার পছন্দের সিস্টেম নির্বাচন করুন</h2>
    <p>Select your desired system to continue</p>
  </div>

  <div class="grid">
    <!-- LEFT: Digital Store Management -->
    <a class="portal-card store" id="cardStore" href="#" data-route="store">
      <div class="card-banner"></div>
      <div class="card-body">
        <div class="icon-wrap">
          <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 18 L10 8 h28 l2 10" stroke="#006a4e" stroke-width="2.4" stroke-linejoin="round"/>
            <path d="M8 18 v22 a2 2 0 0 0 2 2 h28 a2 2 0 0 0 2 -2 V18" stroke="#006a4e" stroke-width="2.4" stroke-linejoin="round"/>
            <path d="M8 18 c0 3 2.6 5 6 5 s6 -2 6 -5 c0 3 2.6 5 6 5 s6 -2 6 -5 c0 3 2.6 5 6 5 s6 -2 6 -5" stroke="#006a4e" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M18 45 V30 h12 v15" stroke="#006a4e" stroke-width="2.4" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="card-title-en">Digital Store Management</div>
        <div class="card-title-bn">ডিজিটাল স্টোর ব্যবস্থাপনা</div>
        <div class="card-desc">স্টোরের দৈনন্দিন কার্যক্রম, ইনভেন্টরি ও রেকর্ড ব্যবস্থাপনার একীকৃত ডিজিটাল সমাধান</div>
        <div class="enter-btn">প্রবেশ করুন / Enter</div>
      </div>
    </a>

    <!-- RIGHT: Digital Meeting Management -->
    <a class="portal-card meeting" id="cardMeeting" href="#" data-route="meeting">
      <div class="card-banner"></div>
      <div class="card-body">
        <div class="icon-wrap">
          <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="6" y="10" width="26" height="20" rx="3" stroke="#1a3c6e" stroke-width="2.4"/>
            <path d="M32 18 l10 -6 v16 l-10 -6" stroke="#1a3c6e" stroke-width="2.4" stroke-linejoin="round"/>
            <path d="M14 38 h20" stroke="#1a3c6e" stroke-width="2.4" stroke-linecap="round"/>
            <path d="M24 30 v8" stroke="#1a3c6e" stroke-width="2.4" stroke-linecap="round"/>
            <circle cx="19" cy="20" r="3" stroke="#1a3c6e" stroke-width="2"/>
            <path d="M13 27 c1 -3 3 -4 6 -4 s5 1 6 4" stroke="#1a3c6e" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="card-title-en">Digital Meeting Management</div>
        <div class="card-title-bn">ডিজিটাল মিটিং ব্যবস্থাপনা</div>
        <div class="card-desc">মিটিং শিডিউলিং, আমন্ত্রণ, এজেন্ডা ও কার্যবিবরণীর আধুনিক ডিজিটাল প্ল্যাটফর্ম</div>
        <div class="enter-btn">প্রবেশ করুন / Enter</div>
      </div>
    </a>
  </div>
</main>

<!-- Footer bottom -->
<div class="footer-bottom">
  © ২০২৬ গণপ্রজাতন্ত্রী বাংলাদেশ সরকার | সর্বস্বত্ব সংরক্ষিত | এই সাইটটি টেকনিক্যাল সহায়তায় আইসিটি সেল, আইন ও বিচার বিভাগ দ্বারা পরিচালিত
</div>

<script>
(function () {
  // ============================================================
  //  LARAVEL ROUTES — set your route URLs here.
  //  In a Blade file you can embed routes directly:
  //    store:   "{{ route('store.dashboard') }}",
  //    meeting: "{{ route('meeting.dashboard') }}",
  // ============================================================
  const ROUTES = {
    store:   '/store',
    meeting: '/meeting'
  };

  document.getElementById('cardStore').href   = ROUTES.store;
  document.getElementById('cardMeeting').href = ROUTES.meeting;
})();
</script>
</body>
</html>