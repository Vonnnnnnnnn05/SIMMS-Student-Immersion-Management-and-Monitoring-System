<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <div class="flex items-center gap-2">
            <a href="<?= base_url('faculty/students') ?>" class="text-xs text-slate-400 hover:text-[#1B365D]">&larr; Back to Advisees</a>
        </div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight mt-1">Trainee Dossier: <?= esc($student['first_name'] . ' ' . $student['last_name']) ?></h1>
        <p class="text-xs text-slate-500 mt-0.5"><?= esc($student['course'] ?? '') ?> &bull; Contact: <?= esc($student['contact_no'] ?? '') ?></p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('reports/personal-info/' . $student['student_id']) ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-[#1B365D] hover:bg-slate-50 transition-colors shadow-2xs flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Personal Sheet</span>
        </a>
        <a href="<?= base_url('reports/completion-dtr/' . $student['student_id']) ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-[#1B365D] hover:bg-slate-50 transition-colors shadow-2xs flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>DTR Sheet</span>
        </a>
        <a href="<?= base_url('reports/portfolio/' . $student['student_id']) ?>" target="_blank" class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
            <span>Portfolio</span>
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Left Column: Status & Requirements -->
    <div class="space-y-6">
        <!-- Immersion Status Card -->
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 pb-2 border-b border-slate-100">Immersion Status</h2>
            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-slate-400 block text-[11px]">Host Agency Placement</span>
                    <span class="font-bold text-[#1B365D] text-sm"><?= esc($deployment['agency_name'] ?? 'Not yet deployed') ?></span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px]">Supervisor Contact</span>
                    <span class="font-medium text-[#1B365D]"><?= esc($deployment['contact_person'] ?? 'Pending assignment') ?></span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px]">Deployment Period</span>
                    <span class="font-medium text-[#1B365D]"><?= esc($deployment['start_date'] ?? 'N/A') ?> to <?= esc($deployment['end_date'] ?? 'TBD') ?></span>
                </div>
                <div class="pt-3 border-t border-slate-100">
                    <span class="text-slate-400 block text-[11px] mb-1">Accumulated Hours</span>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-xl font-bold text-[#1B365D]"><?= number_format($progress['total_hours'] ?? 0, 1) ?></span>
                        <span class="text-xs text-slate-400">/ <?= number_format($progress['required_hours'] ?? 80, 0) ?> hrs</span>
                    </div>
                    <?php 
                        $pct = ($progress['required_hours'] > 0) ? min(100, round(($progress['total_hours'] / $progress['required_hours']) * 100)) : 0;
                    ?>
                    <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2 overflow-hidden">
                        <div class="bg-[#1B365D] h-1.5 rounded-full" style="width: <?= $pct ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clearance Documents Checklist Card -->
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
            <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 pb-2 border-b border-slate-100">Pre-Immersion Clearances</h2>
            <div class="space-y-2 text-xs">
                <?php if (empty($documents)): ?>
                    <div class="text-slate-400 text-center py-4">No documents submitted yet.</div>
                <?php else: ?>
                    <?php foreach ($documents as $doc): ?>
                        <div class="flex items-center justify-between p-2.5 rounded-xl border border-slate-100 bg-slate-50/50">
                            <div class="truncate max-w-[170px]">
                                <div class="font-semibold text-[#1B365D] truncate"><?= esc($doc['document_name']) ?></div>
                                <div class="text-[10px] text-slate-400"><?= date('M d, Y', strtotime($doc['uploaded_at'])) ?></div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[9px] font-bold rounded-full uppercase tracking-wider <?= $doc['status'] === 'approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($doc['status'] === 'rejected' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-amber-50 text-amber-700 border border-amber-200') ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?= $doc['status'] === 'approved' ? 'bg-emerald-500' : ($doc['status'] === 'rejected' ? 'bg-rose-500' : 'bg-amber-500') ?>"></span>
                                <span><?= ucfirst($doc['status']) ?></span>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: DTR Log History Table with Crisp Borders -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
        <div class="pb-3 mb-4 border-b border-slate-100">
            <h2 class="text-sm font-bold text-[#1B365D]">Daily Attendance & Accomplishments Record</h2>
            <p class="text-[11px] text-slate-400">Chronological daily log sheet verified by host agency</p>
        </div>

        <div class="overflow-x-auto border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse" style="margin-bottom:0;">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Work Date</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Shift / Hours</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Tasks Completed</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    <?php if (empty($logs)): ?>
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-slate-400 text-xs">No daily time records logged yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                                <td class="py-3.5 px-4 font-semibold text-[#1B365D] border-r border-slate-200">
                                    <?= date('M d, Y', strtotime($log['log_date'])) ?>
                                </td>
                                <td class="py-3.5 px-4 border-r border-slate-200">
                                    <div class="font-medium text-[#1B365D]"><?= esc($log['hours_rendered']) ?> hrs</div>
                                    <div class="text-[11px] text-slate-400"><?= esc($log['time_in']) ?> &mdash; <?= esc($log['time_out']) ?></div>
                                </td>
                                <td class="py-3.5 px-4 text-slate-600 max-w-sm truncate border-r border-slate-200">
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
                                            <span>In Review</span>
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
</div>
<?= $this->endSection() ?>
