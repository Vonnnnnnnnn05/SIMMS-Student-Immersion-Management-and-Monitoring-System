<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Immersion Subjects & Hours Quota</h1>
        <p class="text-xs text-slate-500 mt-1">Configure academic curriculum subjects, assigned coordinators, and completion requirements</p>
    </div>
    <div>
        <!-- Primary Action CTA (Scholastic Gold #E5A93C) -->
        <button type="button" onclick="openCreateSubjectModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer border-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <span>Add Immersion Subject</span>
        </button>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Subject ID</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Subject Code & Description</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Assigned Faculty Adviser</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-center">Required Hours</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($subjects)): ?>
                    <tr>
                        <td colspan="4" class="py-8 px-4 text-center text-slate-400 text-xs">No immersion subjects registered in the curriculum catalog.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($subjects as $sub): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200 font-mono text-slate-400 text-xs">
                                #SUB-<?= str_pad($sub['subject_id'], 3, '0', STR_PAD_LEFT) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 font-semibold text-[#1B365D]">
                                <?= esc($sub['subject_name']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <?php if ($sub['first_name']): ?>
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-100 text-slate-700 font-semibold text-[10px] flex items-center justify-center shrink-0">
                                            <?= esc(strtoupper(substr($sub['first_name'], 0, 1))) ?>
                                        </div>
                                        <span class="font-medium text-slate-700"><?= esc($sub['first_name'] . ' ' . $sub['last_name']) ?></span>
                                    </div>
                                <?php else: ?>
                                    <span class="text-slate-400 italic text-xs">Unassigned</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-[#E5A93C]/20 border border-[#E5A93C]/40 text-[#1B365D]">
                                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?= esc($sub['required_hours']) ?> Hours</span>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create Subject Modal (Pure Figma Style, Zero Bootstrap) -->
<div id="modal-create-subject" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
        <form action="<?= base_url('admin/subjects/save') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Add Immersion Subject</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Define subject code, quota, and assigned faculty</p>
                </div>
                <button type="button" onclick="closeCreateSubjectModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer border-0 bg-transparent">&times;</button>
            </div>

            <div class="p-6 text-xs text-[#1B365D] space-y-4">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Subject Code & Description *</label>
                    <input type="text" name="subject_name" required placeholder="e.g. IT 412 - Practicum / Industry Immersion" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Assigned Faculty Adviser</label>
                    <select name="faculty_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        <option value="">Select faculty adviser (Optional)</option>
                        <?php foreach ($allFaculty as $fac): ?>
                            <option value="<?= $fac['faculty_id'] ?>"><?= esc($fac['first_name'] . ' ' . $fac['last_name']) ?> (<?= esc($fac['department'] ?? 'CCS') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Required Immersion Hours Quota *</label>
                    <input type="number" name="required_hours" value="80" min="40" max="600" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    <span class="block text-[10px] text-slate-400 mt-1">Standard requirement quota (Default: 80 hours).</span>
                </div>
            </div>

            <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateSubjectModal()" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Save Subject</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openCreateSubjectModal() {
    document.getElementById('modal-create-subject').classList.remove('hidden');
}
function closeCreateSubjectModal() {
    document.getElementById('modal-create-subject').classList.add('hidden');
}
</script>
<?= $this->endSection() ?>
