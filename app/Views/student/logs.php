<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight"><?= esc($title) ?></h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 8: Daily attendance records, task narrative logs, and supervisor sign-offs</p>
    </div>
    <?php if ($isStudent): ?>
        <div>
            <button type="button" onclick="openNewLogModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer border-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Log Today's Work</span>
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Quota Progress Card (Figma Style) -->
<?php if ($isStudent && $progress): ?>
    <?php 
        $total = (float) ($progress['total_hours'] ?? 0);
        $req   = (float) ($progress['required_hours'] ?? 80);
        $pct   = ($req > 0) ? min(100, round(($total / $req) * 100)) : 0;
    ?>
    <div class="bg-[#1B365D] text-white rounded-2xl shadow-xs p-6 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-300">Immersion Quota Progress</span>
                <div class="text-3xl font-extrabold tracking-tight mt-1">
                    <?= number_format($total, 1) ?> <span class="text-sm font-normal text-slate-300">/ <?= number_format($req, 0) ?> Hours Required</span>
                </div>
            </div>
            <div>
                <?php if ($pct >= 100 || $progress['status'] === 'completed'): ?>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold bg-emerald-500 text-white shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Requirement Completed!</span>
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-[#E5A93C] text-[#1B365D]">
                        <span><?= number_format($req - $total, 1) ?> Hours Remaining</span>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="w-full bg-white/10 rounded-full h-2.5 overflow-hidden">
            <div class="bg-[#E5A93C] h-2.5 rounded-full transition-all" style="width: <?= $pct ?>%"></div>
        </div>
    </div>
<?php endif; ?>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Work Date</th>
                    <?php if (! $isStudent): ?>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Trainee</th>
                    <?php endif; ?>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Time Shift</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Hours</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Accomplishments & Daily Tasks</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 <?= ! $isStudent ? 'border-r border-slate-200' : '' ?>">Supervisor Remarks</th>
                    <?php if (! $isStudent): ?>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Approval Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="7" class="py-8 px-4 text-center text-slate-400 text-xs">No daily time records recorded.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200 font-semibold text-[#1B365D] whitespace-nowrap">
                                <?= date('M d, Y (D)', strtotime($log['log_date'])) ?>
                            </td>
                            <?php if (! $isStudent): ?>
                                <td class="py-3.5 px-4 border-r border-slate-200">
                                    <div class="font-bold text-[#1B365D]"><?= esc($log['first_name'] . ' ' . $log['last_name']) ?></div>
                                    <div class="text-[10px] text-slate-400"><?= esc($log['course'] ?? '') ?></div>
                                </td>
                            <?php endif; ?>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600 font-mono text-xs whitespace-nowrap">
                                <?= esc($log['time_in'] ?? '08:00') ?> &mdash; <?= esc($log['time_out'] ?? '17:00') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <span class="inline-block px-2 py-0.5 rounded-lg text-xs font-bold bg-slate-100 border border-slate-200 text-[#1B365D]">
                                    <?= number_format($log['hours_rendered'], 1) ?> hrs
                                </span>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-700 max-w-xs leading-relaxed">
                                <?= esc($log['tasks_done']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($log['status'] === 'approved'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Approved</span>
                                    </span>
                                <?php elseif ($log['status'] === 'rejected'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Disputed</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Pending</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 <?= ! $isStudent ? 'border-r border-slate-200' : '' ?> text-slate-500 italic text-[11px]">
                                <?= esc($log['supervisor_remarks'] ?? 'None') ?>
                            </td>
                            <?php if (! $isStudent): ?>
                                <td class="py-3.5 px-4 text-right">
                                    <?php if ($log['status'] === 'pending'): ?>
                                        <div class="flex items-center justify-end gap-1.5">
                                            <form action="<?= base_url('logs/approve/' . $log['log_id']) ?>" method="POST" class="inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white cursor-pointer border-0 shadow-2xs transition-colors">
                                                    Approve
                                                </button>
                                            </form>
                                            <button type="button" onclick="document.getElementById('reject-log-modal-<?= $log['log_id'] ?>').classList.remove('hidden')" class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 cursor-pointer transition-colors">
                                                Reject
                                            </button>
                                        </div>

                                        <!-- Reject Dialog (Pure Tailwind) -->
                                        <div id="reject-log-modal-<?= $log['log_id'] ?>" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4 text-left">
                                            <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
                                                <form action="<?= base_url('logs/reject/' . $log['log_id']) ?>" method="POST">
                                                    <?= csrf_field() ?>
                                                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                                        <h3 class="text-sm font-bold text-rose-600">Dispute Attendance Hours</h3>
                                                        <button type="button" onclick="document.getElementById('reject-log-modal-<?= $log['log_id'] ?>').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-base cursor-pointer border-0 bg-transparent">&times;</button>
                                                    </div>
                                                    <div class="p-6 text-xs text-slate-600 space-y-3">
                                                        <p>Provide feedback for <?= esc($log['first_name'] ?? 'trainee') ?> explaining the hours dispute or unverified tasks.</p>
                                                        <div>
                                                            <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Supervisor Feedback *</label>
                                                            <textarea name="remarks" required rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-rose-500" placeholder="Specify hours discrepancy or unverified duties..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                                                        <button type="button" onclick="document.getElementById('reject-log-modal-<?= $log['log_id'] ?>').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                                                        <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 text-white hover:bg-rose-700 border-0 cursor-pointer shadow-xs">Confirm Dispute</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded bg-slate-50">Signed Off</span>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: New Daily Log (Pure Figma Style, Zero Bootstrap) -->
<?php if ($isStudent): ?>
    <div id="modal-new-log" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
            <form action="<?= base_url('logs/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-[#1B365D]">Log Daily Work Accomplishment</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Submit daily attendance and task narrative</p>
                    </div>
                    <button type="button" onclick="closeNewLogModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer border-0 bg-transparent">&times;</button>
                </div>

                <div class="p-6 text-xs text-[#1B365D] space-y-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Work Date *</label>
                        <input type="date" name="log_date" required value="<?= date('Y-m-d') ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Time In</label>
                            <input type="time" name="time_in" value="08:00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Time Out</label>
                            <input type="time" name="time_out" value="17:00" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Hours Rendered *</label>
                        <input type="number" step="0.5" min="0.5" max="12" name="hours_rendered" value="8.0" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        <span class="block text-[10px] text-slate-400 mt-1">Standard full workday represents 8.0 hours.</span>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Daily Tasks & Narrative *</label>
                        <textarea name="tasks_done" rows="3" required placeholder="Describe technical duties, projects, and activities executed today..." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]"></textarea>
                    </div>
                </div>

                <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeNewLogModal()" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Submit Daily Log</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openNewLogModal() {
    document.getElementById('modal-new-log').classList.remove('hidden');
}
function closeNewLogModal() {
    document.getElementById('modal-new-log').classList.add('hidden');
}
</script>
<?= $this->endSection() ?>
