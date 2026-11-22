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
    }

    .page-head { margin-bottom: 1.25rem; }
    .page-head h1 { font-size: 1.6rem; font-weight: 700; margin: 0; color: var(--ink); }
    .page-head p  { margin: 2px 0 0; color: var(--muted); }

    /* ---------- Stats strip ---------- */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
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

    .stat-icon.info { background: var(--info-soft); color: var(--info); }
    .stat-icon.ok   { background: var(--ok-soft);   color: var(--ok); }
    .stat-icon.warn { background: var(--warn-soft); color: var(--warn); }
    .stat-icon.bad  { background: var(--accent-soft); color: var(--accent); }

    .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1.1; color: var(--ink); }
    .stat-label { color: var(--muted); font-size: .9rem; font-weight: 500; }
    .stat-sub   { display: block; color: var(--muted); font-size: .8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; margin-top: 2px; }

    @media (max-width: 1199px) {
        .stats-strip { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 575px) {
        .stats-strip { grid-template-columns: 1fr; gap: 14px; }
    }

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
    .field-input[readonly] { background: #f6f7fb; font-weight: 600; }

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

    .combo.is-disabled .combo-field {
        background: #f3f4f8;
        cursor: not-allowed;
        color: #98a2b3;
    }

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

    .combo-spinner {
        position: absolute;
        right: 38px;
        top: 50%;
        margin-top: -8px;
        width: 16px;
        height: 16px;
        border: 2px solid #d5d9e6;
        border-top-color: var(--accent);
        border-radius: 50%;
        animation: spin .7s linear infinite;
        display: none;
    }
    .combo.is-loading .combo-spinner { display: block; }
    .combo.is-loading .combo-clear { display: none !important; }

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
    .combo-item mark { background: #ffe58a; color: inherit; padding: 0; border-radius: 2px; }

    .combo-empty { padding: 14px 12px; color: var(--muted); text-align: center; cursor: default; }

    /* ---------- Availability + warning ---------- */
    .avail {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f6f7fb;
        border: 1.5px dashed var(--line);
        border-radius: 8px;
        padding: 10px 14px;
        margin-bottom: 1.1rem;
    }
    .avail span { color: var(--muted); font-weight: 500; }
    .avail strong { font-size: 1.3rem; color: var(--ink); }

    .warning-box {
        display: none;
        background: var(--warn-soft);
        border-left: 4px solid var(--warn);
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 1.1rem;
        color: #7a4a0c;
        font-weight: 500;
    }

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

    /* ---------- Draft table ---------- */
    .draft-table { margin: 0; }
    .draft-table thead th {
        background: #fafbfd;
        color: var(--muted);
        font-weight: 600;
        font-size: .88rem;
        border-bottom: 1px solid var(--line);
        padding: 12px 22px;
    }
    .draft-table td { padding: 12px 22px; vertical-align: middle; border-color: var(--line); }
    .qty-badge {
        display: inline-block;
        min-width: 44px;
        text-align: center;
        background: var(--info-soft);
        color: var(--info);
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 6px;
    }
    .draft-total { display: flex; justify-content: space-between; margin-bottom: 12px; color: var(--muted); font-weight: 500; }
    .draft-total strong { color: var(--ink); }

    /* ---------- Toasts ---------- */
    #toast-container { z-index: 9999 !important; }
    #toast-container > div {
        opacity: 1 !important;
        border-radius: 10px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .18) !important;
        background-image: none !important;
        padding: 14px 18px 14px 18px !important;
        width: 320px !important;
    }
    .toast-success, .toast-info, .toast-warning, .toast-error {
        background-color: #fff !important;
        color: #000 !important;
    }
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
    <h1>Dashboard</h1>
    <p>Choose products, set your demand and submit one application.</p>
</div>

<!-- Stats -->
<div class="stats-strip">
    <div class="stat">
        <div class="stat-icon info"><i class="fas fa-shopping-cart"></i></div>
        <div>
            <div class="stat-value">{{ $totalQuantity }}</div>
            <div class="stat-label">Total ordered</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon ok"><i class="fas fa-trophy"></i></div>
        <div>
            <div class="stat-value">{{ $highestProduct->total_quantity ?? 0 }}</div>
            <div class="stat-label">Top product orders</div>
            <small class="stat-sub" title="{{ $highestProduct->product->name ?? 'N/A' }}">{{ $highestProduct->product->name ?? 'N/A' }}</small>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon warn"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-value">{{ $pendingCount }}</div>
            <div class="stat-label">Pending applications</div>
        </div>
    </div>
    <div class="stat">
        <div class="stat-icon bad"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-value">{{ $approvedCount }}</div>
            <div class="stat-label">Approved applications</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Select products -->
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-head"><span><i class="fas fa-plus-circle"></i>Select products</span></div>
            <div class="panel-body">

                <!-- Category combobox -->
                <div class="field">
                    <label for="categoryInput">Category</label>
                    <div class="combo" id="categoryCombo">
                        <div class="combo-box">
                            <i class="fas fa-tags combo-lead"></i>
                            <input type="text" id="categoryInput" class="combo-field" autocomplete="off"
                                   placeholder="Search or select a category" role="combobox" aria-expanded="false" aria-controls="categoryList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="Clear category"><i class="fas fa-times"></i></button>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="categoryList" role="listbox"></ul>
                        <input type="hidden" id="category">
                    </div>
                </div>

                <!-- Product combobox -->
                <div class="field">
                    <label for="productInput">Product</label>
                    <div class="combo is-disabled" id="productCombo">
                        <div class="combo-box">
                            <i class="fas fa-box combo-lead"></i>
                            <input type="text" id="productInput" class="combo-field" autocomplete="off" disabled
                                   placeholder="Select a category first" role="combobox" aria-expanded="false" aria-controls="productList">
                            <button type="button" class="combo-clear" tabindex="-1" aria-label="Clear product"><i class="fas fa-times"></i></button>
                            <span class="combo-spinner"></span>
                            <i class="fas fa-chevron-down combo-chevron"></i>
                        </div>
                        <ul class="combo-list" id="productList" role="listbox"></ul>
                        <input type="hidden" id="product">
                    </div>
                </div>

                <div id="allotmentWarning" class="warning-box">
                    <i class="fas fa-exclamation-triangle me-2"></i><span id="warningText"></span>
                </div>

                <div class="avail">
                    <span><i class="fas fa-warehouse me-2"></i>Available quantity</span>
                    <strong id="quantityText">&ndash;</strong>
                    <input type="hidden" id="quantity">
                </div>

                <div class="field">
                    <label for="demand11">Your demand</label>
                    <input type="number" id="demand11" class="field-input" min="1" placeholder="Enter quantity">
                </div>

                <button id="addBtn" type="button" class="btn-solid green">
                    <i class="fas fa-plus"></i>Add to draft
                </button>
            </div>
        </div>
    </div>

    <!-- Draft list -->
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-head">
                <span><i class="fas fa-list-ul"></i>Draft list</span>
                <span id="draftCount" class="count-pill">0 items</span>
            </div>

            <div class="table-responsive" style="flex:1">
                <table class="table draft-table" id="draftTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th style="width:70px"></th>
                        </tr>
                    </thead>
                    <tbody id="draftTableBody">
                        <tr id="emptyRow">
                            <td colspan="3" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                Your draft is empty. Pick a product and add it.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="panel-foot">
                <div class="draft-total"><span>Total quantity</span><strong id="draftTotal">0</strong></div>
                <button id="saveDraft" type="button" class="btn-solid" disabled>
                    <i class="fas fa-paper-plane btn-icon"></i>
                    <span class="btn-text">Submit application</span>
                    <span class="spinner d-none"></span>
                </button>
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
       Searchable combobox: type to filter OR click to open list
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
            $list.empty();
            activeIx = -1;

            if (!matches.length) {
                $list.append($('<li class="combo-empty">').text(options.length ? 'No match found' : 'Nothing to show'));
                return;
            }

            matches.forEach(o => {
                const $li = $('<li class="combo-item" role="option">').html(highlight(o.label, q)).data('opt', o);
                if (selected && selected.value === o.value) $li.addClass('is-selected');
                $list.append($li);
            });

            // pre-highlight the first match when searching, or the selected one when browsing
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
            // show the full list when text is just the chosen label
            const q = (selected && $input.val() === selected.label) ? '' : $input.val();
            render(q);
            $root.addClass('is-open');
            $input.attr('aria-expanded', 'true');
        }

        function close() {
            $root.removeClass('is-open');
            $input.attr('aria-expanded', 'false');
            $input.val(selected ? selected.label : '');
        }

        function choose(o) {
            selected = o;
            $hidden.val(o.value);
            $input.val(o.label);
            $root.addClass('has-value');
            $root.removeClass('is-open');
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

        // ---- events ----
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
            } else if (e.key === 'Escape') {
                close();
            } else if (e.key === 'Tab') {
                close();
            }
        });

        $input.on('blur', function () { setTimeout(close, 120); });

        // mousedown so it fires before the input blurs
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
            setOptions(arr)  { options = arr; if ($root.hasClass('is-open')) render($input.val()); },
            reset,
            setDisabled(b, placeholder) {
                $root.toggleClass('is-disabled', b);
                $input.prop('disabled', b);
                if (placeholder) $input.attr('placeholder', placeholder);
            },
            setLoading(b)    { $root.toggleClass('is-loading', b); },
            focus()          { $input.focus(); },
            value()          { return selected ? selected.value : ''; },
            label()          { return selected ? selected.label : ''; }
        };
    }

    /* =========================================================
       Category + product wiring
       ========================================================= */
    const categories = @json($categories).map(c => ({ value: String(c), label: String(c) }));

    const productCombo = Combo('#productCombo', {
        onSelect(o) { loadQuantity(o.value); },
        onClear()   { clearAvailability(); }
    });

    const categoryCombo = Combo('#categoryCombo', {
        onSelect(o) { loadProducts(o.value); },
        onClear() {
            productCombo.reset(true);
            productCombo.setOptions([]);
            productCombo.setDisabled(true, 'Select a category first');
            clearAvailability();
        }
    });

    categoryCombo.setOptions(categories);

    function clearAvailability() {
        $('#quantity').val('');
        $('#quantityText').text('–');
        $('#demand11').val('');
        $('#allotmentWarning').hide();
    }

    function loadProducts(category) {
        productCombo.reset(true);
        productCombo.setOptions([]);
        clearAvailability();
        productCombo.setDisabled(true, 'Loading products...');
        productCombo.setLoading(true);

        fetch(`/products-by-category/${encodeURIComponent(category)}`)
            .then(res => res.json())
            .then(data => {
                productCombo.setOptions(data.map(p => ({ value: String(p.prcode), label: p.name })));
                productCombo.setDisabled(false, data.length ? 'Search or select a product' : 'No products in this category');
                if (data.length) productCombo.focus();
            })
            .catch(err => {
                console.error('Error:', err);
                productCombo.setDisabled(true, 'Could not load products');
                showMessage('error', 'Failed to load products');
            })
            .finally(() => productCombo.setLoading(false));
    }

    function loadQuantity(prcode) {
        clearAvailability();
        $('#quantityText').text('...');

        fetch(`/product-quantity/${encodeURIComponent(prcode)}`)
            .then(res => res.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    const qty = data.quantity ?? 0;
                    $('#quantity').val(qty);
                    $('#quantityText').text(qty);

                    if (data.allotment_warning) {
                        $('#warningText').text(data.allotment_warning);
                        $('#allotmentWarning').fadeIn();
                    }
                    $('#demand11').trigger('focus');
                } catch (err) {
                    console.error('JSON parse error:', err);
                    $('#quantityText').text('–');
                    showMessage('error', 'Invalid server response');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                $('#quantityText').text('–');
                showMessage('error', 'Failed to load product quantity');
            });
    }

    /* =========================================================
       Draft list
       ========================================================= */
    function updateDraftCount() {
        const $rows = $('#draftTableBody tr:not(#emptyRow)');
        const count = $rows.length;
        let total = 0;
        $rows.each(function () { total += parseInt($(this).find('.qty-badge').text()) || 0; });

        $('#draftCount').text(count + (count === 1 ? ' item' : ' items'));
        $('#draftTotal').text(total);
        $('#saveDraft').prop('disabled', count === 0);
        $('#emptyRow').toggle(count === 0);
    }

    function setLoadingState(btn, isLoading) {
        const $btn = $(btn);
        $btn.prop('disabled', isLoading);
        $btn.find('.spinner').toggleClass('d-none', !isLoading);
        $btn.find('.btn-icon').toggleClass('d-none', isLoading);
        $btn.find('.btn-text').text(isLoading ? 'Submitting...' : 'Submit application');
        if (!isLoading) updateDraftCount();
    }

    function addToDraft() {
        const productCode  = productCombo.value();
        const productName  = productCombo.label();
        const demandQty    = parseInt($('#demand11').val());

        if (!productCode) {
            showMessage('warning', 'Please select a product');
            return;
        }
        if (!demandQty || demandQty <= 0) {
            showMessage('warning', 'Please enter a valid quantity');
            return;
        }
        if ($('#draftTableBody tr').filter(function () { return $(this).attr('data-prcode') === productCode; }).length) {
            showMessage('warning', 'Product already exists in draft');
            return;
        }

        const $row = $('<tr>').attr('data-prcode', productCode);
        $row.append(
            $('<td>').append(
                $('<div class="d-flex align-items-center">').append(
                    $('<i class="fas fa-box text-primary me-2">'),
                    $('<span class="product-name">').text(productName)
                )
            ),
            $('<td>').append($('<span class="qty-badge">').text(demandQty)),
            $('<td class="text-end">').append(
                $('<button type="button" class="btn-remove removeBtn" aria-label="Remove">').html('<i class="fas fa-trash"></i>')
            )
        );

        $('#draftTableBody').append($row);
        updateDraftCount();

        // ready for the next product, keep the category
        productCombo.reset(true);
        clearAvailability();
        productCombo.focus();
        showMessage('success', 'Product added to draft');
    }

    $('#addBtn').on('click', addToDraft);
    $('#demand11').on('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); addToDraft(); }
    });

    $('#draftTableBody').on('click', '.removeBtn', function () {
        $(this).closest('tr').fadeOut(200, function () {
            $(this).remove();
            updateDraftCount();
        });
        showMessage('success', 'Product removed from draft');
    });

    /* =========================================================
       Submit
       ========================================================= */
    $('#saveDraft').on('click', function () {
        const $rows = $('#draftTableBody tr:not(#emptyRow)');
        if (!$rows.length) {
            showMessage('error', 'No items in draft to submit');
            return;
        }

        const draftData = [];
        $rows.each(function () {
            const $r = $(this);
            draftData.push({
                prcode:   $r.attr('data-prcode'),
                product:  $r.find('.product-name').text(),
                quantity: parseInt($r.find('.qty-badge').text())
            });
        });

        setLoadingState(this, true);
        showMessage('info', 'Submitting your application...', 'Please wait');

        fetch('/save-draft', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ draft: draftData })
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success === true) {
                let message = data.message || 'Application submitted successfully!';
                if (data.items_saved) message += ` (${data.items_saved} items processed)`;
                if (data.trid) message += ` Reference ID: ${data.trid}`;

                showMessage('success', message, 'Success!');

                $('#draftTableBody').empty().append(`
                    <tr id="emptyRow">
                        <td colspan="3" class="text-center text-muted py-5">
                            <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                            Your draft is empty. Pick a product and add it.
                        </td>
                    </tr>
                `);
                categoryCombo.reset();
            } else {
                showMessage('error', data.message || 'Submission failed', 'Error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', 'Network error. Please try again.', 'Connection Failed');
        })
        .finally(() => setLoadingState('#saveDraft', false));
    });

    updateDraftCount();
});
</script>
@endpush