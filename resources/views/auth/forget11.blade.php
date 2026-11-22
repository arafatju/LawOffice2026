<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পাসওয়ার্ড পুনরুদ্ধার | ডিজিটাল স্টোর ম্যানেজমেন্ট সিস্টেম</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('sweetalert::alert')

    <style>
        :root {
            --green: #0b5d3b;
            --green-dark: #084a2f;
            --ink: #1d2a24;
            --muted: #5d6b64;
            --line: #cfd8d2;
            --paper: #f4f6f3;
            --error: #b42318;
        }

        body.lg-body {
            margin: 0;
            font-family: 'Noto Sans Bengali', 'Kalpurush', 'SolaimanLipi', system-ui, Arial, sans-serif;
            color: var(--ink);
            background: var(--paper);
            line-height: 1.6;
        }
        .lg-body *, .lg-body *::before, .lg-body *::after { box-sizing: border-box; }

        .lg-shell {
            display: grid;
            grid-template-columns: minmax(320px, 5fr) 6fr;
            min-height: 100vh;
        }

        /* ---------- brand panel ---------- */
        .lg-brand {
            background: var(--green);
            color: #fff;
            padding: 40px 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 28px;
        }
        .lg-gov { display: flex; flex-direction: column; align-items: center; gap: 14px; }
        .lg-gov img {
            width: 84px; height: 84px; padding: 6px;
            background: #fff; border-radius: 50%; object-fit: contain;
        }
        .lg-ministry { margin: 0; font-size: 20px; font-weight: 700; line-height: 1.4; }
        .lg-division { margin: 4px 0 0; font-size: 14px; color: #cfe6d9; }

        .lg-shelves { margin: auto 0; width: 100%; max-width: 380px; height: auto; }

        .lg-title { margin: 0; font-size: 30px; line-height: 1.35; font-weight: 700; }
        .lg-version {
            padding: 4px 14px;
            border: 1px solid #7fb69a;
            border-radius: 999px;
            font-size: 14px;
            color: #e3f3ea;
        }

        /* ---------- form panel ---------- */
        .lg-main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 24px;
        }
        .lg-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 32px 32px 28px;
        }
        .lg-card h2 { margin: 0 0 4px; font-size: 24px; font-weight: 700; }
        .lg-card .lg-lead { margin: 0 0 22px; color: var(--muted); font-size: 15px; }

        /* the three steps of the reset flow */
        .lg-steps { display: flex; gap: 8px; margin: 0 0 22px; padding: 0; list-style: none; }
        .lg-steps li {
            flex: 1; padding-top: 8px;
            font-size: 12px; color: var(--muted);
            border-top: 4px solid var(--line);
        }
        .lg-steps li.is-current { color: var(--green); font-weight: 700; border-top-color: var(--green); }

        .lg-field { margin-bottom: 18px; }
        .lg-label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        .lg-input {
            width: 100%;
            height: 46px;
            padding: 0 14px;
            font: inherit;
            font-size: 15px;
            color: var(--ink);
            background: #fff;
            border: 1.5px solid var(--line);
            border-radius: 8px;
        }
        .lg-input::placeholder { color: #9aa7a0; }
        .lg-input:focus { outline: none; border-color: var(--green); box-shadow: 0 0 0 3px rgba(11, 93, 59, .18); }
        .lg-input.is-invalid { border-color: var(--error); }

        .lg-error { margin: 6px 0 0; font-size: 13px; color: var(--error); }
        .lg-alert {
            margin-bottom: 18px; padding: 10px 14px;
            font-size: 14px; color: var(--error);
            background: #fdecea; border: 1px solid #f5c2bd; border-radius: 8px;
        }

        .lg-btn {
            width: 100%; height: 48px;
            font: inherit; font-size: 16px; font-weight: 700;
            color: #fff; background: var(--green);
            border: 0; border-radius: 8px; cursor: pointer;
        }
        .lg-btn:hover { background: var(--green-dark); }
        .lg-btn:focus-visible { outline: 3px solid rgba(11, 93, 59, .4); outline-offset: 2px; }
        .lg-btn[disabled] { opacity: .7; cursor: wait; }

        .lg-back { margin: 18px 0 0; text-align: center; }
        .lg-link { font-size: 14px; color: var(--green); text-decoration: none; }
        .lg-link:hover { text-decoration: underline; }
        .lg-link:focus-visible { outline: 2px solid var(--green); outline-offset: 2px; border-radius: 4px; }

        .lg-foot {
            width: 100%; max-width: 420px;
            margin-top: 22px;
            text-align: center; font-size: 12px; line-height: 1.6; color: var(--muted);
        }
        .lg-foot p { margin: 0; }

        /* ---------- small screens ---------- */
        @media (max-width: 860px) {
            .lg-shell { grid-template-columns: 1fr; min-height: 0; }
            .lg-brand { padding: 24px 20px; gap: 16px; }
            .lg-shelves { display: none; }
            .lg-title { font-size: 22px; }
            .lg-gov img { width: 64px; height: 64px; }
            .lg-ministry { font-size: 17px; }
            .lg-main { padding: 24px 16px 32px; }
            .lg-card { padding: 26px 22px 22px; }
        }
        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body class="lg-body">
<div class="lg-shell">

    <!-- Brand panel -->
    <aside class="lg-brand">
        <div class="lg-gov">
            <img src="{{ asset('gov.png') }}" alt="গণপ্রজাতন্ত্রী বাংলাদেশ সরকারের লোগো">
            <div>
                <p class="lg-ministry">আইন, বিচার ও সংসদ বিষয়ক মন্ত্রণালয়</p>
                <p class="lg-division">আইন ও বিচার বিভাগ, বাংলাদেশ সচিবালয়, ঢাকা</p>
            </div>
        </div>

        <svg class="lg-shelves" viewBox="0 0 320 190" role="img" aria-label="স্টোররুমের তাক">
            <g fill="#e9efe9">
                <rect x="10" y="10" width="6" height="170"/>
                <rect x="304" y="10" width="6" height="170"/>
                <rect x="10" y="64" width="300" height="6"/>
                <rect x="10" y="124" width="300" height="6"/>
                <rect x="10" y="180" width="300" height="6"/>
            </g>
            <rect x="28"  y="30" width="56" height="34" fill="#f2c14e"/>
            <rect x="92"  y="42" width="40" height="22" fill="#e9efe9"/>
            <rect x="140" y="24" width="48" height="40" fill="#7fb69a"/>
            <rect x="198" y="38" width="62" height="26" fill="#f2c14e"/>
            <rect x="28"  y="88" width="44" height="36" fill="#e9efe9"/>
            <rect x="80"  y="76" width="60" height="48" fill="#7fb69a"/>
            <rect x="150" y="96" width="50" height="28" fill="#f2c14e"/>
            <rect x="210" y="84" width="46" height="40" fill="#e9efe9"/>
            <rect x="28"  y="144" width="70" height="36" fill="#f2c14e"/>
            <rect x="106" y="136" width="44" height="44" fill="#c8312e"/>
            <rect x="160" y="150" width="58" height="30" fill="#7fb69a"/>
            <rect x="228" y="140" width="52" height="40" fill="#e9efe9"/>
        </svg>

        <h1 class="lg-title">ডিজিটাল স্টোর<br>ম্যানেজমেন্ট সিস্টেম</h1>
        <span class="lg-version">সংস্করণ ২.৫</span>
    </aside>

    <!-- Form panel -->
    <main class="lg-main">
        <div class="lg-card">
            <h2>পাসওয়ার্ড পুনরুদ্ধার</h2>
            <p class="lg-lead">আপনার অ্যাকাউন্টের ইমেইল দিন। আমরা ৬ ডিজিটের একটি ওটিপি পাঠাব, যা ৫ মিনিট পর্যন্ত কার্যকর থাকবে।</p>

            <ol class="lg-steps" aria-label="পাসওয়ার্ড পুনরুদ্ধারের ধাপ">
                <li class="is-current" aria-current="step">ইমেইল</li>
                <li>ওটিপি</li>
                <li>নতুন পাসওয়ার্ড</li>
            </ol>

            @if ($errors->has('error') || $errors->has('otp'))
                <div class="lg-alert" role="alert">{{ $errors->first('error') ?: $errors->first('otp') }}</div>
            @endif

            <form method="POST" action="{{ route('forget22') }}" id="forget-form">
                @csrf

                <div class="lg-field">
                    <label class="lg-label" for="email">ইমেইল</label>
                    <input id="email" type="email" name="email"
                           class="lg-input @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="name@example.gov.bd"
                           required autocomplete="email" autofocus>
                    @error('email')
                        <p class="lg-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="lg-btn" id="send-btn">ওটিপি পাঠান</button>
            </form>

            <p class="lg-back">
                <a class="lg-link" href="{{ route('login') }}">লগইন পেজে ফিরে যান</a>
            </p>
        </div>

        <div class="lg-foot">
            <p>&copy; {{ date('Y') }} আইন ও বিচার বিভাগ, আইন, বিচার ও সংসদ বিষয়ক মন্ত্রণালয়</p>
            <p>Technical Consultancy: Arafat Ur Rahman, Assistant Programmer, MOLJPA</p>
            <p>Version 2.5</p>
        </div>
    </main>
</div>

<script>
    // stop double submits (each click would send another OTP email)
    document.getElementById('forget-form').addEventListener('submit', function () {
        var btn = document.getElementById('send-btn');
        btn.disabled = true;
        btn.textContent = 'পাঠানো হচ্ছে...';
    });
</script>
</body>
</html>