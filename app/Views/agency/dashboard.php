<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight"><?= esc($agency['name'] ?? 'Partner Host Agency') ?></h1>
        <p class="text-xs text-slate-500 mt-1">Supervisor Portal: Attendance sign-off, trainee progress tracking, and performance rubrics</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('logs') ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Review Trainee Logs</span>
        </a>
    </div>
</div>

<!-- 3 Monochromatic Metric Cards (Figma 70-20-10) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Card 1: Assigned Trainees -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Assigned Trainees</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $traineesCount ?></div>
        <div class="text-[11px] text-slate-400 mt-1">Active immersion students on-site</div>
    </div>

    <!-- Card 2: Pending Daily Logs -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pending Daily Logs</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $pendingLogsCount ?></div>
        <div class="mt-1">
            <a href="<?= base_url('logs') ?>" class="text-[11px] font-bold text-[#1B365D] hover:underline">Review & sign-off hours &rarr;</a>
        </div>
    </div>

    <!-- Card 3: Submitted Evaluations -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Completed Ratings</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $evaluationsCount ?></div>
        <div class="mt-1">
            <a href="<?= base_url('evaluations') ?>" class="text-[11px] font-bold text-[#1B365D] hover:underline">View evaluation rubrics &rarr;</a>
        </div>
    </div>
</div>

<!-- Partnership Profile & Desk Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Left Card: Institutional Partnership Status -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
        <div class="pb-3 mb-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-sm font-bold text-[#1B365D]">Establishment Accreditation</h2>
            <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                Active MOA
            </span>
        </div>

        <div class="space-y-3 text-xs">
            <div>
                <span class="text-slate-400 block text-[11px]">Establishment Name</span>
                <span class="font-bold text-[#1B365D] text-sm"><?= esc($agency['name'] ?? '') ?></span>
            </div>
            <div>
                <span class="text-slate-400 block text-[11px]">Designated Focal Person / Supervisor</span>
                <span class="font-medium text-[#1B365D]"><?= esc($agency['contact_person'] ?? '') ?></span>
            </div>
            <div>
                <span class="text-slate-400 block text-[11px]">Operating Facility Address</span>
                <span class="text-slate-600"><?= esc($agency['address'] ?? '') ?></span>
            </div>
            <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-between">
                <div>
                    <div class="font-semibold text-xs text-[#1B365D]">Memorandum of Agreement</div>
                    <div class="text-[11px] text-slate-400"><?= esc($moa['start_date'] ?? '2026-01-15') ?> &bull; Certified Industry Partner</div>
                </div>
                <a href="<?= base_url('agency/profile') ?>" class="text-xs font-bold text-[#1B365D] hover:underline">Edit Info &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Right Card: Supervisor Desk Shortcuts -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
        <div class="pb-3 mb-4 border-b border-slate-100">
            <h2 class="text-sm font-bold text-[#1B365D]">Supervisor Operations</h2>
            <p class="text-[11px] text-slate-400">Direct shortcuts to daily supervisory workflows</p>
        </div>

        <div class="space-y-2">
            <a href="<?= base_url('agency/trainees') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    <span>View Assigned Trainees</span>
                </div>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>

            <a href="<?= base_url('logs') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Approve Trainee Daily Attendance (DTR)</span>
                </div>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>

            <a href="<?= base_url('evaluations') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                    <span>Rate Trainee Performance & Rubrics</span>
                </div>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>

            <a href="<?= base_url('chat') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                <div class="flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-1.074-.85 6.002 6.002 0 001.378-3.082C4.184 15.65 3 13.926 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
                    <span>Communications & Direct Chat</span>
                </div>
                <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
