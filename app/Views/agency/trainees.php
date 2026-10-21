<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Assigned Student Trainees</h1>
        <p class="text-xs text-slate-500 mt-1">Supervise deployed interns at your establishment, verify their rendered hours, and evaluate performance</p>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Trainee Identity</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Program / Strand</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Contact Number</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Rendered Hours</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Evaluation Rating</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($trainees)): ?>
                    <tr>
                        <td colspan="7" class="py-8 px-4 text-center text-slate-400 text-xs">No trainees currently placed with your host establishment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($trainees as $tr): ?>
                        <?php 
                            $total = (float) ($tr['total_hours'] ?? 0);
                            $req   = (float) ($tr['required_hours'] ?? 80);
                            $pct   = ($req > 0) ? min(100, round(($total / $req) * 100)) : 0;
                        ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                        <?= esc(strtoupper(substr($tr['first_name'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-[#1B365D]"><?= esc($tr['first_name'] . ' ' . $tr['last_name']) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= esc($tr['email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600">
                                <?= esc($tr['course'] ?? 'N/A') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600 font-mono text-xs">
                                <?= esc($tr['contact_no'] ?? 'N/A') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="font-bold text-xs text-[#1B365D] mb-1.5"><?= number_format($total, 1) ?> / <?= number_format($req, 0) ?> hrs (<?= $pct ?>%)</div>
                                <div class="w-32 bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="<?= $pct >= 100 ? 'bg-emerald-500' : 'bg-[#E5A93C]' ?> h-2 rounded-full transition-all" style="width: <?= $pct ?>%"></div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($tr['progress_status'] === 'completed' || $pct >= 100): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        <span>Completed</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Active Trainee</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($tr['rating']): ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#E5A93C]/20 border border-[#E5A93C]/40 text-[#1B365D]">
                                        <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span><?= number_format($tr['rating'], 2) ?> / 5.0</span>
                                    </span>
                                <?php else: ?>
                                    <span class="text-slate-400 italic text-[11px]">Pending Rating</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="<?= base_url('evaluations/rate/' . $tr['student_id']) ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] transition-colors shadow-2xs">
                                    <span><?= $tr['rating'] ? 'Update Score' : 'Evaluate Trainee' ?></span>
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
