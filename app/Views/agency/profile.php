<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Host Establishment Profile & MOA</h1>
        <p class="text-xs text-slate-500 mt-1">Manage corporate focal person details and review active Memorandum of Agreement status</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    <!-- Left Column: Agency & MOA Cards (2 cols) -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Corporate Info Card -->
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-[#1B365D]"><?= esc($agency['name'] ?? 'Company Name') ?></h2>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 mt-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Accredited Partner</span>
                    </span>
                </div>
            </div>

            <div class="w-full border-t border-slate-100 my-4"></div>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Corporate Email</span>
                    <span class="font-medium text-[#1B365D]"><?= esc($agency['email'] ?? 'N/A') ?></span>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Placement Slot Quota</span>
                    <span class="font-semibold text-[#1B365D]"><?= esc($agency['capacity'] ?? 10) ?> Trainees</span>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Facility Address</span>
                    <span class="text-slate-600"><?= esc($agency['address'] ?? 'N/A') ?></span>
                </div>
            </div>
        </div>

        <!-- MOA Status Card -->
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6 border-l-4 border-l-[#1B365D]">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Institutional MOA</h3>
                <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">Active</span>
            </div>
            <p class="text-xs text-slate-500 mb-4">Valid legal immersion agreement certified with the institution.</p>
            <div class="space-y-2 text-xs border-t border-slate-100 pt-3">
                <div class="flex justify-between">
                    <span class="text-slate-400">Effective Start:</span>
                    <span class="font-semibold text-[#1B365D]"><?= esc($moa['start_date'] ?? '2026-01-15') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Expiration Date:</span>
                    <span class="font-semibold text-[#1B365D]"><?= esc($moa['end_date'] ?? '2027-01-15') ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Edit Supervisor & Contact Details (3 cols) -->
    <div class="lg:col-span-3 bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6">
        <div class="pb-4 mb-5 border-b border-slate-100">
            <h2 class="text-sm font-bold text-[#1B365D]">Edit Corporate Focal Points</h2>
            <p class="text-[11px] text-slate-400">Update company supervisor and operational address</p>
        </div>

        <form action="<?= base_url('agency/profile/update') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Designated Supervisor / Focal Person *</label>
                <input type="text" name="contact_person" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($agency['contact_person'] ?? '') ?>" required>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Supervisor Contact Number *</label>
                <input type="tel" name="contact_no" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($agency['contact_no'] ?? '') ?>" required>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Corporate Facility Physical Address *</label>
                <textarea name="address" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required><?= esc($agency['address'] ?? '') ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 text-right">
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors cursor-pointer border-0">
                    Save Contact Details
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
