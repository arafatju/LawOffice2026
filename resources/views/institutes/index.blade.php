@extends('common.userdashboard')

@push('styles')
<style>
    :root {
        --accent: #1a237e;
        --accent-soft: #e8eaf6;
        --ok: #2f855a;
        --ok-soft: #e3f4ea;
        --warn: #b7791f;
        --warn-soft: #fdf0d5;
        --bad: #c53030;
        --bad-soft: #fde8e8;
        --info: #2b6cb0;
        --info-soft: #e3effb;
        --violet: #6b46c1;
        --violet-soft: #ede9fe;
    }

    .page-head { margin-bottom: 1.25rem; }
    .page-head h1 { font-size: 1.6rem; font-weight: 700; margin: 0; color: var(--ink); }
    .page-head p  { margin: 2px 0 0; color: var(--muted); }

    /* ---------- Stats strip ---------- */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 1.75rem;
    }
    .stat {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 22px 24px;
        min-width: 0;
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
    }
    .stat > div:last-child { min-width: 0; }
    .stat-icon {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 10px;
        font-size: 1.15rem;
    }
    .stat-icon.info   { background: var(--info-soft);   color: var(--info); }
    .stat-icon.ok     { background: var(--ok-soft);     color: var(--ok); }
    .stat-icon.warn   { background: var(--warn-soft);   color: var(--warn); }
    .stat-icon.violet { background: var(--violet-soft); color: var(--violet); }
    .stat-icon.bad    { background: var(--accent-soft); color: var(--accent); }

    .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.1; color: var(--ink); }
    .stat-label { color: var(--muted); font-size: .9rem; font-weight: 500; }
    .stat-sub   { display: block; color: var(--muted); font-size: .8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; margin-top: 2px; }

    @media (max-width: 1399px) { .stats-strip { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
    @media (max-width: 991px)  { .stats-strip { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 575px)  { .stats-strip { grid-template-columns: 1fr; gap: 14px; } }

    /* ---------- Panels ---------- */
    .panel {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 22px;
        border-bottom: 1px solid var(--line);
        font-weight: 600;
        font-size: 1.05rem;
        border-radius: 12px 12px 0 0;
    }
    .panel-head i { color: var(--accent); margin-right: 8px; }
    .panel-body { padding: 22px; flex: 1; }
    .panel-foot {
        padding: 16px 22px;
        border-top: 1px solid var(--line);
        background: #fafbfd;
        border-radius: 0 0 12px 12px;
    }
    .count-pill {
        background: var(--accent-soft);
        color: var(--accent);
        font-size: .82rem;
        font-weight: 600;
        padding: 3px 12px;
        border-radius: 999px;
    }

    .field { margin-bottom: 1.1rem; }
    .field > label {
        display: block;
        font-weight: 600;
        font-size: .92rem;
        margin-bottom: 6px;
        color: var(--ink);
    }
    .field > label small { color: var(--muted); font-weight: 400; }

    .field-input {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        border: 1.5px solid var(--line);
        border-radius: 8px;
        background: #fff;
        font-size: 1rem;
        color: var(--ink);
        transition: border-color .15s, box-shadow .15s;
    }
    .field-input:focus {
        outline: 0;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(26, 35, 126, .12);
    }

    /* conditional sections */
    .cond-section {
        display: none;
        background: #fafbfd;
        border: 1px solid var(--line);
        border-left: 4px solid var(--accent);
        border-radius: 10px;
        padding: 16px 16px 4px;
        margin-bottom: 1.1rem;
    }
    .cond-section.is-visible { display: block; }

    /* ---------- Searchable combobox ---------- */
    .combo { position: relative; }
    .combo-box { position: relative; }

    .combo-field {
        width: 100%;
        height: 46px;
        padding: 0 70px 0 40px;
        border: 1.5px solid var(--line);
        border-radius: 8px;
        background: #fff;
        font-size: 1rem;
        color: var(--ink);
        transition: border-color .15s, box-shadow .15s, background .15s;
        text-overflow: ellipsis;
    }
    .combo-field::placeholder { color: #98a2b3; }
    .combo-field:focus {
        outline: 0;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(26, 35, 126, .12);
    }
    .combo.is-disabled .combo-field { background: #f3f4f8; cursor: not-allowed; color: #98a2b3; }

    .combo-lead, .combo-chevron {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        pointer-events: none;
    }
    .combo-lead { left: 14px; }
    .combo-chevron { right: 14px; transition: transform .15s; }
    .combo.is-open .combo-chevron { transform: translateY(-50%) rotate(180deg); }

    .combo-clear {
        position: absolute;
        right: 38px;
        top: 50%;
        transform: translateY(-50%);
        display: none;
        border: 0;
        background: #eef0f5;
        color: var(--muted);
        width: 22px;
        height: 22px;
        border-radius: 50%;
        font-size: .7rem;
        line-height: 1;
        cursor: pointer;
    }
    .combo-clear:hover { background: var(--bad-soft); color: var(--bad); }
    .combo.has-value:not(.is-disabled) .combo-clear { display: block; }

    .combo-list {
        position: absolute;
        left: 0;
        right: 0;
        top: calc(100% + 6px);
        z-index: 50;
        max-height: 260px;
        overflow-y: auto;
        margin: 0;
        padding: 6px;
        list-style: none;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 10px;
        box-shadow: 0 12px 28px rgba(16, 24, 40, .16);
        display: none;
    }
    .combo.is-open .combo-list { display: block; }

    .combo-item {
        padding: 9px 12px;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .combo-item.is-active { background: var(--accent-soft); }
    .combo-item.is-selected { font-weight: 600; color: var(--accent); }
    .combo-item.is-selected::after { content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: .75rem; }
    .combo-item.combo-new { color: var(--ok); font-weight: 600; }
    .combo-item mark { background: #ffe58a; color: inherit; padding: 0; border-radius: 2px; }
    .combo-empty { padding: 14px 12px; color: var(--muted); text-align: center; cursor: default; }

    /* ---------- Buttons ---------- */
    .btn-solid {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        height: 46px;
        border: 0;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        color: #fff;
        background: var(--accent);
        transition: background .15s, opacity .15s;
    }
    .btn-solid:hover:not(:disabled) { background: var(--navy-deep); }
    .btn-solid:disabled { opacity: .45; cursor: not-allowed; }
    .btn-solid.green { background: var(--ok); }
    .btn-solid.green:hover:not(:disabled) { background: #276749; }

    .btn-remove {
        border: 0;
        background: transparent;
        color: var(--muted);
        width: 34px;
        height: 34px;
        border-radius: 8px;
    }
    .btn-remove:hover { background: var(--bad-soft); color: var(--bad); }

    .spinner {
        width: 18px;
        height: 18px;
        border: 3px solid rgba(255, 255, 255, .35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ---------- Saved institutes ---------- */
    .search-box { position: relative; width: 260px; max-width: 45%; }
    .search-box i {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        color: var(--muted); font-size: .85rem; pointer-events: none;
    }
    .search-box input {
        width: 100%; height: 38px; padding: 0 12px 0 34px;
        border: 1.5px solid var(--line); border-radius: 8px;
        font-size: .92rem; color: var(--ink); background: #fff;
    }
    .search-box input:focus { outline: 0; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26, 35, 126, .12); }

    .group-tabs {
        display: flex; gap: 6px; flex-wrap: wrap;
        padding: 10px 22px 0; border-bottom: 1px solid var(--line);
    }
    .group-tab {
        border: 0; background: transparent; padding: 10px 14px;
        font-weight: 600; color: var(--muted);
        border-bottom: 3px solid transparent; margin-bottom: -1px;
    }
    .group-tab:hover { color: var(--ink); }
    .group-tab.is-active { color: var(--accent); border-bottom-color: var(--accent); }
    .group-tab .count-pill { margin-left: 6px; }

    #savedList { transition: opacity .15s; min-height: 160px; }

    .inst-card { border: 1px solid var(--line); border-radius: 10px; margin-bottom: 14px; overflow: hidden; }
    .inst-card-head { display: flex; align-items: center; gap: 12px; padding: 10px 16px; background: #fafbfd; }
    .inst-name { flex: 1; min-width: 0; font-weight: 700; color: var(--ink); overflow-wrap: anywhere; }
    .inst-name i { color: var(--info); margin-right: 8px; }

    .dir-list { list-style: none; margin: 0; padding: 0; }
    .dir-list li {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        padding: 8px 16px 8px 40px; border-top: 1px solid var(--line);
    }
    .dir-list li i { color: var(--accent); margin-right: 8px; }
    .dir-list li .dir-label { overflow-wrap: anywhere; }
    .dir-list li.dir-empty { color: var(--muted); font-style: italic; justify-content: flex-start; }

    .inst-row {
        display: flex; align-items: center; justify-content: space-between; gap: 12px;
        padding: 10px 16px; border: 1px solid var(--line); border-radius: 10px; margin-bottom: 10px;
    }
    .inst-row i { margin-right: 8px; color: var(--accent); }
    .inst-row .inst-name { font-weight: 600; }

    .dir-pager {
        display: flex; align-items: center; justify-content: space-between; gap: 10px; flex-wrap: wrap;
        padding: 8px 16px 8px 40px; border-top: 1px solid var(--line); background: #fcfcfe;
    }
    .dir-pager:empty { display: none; }
    .dir-pager .pager-info { font-size: .82rem; }
    .dir-pager .pg-btn { min-width: 30px; height: 30px; padding: 0 8px; font-size: .85rem; }

    .panel-head { flex-wrap: wrap; gap: 10px; }
    .head-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .head-actions .search-box { width: 220px; max-width: 100%; }
    .btn-outline {
        display: inline-flex; align-items: center; gap: 8px; height: 38px; padding: 0 14px;
        border: 1.5px solid var(--accent); border-radius: 8px; background: #fff;
        color: var(--accent); font-weight: 600; font-size: .9rem; text-decoration: none;
        transition: background .15s;
    }
    .btn-outline:hover { background: var(--accent-soft); color: var(--accent); }

    .pager:empty { display: none; }

    .dir-panel-title {
        display: none; padding: 12px 22px; background: #fafbfd;
        border-bottom: 1px solid var(--line); font-weight: 700; color: var(--ink); overflow-wrap: anywhere;
    }
    .dir-panel-title i { color: var(--info); margin-right: 8px; }
    #dirPanelBody { transition: opacity .15s; min-height: 160px; }
    .dir-list.flat li { padding: 10px 4px; }
    .dir-list.flat li:first-child { border-top: 0; }

    .list-empty { text-align: center; color: var(--muted); padding: 40px 0; }

    .pager { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .pager-info { color: var(--muted); font-size: .9rem; }
    .pager-nav { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .pg-btn {
        min-width: 36px; height: 36px; padding: 0 10px;
        border: 1px solid var(--line); border-radius: 8px;
        background: #fff; color: var(--ink); font-weight: 600;
    }
    .pg-btn:hover:not(:disabled):not(.is-active) { background: var(--accent-soft); }
    .pg-btn.is-active { background: var(--accent); border-color: var(--accent); color: #fff; }
    .pg-btn:disabled { opacity: .45; cursor: not-allowed; }
    .pg-gap { color: var(--muted); padding: 0 2px; }

    /* ---------- Toasts ---------- */
    #toast-container { z-index: 9999 !important; }
    #toast-container > div {
        opacity: 1 !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .18) !important;
        background-image: none !important;
        padding: 14px 18px !important;
        width: 320px !important;
    }
    .toast-success, .toast-info, .toast-warning, .toast-error { background-color: #fff !important; color: #000 !important; }
    .toast-success { border-left: 5px solid var(--ok) !important; }
    .toast-info    { border-left: 5px solid var(--info) !important; }
    .toast-warning { border-left: 5px solid var(--warn) !important; }
    .toast-error   { border-left: 5px solid var(--bad) !important; }
    .toast-title, .toast-message { color: #000 !important; font-weight: 600 !important; }
    .toast-close-button { color: #000 !important; opacity: .6 !important; }
    .toast-progress { background-color: rgba(0, 0, 0, .12) !important; }

    @media (prefers-reduced-motion: reduce) {
        * { animation-duration: .01ms !important; transition-duration: .01ms !important; }
    }

    /* ---------- Page nav (প্রতিষ্ঠান | মিটিং ড্যাশবোর্ড) ---------- */
    .main-tabs {
        display: flex; gap: 8px; flex-wrap: wrap;
        margin-bottom: 1.25rem; border-bottom: 2px solid var(--line);
    }
    .main-tab {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 22px; text-decoration: none;
        font-weight: 700; font-size: 1.02rem; color: var(--muted);
        border-bottom: 3px solid transparent; margin-bottom: -2px;
    }
    .main-tab:hover { color: var(--ink); }
    .main-tab.is-active { color: var(--accent); border-bottom-color: var(--accent); }
</style>
@endpush

@section('content')
<div class="page-head">
    <h1>প্রতিষ্ঠান সমূহ</h1>
    <p>বিভিন্ন মন্ত্রণালয়/বিভাগ, অধিদপ্তর/দপ্তর/সংস্থা, স্বায়ত্তশাসিত সংস্থা, এনজিও ও অন্যান্য প্রতিষ্ঠান নিবন্ধন করুন</p>
</div>

<div class="main-tabs">
    <a href="{{ route('institutes.index') }}" class="main-tab {{ request()->routeIs('institutes.index') ? 'is-active' : '' }}"><i class="fas fa-building"></i>প্রতিষ্ঠান</a>
    <a href="{{ route('institutes.meetings') }}" class="main-tab {{ request()->routeIs('institutes.meetings') ? 'is-active' : '' }}"><i class="fas fa-calendar-check"></i>মিটিং ড্যাশবোর্ড</a>
</div>

<div id="paneInstitutes">
<!-- Stats -->
<div class="stats-strip">
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value" id="statMeetings">{{ $stats['meetings'] }}</div>
            <div class="stat-label">মোট মিটিং সম্পন্ন</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon ok"><i class="fas fa-landmark"></i></div>
        <div>
            <div class="stat-value" id="statMinistries">{{ $stats['ministries'] }}</div>
            <div class="stat-label">মন্ত্রণালয়/বিভাগ</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon warn"><i class="fas fa-sitemap"></i></div>
        <div>
            <div class="stat-value" id="statDirectorates">{{ $stats['directorates'] }}</div>
            <div class="stat-label">অধিদপ্তর/দপ্তর/সংস্থা</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon violet"><i class="fas fa-building-columns"></i></div>
        <div>
            <div class="stat-value" id="statAutonomous">{{ $stats['autonomous'] }}</div>
            <div class="stat-label">স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon bad"><i class="fas fa-handshake"></i></div>
        <div>
            <div class="stat-value" id="statOrgs">{{ $stats['orgs'] }}</div>
            <div class="stat-label">এনজিও ও অন্যান্য</div>
            <small class="stat-sub" id="statOrgsSub">এনজিও {{ $stats['ngo'] }} &middot; অন্যান্য {{ $stats['other'] }}</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Add institute -->
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-head"><span><i class="fas fa-plus-circle"></i> নতুন প্রতিষ্ঠান অন্তর্ভুক্ত করুন</span></div>
            <div class="panel-body">

                <!-- Category combobox -->
                <div class="field">
                    <label for="categoryInput">ক্যাটাগরি</label>
                    <div class="combo" id="categoryCombo">
                        <div class="combo-box">
                            <i class="fas fa-tags combo-lead"></i>
                            <input type="text" id="categoryInput" class="combo-field" autocomplete="off"
                                   placeholder="ক্যাটাগরি নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="categoryList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="ক্যাটাগরি মুছুন"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="categoryList" role="listbox"></ul>
                        <input type="hidden" id="category">
                    </div>
                </div>

                <!-- Ministry -> Directorate -->
                <div class="cond-section" id="ministrySection">
                    <div class="field">
                        <label for="ministryInput">মন্ত্রণালয়/বিভাগ <small>(নির্বাচন করুন, অথবা নতুন নাম লিখুন)</small></label>
                        <div class="combo" id="ministryCombo">
                            <div class="combo-box">
                                <i class="fas fa-landmark combo-lead"></i>
                                <input type="text" id="ministryInput" class="combo-field" autocomplete="off"
                                       placeholder="মন্ত্রণালয়/বিভাগ খুঁজুন বা যোগ করুন" role="combobox" aria-expanded="false" aria-controls="ministryList">
                                <button type="button" class="combo-clear" tabindex="-1" aria-label="মন্ত্রণালয়/বিভাগ মুছুন"><i class="fas fa-times"></i></button>
                                <i class="fas fa-chevron-down combo-chevron"></i>
                            </div>
                            <ul class="combo-list" id="ministryList" role="listbox"></ul>
                            <input type="hidden" id="ministry">
                        </div>
                    </div>

                    <div class="field">
                        <label for="directorateName">অধিদপ্তর/দপ্তর/সংস্থা যোগ করুন <small>(ঐচ্ছিক &ndash; শুধু মন্ত্রণালয়/বিভাগ যোগ করতে খালি রাখুন)</small></label>
                        <input type="text" id="directorateName" class="field-input" maxlength="255" placeholder="অধিদপ্তর/দপ্তর/সংস্থার নাম">
                    </div>
                </div>

                <!-- Autonomous / NGO / Others -->
                <div class="cond-section" id="orgSection">
                    <div class="field">
                        <label for="orgName" id="orgLabel">নাম</label>
                        <input type="text" id="orgName" class="field-input" maxlength="255" placeholder="নাম লিখুন">
                    </div>
                </div>

                <button id="addBtn" type="button" class="btn-solid green">
                    <i class="fas fa-plus btn-icon"></i>
                    <span class="btn-text">যোগ করুন</span>
                    <span class="spinner d-none"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Directorates of the ministry chosen on the left -->
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-head">
                <span><i class="fas fa-sitemap"></i>অধিদপ্তর/দপ্তর/সংস্থা সমূহ</span>
            </div>
            <div class="dir-panel-title" id="dirPanelTitle"></div>
            <div class="panel-body" id="dirPanelBody"></div>
            <div class="panel-foot pager" id="dirPanelPager"></div>
        </div>
    </div>
</div>

<!-- Saved institutes (all groups) -->
<div class="row g-4 mt-1">
    <div class="col-12">
        <div class="panel">
            <div class="panel-head">
                <span><i class="fas fa-database"></i>নিবন্ধিত প্রতিষ্ঠান সমূহ</span>
                <div class="head-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="search" id="listSearch" placeholder="নাম দিয়ে খুঁজুন" autocomplete="off">
                    </div>
                    <a class="btn-outline" href="{{ route('institutes.export') }}">
                        <i class="fas fa-file-csv"></i>CSV ডাউনলোড
                    </a>
                    <a class="btn-outline" href="{{ route('institutes.report') }}" target="_blank" rel="noopener">
                        <i class="fas fa-file-pdf"></i>প্রিন্ট / পিডিএফ
                    </a>
                </div>
            </div>

            <div class="group-tabs" role="tablist">
                <button type="button" class="group-tab is-active" data-group="ministry" role="tab">
                    মন্ত্রণালয়/বিভাগ &amp; অধিদপ্তর/দপ্তর/সংস্থা <span class="count-pill" id="tabCountMinistry">{{ $stats['ministries'] }}</span>
                </button>
                <button type="button" class="group-tab" data-group="autonomous" role="tab">
                    স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা <span class="count-pill" id="tabCountAutonomous">{{ $stats['autonomous'] }}</span>
                </button>
                <button type="button" class="group-tab" data-group="ngo" role="tab">
                    এনজিও <span class="count-pill" id="tabCountNgo">{{ $stats['ngo'] }}</span>
                </button>
                <button type="button" class="group-tab" data-group="other" role="tab">
                    অন্যান্য <span class="count-pill" id="tabCountOther">{{ $stats['other'] }}</span>
                </button>
            </div>

            <div class="panel-body" id="savedList"></div>
            <div class="panel-foot pager" id="savedPager"></div>
        </div>
    </div>
</div>

    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(function () {

    toastr.options = {
        closeButton: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: true,
        showDuration: 300,
        hideDuration: 800,
        timeOut: 4000,
        extendedTimeOut: 1000
    };

    function showMessage(type, message, title = '') {
        toastr[type](message, title);
    }

    /* =========================================================
       Searchable combobox. opts.creatable lets the user type a new value.
       ========================================================= */
    function Combo(rootSel, opts) {
        opts = opts || {};
        const $root   = $(rootSel);
        const $input  = $root.find('.combo-field');
        const $list   = $root.find('.combo-list');
        const $hidden = $root.find('input[type=hidden]');
        const $clear  = $root.find('.combo-clear');

        let options  = [];
        let selected = null;
        let activeIx = -1;

        const esc = s => $('<div>').text(s).html();

        function highlight(label, q) {
            if (!q) return esc(label);
            const i = label.toLowerCase().indexOf(q.toLowerCase());
            if (i < 0) return esc(label);
            return esc(label.slice(0, i)) + '<mark>' + esc(label.slice(i, i + q.length)) + '</mark>' + esc(label.slice(i + q.length));
        }

        function render(q) {
            q = (q || '').trim();
            const matches = options.filter(o => o.label.toLowerCase().includes(q.toLowerCase()));
            const exact   = options.some(o => o.label.toLowerCase() === q.toLowerCase());
            $list.empty();
            activeIx = -1;

            matches.forEach(o => {
                const $li = $('<li class="combo-item" role="option">').html(highlight(o.label, q)).data('opt', o);
                if (selected && selected.value === o.value) $li.addClass('is-selected');
                $list.append($li);
            });

            if (opts.creatable && q && !exact) {
                $list.append(
                    $('<li class="combo-item combo-new" role="option">')
                        .html('<span><i class="fas fa-plus me-2"></i>যোগ করুন &ldquo;' + esc(q) + '&rdquo;</span>')
                        .data('opt', { value: q, label: q, isNew: true })
                );
            }

            if (!$list.children().length) {
                $list.append($('<li class="combo-empty">').text(options.length ? 'কিছু পাওয়া যায়নি' : 'দেখানোর কিছু নেই'));
                return;
            }

            const $items = $list.children('.combo-item');
            const selIx = $items.index($items.filter('.is-selected'));
            setActive(q ? 0 : (selIx >= 0 ? selIx : -1), !q);
        }

        function setActive(ix, scroll) {
            const $items = $list.children('.combo-item');
            $items.removeClass('is-active');
            if (ix < 0 || ix >= $items.length) { activeIx = -1; return; }
            activeIx = ix;
            const $el = $items.eq(ix).addClass('is-active');
            if (scroll !== false) {
                const el = $el[0];
                const top = el.offsetTop, bottom = top + el.offsetHeight;
                if (top < $list[0].scrollTop) $list[0].scrollTop = top - 6;
                else if (bottom > $list[0].scrollTop + $list[0].clientHeight) $list[0].scrollTop = bottom - $list[0].clientHeight + 6;
            }
        }

        function open() {
            if ($root.hasClass('is-disabled')) return;
            const q = (selected && $input.val() === selected.label) ? '' : $input.val();
            render(q);
            $root.addClass('is-open');
            $input.attr('aria-expanded', 'true');
        }

        function close() {
            $root.removeClass('is-open');
            $input.attr('aria-expanded', 'false');

            // creatable: keep what the user typed instead of throwing it away
            if (opts.creatable) {
                const t = $input.val().trim();
                if (t && (!selected || selected.label !== t)) {
                    const ex = options.find(o => o.label.toLowerCase() === t.toLowerCase());
                    choose(ex || { value: t, label: t, isNew: true });
                    return;
                }
            }
            $input.val(selected ? selected.label : '');
        }

        function choose(o) {
            selected = o;
            $hidden.val(o.value);
            $input.val(o.label);
            $root.addClass('has-value').removeClass('is-open is-invalid');
            $input.attr('aria-expanded', 'false');
            if (opts.onSelect) opts.onSelect(o);
        }

        function reset(silent) {
            selected = null;
            $hidden.val('');
            $input.val('');
            $root.removeClass('has-value is-open');
            if (!silent && opts.onClear) opts.onClear();
        }

        $input.on('focus click', open);

        $input.on('input', function () {
            $root.addClass('is-open');
            render($input.val());
        });

        $input.on('keydown', function (e) {
            const $items = $list.children('.combo-item');
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (!$root.hasClass('is-open')) { open(); return; }
                setActive(Math.min(activeIx + 1, $items.length - 1));
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                setActive(Math.max(activeIx - 1, 0));
            } else if (e.key === 'Enter') {
                if ($root.hasClass('is-open')) {
                    e.preventDefault();
                    const $el = activeIx >= 0 ? $items.eq(activeIx) : ($items.length === 1 ? $items.eq(0) : $());
                    if ($el.length) choose($el.data('opt'));
                }
            } else if (e.key === 'Escape' || e.key === 'Tab') {
                close();
            }
        });

        $input.on('blur', function () { setTimeout(close, 120); });

        $list.on('mousedown', '.combo-item', function (e) {
            e.preventDefault();
            choose($(this).data('opt'));
        });
        $list.on('mouseenter', '.combo-item', function () {
            setActive($list.children('.combo-item').index(this), false);
        });

        $root.find('.combo-chevron').css('pointer-events', 'auto').on('mousedown', function (e) {
            e.preventDefault();
            if ($root.hasClass('is-open')) { $input.blur(); } else { $input.focus(); }
        });

        $clear.on('mousedown', function (e) {
            e.preventDefault();
            reset();
            $input.focus();
        });

        return {
            setOptions(arr) { options = arr; if ($root.hasClass('is-open')) render($input.val()); },
            reset,
            setDisabled(b, placeholder) {
                $root.toggleClass('is-disabled', b);
                $input.prop('disabled', b);
                if (placeholder) $input.attr('placeholder', placeholder);
            },
            focus()  { $input.focus(); },
            value()  { return selected ? selected.value : ''; },
            label()  { return selected ? selected.label : ''; },
            isNew()  { return !!(selected && selected.isNew); },

            // take over whatever is typed right now (used before the form is sent,
            // so a new name is never lost to the blur delay)
            commit() {
                if (!opts.creatable || $root.hasClass('is-disabled')) return;
                const t = $input.val().trim();
                if (t && (!selected || selected.label !== t)) {
                    const ex = options.find(o => o.label.toLowerCase() === t.toLowerCase());
                    choose(ex || { value: t, label: t, isNew: true });
                }
            },

            selectByLabel(label) {
                const ex = options.find(function (o) { return o.label.toLowerCase() === String(label).toLowerCase(); });
                if (ex) choose(ex);
            },

            // select an existing option by its value (used to restore the search filters)
            selectByValue(v) {
                const ex = options.find(o => o.value === String(v));
                if (ex) choose(ex);
            }
        };
    }


    /* ===================== প্রতিষ্ঠান ===================== */
    (function () {
    // Sections (শাখা) are managed on another page, so they are not listed here.
    const TYPE_LABELS = {
        ministry:    'মন্ত্রণালয়/বিভাগ',
        directorate: 'অধিদপ্তর/দপ্তর/সংস্থা',
        autonomous:  'স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা',
        ngo:         'এনজিও',
        other:       'অন্যান্য'
    };

    /* =========================================================
       Category + ministry wiring
       ========================================================= */
    const categories = [
        { value: 'ministry',   label: TYPE_LABELS.ministry },
        { value: 'autonomous', label: TYPE_LABELS.autonomous },
        { value: 'ngo',        label: TYPE_LABELS.ngo },
        { value: 'other',      label: TYPE_LABELS.other }
    ];

    const toOptions = list => list.map(m => ({ value: String(m.id), label: m.name }));

    const ministryCombo = Combo('#ministryCombo', {
        creatable: true,
        onSelect(o) { onMinistryPicked(o); },
        onClear()   { showDirPlaceholder(); }
    });
    ministryCombo.setOptions(toOptions(@json($ministries)));

    function showSection(type) {
        const isSimple = (type === 'autonomous' || type === 'ngo' || type === 'other');

        $('#ministrySection').toggleClass('is-visible', type === 'ministry');
        $('#orgSection').toggleClass('is-visible', isSimple);

        if (isSimple) {
            const label = TYPE_LABELS[type];
            $('#orgLabel').text(label + ' এর নাম');
            $('#orgName').attr('placeholder', label + ' এর নাম লিখুন');
            $('#orgName').trigger('focus');
        }
    }

    function clearFields() {
        ministryCombo.reset(true);
        showDirPlaceholder();
        $('#directorateName').val('');
        $('#orgName').val('');
    }

    const categoryCombo = Combo('#categoryCombo', {
        onSelect(o) { clearFields(); showSection(o.value); },
        onClear()   { clearFields(); showSection(''); }
    });
    categoryCombo.setOptions(categories);

    /* =========================================================
       Add (saves straight away)
       ========================================================= */
    function setLoadingState(isLoading) {
        const $btn = $('#addBtn');
        $btn.prop('disabled', isLoading);
        $btn.find('.spinner').toggleClass('d-none', !isLoading);
        $btn.find('.btn-icon').toggleClass('d-none', isLoading);
        $btn.find('.btn-text').text(isLoading ? 'সংরক্ষণ হচ্ছে...' : 'যোগ করুন');
    }

    function addInstitute() {
        const type = categoryCombo.value();
        if (!type) {
            showMessage('warning', 'অনুগ্রহ করে একটি ক্যাটাগরি নির্বাচন করুন');
            return;
        }

        let item;

        if (type === 'ministry') {
            const ministry    = ministryCombo.label().trim();
            const directorate = $('#directorateName').val().trim();

            if (!ministry) {
                showMessage('warning', 'অনুগ্রহ করে মন্ত্রণালয়/বিভাগ নির্বাচন করুন বা নাম লিখুন');
                return;
            }

            if (directorate) {
                item = { type: 'directorate', name: directorate, ministry: ministry };
            } else {
                if (!ministryCombo.isNew()) {
                    showMessage('warning', 'এই মন্ত্রণালয়/বিভাগ ইতিমধ্যে আছে। এর অধীনে যোগ করতে অধিদপ্তর/দপ্তর/সংস্থার নাম লিখুন।');
                    return;
                }
                item = { type: 'ministry', name: ministry, ministry: null };
            }
        } else {
            const name = $('#orgName').val().trim();
            if (!name) {
                showMessage('warning', 'অনুগ্রহ করে ' + TYPE_LABELS[type] + ' এর নাম লিখুন');
                return;
            }
            item = { type: type, name: name, ministry: null };
        }

        setLoadingState(true);

        fetch(@json(route('institutes.store')), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ draft: [item] })
        })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) { return { ok: res.ok, body: body }; });
        })
        .then(function (r) {
            const body = r.body;
            if (r.ok && body.success === true) {
                if (body.created === 0) {
                    showMessage('warning', body.message || 'ইতিমধ্যে আছে');
                } else {
                    showMessage('success', body.message || 'সফলভাবে সংরক্ষণ করা হয়েছে', 'সফল!');
                }

                ministryCombo.setOptions(toOptions(body.ministries || []));
                applyStats(body.stats);

                // ready for the next entry
                if (item.type === 'directorate') {
                    if (ministryCombo.isNew()) {
                        ministryCombo.selectByLabel(item.ministry);   // now saved: loads its directorates
                    } else {
                        loadDirPanel(dirPanel.page);
                    }
                    $('#directorateName').val('').trigger('focus');
                } else if (item.type === 'ministry') {
                    ministryCombo.selectByLabel(item.name);           // show it on the right, add its directorates next
                    $('#directorateName').trigger('focus');
                } else {
                    $('#orgName').val('').trigger('focus');
                }

                loadList();
            } else {
                let msg = body.message || 'সংরক্ষণ ব্যর্থ হয়েছে';
                if (body.errors) {
                    const first = Object.values(body.errors)[0];
                    if (first && first[0]) msg = first[0];
                }
                showMessage('error', msg, 'ত্রুটি');
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
            showMessage('error', 'নেটওয়ার্ক ত্রুটি। আবার চেষ্টা করুন।', 'সংযোগ ব্যর্থ');
        })
        .finally(function () { setLoadingState(false); });
    }

    $('#addBtn').on('click', addInstitute);
    $('#directorateName, #orgName').on('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); addInstitute(); }
    });

    /* =========================================================
       Stats refresh
       ========================================================= */
    function applyStats(s) {
        if (!s) return;
        $('#statMeetings').text(s.meetings);
        $('#statMinistries').text(s.ministries);
        $('#statDirectorates').text(s.directorates);
        $('#statAutonomous').text(s.autonomous);
        $('#statOrgs').text(s.orgs);
        $('#statOrgsSub').text('এনজিও ' + s.ngo + ' \u00b7 অন্যান্য ' + s.other);
        $('#tabCountMinistry').text(s.ministries);
        $('#tabCountAutonomous').text(s.autonomous);
        $('#tabCountNgo').text(s.ngo);
        $('#tabCountOther').text(s.other);
    }

    /* =========================================================
       Saved institutes: group tabs, search, pagination, delete
       ========================================================= */
    const BASE = @json(url('/institutes'));
    const listState = { group: 'ministry', page: 1, q: '' };
    let listReq = 0;

    function delBtn(id, name, type) {
        return $('<button type="button" class="btn-remove delBtn" title="মুছুন" aria-label="মুছুন">')
            .attr({ 'data-id': id, 'data-name': name, 'data-type': type })
            .html('<i class="fas fa-trash"></i>');
    }

    function fillDirectorates($card, rows, meta) {
        const $dirs = $card.find('.dir-list').empty();

        if (!rows.length) {
            $dirs.append($('<li class="dir-empty">').text($card.attr('data-q') ? 'কোনো মিল পাওয়া যায়নি' : 'এখনো কোনো অধিদপ্তর/দপ্তর/সংস্থা নেই'));
        }
        rows.forEach(function (d) {
            $dirs.append(
                $('<li>').append(
                    $('<span class="dir-label">').append($('<i class="fas fa-sitemap">'), document.createTextNode(d.name)),
                    delBtn(d.id, d.name, 'directorate')
                )
            );
        });

        const total = meta ? meta.total : 0;
        $card.find('.dir-count').text(total + 'টি অধিদপ্তর/দপ্তর/সংস্থা');
        $card.attr('data-page', meta ? meta.current_page : 1);

        const $pg = $card.find('.dir-pager').empty();
        if (meta && meta.total > 0) {
            $pg.append($('<span class="pager-info">').text('মোট অধিদপ্তর/দপ্তর/সংস্থা: ' + meta.total));
            if (meta.last_page > 1) $pg.append(buildNav(meta));
        }
    }

    function loadDirectorates($card, page) {
        const params = new URLSearchParams({ page: page, q: $card.attr('data-q') || '' });
        $card.css('opacity', .6);

        fetch(BASE + '/' + encodeURIComponent($card.attr('data-id')) + '/directorates?' + params.toString(), {
            headers: { 'Accept': 'application/json' }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function (res) {
            // removed the last row of the last page -> go back one page
            if (!res.data.length && page > 1) { loadDirectorates($card, page - 1); return; }
            fillDirectorates($card, res.data, res.meta);
        })
        .catch(function (err) {
            console.error('Error:', err);
            showMessage('error', 'অধিদপ্তর/দপ্তর/সংস্থার তালিকা লোড করা যায়নি');
        })
        .finally(function () { $card.css('opacity', 1); });
    }

    function ministryCard(m) {
        const $card = $('<div class="inst-card">').attr({ 'data-id': m.id, 'data-q': m.dir_q || '', 'data-page': 1 });

        $card.append(
            $('<div class="inst-card-head">').append(
                $('<span class="inst-name">').append($('<i class="fas fa-landmark">'), document.createTextNode(m.name)),
                $('<span class="count-pill dir-count">'),
                delBtn(m.id, m.name, 'ministry')
            ),
            $('<ul class="dir-list">'),
            $('<div class="dir-pager">')
        );

        fillDirectorates($card, m.directorates, m.directorates_meta);
        return $card;
    }

    const GROUP_ICONS = { ngo: 'fa-handshake', autonomous: 'fa-building-columns', other: 'fa-building' };

    function simpleRow(item) {
        const icon = GROUP_ICONS[listState.group] || 'fa-building';
        return $('<div class="inst-row">').append(
            $('<span class="inst-name">').append($('<i class="fas ' + icon + '">'), document.createTextNode(item.name)),
            delBtn(item.id, item.name, listState.group)
        );
    }

    function renderList(items) {
        const $box = $('#savedList').empty();
        if (!items.length) {
            $box.append(
                $('<div class="list-empty">').append(
                    $('<i class="fas fa-folder-open fa-2x mb-2 d-block">'),
                    document.createTextNode(listState.q ? 'কিছু পাওয়া যায়নি' : 'এখনো কিছু সংরক্ষণ করা হয়নি')
                )
            );
            return;
        }
        items.forEach(function (item) {
            $box.append(listState.group === 'ministry' ? ministryCard(item) : simpleRow(item));
        });
    }

    function pgBtn(label, page, disabled, active) {
        return $('<button type="button" class="pg-btn">')
            .attr('data-page', page)
            .toggleClass('is-active', !!active)
            .prop('disabled', !!disabled)
            .html(label);
    }

    function buildNav(meta) {
        const $nav = $('<div class="pager-nav">');
        $nav.append(pgBtn('<i class="fas fa-chevron-left"></i>', meta.current_page - 1, meta.current_page <= 1));

        const pages = [1, meta.last_page, meta.current_page - 1, meta.current_page, meta.current_page + 1]
            .filter(function (n, i, a) { return n >= 1 && n <= meta.last_page && a.indexOf(n) === i; })
            .sort(function (a, b) { return a - b; });

        let prev = 0;
        pages.forEach(function (n) {
            if (n - prev > 1) $nav.append($('<span class="pg-gap">').text('\u2026'));
            $nav.append(pgBtn(n, n, false, n === meta.current_page));
            prev = n;
        });

        $nav.append(pgBtn('<i class="fas fa-chevron-right"></i>', meta.current_page + 1, meta.current_page >= meta.last_page));
        return $nav;
    }

    function renderPager(meta) {
        const $p = $('#savedPager').empty();
        if (!meta.total) return;

        const labels = {
            ministry:   'মন্ত্রণালয়/বিভাগ',
            autonomous: 'স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা',
            ngo:        'এনজিও',
            other:      'অন্যান্য'
        };
        $p.append($('<span class="pager-info">').text('মোট ' + labels[listState.group] + ': ' + meta.total));
        if (meta.last_page > 1) $p.append(buildNav(meta));
    }

    function loadList() {
        const reqId = ++listReq;
        const $box = $('#savedList');
        $box.css('opacity', .5);

        const params = new URLSearchParams({ group: listState.group, page: listState.page, q: listState.q });

        fetch(BASE + '/list?' + params.toString(), { headers: { 'Accept': 'application/json' } })
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.json();
            })
            .then(function (res) {
                if (reqId !== listReq) return;
                // deleted the last row of the last page -> go back one page
                if (!res.data.length && listState.page > 1) { listState.page--; loadList(); return; }
                renderList(res.data);
                renderPager(res.meta);
            })
            .catch(function (err) {
                console.error('Error:', err);
                if (reqId !== listReq) return;
                $box.empty().append($('<div class="list-empty">').text('তালিকা লোড করা যায়নি।'));
                $('#savedPager').empty();
            })
            .finally(function () { if (reqId === listReq) $box.css('opacity', 1); });
    }

    // tabs
    $('.group-tab').on('click', function () {
        $('.group-tab').removeClass('is-active');
        $(this).addClass('is-active');
        listState.group = $(this).attr('data-group');
        listState.page = 1;
        loadList();
    });

    // search (debounced)
    let searchTimer = null;
    $('#listSearch').on('input', function () {
        const v = $(this).val().trim();
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
            listState.q = v;
            listState.page = 1;
            loadList();
        }, 300);
    });

    // pagination
    $('#savedPager').on('click', '.pg-btn:not(:disabled)', function () {
        listState.page = parseInt($(this).attr('data-page'), 10) || 1;
        loadList();
    });

    // directorate pagination inside a ministry card
    $('#savedList').on('click', '.dir-pager .pg-btn:not(:disabled)', function () {
        loadDirectorates($(this).closest('.inst-card'), parseInt($(this).attr('data-page'), 10) || 1);
    });

    // delete
    $('#savedList, #dirPanelBody').on('click', '.delBtn', function () {
        const $b   = $(this);
        const id   = $b.attr('data-id');
        const name = $b.attr('data-name');
        const type = $b.attr('data-type');

        if (!confirm('"' + name + '" (' + TYPE_LABELS[type] + ') মুছে ফেলতে চান?')) return;

        const $card = $b.closest('.inst-card');
        $b.prop('disabled', true);

        fetch(BASE + '/' + encodeURIComponent(id), {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) { return { ok: res.ok, body: body }; });
        })
        .then(function (r) {
            if (r.ok && r.body.success) {
                showMessage('success', r.body.message || 'সফলভাবে মুছে ফেলা হয়েছে');
                if (type === 'ministry' && ministryCombo.label() === name) ministryCombo.reset(true);
                if (type === 'ministry' && String(dirPanel.id) === String(id)) showDirPlaceholder();
                ministryCombo.setOptions(toOptions(r.body.ministries || []));
                applyStats(r.body.stats);

                if (type === 'directorate') {
                    if ($card.length) {
                        loadDirectorates($card, parseInt($card.attr('data-page'), 10) || 1);
                    } else {
                        loadList();
                    }
                    if (dirPanel.id) loadDirPanel(dirPanel.page);
                } else {
                    loadList();
                }
            } else {
                showMessage('error', r.body.message || 'মুছে ফেলা যায়নি', 'ত্রুটি');
                $b.prop('disabled', false);
            }
        })
        .catch(function (err) {
            console.error('Error:', err);
            showMessage('error', 'নেটওয়ার্ক ত্রুটি। আবার চেষ্টা করুন।', 'সংযোগ ব্যর্থ');
            $b.prop('disabled', false);
        });
    });

    /* =========================================================
       Right panel: directorates of the ministry chosen on the left
       ========================================================= */
    const dirPanel = { id: null, name: '', page: 1 };
    let dirReq = 0;

    function showDirPlaceholder(msg, icon) {
        dirPanel.id = null;
        dirPanel.name = '';
        dirPanel.page = 1;
        dirReq++;
        $('#dirPanelTitle').hide().empty();
        $('#dirPanelPager').empty();
        $('#dirPanelBody').css('opacity', 1).empty().append(
            $('<div class="list-empty">').append(
                $('<i class="fas ' + (icon || 'fa-hand-point-left') + ' fa-2x mb-2 d-block">'),
                document.createTextNode(msg || 'অধিদপ্তর/দপ্তর/সংস্থা দেখতে বামদিক থেকে একটি মন্ত্রণালয়/বিভাগ নির্বাচন করুন')
            )
        );
    }

    function onMinistryPicked(o) {
        if (o.isNew) {
            showDirPlaceholder('"' + o.label + '" একটি নতুন মন্ত্রণালয়/বিভাগ। বামদিকে এর প্রথম অধিদপ্তর/দপ্তর/সংস্থা যোগ করুন।', 'fa-circle-plus');
            return;
        }
        dirPanel.id = o.value;
        dirPanel.name = o.label;
        dirPanel.page = 1;
        loadDirPanel(1);
    }

    function renderDirPanel(rows, meta) {
        $('#dirPanelTitle').empty()
            .append($('<i class="fas fa-landmark">'), document.createTextNode(dirPanel.name))
            .show();

        const $body = $('#dirPanelBody').empty();

        if (!rows.length) {
            $body.append(
                $('<div class="list-empty">').append(
                    $('<i class="fas fa-folder-open fa-2x mb-2 d-block">'),
                    document.createTextNode('এখনো কোনো অধিদপ্তর/দপ্তর/সংস্থা নেই')
                )
            );
        } else {
            const $ul = $('<ul class="dir-list flat">');
            rows.forEach(function (d) {
                $ul.append(
                    $('<li>').append(
                        $('<span class="dir-label">').append($('<i class="fas fa-sitemap">'), document.createTextNode(d.name)),
                        delBtn(d.id, d.name, 'directorate')
                    )
                );
            });
            $body.append($ul);
        }

        const $p = $('#dirPanelPager').empty();
        if (meta.total) {
            $p.append($('<span class="pager-info">').text('মোট অধিদপ্তর/দপ্তর/সংস্থা: ' + meta.total));
            if (meta.last_page > 1) $p.append(buildNav(meta));
        }
    }

    function loadDirPanel(page) {
        if (!dirPanel.id) return;
        const reqId = ++dirReq;
        dirPanel.page = page;
        const $body = $('#dirPanelBody');
        $body.css('opacity', .5);

        fetch(BASE + '/' + encodeURIComponent(dirPanel.id) + '/directorates?page=' + page, {
            headers: { 'Accept': 'application/json' }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function (res) {
            if (reqId !== dirReq) return;
            // removed the last row of the last page -> go back one page
            if (!res.data.length && page > 1) { loadDirPanel(page - 1); return; }
            renderDirPanel(res.data, res.meta);
        })
        .catch(function (err) {
            console.error('Error:', err);
            if (reqId !== dirReq) return;
            $body.empty().append($('<div class="list-empty">').text('অধিদপ্তর/দপ্তর/সংস্থার তালিকা লোড করা যায়নি।'));
            $('#dirPanelPager').empty();
        })
        .finally(function () { if (reqId === dirReq) $body.css('opacity', 1); });
    }

    $('#dirPanelPager').on('click', '.pg-btn:not(:disabled)', function () {
        loadDirPanel(parseInt($(this).attr('data-page'), 10) || 1);
    });

    showDirPlaceholder();
    loadList();
    })();

});
</script>
@endpush