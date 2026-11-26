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

    /* ---------- Stats ---------- */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 1.75rem;
    }
    .stat {
        display: flex; align-items: center; gap: 16px;
        padding: 22px 24px; min-width: 0;
        background: var(--surface); border: 1px solid var(--line); border-radius: 12px;
    }
    .stat > div:last-child { min-width: 0; }
    .stat-icon {
        width: 46px; height: 46px; flex-shrink: 0;
        display: grid; place-items: center; border-radius: 10px; font-size: 1.15rem;
    }
    .stat-icon.info   { background: var(--info-soft);   color: var(--info); }
    .stat-icon.ok     { background: var(--ok-soft);     color: var(--ok); }
    .stat-icon.warn   { background: var(--warn-soft);   color: var(--warn); }
    .stat-icon.violet { background: var(--violet-soft); color: var(--violet); }
    .stat-icon.bad    { background: var(--accent-soft); color: var(--accent); }
    .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.1; color: var(--ink); }
    .stat-label { color: var(--muted); font-size: .9rem; font-weight: 500; }
    .stat-sub   { display: block; color: var(--ink); font-size: .85rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; margin-top: 2px; }

    /* ---------- Panels ---------- */
    .panel {
        background: var(--surface); border: 1px solid var(--line); border-radius: 12px;
        display: flex; flex-direction: column; margin-bottom: 1.5rem;
    }
    .panel-head {
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
        padding: 16px 22px; border-bottom: 1px solid var(--line);
        font-weight: 600; font-size: 1.05rem; border-radius: 12px 12px 0 0;
    }
    .panel-head i { color: var(--accent); margin-right: 8px; }
    .panel-body { padding: 22px; flex: 1; }
    .panel-foot {
        padding: 14px 22px; border-top: 1px solid var(--line);
        background: #fafbfd; border-radius: 0 0 12px 12px;
    }
    .count-pill {
        background: var(--accent-soft); color: var(--accent);
        font-size: .82rem; font-weight: 600; padding: 3px 12px; border-radius: 999px;
    }

    .form-section {
        font-weight: 700; color: var(--accent); font-size: .85rem; letter-spacing: .04em;
        text-transform: uppercase; margin: 6px 0 12px; padding-bottom: 6px; border-bottom: 1px dashed var(--line);
    }

    .field { margin-bottom: .9rem; }
    .field > label {
        display: block; font-weight: 600; font-size: .9rem; margin-bottom: 6px; color: var(--ink);
    }
    .field > label small { color: var(--muted); font-weight: 400; }
    .req { color: var(--bad); }

    .field-input {
        width: 100%; height: 46px; padding: 0 14px;
        border: 1.5px solid var(--line); border-radius: 8px; background: #fff;
        font-size: 1rem; color: var(--ink); transition: border-color .15s, box-shadow .15s;
    }
    .field-input:focus {
        outline: 0; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26, 35, 126, .12);
    }
    .field-input.is-invalid { border-color: var(--bad); }
    textarea.field-input { height: auto; min-height: 110px; padding: 10px 14px; resize: vertical; }
    input[type=file].field-input { padding: 8px 10px; height: 46px; }
    .field-error { color: var(--bad); font-size: .82rem; margin-top: 4px; }
    .field-error:empty { display: none; }
    .field-hint { color: var(--muted); font-size: .82rem; margin-top: 4px; }

    .radio-row { display: flex; gap: 10px; height: 46px; align-items: center; flex-wrap: wrap; }
    .radio-pill {
        display: inline-flex; align-items: center; gap: 8px; cursor: pointer;
        padding: 8px 18px; border: 1.5px solid var(--line); border-radius: 8px; font-weight: 600; margin: 0;
    }
    .radio-pill input { accent-color: var(--accent); }
    .radio-pill:has(input:checked) { border-color: var(--accent); background: var(--accent-soft); color: var(--accent); }

    /* ---------- Searchable combobox ---------- */
    .combo { position: relative; }
    .combo-box { position: relative; }
    .combo-field {
        width: 100%; height: 46px; padding: 0 70px 0 40px;
        border: 1.5px solid var(--line); border-radius: 8px; background: #fff;
        font-size: 1rem; color: var(--ink);
        transition: border-color .15s, box-shadow .15s, background .15s; text-overflow: ellipsis;
    }
    .combo-field::placeholder { color: #98a2b3; }
    .combo-field:focus { outline: 0; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26, 35, 126, .12); }
    .combo.is-disabled .combo-field { background: #f3f4f8; cursor: not-allowed; color: #98a2b3; }
    .combo.is-invalid .combo-field { border-color: var(--bad); }

    .combo-lead, .combo-chevron {
        position: absolute; top: 50%; transform: translateY(-50%); color: var(--muted); pointer-events: none;
    }
    .combo-lead { left: 14px; }
    .combo-chevron { right: 14px; transition: transform .15s; }
    .combo.is-open .combo-chevron { transform: translateY(-50%) rotate(180deg); }

    .combo-clear {
        position: absolute; right: 38px; top: 50%; transform: translateY(-50%); display: none;
        border: 0; background: #eef0f5; color: var(--muted);
        width: 22px; height: 22px; border-radius: 50%; font-size: .7rem; line-height: 1; cursor: pointer;
    }
    .combo-clear:hover { background: var(--bad-soft); color: var(--bad); }
    .combo.has-value:not(.is-disabled) .combo-clear { display: block; }

    .combo-list {
        position: absolute; left: 0; right: 0; top: calc(100% + 6px); z-index: 50;
        max-height: 260px; overflow-y: auto; margin: 0; padding: 6px; list-style: none;
        background: #fff; border: 1px solid var(--line); border-radius: 10px;
        box-shadow: 0 12px 28px rgba(16, 24, 40, .16); display: none;
    }
    .combo.is-open .combo-list { display: block; }
    .combo-item {
        padding: 9px 12px; border-radius: 6px; cursor: pointer;
        display: flex; align-items: center; justify-content: space-between; gap: 8px;
    }
    .combo-item.is-active { background: var(--accent-soft); }
    .combo-item.is-selected { font-weight: 600; color: var(--accent); }
    .combo-item.is-selected::after { content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: .75rem; }
    .combo-item.combo-new { color: var(--ok); font-weight: 600; }
    .combo-item mark { background: #ffe58a; color: inherit; padding: 0; border-radius: 2px; }
    .combo-empty { padding: 14px 12px; color: var(--muted); text-align: center; cursor: default; }

    /* ---------- Buttons ---------- */
    .btn-solid {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 46px; padding: 0 28px; border: 0; border-radius: 8px;
        font-weight: 600; font-size: 1rem; color: #fff; background: var(--accent);
        transition: background .15s, opacity .15s; text-decoration: none;
    }
    .btn-solid:hover:not(:disabled) { background: var(--navy-deep); color: #fff; }
    .btn-solid:disabled { opacity: .45; cursor: not-allowed; }
    .btn-solid.green { background: var(--ok); }
    .btn-solid.green:hover:not(:disabled) { background: #276749; }
    .btn-ghost {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 46px; padding: 0 22px; border: 1.5px solid var(--line); border-radius: 8px;
        background: #fff; color: var(--ink); font-weight: 600; text-decoration: none;
    }
    .btn-ghost:hover { background: var(--accent-soft); color: var(--accent); }

    .spinner {
        width: 18px; height: 18px; border: 3px solid rgba(255, 255, 255, .35);
        border-top-color: #fff; border-radius: 50%; animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ---------- Filters ---------- */
    .filter-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 12px; align-items: end;
    }
    .filter-grid .field { margin: 0; }
    .filter-grid .field-input { height: 42px; font-size: .95rem; }
    .filter-grid .combo-field { height: 42px; font-size: .95rem; }
    .filter-grid label { font-size: .8rem !important; color: var(--muted) !important; }
    .person-group { display: grid; grid-template-columns: 110px 1fr; gap: 6px; }
    .filter-actions { display: flex; gap: 8px; margin-top: 14px; flex-wrap: wrap; }
    .filter-actions .btn-solid, .filter-actions .btn-ghost { height: 42px; }

    /* ---------- Table ---------- */
    .m-table { margin: 0; }
    .m-table thead th {
        background: #fafbfd; color: var(--muted); font-weight: 600; font-size: .85rem;
        border-bottom: 1px solid var(--line); padding: 12px 16px; white-space: nowrap;
    }
    .m-table td { padding: 12px 16px; vertical-align: top; border-color: var(--line); }
    .code { font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: .82rem; font-weight: 700; color: var(--accent); white-space: nowrap; }
    .row-name { font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }
    .sub { display: block; color: var(--muted); font-size: .82rem; overflow-wrap: anywhere; }

    .type-badge {
        display: inline-block; font-size: .75rem; font-weight: 700;
        padding: 2px 10px; border-radius: 6px; margin-bottom: 4px;
    }
    .type-badge.ministry   { background: var(--info-soft);   color: var(--info); }
    .type-badge.autonomous { background: var(--violet-soft); color: var(--violet); }
    .type-badge.ngo        { background: var(--ok-soft);     color: var(--ok); }
    .type-badge.other      { background: var(--warn-soft);   color: var(--warn); }
    .type-badge.mtype      { background: var(--accent-soft); color: var(--accent); }

    .att-badge { display: inline-block; font-weight: 700; font-size: .8rem; padding: 3px 12px; border-radius: 999px; }
    .att-badge.yes { background: var(--ok-soft);  color: var(--ok); }
    .att-badge.no  { background: var(--bad-soft); color: var(--bad); }

    .kw-chip {
        display: inline-block; background: var(--accent-soft); color: var(--accent);
        font-size: .75rem; font-weight: 600; padding: 1px 8px; border-radius: 999px; margin: 3px 4px 0 0;
    }
    details.contents { margin-top: 6px; }
    details.contents summary { cursor: pointer; color: var(--info); font-size: .85rem; font-weight: 600; }
    details.contents div {
        margin-top: 6px; padding: 10px 12px; background: #fafbfd;
        border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; max-width: 420px;
        max-height: 220px; overflow-y: auto; overflow-wrap: anywhere;
    }
    .file-link { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; color: var(--bad); text-decoration: none; white-space: nowrap; }
    .file-link:hover { text-decoration: underline; }

    .head-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .btn-ghost.sm { height: 38px; padding: 0 14px; font-size: .9rem; }
    .btn-ghost .fa-file-pdf { color: var(--bad); margin: 0; }
    .subject-text { overflow-wrap: anywhere; }

    .list-empty { text-align: center; color: var(--muted); padding: 40px 0; }
    .list-foot { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .list-foot .pagination { margin: 0; }

    /* ---------- Toasts ---------- */
    #toast-container { z-index: 9999 !important; }
    #toast-container > div {
        opacity: 1 !important; border-radius: 10px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .18) !important;
        background-image: none !important; padding: 14px 18px !important; width: 320px !important;
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
</style>
@endpush

@section('content')
<div class="page-head">
    <h1>মিটিং সমূহ</h1>
    <p>মন্ত্রণালয়/বিভাগ, অধিদপ্তর/দপ্তর/সংস্থা, শাখা, স্বায়ত্তশাসিত সংস্থা, এনজিও ও অন্যান্য প্রতিষ্ঠানের সাথে মিটিং নথিভুক্ত করুন।</p>
</div>

<!-- Stats -->
<div class="stats-strip">
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">মোট মিটিং</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon ok"><i class="fas fa-landmark"></i></div>
        <div>
            <div class="stat-value">{{ $stats['ministry']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ মন্ত্রণালয়/বিভাগ</div>
            <small class="stat-sub" title="{{ $stats['ministry']['name'] }}">{{ $stats['ministry']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon warn"><i class="fas fa-sitemap"></i></div>
        <div>
            <div class="stat-value">{{ $stats['directorate']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ অধিদপ্তর/দপ্তর/সংস্থা</div>
            <small class="stat-sub" title="{{ $stats['directorate']['name'] }}">{{ $stats['directorate']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-code-branch"></i></div>
        <div>
            <div class="stat-value">{{ $stats['section']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ শাখা</div>
            <small class="stat-sub" title="{{ $stats['section']['name'] }}">{{ $stats['section']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon violet"><i class="fas fa-building-columns"></i></div>
        <div>
            <div class="stat-value">{{ $stats['autonomous']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা</div>
            <small class="stat-sub" title="{{ $stats['autonomous']['name'] }}">{{ $stats['autonomous']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon bad"><i class="fas fa-handshake"></i></div>
        <div>
            <div class="stat-value">{{ $stats['org']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ এনজিও / অন্যান্য</div>
            <small class="stat-sub" title="{{ $stats['org']['name'] }}">{{ $stats['org']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-bookmark"></i></div>
        <div>
            <div class="stat-value">{{ $stats['name']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ মিটিংয়ের নাম</div>
            <small class="stat-sub" title="{{ $stats['name']['name'] }}">{{ $stats['name']['name'] }}</small>
        </div>
    </div>
</div>

<!-- Add meeting -->
<div class="panel">
    <div class="panel-head"><span><i class="fas fa-plus-circle"></i>নতুন মিটিং যোগ করুন</span></div>

    <form id="meetingForm" autocomplete="off" novalidate>
        <div class="panel-body">

            <div class="form-section">প্রতিষ্ঠান</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="field">
                        <label for="categoryInput">ক্যাটাগরি <span class="req">*</span></label>
                        <div class="combo" id="categoryCombo">
                            <div class="combo-box">
                                <i class="fas fa-tags combo-lead"></i>
                                <input type="text" id="categoryInput" class="combo-field" autocomplete="off"
                                       placeholder="ক্যাটাগরি নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="categoryList">
                                <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                                <i class="fas fa-chevron-down combo-chevron"></i>
                            </div>
                            <ul class="combo-list" id="categoryList" role="listbox"></ul>
                            <input type="hidden" id="category">
                        </div>
                        <div class="field-error" data-err="category"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="field">
                        <label for="instituteInput"><span id="instituteLabel">প্রতিষ্ঠান</span> <span class="req">*</span></label>
                        <div class="combo is-disabled" id="instituteCombo">
                            <div class="combo-box">
                                <i class="fas fa-building combo-lead"></i>
                                <input type="text" id="instituteInput" class="combo-field" autocomplete="off" disabled
                                       placeholder="আগে ক্যাটাগরি নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="instituteList">
                                <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                                <i class="fas fa-chevron-down combo-chevron"></i>
                            </div>
                            <ul class="combo-list" id="instituteList" role="listbox"></ul>
                            <input type="hidden" id="institute">
                        </div>
                        <div class="field-hint" id="instituteNewHint" style="display:none"><i class="fas fa-circle-plus me-1"></i>নতুন প্রতিষ্ঠান &mdash; মিটিং সংরক্ষণের সময় যোগ হবে</div>
                        <div class="field-error" data-err="institute_id"></div>
                        <div class="field-error" data-err="institute_name"></div>
                        <div class="field-hint" id="instituteHint" style="display:none"></div>
                    </div>
                </div>

                <div class="col-md-4" id="directorateField" style="display:none">
                    <div class="field">
                        <label for="directorateInput">অধিদপ্তর/দপ্তর/সংস্থা <small>(নির্বাচন করুন, অথবা নতুন নাম লিখুন)</small></label>
                        <div class="combo is-disabled" id="directorateCombo">
                            <div class="combo-box">
                                <i class="fas fa-sitemap combo-lead"></i>
                                <input type="text" id="directorateInput" class="combo-field" autocomplete="off" disabled
                                       placeholder="আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="directorateList">
                                <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                                <i class="fas fa-chevron-down combo-chevron"></i>
                            </div>
                            <ul class="combo-list" id="directorateList" role="listbox"></ul>
                            <input type="hidden" id="directorate">
                        </div>
                        <div class="field-hint" id="directorateNewHint" style="display:none"><i class="fas fa-circle-plus me-1"></i>নতুন অধিদপ্তর/দপ্তর/সংস্থা &mdash; মিটিং সংরক্ষণের সময় যোগ হবে</div>
                        <div class="field-error" data-err="directorate_id"></div>
                        <div class="field-error" data-err="directorate_name"></div>
                    </div>
                </div>

                <!-- opens only after a directorate is chosen -->
                <div class="col-md-4" id="sectionField" style="display:none">
                    <div class="field">
                        <label for="sectionInput">শাখা <small>(ঐচ্ছিক &ndash; নির্বাচন করুন, অথবা নতুন নাম লিখুন)</small></label>
                        <div class="combo is-disabled" id="sectionCombo">
                            <div class="combo-box">
                                <i class="fas fa-code-branch combo-lead"></i>
                                <input type="text" id="sectionInput" class="combo-field" autocomplete="off" disabled
                                       placeholder="আগে অধিদপ্তর/দপ্তর/সংস্থা নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="sectionList">
                                <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                                <i class="fas fa-chevron-down combo-chevron"></i>
                            </div>
                            <ul class="combo-list" id="sectionList" role="listbox"></ul>
                            <input type="hidden" id="section">
                        </div>
                        <div class="field-hint" id="sectionNewHint" style="display:none"><i class="fas fa-circle-plus me-1"></i>নতুন শাখা &mdash; মিটিং সংরক্ষণের সময় যোগ হবে</div>
                        <div class="field-error" data-err="section_id"></div>
                        <div class="field-error" data-err="section_name"></div>
                    </div>
                </div>
            </div>

            <div class="form-section">অংশগ্রহণকারী</div>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="field">
                        <label for="participant_name">নাম <span class="req">*</span></label>
                        <input type="text" id="participant_name" name="participant_name" class="field-input" maxlength="255">
                        <div class="field-error" data-err="participant_name"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="field">
                        <label for="participant_email">ইমেইল <span class="req">*</span></label>
                        <input type="email" id="participant_email" name="participant_email" class="field-input" maxlength="255">
                        <div class="field-error" data-err="participant_email"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="field">
                        <label for="participant_mobile">মোবাইল <span class="req">*</span></label>
                        <input type="tel" id="participant_mobile" name="participant_mobile" class="field-input" maxlength="20" placeholder="01XXXXXXXXX">
                        <div class="field-error" data-err="participant_mobile"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="field">
                        <label for="participant_designation">পদবি <span class="req">*</span></label>
                        <input type="text" id="participant_designation" name="participant_designation" class="field-input" maxlength="255">
                        <div class="field-error" data-err="participant_designation"></div>
                    </div>
                </div>
            </div>

            <div class="form-section">মিটিং</div>
            <div class="row g-3">
                <!-- সভা / সেমিনার / ওয়ার্কশপ -->
                <div class="col-12">
                    <div class="field">
                        <label>মিটিং ধরন <span class="req">*</span></label>
                        <div class="radio-row">
                            @foreach(\App\Models\Meeting::TYPES as $key => $label)
                                <label class="radio-pill">
                                    <input type="radio" name="meeting_type" value="{{ $key }}" {{ $loop->first ? 'checked' : '' }}> {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        <div class="field-error" data-err="meeting_type"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="field">
                        <label for="meeting_name">মিটিংয়ের নাম <span class="req">*</span></label>
                        <input type="text" id="meeting_name" name="meeting_name" class="field-input" maxlength="255">
                        <div class="field-error" data-err="meeting_name"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="field">
                        <label for="meeting_keyword">মিটিংয়ের কীওয়ার্ড <small>(কমা দিয়ে আলাদা করুন)</small></label>
                        <input type="text" id="meeting_keyword" name="meeting_keyword" class="field-input" maxlength="255" placeholder="যেমন: বাজেট, প্রশিক্ষণ">
                        <div class="field-error" data-err="meeting_keyword"></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="field">
                        <label for="meeting_contents">মিটিংয়ের আলোচ্য বিষয়</label>
                        <textarea id="meeting_contents" name="meeting_contents" class="field-input" rows="4" placeholder="আলোচনা, সিদ্ধান্ত, পরবর্তী করণীয়..."></textarea>
                        <div class="field-error" data-err="meeting_contents"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="field">
                        <label for="meeting_at">মিটিংয়ের তারিখ ও সময় <span class="req">*</span></label>
                        <input type="datetime-local" id="meeting_at" name="meeting_at" class="field-input">
                        <div class="field-error" data-err="meeting_at"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field">
                        <label>হাজিরা <span class="req">*</span></label>
                        <div class="radio-row">
                            <label class="radio-pill"><input type="radio" name="attended" value="yes"> হ্যাঁ</label>
                            <label class="radio-pill"><input type="radio" name="attended" value="no"> না</label>
                        </div>
                        <div class="field-error" data-err="attended"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="field">
                        <label for="attachment">সংযুক্ত ফাইল <small>(পিডিএফ, সর্বোচ্চ ২ এমবি)</small></label>
                        <input type="file" id="attachment" name="attachment" class="field-input" accept="application/pdf,.pdf">
                        <div class="field-error" data-err="attachment"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-foot">
            <button id="saveBtn" type="submit" class="btn-solid green">
                <i class="fas fa-save btn-icon"></i>
                <span class="btn-text">মিটিং সংরক্ষণ করুন</span>
                <span class="spinner d-none"></span>
            </button>
        </div>
    </form>
</div>

<!-- Meetings list -->
<div class="panel">
    <div class="panel-head">
        <span><i class="fas fa-list-ul"></i>মিটিং তালিকা</span>
        <div class="head-actions">
            <span class="count-pill">{{ $meetings->total() }}টি মিটিং</span>
            <a class="btn-ghost sm" href="{{ route('meetings.report', request()->except('page')) }}" target="_blank" rel="noopener">
                <i class="fas fa-file-pdf"></i>পিডিএফ ডাউনলোড
            </a>
        </div>
    </div>

    <div class="panel-body" style="border-bottom:1px solid var(--line)">
        <form method="GET" action="{{ route('meetings.index') }}" id="filterForm">
            <div class="filter-grid">
                <div class="field">
                    <label for="fCategoryInput">ক্যাটাগরি</label>
                    <div class="combo" id="fCategoryCombo">
                        <div class="combo-box">
                            <i class="fas fa-tags combo-lead"></i>
                            <input type="text" id="fCategoryInput" class="combo-field" autocomplete="off"
                                   placeholder="সব ক্যাটাগরি" role="combobox" aria-expanded="false" aria-controls="fCategoryInputList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="fCategoryInputList" role="listbox"></ul>
                        <input type="hidden" name="category">
                    </div>
                </div>
                <div class="field">
                    <label for="fInstituteInput">প্রতিষ্ঠান</label>
                    <div class="combo is-disabled" id="fInstituteCombo">
                        <div class="combo-box">
                            <i class="fas fa-building combo-lead"></i>
                            <input type="text" id="fInstituteInput" class="combo-field" autocomplete="off" disabled
                                   placeholder="আগে ক্যাটাগরি নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="fInstituteInputList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="fInstituteInputList" role="listbox"></ul>
                        <input type="hidden" name="institute_id">
                    </div>
                </div>
                <div class="field" id="fDirectorateField" style="display:none">
                    <label for="fDirectorateInput">অধিদপ্তর/দপ্তর/সংস্থা</label>
                    <div class="combo is-disabled" id="fDirectorateCombo">
                        <div class="combo-box">
                            <i class="fas fa-sitemap combo-lead"></i>
                            <input type="text" id="fDirectorateInput" class="combo-field" autocomplete="off" disabled
                                   placeholder="আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="fDirectorateInputList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="fDirectorateInputList" role="listbox"></ul>
                        <input type="hidden" name="directorate_id">
                    </div>
                </div>
                <div class="field" id="fSectionField" style="display:none">
                    <label for="fSectionInput">শাখা</label>
                    <div class="combo is-disabled" id="fSectionCombo">
                        <div class="combo-box">
                            <i class="fas fa-code-branch combo-lead"></i>
                            <input type="text" id="fSectionInput" class="combo-field" autocomplete="off" disabled
                                   placeholder="আগে অধিদপ্তর/দপ্তর/সংস্থা নির্বাচন করুন" role="combobox" aria-expanded="false" aria-controls="fSectionInputList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="মুছুন"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="fSectionInputList" role="listbox"></ul>
                        <input type="hidden" name="section_id">
                    </div>
                </div>

                <!-- সভা / সেমিনার / ওয়ার্কশপ -->
                <div class="field">
                    <label for="fType">ধরন</label>
                    <select id="fType" name="meeting_type" class="field-input">
                        <option value="">সব</option>
                        @foreach(\App\Models\Meeting::TYPES as $key => $label)
                            <option value="{{ $key }}" {{ request('meeting_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="fFrom">তারিখ (শুরু)</label>
                    <input type="date" id="fFrom" name="date_from" class="field-input" value="{{ request('date_from') }}">
                </div>
                <div class="field">
                    <label for="fTo">তারিখ (শেষ)</label>
                    <input type="date" id="fTo" name="date_to" class="field-input" value="{{ request('date_to') }}">
                </div>
                <div class="field">
                    <label for="fPersonQ">অংশগ্রহণকারী</label>
                    <div class="person-group">
                        <select name="person_field" class="field-input" aria-label="অংশগ্রহণকারী খোঁজার ধরন">
                            <option value="name"   {{ (request('person_field', 'name') === 'name') ? 'selected' : '' }}>নাম</option>
                            <option value="email"  {{ (request('person_field') === 'email') ? 'selected' : '' }}>ইমেইল</option>
                            <option value="mobile" {{ (request('person_field') === 'mobile') ? 'selected' : '' }}>মোবাইল</option>
                        </select>
                        <input type="text" id="fPersonQ" name="person_q" class="field-input" value="{{ request('person_q') }}" placeholder="খুঁজুন">
                    </div>
                </div>
                <div class="field">
                    <label for="fTopic">মিটিংয়ের বিষয় / কীওয়ার্ড</label>
                    <input type="text" id="fTopic" name="topic" class="field-input" value="{{ request('topic') }}" placeholder="বিষয় বা কীওয়ার্ড">
                </div>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn-solid"><i class="fas fa-search"></i>খুঁজুন</button>
                <a href="{{ route('meetings.index') }}" class="btn-ghost"><i class="fas fa-rotate-left"></i>রিসেট</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table m-table">
            <thead>
                <tr>
                    <th>মিটিং</th>
                    <th>বিষয়</th>
                    <th>সময়</th>
                    <th>প্রতিষ্ঠান</th>
                    <th>অংশগ্রহণকারী</th>
                    <th>হাজিরা</th>
                </tr>
            </thead>
            <tbody>
                @forelse($meetings as $m)
                    <tr>
                        {{-- মিটিং: type, meeting name (meeting id) --}}
                        <td style="min-width:200px">
                            @if(isset(\App\Models\Meeting::TYPES[$m->meeting_type]))
                                <div><span class="type-badge mtype">{{ \App\Models\Meeting::TYPES[$m->meeting_type] }}</span></div>
                            @endif
                            <div class="row-name">{{ $m->meeting_name }}</div>
                            <span class="code">({{ $m->meeting_code }})</span>
                            @if($m->attachment_path)
                                <div class="mt-1">
                                    <a class="file-link" href="{{ route('meetings.file', $m) }}" target="_blank" rel="noopener">
                                        <i class="fas fa-file-pdf"></i>পিডিএফ{{ $m->attachment_size ? ' · ' . number_format($m->attachment_size / 1024) . ' KB' : '' }}
                                    </a>
                                </div>
                            @endif
                        </td>

                        {{-- বিষয়: contents --}}
                        <td style="min-width:260px">
                            @if($m->meeting_keyword)
                                <div>
                                    @foreach(array_filter(array_map('trim', explode(',', $m->meeting_keyword))) as $k)
                                        <span class="kw-chip">{{ $k }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @php
                                $text = trim((string) $m->meeting_contents);
                            @endphp
                            @if($text === '')
                                <span class="text-muted">&ndash;</span>
                            @elseif(mb_strlen($text) > 160)
                                <div class="subject-text mt-1">{{ \Illuminate\Support\Str::limit($text, 160) }}</div>
                                <details class="contents">
                                    <summary>আরও পড়ুন</summary>
                                    <div>{!! nl2br(e($text)) !!}</div>
                                </details>
                            @else
                                <div class="subject-text mt-1">{!! nl2br(e($text)) !!}</div>
                            @endif
                        </td>

                        {{-- সময়: date and time --}}
                        <td style="white-space:nowrap">
                            <div class="row-name">{{ $m->meeting_at->format('d M Y') }}</div>
                            <small class="sub">{{ $m->meeting_at->format('h:i A') }}</small>
                        </td>

                        {{-- প্রতিষ্ঠান: ministry / directorate / section / autonomous / NGO / others --}}
                        <td style="min-width:200px">
                            <span class="type-badge {{ $m->category }}">{{ $categoryLabels[$m->category] ?? $m->category }}</span>
                            <div class="row-name">{{ optional($m->institute)->name }}</div>
                            @if($m->directorate)
                                <small class="sub"><i class="fas fa-sitemap me-1"></i>{{ $m->directorate->name }}</small>
                            @endif
                            @if($m->section)
                                <small class="sub"><i class="fas fa-code-branch me-1"></i>{{ $m->section->name }}</small>
                            @endif
                        </td>

                        {{-- অংশগ্রহণকারী: name, email, mobile --}}
                        <td style="min-width:200px">
                            <div class="row-name">{{ $m->participant_name }}</div>
                            <small class="sub">{{ $m->participant_email }}</small>
                            <small class="sub">{{ $m->participant_mobile }}</small>
                        </td>

                        {{-- হাজিরা: attendance --}}
                        <td>
                            <span class="att-badge {{ $m->attended ? 'yes' : 'no' }}">{{ $m->attended ? 'হ্যাঁ' : 'না' }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="list-empty">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                {{ request()->hasAny(['category','institute_id','directorate_id','section_id','meeting_type','date_from','date_to','person_q','topic']) ? 'আপনার অনুসন্ধানের সাথে কোনো মিটিং মেলেনি।' : 'এখনো কোনো মিটিং নেই। উপরে প্রথম মিটিংটি যোগ করুন।' }}
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($meetings->hasPages())
        <div class="panel-foot list-foot">
            <span class="text-muted">পৃষ্ঠা {{ $meetings->currentPage() }} / {{ $meetings->lastPage() }}</span>
            {{ $meetings->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
@php
    $filterInit = [
        'category'       => (string) request('category', ''),
        'institute_id'   => (string) request('institute_id', ''),
        'directorate_id' => (string) request('directorate_id', ''),
        'section_id'     => (string) request('section_id', ''),
    ];
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(function () {

    toastr.options = {
        closeButton: true, newestOnTop: true, progressBar: true,
        positionClass: 'toast-top-right', preventDuplicates: true,
        showDuration: 300, hideDuration: 800, timeOut: 4000, extendedTimeOut: 1000
    };

    function showMessage(type, message, title = '') { toastr[type](message, title); }

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
            setCreatable(b) { opts.creatable = !!b; },
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

            // select an existing option by its value (used to restore the search filters)
            selectByValue(v) {
                const ex = options.find(o => o.value === String(v));
                if (ex) choose(ex);
            }
        };
    }

    /* =========================================================
       Data from the server
       ========================================================= */
    const TREE       = @json($tree);        // [{id, name, directorates:[{id, name, sections:[{id, name}]}]}]
    const AUTONOMOUS = @json($autonomous);  // [{id, name}]
    const NGOS       = @json($ngos);        // [{id, name}]
    const OTHERS     = @json($others);      // [{id, name}]

    const toOpts = list => list.map(x => ({ value: String(x.id), label: x.name }));

    const CAT_META = {
        ministry:   { label: 'মন্ত্রণালয়/বিভাগ', placeholder: 'মন্ত্রণালয়/বিভাগ খুঁজুন বা নির্বাচন করুন', empty: 'কোনো মন্ত্রণালয়/বিভাগ সংরক্ষিত নেই।' },
        autonomous: { label: 'স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা', placeholder: 'স্বায়ত্তশাসিত সংস্থা খুঁজুন বা নির্বাচন করুন', empty: 'কোনো স্বায়ত্তশাসিত সংস্থা সংরক্ষিত নেই।' },
        ngo:        { label: 'এনজিও', placeholder: 'এনজিও খুঁজুন বা নির্বাচন করুন', empty: 'কোনো এনজিও সংরক্ষিত নেই।' },
        other:      { label: 'অন্যান্য', placeholder: 'অন্যান্য থেকে খুঁজুন বা নির্বাচন করুন', empty: 'অন্যান্য তালিকায় কিছু সংরক্ষিত নেই।' }
    };

    const CATEGORIES = Object.keys(CAT_META).map(function (k) { return { value: k, label: CAT_META[k].label }; });

    function optionsFor(cat) {
        if (cat === 'ministry')   return toOpts(TREE);
        if (cat === 'autonomous') return toOpts(AUTONOMOUS);
        if (cat === 'ngo')        return toOpts(NGOS);
        if (cat === 'other')      return toOpts(OTHERS);
        return [];
    }

    const DIR_PLACEHOLDER = 'অধিদপ্তর/দপ্তর/সংস্থা খুঁজুন, নির্বাচন করুন বা নতুন নাম লিখুন';
    const SEC_PLACEHOLDER = 'শাখা খুঁজুন, নির্বাচন করুন বা নতুন নাম লিখুন';

    /* =========================================================
       Add-meeting form: category -> institute -> directorate -> section
       ========================================================= */
    const sectionCombo = Combo('#sectionCombo', {
        creatable: true,
        onSelect(o) { $('#sectionNewHint').toggle(!!o.isNew); },
        onClear()   { $('#sectionNewHint').hide(); }
    });

    function hideSection() {
        $('#sectionNewHint').hide();
        sectionCombo.reset(true);
        sectionCombo.setOptions([]);
        sectionCombo.setDisabled(true, 'আগে অধিদপ্তর/দপ্তর/সংস্থা নির্বাচন করুন');
        $('#sectionField').hide();
    }

    const directorateCombo = Combo('#directorateCombo', {
        creatable: true,
        onSelect(o) {
            $('#directorateNewHint').toggle(!!o.isNew);
            // sections of an existing directorate; a brand-new directorate has none yet
            let sections = [];
            if (!o.isNew) {
                const m = TREE.find(x => String(x.id) === instituteCombo.value());
                const d = m && m.directorates.find(x => String(x.id) === o.value);
                sections = d ? d.sections : [];
            }
            sectionCombo.reset(true);
            sectionCombo.setOptions(toOpts(sections));
            sectionCombo.setDisabled(false, SEC_PLACEHOLDER);
            $('#sectionNewHint').hide();
            $('#sectionField').show();
        },
        onClear() { $('#directorateNewHint').hide(); hideSection(); }
    });

    const instituteCombo = Combo('#instituteCombo', {
        onSelect(o) {
            $('#instituteNewHint').toggle(!!o.isNew);
            if (categoryCombo.value() !== 'ministry') return;
            const m = TREE.find(x => String(x.id) === o.value);
            $('#directorateNewHint').hide();
            directorateCombo.reset(true);
            directorateCombo.setOptions(toOpts(m ? m.directorates : []));
            directorateCombo.setDisabled(false, DIR_PLACEHOLDER);
            hideSection();
        },
        onClear() {
            $('#instituteNewHint').hide();
            $('#directorateNewHint').hide();
            directorateCombo.reset(true);
            directorateCombo.setOptions([]);
            directorateCombo.setDisabled(true, 'আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন');
            hideSection();
        }
    });

    const categoryCombo = Combo('#categoryCombo', {
        onSelect(o) {
            const meta = CAT_META[o.value];
            instituteCombo.reset(true);
            $('#directorateNewHint').hide();
            directorateCombo.reset(true);
            directorateCombo.setOptions([]);
            directorateCombo.setDisabled(true, 'আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন');
            hideSection();

            $('#instituteLabel').text(meta.label);
            const opts = optionsFor(o.value);
            const canAdd = o.value !== 'ministry';          // autonomous / NGO / Others can be typed in
            instituteCombo.setOptions(opts);
            instituteCombo.setCreatable(canAdd);
            instituteCombo.setDisabled(false, canAdd ? meta.placeholder + ' বা নতুন নাম লিখুন' : meta.placeholder);
            $('#instituteNewHint').hide();
            $('#directorateField').toggle(o.value === 'ministry');

            if (!canAdd && !opts.length) {
                $('#instituteHint').html(meta.empty + ' আগে <a href="{{ route('institutes.index') }}">প্রতিষ্ঠান পাতায়</a> যোগ করুন।').show();
            } else {
                $('#instituteHint').hide().empty();
            }
        },
        onClear() {
            instituteCombo.reset(true);
            instituteCombo.setOptions([]);
            instituteCombo.setCreatable(false);
            $('#instituteNewHint').hide();
            instituteCombo.setDisabled(true, 'আগে ক্যাটাগরি নির্বাচন করুন');
            $('#directorateNewHint').hide();
            directorateCombo.reset(true);
            hideSection();
            $('#directorateField').hide();
            $('#instituteLabel').text('প্রতিষ্ঠান');
            $('#instituteHint').hide().empty();
        }
    });
    categoryCombo.setOptions(CATEGORIES);

    /* ---------- file: quick client-side check (the server checks again) ---------- */
    $('#attachment').on('change', function () {
        const f = this.files[0];
        if (!f) return;
        const isPdf = f.type === 'application/pdf' || /\.pdf$/i.test(f.name);
        if (!isPdf) {
            showMessage('warning', 'শুধু পিডিএফ ফাইল গ্রহণযোগ্য');
            this.value = '';
        } else if (f.size > 2 * 1024 * 1024) {
            showMessage('warning', 'পিডিএফ ফাইল ২ এমবির বেশি হতে পারবে না');
            this.value = '';
        }
    });

    /* ---------- errors ---------- */
    function clearErrors() {
        $('.field-error').text('');
        $('.field-input').removeClass('is-invalid');
        $('.combo').removeClass('is-invalid');
    }

    function setError(key, msg) {
        $('.field-error[data-err="' + key + '"]').first().text(msg);
        $('[name="' + key + '"]').addClass('is-invalid');
        if (key === 'category')     $('#categoryCombo').addClass('is-invalid');
        if (key === 'institute_id' || key === 'institute_name') $('#instituteCombo').addClass('is-invalid');
        if (key === 'directorate_id' || key === 'directorate_name') $('#directorateCombo').addClass('is-invalid');
        if (key === 'section_id' || key === 'section_name') $('#sectionCombo').addClass('is-invalid');
    }

    function setLoadingState(isLoading) {
        const $btn = $('#saveBtn');
        $btn.prop('disabled', isLoading);
        $btn.find('.spinner').toggleClass('d-none', !isLoading);
        $btn.find('.btn-icon').toggleClass('d-none', isLoading);
        $btn.find('.btn-text').text(isLoading ? 'সংরক্ষণ হচ্ছে...' : 'মিটিং সংরক্ষণ করুন');
    }

    /* ---------- submit ---------- */
    $('#meetingForm').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        // a new directorate / section that is typed but not yet "taken over"
        // (the field still has focus) must be committed before we read it
        instituteCombo.commit();
        directorateCombo.commit();
        sectionCombo.commit();

        const cat  = categoryCombo.value();
        const inst = instituteCombo.value();

        if (!cat)  { setError('category', 'অনুগ্রহ করে একটি ক্যাটাগরি নির্বাচন করুন'); showMessage('warning', 'অনুগ্রহ করে একটি ক্যাটাগরি নির্বাচন করুন'); return; }
        if (!inst) { setError('institute_id', 'অনুগ্রহ করে তালিকা থেকে নির্বাচন করুন'); showMessage('warning', 'অনুগ্রহ করে তালিকা থেকে নির্বাচন করুন'); return; }

        const fd = new FormData();
        fd.append('category', cat);
        if (instituteCombo.isNew()) fd.append('institute_name', instituteCombo.label());
        else                        fd.append('institute_id', inst);

        if (cat === 'ministry' && directorateCombo.label()) {
            if (directorateCombo.isNew()) fd.append('directorate_name', directorateCombo.label());
            else                          fd.append('directorate_id', directorateCombo.value());

            if (sectionCombo.label()) {
                if (sectionCombo.isNew()) fd.append('section_name', sectionCombo.label());
                else                      fd.append('section_id', sectionCombo.value());
            }
        }

        ['participant_name', 'participant_email', 'participant_mobile', 'participant_designation',
         'meeting_name', 'meeting_keyword', 'meeting_contents', 'meeting_at'].forEach(function (n) {
            fd.append(n, ($('[name="' + n + '"]').val() || '').trim());
        });
        fd.append('meeting_type', $('input[name="meeting_type"]:checked').val() || '');
        fd.append('attended', $('input[name="attended"]:checked').val() || '');

        const file = $('#attachment')[0].files[0];
        if (file) fd.append('attachment', file);

        setLoadingState(true);

        fetch(@json(route('meetings.store')), {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: fd
        })
        .then(function (res) {
            return res.json().catch(function () { return {}; }).then(function (body) { return { ok: res.ok, status: res.status, body: body }; });
        })
        .then(function (r) {
            const body = r.body;

            if (r.ok && body.success === true) {
                showMessage('success', body.message || 'মিটিং সংরক্ষণ করা হয়েছে', 'সফল!');
                setTimeout(function () { window.location.reload(); }, 900);
                return;
            }

            if (r.status === 422 && body.errors) {
                let first = null;
                Object.keys(body.errors).forEach(function (k) {
                    setError(k, body.errors[k][0]);
                    if (!first) first = body.errors[k][0];
                });
                showMessage('error', first || 'অনুগ্রহ করে ফর্মটি যাচাই করুন', 'ফর্ম যাচাই করুন');
                return;
            }

            showMessage('error', body.message || 'সংরক্ষণ ব্যর্থ হয়েছে', 'ত্রুটি');
        })
        .catch(function (err) {
            console.error('Error:', err);
            showMessage('error', 'নেটওয়ার্ক ত্রুটি। আবার চেষ্টা করুন।', 'সংযোগ ব্যর্থ');
        })
        .finally(function () { setLoadingState(false); });
    });

    /* =========================================================
       Search filters: same cascade as the entry form
       category -> institute -> directorate -> section (শাখা)
       ========================================================= */
    const F_DIR_PH = 'অধিদপ্তর/দপ্তর/সংস্থা খুঁজুন বা নির্বাচন করুন';
    const F_SEC_PH = 'শাখা খুঁজুন বা নির্বাচন করুন';

    function fHideSection() {
        fSection.reset(true);
        fSection.setOptions([]);
        fSection.setDisabled(true, 'আগে অধিদপ্তর/দপ্তর/সংস্থা নির্বাচন করুন');
        $('#fSectionField').hide();
    }

    const fSection = Combo('#fSectionCombo', {});

    const fDirectorate = Combo('#fDirectorateCombo', {
        onSelect(o) {
            const m = TREE.find(x => String(x.id) === fInstitute.value());
            const d = m && m.directorates.find(x => String(x.id) === o.value);
            fSection.reset(true);
            fSection.setOptions(toOpts(d ? d.sections : []));
            fSection.setDisabled(false, F_SEC_PH);
            $('#fSectionField').show();
        },
        onClear() { fHideSection(); }
    });

    const fInstitute = Combo('#fInstituteCombo', {
        onSelect(o) {
            if (fCategory.value() !== 'ministry') return;
            const m = TREE.find(x => String(x.id) === o.value);
            fDirectorate.reset(true);
            fDirectorate.setOptions(toOpts(m ? m.directorates : []));
            fDirectorate.setDisabled(false, F_DIR_PH);
            fHideSection();
        },
        onClear() {
            fDirectorate.reset(true);
            fDirectorate.setOptions([]);
            fDirectorate.setDisabled(true, 'আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন');
            fHideSection();
        }
    });

    const fCategory = Combo('#fCategoryCombo', {
        onSelect(o) {
            fInstitute.reset(true);
            fInstitute.setOptions(optionsFor(o.value));
            fInstitute.setDisabled(false, CAT_META[o.value].placeholder);
            fDirectorate.reset(true);
            fDirectorate.setOptions([]);
            fDirectorate.setDisabled(true, 'আগে মন্ত্রণালয়/বিভাগ নির্বাচন করুন');
            fHideSection();
            $('#fDirectorateField').toggle(o.value === 'ministry');
        },
        onClear() {
            fInstitute.reset(true);
            fInstitute.setOptions([]);
            fInstitute.setDisabled(true, 'আগে ক্যাটাগরি নির্বাচন করুন');
            fDirectorate.reset(true);
            fHideSection();
            $('#fDirectorateField').hide();
        }
    });
    fCategory.setOptions(CATEGORIES);

    // restore the current search (each step fills the options of the next one)
    const F_INIT = @json($filterInit);
    if (F_INIT.category)       fCategory.selectByValue(F_INIT.category);
    if (F_INIT.institute_id)   fInstitute.selectByValue(F_INIT.institute_id);
    if (F_INIT.directorate_id) fDirectorate.selectByValue(F_INIT.directorate_id);
    if (F_INIT.section_id)     fSection.selectByValue(F_INIT.section_id);

    // don't send empty filter fields in the URL
    $('#filterForm').on('submit', function () {
        $(this).find('input, select').filter(function () { return !this.value; }).prop('disabled', true);
    });
});
</script>
@endpush