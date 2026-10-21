<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Trainee Performance Evaluations</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 10: Multi-criteria ratings, competencies rubric, and qualitative supervisor feedback</p>
    </div>
    <?php if ($role === 'agency'): ?>
        <a href="<?= base_url('agency/trainees') ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            <span>Rate a Trainee</span>
        </a>
    <?php endif; ?>
</div>

<!-- Evaluations Table Card with Crisp Borders -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">ID</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Student Trainee</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Host Agency</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Overall Rating</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Supervisor Remarks</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Date Evaluated</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                <?php if (empty($evaluations)): ?>
                    <tr>
                        <td colspan="7" class="py-8 px-4 text-center text-slate-400 text-xs">No student evaluations submitted yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($evaluations as $ev): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-400 border-r border-slate-200">
                                #EVAL-<?= $ev['evaluation_id'] ?>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-[#1B365D] border-r border-slate-200">
                                <div><?= esc($ev['first_name'] . ' ' . $ev['last_name']) ?></div>
                                <div class="text-[11px] text-slate-400 font-normal"><?= esc($ev['course'] ?? '') ?></div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 border-r border-slate-200">
                                <?= esc($ev['agency_name']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-[#E5A93C]/20 text-[#1B365D] border border-[#E5A93C]/30">
                                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <span><?= number_format($ev['rating'], 2) ?> / 5.0</span>
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 max-w-xs truncate border-r border-slate-200">
                                <?= esc($ev['feedback'] ?? 'None recorded') ?>
                            </td>
                            <td class="py-3.5 px-4 text-slate-400 border-r border-slate-200">
                                <?= date('M d, Y', strtotime($ev['evaluated_at'])) ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="<?= base_url('reports/evaluation/' . $ev['student_id']) ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-[#1B365D] hover:bg-slate-50 transition-colors shadow-2xs inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                    <span>Print Sheet</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
