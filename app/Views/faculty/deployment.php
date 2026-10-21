<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Student Placement & Deployment Desk</h1>
        <p class="text-xs text-slate-500 mt-1">Sprints 6 & 7: Issue formal application letters, schedule deployment dates, and activate trainees</p>
    </div>
    <div>
        <button type="button" onclick="openAssignDeploymentModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer border-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            <span>Assign New Deployment</span>
        </button>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Deployment ID</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Student Name</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Program / Strand</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Partner Host Agency</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Supervisor Contact</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Deployment Schedule</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Letter</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($deployments)): ?>
                    <tr>
                        <td colspan="8" class="py-8 px-4 text-center text-slate-400 text-xs">No students currently scheduled or active in deployment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($deployments as $dep): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200 font-mono text-slate-400 text-xs">
                                #DEP-<?= str_pad($dep['deployment_id'], 4, '0', STR_PAD_LEFT) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 font-semibold text-[#1B365D]">
                                <?= esc($dep['first_name'] . ' ' . $dep['last_name']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600">
                                <?= esc($dep['course'] ?? 'N/A') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 font-bold text-[#1B365D]">
                                <?= esc($dep['agency_name']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600">
                                <?= esc($dep['contact_person'] ?? 'TBD') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-500 text-[11px]">
                                <?= date('M d, Y', strtotime($dep['start_date'])) ?> &mdash; <?= $dep['end_date'] ? date('M d, Y', strtotime($dep['end_date'])) : 'Open' ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($dep['status'] === 'active'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Active</span>
                                    </span>
                                <?php elseif ($dep['status'] === 'completed'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        <span>Completed</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span><?= esc(ucfirst($dep['status'])) ?></span>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <a href="<?= base_url('application-letter/generate/' . $dep['student_id']) ?>" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#1B365D] text-white hover:bg-[#152a48] transition-colors shadow-2xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span>Letter</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Assign Deployment Modal (Pure Figma Style, Zero Bootstrap) -->
<div id="modal-assign-deployment" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
        <form action="<?= base_url('deployment/assign') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Schedule Student Deployment</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Activate student traineeship schedule</p>
                </div>
                <button type="button" onclick="closeAssignDeploymentModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer border-0 bg-transparent">&times;</button>
            </div>

            <div class="p-6 text-xs text-[#1B365D] space-y-4">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Select Approved Trainee *</label>
                    <select name="student_id" id="studentSelect" onchange="autoSelectAgency(this)" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        <option value="" selected disabled>Select student trainee</option>
                        <?php foreach ($approvedStudents as $ap): ?>
                            <option value="<?= $ap['student_id'] ?>" data-agency="<?= $ap['agency_id'] ?>">
                                <?= esc($ap['first_name'] . ' ' . $ap['last_name']) ?> &bull; (<?= esc($ap['agency_name']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="hidden" name="agency_id" id="agencyIdHidden" value="<?= $approvedStudents[0]['agency_id'] ?? '' ?>">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Start Date *</label>
                        <input type="date" name="start_date" required value="<?= date('Y-m-d') ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Target End Date</label>
                        <input type="date" name="end_date" value="<?= date('Y-m-d', strtotime('+2 months')) ?>" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                </div>
            </div>

            <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeAssignDeploymentModal()" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Activate Deployment</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openAssignDeploymentModal() {
    document.getElementById('modal-assign-deployment').classList.remove('hidden');
}
function closeAssignDeploymentModal() {
    document.getElementById('modal-assign-deployment').classList.add('hidden');
}
function autoSelectAgency(selectElem) {
    const selectedOption = selectElem.options[selectElem.selectedIndex];
    const agencyId = selectedOption.getAttribute('data-agency');
    if (agencyId) {
        document.getElementById('agencyIdHidden').value = agencyId;
    }
}
</script>
<?= $this->endSection() ?>
