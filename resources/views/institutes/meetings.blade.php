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

    /* ===== Meetings tab (scoped to #paneMeetings) ===== */
#paneMeetings .page-head { margin-bottom: 1.25rem; }
#paneMeetings .page-head h1 { font-size: 1.6rem; font-weight: 700; margin: 0; color: var(--ink); }
#paneMeetings .page-head p { margin: 2px 0 0; color: var(--muted); }
#paneMeetings .stats-strip {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 1.75rem; }
#paneMeetings .stat {
        display: flex; align-items: center; gap: 16px;
        padding: 22px 24px; min-width: 0;
        background: var(--surface); border: 1px solid var(--line); border-radius: 12px; }
#paneMeetings .stat > div:last-child { min-width: 0; }
#paneMeetings .stat-icon {
        width: 46px; height: 46px; flex-shrink: 0;
        display: grid; place-items: center; border-radius: 10px; font-size: 1.15rem; }
#paneMeetings .stat-icon.info { background: var(--info-soft);   color: var(--info); }
#paneMeetings .stat-icon.ok { background: var(--ok-soft);     color: var(--ok); }
#paneMeetings .stat-icon.warn { background: var(--warn-soft);   color: var(--warn); }
#paneMeetings .stat-icon.violet { background: var(--violet-soft); color: var(--violet); }
#paneMeetings .stat-icon.bad { background: var(--accent-soft); color: var(--accent); }
#paneMeetings .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.1; color: var(--ink); }
#paneMeetings .stat-label { color: var(--muted); font-size: .9rem; font-weight: 500; }
#paneMeetings .stat-sub { display: block; color: var(--ink); font-size: .85rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; margin-top: 2px; }
#paneMeetings .panel {
        background: var(--surface); border: 1px solid var(--line); border-radius: 12px;
        display: flex; flex-direction: column; margin-bottom: 1.5rem; }
#paneMeetings .panel-head {
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
        padding: 16px 22px; border-bottom: 1px solid var(--line);
        font-weight: 600; font-size: 1.05rem; border-radius: 12px 12px 0 0; }
#paneMeetings .panel-head i { color: var(--accent); margin-right: 8px; }
#paneMeetings .panel-body { padding: 22px; flex: 1; }
#paneMeetings .panel-foot {
        padding: 14px 22px; border-top: 1px solid var(--line);
        background: #fafbfd; border-radius: 0 0 12px 12px; }
#paneMeetings .count-pill {
        background: var(--accent-soft); color: var(--accent);
        font-size: .82rem; font-weight: 600; padding: 3px 12px; border-radius: 999px; }
#paneMeetings .form-section {
        font-weight: 700; color: var(--accent); font-size: .85rem; letter-spacing: .04em;
        text-transform: uppercase; margin: 6px 0 12px; padding-bottom: 6px; border-bottom: 1px dashed var(--line); }
#paneMeetings .field { margin-bottom: .9rem; }
#paneMeetings .field > label {
        display: block; font-weight: 600; font-size: .9rem; margin-bottom: 6px; color: var(--ink); }
#paneMeetings .field > label small { color: var(--muted); font-weight: 400; }
#paneMeetings .req { color: var(--bad); }
#paneMeetings .field-input {
        width: 100%; height: 46px; padding: 0 14px;
        border: 1.5px solid var(--line); border-radius: 8px; background: #fff;
        font-size: 1rem; color: var(--ink); transition: border-color .15s, box-shadow .15s; }
#paneMeetings .field-input:focus {
        outline: 0; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26, 35, 126, .12); }
#paneMeetings .field-input.is-invalid { border-color: var(--bad); }
#paneMeetings textarea.field-input { height: auto; min-height: 110px; padding: 10px 14px; resize: vertical; }
#paneMeetings input[type=file].field-input { padding: 8px 10px; height: 46px; }
#paneMeetings .field-error { color: var(--bad); font-size: .82rem; margin-top: 4px; }
#paneMeetings .field-error:empty { display: none; }
#paneMeetings .field-hint { color: var(--muted); font-size: .82rem; margin-top: 4px; }
#paneMeetings .radio-row { display: flex; gap: 10px; height: 46px; align-items: center; }
#paneMeetings .radio-pill {
        display: inline-flex; align-items: center; gap: 8px; cursor: pointer;
        padding: 8px 18px; border: 1.5px solid var(--line); border-radius: 8px; font-weight: 600; margin: 0; }
#paneMeetings .radio-pill input { accent-color: var(--accent); }
#paneMeetings .radio-pill:has(input:checked) { border-color: var(--accent); background: var(--accent-soft); color: var(--accent); }
#paneMeetings .combo { position: relative; }
#paneMeetings .combo-box { position: relative; }
#paneMeetings .combo-field {
        width: 100%; height: 46px; padding: 0 70px 0 40px;
        border: 1.5px solid var(--line); border-radius: 8px; background: #fff;
        font-size: 1rem; color: var(--ink);
        transition: border-color .15s, box-shadow .15s, background .15s; text-overflow: ellipsis; }
#paneMeetings .combo-field::placeholder { color: #98a2b3; }
#paneMeetings .combo-field:focus { outline: 0; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(26, 35, 126, .12); }
#paneMeetings .combo.is-disabled .combo-field { background: #f3f4f8; cursor: not-allowed; color: #98a2b3; }
#paneMeetings .combo.is-invalid .combo-field { border-color: var(--bad); }
#paneMeetings .combo-lead,
#paneMeetings .combo-chevron {
        position: absolute; top: 50%; transform: translateY(-50%); color: var(--muted); pointer-events: none; }
#paneMeetings .combo-lead { left: 14px; }
#paneMeetings .combo-chevron { right: 14px; transition: transform .15s; }
#paneMeetings .combo.is-open .combo-chevron { transform: translateY(-50%) rotate(180deg); }
#paneMeetings .combo-clear {
        position: absolute; right: 38px; top: 50%; transform: translateY(-50%); display: none;
        border: 0; background: #eef0f5; color: var(--muted);
        width: 22px; height: 22px; border-radius: 50%; font-size: .7rem; line-height: 1; cursor: pointer; }
#paneMeetings .combo-clear:hover { background: var(--bad-soft); color: var(--bad); }
#paneMeetings .combo.has-value:not(.is-disabled) .combo-clear { display: block; }
#paneMeetings .combo-list {
        position: absolute; left: 0; right: 0; top: calc(100% + 6px); z-index: 50;
        max-height: 260px; overflow-y: auto; margin: 0; padding: 6px; list-style: none;
        background: #fff; border: 1px solid var(--line); border-radius: 10px;
        box-shadow: 0 12px 28px rgba(16, 24, 40, .16); display: none; }
#paneMeetings .combo.is-open .combo-list { display: block; }
#paneMeetings .combo-item {
        padding: 9px 12px; border-radius: 6px; cursor: pointer;
        display: flex; align-items: center; justify-content: space-between; gap: 8px; }
#paneMeetings .combo-item.is-active { background: var(--accent-soft); }
#paneMeetings .combo-item.is-selected { font-weight: 600; color: var(--accent); }
#paneMeetings .combo-item.is-selected::after { content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: .75rem; }
#paneMeetings .combo-item.combo-new { color: var(--ok); font-weight: 600; }
#paneMeetings .combo-item mark { background: #ffe58a; color: inherit; padding: 0; border-radius: 2px; }
#paneMeetings .combo-empty { padding: 14px 12px; color: var(--muted); text-align: center; cursor: default; }
#paneMeetings .btn-solid {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 46px; padding: 0 28px; border: 0; border-radius: 8px;
        font-weight: 600; font-size: 1rem; color: #fff; background: var(--accent);
        transition: background .15s, opacity .15s; text-decoration: none; }
#paneMeetings .btn-solid:hover:not(:disabled) { background: var(--navy-deep); color: #fff; }
#paneMeetings .btn-solid:disabled { opacity: .45; cursor: not-allowed; }
#paneMeetings .btn-solid.green { background: var(--ok); }
#paneMeetings .btn-solid.green:hover:not(:disabled) { background: #276749; }
#paneMeetings .btn-ghost {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        height: 46px; padding: 0 22px; border: 1.5px solid var(--line); border-radius: 8px;
        background: #fff; color: var(--ink); font-weight: 600; text-decoration: none; }
#paneMeetings .btn-ghost:hover { background: var(--accent-soft); color: var(--accent); }
#paneMeetings .spinner {
        width: 18px; height: 18px; border: 3px solid rgba(255, 255, 255, .35);
        border-top-color: #fff; border-radius: 50%; animation: spin .8s linear infinite; }
#paneMeetings .filter-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 12px; align-items: end; }
#paneMeetings .filter-grid .field { margin: 0; }
#paneMeetings .filter-grid .field-input { height: 42px; font-size: .95rem; }
#paneMeetings .filter-grid .combo-field { height: 42px; font-size: .95rem; }
#paneMeetings .filter-grid label { font-size: .8rem !important; color: var(--muted) !important; }
#paneMeetings .person-group { display: grid; grid-template-columns: 110px 1fr; gap: 6px; }
#paneMeetings .filter-actions { display: flex; gap: 8px; margin-top: 14px; flex-wrap: wrap; }
#paneMeetings .filter-actions .btn-solid,
#paneMeetings .filter-actions .btn-ghost { height: 42px; }
#paneMeetings .m-table { margin: 0; }
#paneMeetings .m-table thead th {
        background: #fafbfd; color: var(--muted); font-weight: 600; font-size: .85rem;
        border-bottom: 1px solid var(--line); padding: 12px 16px; white-space: nowrap; }
#paneMeetings .m-table td { padding: 12px 16px; vertical-align: top; border-color: var(--line); }
#paneMeetings .code { font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-size: .82rem; font-weight: 700; color: var(--accent); white-space: nowrap; }
#paneMeetings .row-name { font-weight: 600; color: var(--ink); overflow-wrap: anywhere; }
#paneMeetings .sub { display: block; color: var(--muted); font-size: .82rem; overflow-wrap: anywhere; }
#paneMeetings .type-badge {
        display: inline-block; font-size: .75rem; font-weight: 700;
        padding: 2px 10px; border-radius: 6px; margin-bottom: 4px; }
#paneMeetings .type-badge.ministry { background: var(--info-soft);   color: var(--info); }
#paneMeetings .type-badge.autonomous { background: var(--violet-soft); color: var(--violet); }
#paneMeetings .type-badge.ngo { background: var(--ok-soft);     color: var(--ok); }
#paneMeetings .type-badge.other { background: var(--warn-soft);   color: var(--warn); }
#paneMeetings .att-badge { display: inline-block; font-weight: 700; font-size: .8rem; padding: 3px 12px; border-radius: 999px; }
#paneMeetings .att-badge.yes { background: var(--ok-soft);  color: var(--ok); }
#paneMeetings .att-badge.no { background: var(--bad-soft); color: var(--bad); }
#paneMeetings .kw-chip {
        display: inline-block; background: var(--accent-soft); color: var(--accent);
        font-size: .75rem; font-weight: 600; padding: 1px 8px; border-radius: 999px; margin: 3px 4px 0 0; }
#paneMeetings details.contents { margin-top: 6px; }
#paneMeetings details.contents summary { cursor: pointer; color: var(--info); font-size: .85rem; font-weight: 600; }
#paneMeetings details.contents div {
        margin-top: 6px; padding: 10px 12px; background: #fafbfd;
        border: 1px solid var(--line); border-radius: 8px; font-size: .9rem; max-width: 420px;
        max-height: 220px; overflow-y: auto; overflow-wrap: anywhere; }
#paneMeetings .file-link { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; color: var(--bad); text-decoration: none; white-space: nowrap; }
#paneMeetings .file-link:hover { text-decoration: underline; }
#paneMeetings .head-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
#paneMeetings .btn-ghost.sm { height: 38px; padding: 0 14px; font-size: .9rem; }
#paneMeetings .btn-ghost .fa-file-pdf { color: var(--bad); margin: 0; }
#paneMeetings .subject-text { overflow-wrap: anywhere; }
#paneMeetings .list-empty { text-align: center; color: var(--muted); padding: 40px 0; }
#paneMeetings .list-foot { display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
#paneMeetings .list-foot .pagination { margin: 0; }

    /* ---------- Meetings tab: rules that differ from the institutes tab ---------- */
    #paneMeetings .panel { height: auto; }
    #paneMeetings .btn-solid { width: auto; }
    #paneMeetings .stats-strip { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }

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
    <h1>মিটিং ড্যাশবোর্ড</h1>
    <p>সকল প্রতিষ্ঠানের মিটিং এক নজরে দেখুন ও খুঁজুন।</p>
</div>

<div class="main-tabs">
    <a href="{{ route('institutes.index') }}" class="main-tab {{ request()->routeIs('institutes.index') ? 'is-active' : '' }}"><i class="fas fa-building"></i>প্রতিষ্ঠান</a>
    <a href="{{ route('institutes.meetings') }}" class="main-tab {{ request()->routeIs('institutes.meetings') ? 'is-active' : '' }}"><i class="fas fa-calendar-check"></i>মিটিং ড্যাশবোর্ড</a>
</div>

    <!-- ================= মিটিং ================= -->
    <div id="paneMeetings">
<!-- Stats -->
<div class="stats-strip">
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-calendar-check"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['total'] }}</div>
            <div class="stat-label">মোট মিটিং</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon ok"><i class="fas fa-landmark"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['ministry']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ মন্ত্রণালয়/বিভাগ</div>
            <small class="stat-sub" title="{{ $meetingStats['ministry']['name'] }}">{{ $meetingStats['ministry']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon warn"><i class="fas fa-sitemap"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['directorate']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ অধিদপ্তর/দপ্তর/সংস্থা</div>
            <small class="stat-sub" title="{{ $meetingStats['directorate']['name'] }}">{{ $meetingStats['directorate']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-code-branch"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['section']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ শাখা</div>
            <small class="stat-sub" title="{{ $meetingStats['section']['name'] }}">{{ $meetingStats['section']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon violet"><i class="fas fa-building-columns"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['autonomous']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ স্বায়ত্তশাসিত সংস্থা/আধা-স্বায়ত্তশাসিত সংস্থা</div>
            <small class="stat-sub" title="{{ $meetingStats['autonomous']['name'] }}">{{ $meetingStats['autonomous']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon bad"><i class="fas fa-handshake"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['org']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ এনজিও / অন্যান্য</div>
            <small class="stat-sub" title="{{ $meetingStats['org']['name'] }}">{{ $meetingStats['org']['name'] }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-bookmark"></i></div>
        <div>
            <div class="stat-value">{{ $meetingStats['name']['count'] }}</div>
            <div class="stat-label">সর্বোচ্চ মিটিংয়ের নাম</div>
            <small class="stat-sub" title="{{ $meetingStats['name']['name'] }}">{{ $meetingStats['name']['name'] }}</small>
        </div>
    </div>
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
        <form method="GET" action="{{ route('institutes.meetings') }}" id="filterForm">
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
                <a href="{{ route('institutes.meetings') }}" class="btn-ghost"><i class="fas fa-rotate-left"></i>রিসেট</a>
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
                        {{-- মিটিং: meeting name (meeting id) --}}
                        <td style="min-width:200px">
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
                                {{ request()->hasAny(['category','institute_id','directorate_id','section_id','date_from','date_to','person_q','topic']) ? 'আপনার অনুসন্ধানের সাথে কোনো মিটিং মেলেনি।' : 'এখনো কোনো মিটিং নেই। উপরে প্রথম মিটিংটি যোগ করুন।' }}
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


    /* ======================== মিটিং ======================== */
    (function () {
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
    })();
});
</script>
@endpush