<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নতুন পাসওয়ার্ড | ডিজিটাল স্টোর ম্যানেজমেন্ট সিস্টেম</title>

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

        .lg-steps { display: flex; gap: 8px; margin: 0 0 22px; padding: 0; list-style: none; }
        .lg-steps li {
            flex: 1; padding-top: 8px;
            font-size: 12px; color: var(--muted);
            border-top: 4px solid var(--line);
        }
        .lg-steps li.is-done { border-top-color: #7fb69a; }
        .lg-steps li.is-current { color: var(--green); font-weight: 700; border-top-color: var(--green); }

        .lg-field { margin-bottom: 16px; }
        .lg-label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        .lg-input-wrap { position: relative; }
        .lg-input {
            width: 100%;
            height: 46px;
            padding: 0 76px 0 14px;
            font: inherit;
            font-size: 15px;
            color: var(--ink);
            background: #fff;
            border: 1.5px solid var(--line);
            border-radius: 8px;
        }
        .lg-input:focus { outline: none; border-color: var(--green); box-shadow: 0 0 0 3px rgba(11, 93, 59, .18); }
        .lg-input.is-invalid { border-color: var(--error); }

        .lg-toggle {
            position: absolute; top: 50%; right: 6px; transform: translateY(-50%);
            padding: 6px 10px;
            font: inherit; font-size: 13px; color: var(--green);
            background: none; border: 0; border-radius: 6px; cursor: pointer;
        }
        .lg-toggle:hover { background: #eef6f1; }
        .lg-toggle:focus-visible { outline: 2px solid var(--green); }

        .lg-error { margin: 6px 0 0; font-size: 13px; color: var(--error); }
        .lg-alert {
            margin-bottom: 18px; padding: 10px 14px;
            font-size: 14px; color: var(--error);
            background: #fdecea; border: 1px solid #f5c2bd; border-radius: 8px;
        }

        /* live rule checklist */
        .lg-rules { margin: 0 0 18px; padding: 12px 14px; list-style: none; background: var(--paper); border-radius: 8px; font-size: 13px; }
        .lg-rules li { display: flex; gap: 8px; color: var(--muted); }
        .lg-rules li + li { margin-top: 2px; }
        .lg-rules li::before { content: '\25CB'; width: 1em; flex: none; }
        .lg-rules li.is-ok { color: var(--green); font-weight: 600; }
        .lg-rules li.is-ok::before { content: '\2713'; }

        .lg-btn {
            width: 100%; height: 48px;
            font: inherit; font-size: 16px; font-weight: 700;
            color: #fff; background: var(--green);
            border: 0; border-radius: 8px; cursor: pointer;
        }
        .lg-btn:hover { background: var(--green-dark); }
        .lg-btn:focus-visible { outline: 3px solid rgba(11, 93, 59, .4); outline-offset: 2px; }
        .lg-btn[disabled] { opacity: .5; cursor: not-allowed; }

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
            .lg-card { padding: 26px 20px 22px; }
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
            <h2>নতুন পাসওয়ার্ড দিন</h2>
            <p class="lg-lead">ওটিপি যাচাই হয়েছে। নিরাপত্তার জন্য ১০ মিনিটের মধ্যে পাসওয়ার্ড পরিবর্তন সম্পূর্ণ করুন।</p>

            <ol class="lg-steps" aria-label="পাসওয়ার্ড পুনরুদ্ধারের ধাপ">
                <li class="is-done">ইমেইল</li>
                <li class="is-done">ওটিপি</li>
                <li class="is-current" aria-current="step">নতুন পাসওয়ার্ড</li>
            </ol>

            @if ($errors->has('error'))
                <div class="lg-alert" role="alert">{{ $errors->first('error') }}</div>
            @endif

            <form method="POST" action="{{ route('forget44') }}" id="reset-form">
                @csrf

                <div class="lg-field">
                    <label class="lg-label" for="password">নতুন পাসওয়ার্ড</label>
                    <div class="lg-input-wrap">
                        <input id="password" type="password" name="password"
                               class="lg-input @error('password') is-invalid @enderror"
                               required autocomplete="new-password" autofocus
                               aria-describedby="rules">
                        <button type="button" class="lg-toggle" data-target="password" aria-pressed="false">দেখান</button>
                    </div>
                    @error('password')
                        <p class="lg-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="lg-field">
                    <label class="lg-label" for="password_confirmation">পাসওয়ার্ড আবার লিখুন</label>
                    <div class="lg-input-wrap">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="lg-input" required autocomplete="new-password">
                        <button type="button" class="lg-toggle" data-target="password_confirmation" aria-pressed="false">দেখান</button>
                    </div>
                </div>

                <ul class="lg-rules" id="rules">
                    <li data-rule="length">কমপক্ষে ১২ অক্ষর</li>
                    <li data-rule="upper">একটি বড় হাতের ইংরেজি অক্ষর (A-Z)</li>
                    <li data-rule="lower">একটি ছোট হাতের ইংরেজি অক্ষর (a-z)</li>
                    <li data-rule="digit">একটি ইংরেজি সংখ্যা (0-9)</li>
                    <li data-rule="symbol">একটি চিহ্ন: # ? ! @ $ % ^ &amp; * -</li>
                    <li data-rule="match">দুই ঘরের পাসওয়ার্ড মিলেছে</li>
                </ul>

                <button type="submit" class="lg-btn" id="submit-btn">পাসওয়ার্ড পরিবর্তন করুন</button>
            </form>

            <p class="lg-back">
                <a class="lg-link" href="{{ route('forget11') }}">শুরুতে ফিরে যান</a>
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
(function () {
    var pw      = document.getElementById('password');
    var confirm = document.getElementById('password_confirmation');
    var btn     = document.getElementById('submit-btn');
    var form    = document.getElementById('reset-form');

    // show / hide toggles
    Array.prototype.forEach.call(document.querySelectorAll('.lg-toggle'), function (t) {
        t.addEventListener('click', function () {
            var input = document.getElementById(t.getAttribute('data-target'));
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            t.textContent = show ? 'লুকান' : 'দেখান';
            t.setAttribute('aria-pressed', show ? 'true' : 'false');
        });
    });

    // same rules as the server (min 12, A-Z, a-z, 0-9, one of # ? ! @ $ % ^ & * -)
    function checks() {
        var v = pw.value;
        return {
            length: v.length >= 12 && v.length <= 128,
            upper:  /[A-Z]/.test(v),
            lower:  /[a-z]/.test(v),
            digit:  /[0-9]/.test(v),
            symbol: /[#?!@$%^&*\-]/.test(v),
            match:  v !== '' && v === confirm.value
        };
    }

    function update() {
        var c = checks(), all = true;
        Array.prototype.forEach.call(document.querySelectorAll('#rules li'), function (li) {
            var ok = c[li.getAttribute('data-rule')];
            li.classList.toggle('is-ok', ok);
            if (!ok) all = false;
        });
        btn.disabled = !all;
    }

    pw.addEventListener('input', update);
    confirm.addEventListener('input', update);
    update();   // sets the initial state (button stays enabled if this script fails to load)

    form.addEventListener('submit', function () {
        btn.disabled = true;
        btn.textContent = 'পরিবর্তন হচ্ছে...';
    });
})();
</script>
</body>
</html>