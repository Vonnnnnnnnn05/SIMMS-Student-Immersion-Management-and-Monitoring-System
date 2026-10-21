<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Welcome back, <?= esc($student['first_name'] ?? 'Trainee') ?>!</h1>
        <p class="text-xs text-slate-500 mt-1"><?= esc($student['course'] ?? 'Student Trainee') ?> &bull; <?= esc($student['year_level'] ?? '') ?></p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('logs') ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <span>Log Daily DTR</span>
        </a>
    </div>
</div>

<!-- Progress Metric Cards (Figma Monochromatic 70-20-10) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <!-- Card 1: Hours Rendered -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Immersion Hours</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div>
            <div class="flex items-baseline gap-1.5">
                <span class="text-2xl font-bold text-[#1B365D]"><?= number_format($progress['total_hours'] ?? 0, 1) ?></span>
                <span class="text-xs text-slate-400">/ <?= number_format($progress['required_hours'] ?? 80, 0) ?> hrs</span>
            </div>
            <?php 
                $percent = ($progress['required_hours'] > 0) ? min(100, round(($progress['total_hours'] / $progress['required_hours']) * 100)) : 0;
            ?>
            <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3 overflow-hidden">
                <div class="bg-[#1B365D] h-1.5 rounded-full" style="width: <?= $percent ?>%"></div>
            </div>
            <div class="flex items-center justify-between text-[11px] text-slate-400 mt-2 font-medium">
                <span>Progress</span>
                <span class="text-[#1B365D] font-bold"><?= $percent ?>% Completed</span>
            </div>
        </div>
    </div>

    <!-- Card 2: Placement Status -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Host Agency</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
        <div>
            <?php if ($placement): ?>
                <div class="font-bold text-sm text-[#1B365D] truncate"><?= esc($placement['agency_name']) ?></div>
                <div class="text-[11px] text-slate-400 mt-0.5 truncate">Supervisor: <?= esc($placement['contact_person'] ?? 'Pending') ?></div>
                <div class="mt-3">
                    <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider <?= $placement['status'] === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' ?>">
                        <?= ucfirst($placement['status']) ?>
                    </span>
                </div>
            <?php else: ?>
                <div class="text-xs text-slate-500 font-medium">No placement selected yet</div>
                <a href="<?= base_url('student/agencies') ?>" class="inline-block mt-3 text-xs font-bold text-[#1B365D] hover:underline">Browse Agencies &rarr;</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Card 3: Document Compliance -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pre-Immersion Files</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
        </div>
        <div>
            <div class="flex items-baseline gap-1.5">
                <span class="text-2xl font-bold text-[#1B365D]"><?= $approvedDocs ?></span>
                <span class="text-xs text-slate-400">/ <?= $totalDocs ?> Verified</span>
            </div>
            <div class="text-[11px] text-slate-400 mt-1">Medical, Waiver, and Insurance</div>
            <div class="mt-3">
                <a href="<?= base_url('student/documents') ?>" class="inline-block text-xs font-bold text-[#1B365D] hover:underline">Upload Checklist &rarr;</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Accomplishments Table (Figma Table with Crisp Borders) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
        <div>
            <h2 class="text-sm font-bold text-[#1B365D]">Recent Daily Accomplishments (DTR)</h2>
            <p class="text-[11px] text-slate-400">Sprint 7 & 8: Verified log records rendered on-site</p>
        </div>
        <a href="<?= base_url('logs') ?>" class="text-xs font-bold text-[#1B365D] hover:underline">View All Logs &rarr;</a>
    </div>

    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Log Date</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Shift / Hours</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Tasks Rendered</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Approval Status</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                <?php if (empty($recentLogs)): ?>
                    <tr>
                        <td colspan="4" class="py-8 px-4 text-center text-slate-400 text-xs">No daily logs recorded yet. Click 'Log Daily DTR' to start!</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recentLogs as $log): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                            <td class="py-3.5 px-4 font-semibold text-[#1B365D] border-r border-slate-200">
                                <?= date('M d, Y', strtotime($log['log_date'])) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="font-medium text-[#1B365D]"><?= esc($log['hours_rendered']) ?> hrs</div>
                                <div class="text-[11px] text-slate-400"><?= esc($log['time_in']) ?> &mdash; <?= esc($log['time_out']) ?></div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 max-w-md truncate border-r border-slate-200">
                                <?= esc($log['tasks_done']) ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <?php if ($log['status'] === 'approved'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Approved</span>
                                    </span>
                                <?php elseif ($log['status'] === 'rejected'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Returned</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Pending Review</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
