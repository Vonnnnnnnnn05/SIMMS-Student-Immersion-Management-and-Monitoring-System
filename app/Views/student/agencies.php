<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Accredited Partner Host Agencies</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 4: Browse vetted institutional partners and submit your placement application</p>
    </div>
</div>

<?php if ($existingSelection): ?>
    <div class="mb-6 p-4 bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] border-l-4 border-l-[#1B365D] flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
        <div>
            <div class="flex items-center gap-2">
                <span class="font-bold text-[#1B365D]">Current Application:</span>
                <span class="font-semibold text-slate-700"><?= esc($existingSelection['agency_name'] ?? 'Selected Agency') ?></span>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider <?= $existingSelection['status'] === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($existingSelection['status'] === 'rejected' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200') ?>">
                    <span class="w-1.5 h-1.5 rounded-full <?= $existingSelection['status'] === 'approved' ? 'bg-emerald-500' : ($existingSelection['status'] === 'rejected' ? 'bg-rose-500' : 'bg-amber-500') ?>"></span>
                    <span><?= ucfirst($existingSelection['status']) ?></span>
                </span>
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Submitted on <?= date('M d, Y', strtotime($existingSelection['date_selected'])) ?></div>
            <?php if (!empty($existingSelection['remarks'])): ?>
                <div class="text-[11px] text-slate-600 mt-1 italic">Coordinator Remarks: <?= esc($existingSelection['remarks']) ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    <?php if (empty($agencies)): ?>
        <div class="col-span-full bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-12 text-center text-slate-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            <div class="font-semibold text-slate-600 text-sm">No accredited partner agencies registered yet.</div>
            <p class="text-xs text-slate-400 mt-1">Please check back later or contact your faculty coordinator.</p>
        </div>
    <?php else: ?>
        <?php foreach ($agencies as $agency): ?>
            <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between hover:shadow-sm transition-shadow">
                <div>
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Active MOA</span>
                        </span>
                    </div>

                    <h2 class="text-sm font-bold text-[#1B365D] mb-1.5"><?= esc($agency['name']) ?></h2>
                    <p class="text-xs text-slate-500 mb-3 flex items-start gap-1.5">
                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <span><?= esc($agency['address']) ?></span>
                    </p>

                    <div class="space-y-1.5 text-xs text-slate-500 py-3 border-t border-slate-100">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Supervisor:</span>
                            <span class="font-medium text-[#1B365D]"><?= esc($agency['contact_person']) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Contact:</span>
                            <span><?= esc($agency['contact_no']) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Quota Capacity:</span>
                            <span class="font-medium text-[#1B365D]"><?= esc($agency['capacity']) ?> Trainees</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <?php if ($existingSelection && $existingSelection['agency_id'] == $agency['agency_id']): ?>
                        <button class="w-full py-2 px-3 rounded-xl text-xs font-semibold bg-slate-100 text-slate-500 cursor-not-allowed border-0" disabled>
                            Currently Selected
                        </button>
                    <?php elseif (! $existingSelection || $existingSelection['status'] === 'rejected'): ?>
                        <form action="<?= base_url('student/agencies/select') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="agency_id" value="<?= $agency['agency_id'] ?>">
                            <button type="submit" class="w-full py-2 px-3 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] transition-colors cursor-pointer border-0 shadow-2xs" onclick="return confirm('Confirm selection of <?= esc($agency['name']) ?> for your immersion placement?')">
                                Request Placement
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="w-full py-2 px-3 rounded-xl text-xs font-semibold bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed" disabled>
                            Application Under Review
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
