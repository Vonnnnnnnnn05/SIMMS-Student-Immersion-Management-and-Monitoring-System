<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Faculty & Immersion Coordinators</h1>
        <p class="text-xs text-slate-500 mt-1">Supervise academic coordinators, assigned colleges, and immersion communication channels</p>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Coordinator Identity</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Department / College</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Contact Number</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Email Address</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($facultyList)): ?>
                    <tr>
                        <td colspan="5" class="py-8 px-4 text-center text-slate-400 text-xs">No faculty coordinators currently assigned.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($facultyList as $fac): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                        <?= esc(strtoupper(substr($fac['first_name'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-[#1B365D]"><?= esc($fac['first_name'] . ' ' . $fac['last_name']) ?></div>
                                        <div class="text-[10px] text-slate-400">ID #FAC-<?= str_pad($fac['faculty_id'], 4, '0', STR_PAD_LEFT) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 border border-slate-200 text-slate-700">
                                    <?= esc($fac['department'] ?? 'College of Computer Studies') ?>
                                </span>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600 font-mono text-xs">
                                <?= esc($fac['contact_no'] ?? 'N/A') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600">
                                <?= esc($fac['email']) ?>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <?php if ($fac['status'] === 'active'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Active</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Inactive</span>
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
