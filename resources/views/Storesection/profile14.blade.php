{{-- resources/views/dashboard.blade.php --}}
@extends('common.master2')

@section('title', 'সেকশন অ্যাডমিন ব্যবস্থাপনা')
@section('breadcrumb', 'প্রোফাইল ব্যবস্থাপনা')

@section('content')
@php
    // ইংরেজি সংখ্যা -> বাংলা সংখ্যা
    $bn = fn($v) => strtr((string) $v, [
        '0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪',
        '5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯',
    ]);
    $months = [1=>'জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন',
               'জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    $bnDate = fn($d) => $bn($d->day).' '.$months[$d->month].' '.$bn($d->year);

    $info = $user->personalinfo;
    $na   = 'প্রদান করা হয়নি';
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .gp {
        --green: #006a4e;
        --green-dark: #004d38;
        --red: #f42a41;
        --ink: #1c2b27;
        --muted: #5c6b66;
        --line: #d9e2de;
        --paper: #ffffff;
        --bg: #eef3f0;
        font-family: 'Hind Siliguri', 'Noto Sans Bengali', 'Kalpurush', sans-serif;
        color: var(--ink);
        background: var(--bg);
        padding: 2rem 1rem 3rem;
        line-height: 1.6;
    }
    .gp *, .gp *::before, .gp *::after { box-sizing: border-box; }

    .gp-sheet {
        max-width: 960px;
        margin: 0 auto;
        background: var(--paper);
        border: 1px solid var(--line);
        border-top: 6px solid var(--green);
        border-radius: 6px;
        box-shadow: 0 2px 12px rgba(0, 40, 30, .08);
    }

    /* শিরোনাম */
    .gp-head {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--line);
    }
    .gp-head h1 { margin: 0; font-size: 1.35rem; font-weight: 700; color: var(--green-dark); }

    /* দুই কলাম */
    .gp-body { display: grid; grid-template-columns: 280px 1fr; }

    .gp-id {
        padding: 2rem 1.5rem;
        text-align: center;
        border-right: 1px solid var(--line);
        background: #f7faf8;
    }
    .gp-avatar {
        width: 112px; height: 112px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        border: 3px solid var(--green);
        background: #fff;
        color: var(--green);
        display: grid; place-items: center;
        font-size: 3rem;
    }
    .gp-name { margin: 0 0 .25rem; font-size: 1.4rem; font-weight: 700; }
    .gp-desig { margin: 0; font-weight: 600; color: var(--green-dark); }
    .gp-office { margin: .25rem 0 0; font-size: .95rem; color: var(--muted); }
    .gp-uid {
        margin-top: 1.25rem;
        padding-top: 1rem;
        border-top: 1px dashed var(--line);
        font-size: .9rem; color: var(--muted);
    }
    .gp-uid strong { display: block; font-size: 1.1rem; color: var(--ink); letter-spacing: .5px; }

    .gp-detail { padding: 1.5rem 2rem 2rem; }

    .gp-sec { margin-bottom: 1.75rem; }
    .gp-sec h2 {
        margin: 0 0 .5rem;
        padding-bottom: .4rem;
        font-size: 1.1rem; font-weight: 700;
        color: var(--green-dark);
        border-bottom: 2px solid var(--green);
        display: flex; align-items: center; gap: .5rem;
    }

    .gp-row {
        display: grid;
        grid-template-columns: 190px 1fr;
        gap: 1rem;
        padding: .6rem 0;
        border-bottom: 1px solid var(--line);
    }
    .gp-row:last-child { border-bottom: 0; }
    .gp-row dt { margin: 0; color: var(--muted); font-weight: 500; }
    .gp-row dd { margin: 0; font-weight: 600; word-break: break-word; }
    .gp-row dd.empty { color: #98a5a0; font-weight: 400; }

    /* বোতাম */
    .gp-actions { display: flex; justify-content: flex-end; gap: .75rem; padding: 1rem 2rem 1.5rem; border-top: 1px solid var(--line); }
    .gp-btn {
        font: inherit; font-weight: 600;
        padding: .55rem 1.4rem;
        border-radius: 4px;
        border: 1px solid var(--green);
        background: var(--green); color: #fff;
        cursor: pointer;
    }
    .gp-btn-alt { background: #fff; color: var(--green-dark); }
    .gp-btn.gp-btn-alt:hover { background: #eef3f0; }
    .gp-btn:hover { background: var(--green-dark); }
    .gp-btn:focus-visible { outline: 3px solid #86d3b9; outline-offset: 2px; }

    .gp-foot { display: none; padding: 1rem 2rem; font-size: .85rem; color: var(--muted); border-top: 1px solid var(--line); }

    @media (max-width: 760px) {
        .gp-body { grid-template-columns: 1fr; }
        .gp-id { border-right: 0; border-bottom: 1px solid var(--line); }
        .gp-row { grid-template-columns: 1fr; gap: 0; }
        .gp-detail, .gp-head { padding-left: 1.25rem; padding-right: 1.25rem; }
        .gp-actions { padding-left: 1.25rem; padding-right: 1.25rem; }
        .gp-actions .gp-btn { width: 100%; }
    }

    @media print {
        body * { visibility: hidden; }
        .gp-sheet, .gp-sheet * { visibility: visible; }
        .gp-sheet { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; border-radius: 0; }
        .gp { background: #fff; padding: 0; }
        .no-print { display: none !important; }
        .gp-foot { display: block; }
        .gp-id { background: #fff; }
    }
</style>

<div class="gp">
    <div class="gp-sheet">

        <header class="gp-head">
            <h1>কর্মকর্তা/কর্মচারীর ব্যক্তিগত তথ্য</h1>
        </header>

        <div class="gp-body">

            {{-- পরিচিতি --}}
            <aside class="gp-id">
                <div class="gp-avatar" aria-hidden="true"><i class="fas fa-user-tie"></i></div>
                <h2 class="gp-name">{{ $user->name }}</h2>
                <p class="gp-desig">{{ $info->designation2 ?? $info->designation ?? '' }}</p>
                <p class="gp-office">{{ $info->office ?? '' }}</p>
                <div class="gp-uid">
                    ইউজার আইডি
                    <strong>{{ $bn($user->userid) }}</strong>
                </div>
            </aside>

            {{-- বিস্তারিত --}}
            <main class="gp-detail">

                <section class="gp-sec">
                    <h2><i class="fas fa-briefcase"></i> পদবি ও কর্মস্থল</h2>
                    <dl>
                        
                        <div class="gp-row">
                            <dt>কর্মকর্তার পদবি</dt>
                            <dd class="{{ !empty($info->designation2) ? '' : 'empty' }}">{{ $info->designation2 ?? $na }}</dd>
                        </div>
                        <div class="gp-row">
                            <dt>দপ্তরের নাম</dt>
                            <dd class="{{ !empty($info->office) ? '' : 'empty' }}">{{ $info->office ?? $na }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="gp-sec">
                    <h2><i class="fas fa-address-card"></i> যোগাযোগের তথ্য</h2>
                    <dl>
                        <div class="gp-row">
                            <dt>ইমেইল</dt>
                            <dd>{{ $user->email }}</dd>
                        </div>
                        <div class="gp-row">
                            <dt>মোবাইল নম্বর</dt>
                            @if($user->mobile)
                                <dd>{{ $bn($user->mobile) }}</dd>
                            @else
                                <dd class="empty">{{ $na }}</dd>
                            @endif
                        </div>
                    </dl>
                </section>

                <section class="gp-sec">
                    <h2><i class="fas fa-cog"></i> সিস্টেম তথ্য</h2>
                    <dl>
                        <div class="gp-row">
                            <dt>অবস্থান</dt>
                            <dd class="{{ $user->location ? '' : 'empty' }}">{{ $user->location ?? $na }}</dd>
                        </div>
                        <div class="gp-row">
                            <dt>ডিভাইস</dt>
                            <dd class="{{ $user->device ? '' : 'empty' }}">{{ $user->device ?? $na }}</dd>
                        </div>
                        <div class="gp-row">
                            <dt>নিবন্ধনের তারিখ</dt>
                            <dd>{{ $bnDate($user->created_at) }}</dd>
                        </div>
                        <div class="gp-row">
                            <dt>সর্বশেষ হালনাগাদ</dt>
                            <dd>{{ $bnDate($user->updated_at) }}</dd>
                        </div>
                    </dl>
                </section>

            </main>
        </div>

        <div class="gp-actions no-print">
            <button type="button" class="gp-btn" onclick="window.print()">
                <i class="fas fa-print"></i> প্রিন্ট করুন
            </button>
            <button type="button" class="gp-btn gp-btn-alt" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> ফিরে যান
            </button>
        </div>

        <div class="gp-foot">
            প্রিন্টের তারিখ: <span id="gp-print-date"></span>
        </div>
    </div>
</div>

<script>
    (function () {
        var toBn = function (s) {
            return String(s).replace(/\d/g, function (d) { return '০১২৩৪৫৬৭৮৯'[d]; });
        };
        var el = document.getElementById('gp-print-date');
        if (el) {
            el.textContent = toBn(new Date().toLocaleDateString('en-GB')) + ', ' +
                             toBn(new Date().toLocaleTimeString('en-GB', {hour: '2-digit', minute: '2-digit'}));
        }
    })();
</script>
@endsection