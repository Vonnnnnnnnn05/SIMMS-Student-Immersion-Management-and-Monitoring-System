<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Advisee Immersion Trainees</h1>
        <p class="text-xs text-slate-500 mt-1">Track advisee academic profiles, active deployments, and cumulative rendered hours</p>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Student Identity</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Program / Level</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Host Training Agency</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Rendered Hours</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="6" class="py-8 px-4 text-center text-slate-400 text-xs">No trainees currently enrolled under your coordination.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $st): ?>
                        <?php 
                            $total = (float) ($st['total_hours'] ?? 0);
                            $req   = (float) ($st['required_hours'] ?? 80);
                            $pct   = ($req > 0) ? min(100, round(($total / $req) * 100)) : 0;
                        ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Student Identity -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                        <?= esc(strtoupper(substr($st['first_name'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-[#1B365D]"><?= esc($st['first_name'] . ' ' . $st['last_name']) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= esc($st['email']) ?></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Program / Level -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="font-medium text-slate-700"><?= esc($st['course'] ?? 'N/A') ?></div>
                                <div class="text-[11px] text-slate-400"><?= esc($st['year_level'] ?? '') ?></div>
                            </td>

                            <!-- Host Agency -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <?php if ($st['agency_name']): ?>
                                    <span class="inline-flex items-center gap-1.5 font-semibold text-[#1B365D]">
                                        <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        <span><?= esc($st['agency_name']) ?></span>
                                    </span>
                                <?php else: ?>
                                    <span class="text-slate-400 italic text-xs">Pending Placement</span>
                                <?php endif; ?>
                            </td>

                            <!-- Rendered Hours Progress -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="font-bold text-xs text-[#1B365D] mb-1.5"><?= number_format($total, 1) ?> / <?= number_format($req, 0) ?> hrs (<?= $pct ?>%)</div>
                                <div class="w-32 bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="<?= $pct >= 100 ? 'bg-emerald-500' : 'bg-[#E5A93C]' ?> h-2 rounded-full transition-all" style="width: <?= $pct ?>%"></div>
                                </div>
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($pct >= 100 || $st['progress_status'] === 'completed'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Completed</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>In Progress</span>
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Action Button -->
                            <td class="py-3.5 px-4 text-right">
                                <a href="<?= base_url('faculty/student/' . $st['student_id']) ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#1B365D] text-white hover:bg-[#152a48] transition-colors shadow-2xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/></svg>
                                    <span>Open Dossier</span>
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
