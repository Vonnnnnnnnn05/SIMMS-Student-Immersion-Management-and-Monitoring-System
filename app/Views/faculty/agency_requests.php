<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Student Agency Endorsement Requests</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 4: Review and validate student traineeship placements with vetted host establishments</p>
    </div>
</div>

<!-- Table Card (Crisp Borders, Figma Elevation) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Student Name</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Program / Strand</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Selected Partner Agency</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Date Requested</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200 text-center">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Remarks</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-xs text-[#1B365D]">
                <?php if (empty($requests)): ?>
                    <tr>
                        <td colspan="7" class="py-8 px-4 text-center text-slate-400 text-xs">No pending student agency placement applications.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($requests as $req): ?>
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 border-r border-slate-200 font-semibold text-[#1B365D]">
                                <?= esc($req['first_name'] . ' ' . $req['last_name']) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-600">
                                <?= esc($req['course'] ?? 'N/A') ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="font-bold text-[#1B365D]"><?= esc($req['agency_name']) ?></div>
                                <div class="text-[10px] text-slate-400 mt-0.5"><?= esc($req['agency_address'] ?? 'Official Host Partner') ?></div>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-400 text-[11px]">
                                <?= date('M d, Y', strtotime($req['date_selected'])) ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-center">
                                <?php if ($req['status'] === 'approved'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Approved</span>
                                    </span>
                                <?php elseif ($req['status'] === 'rejected'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        <span>Rejected</span>
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <span>Pending Review</span>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4 border-r border-slate-200 text-slate-500 italic text-[11px]">
                                <?= esc($req['remarks'] ?? 'None recorded') ?>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <?php if ($req['status'] === 'pending'): ?>
                                    <div class="flex items-center justify-end gap-1.5">
                                        <form action="<?= base_url('faculty/agency-requests/' . $req['id'] . '/action') ?>" method="POST" class="inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="action" value="approved">
                                            <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white cursor-pointer border-0 shadow-2xs transition-colors">
                                                Approve
                                            </button>
                                        </form>
                                        <button type="button" onclick="document.getElementById('reject-modal-<?= $req['id'] ?>').classList.remove('hidden')" class="px-3 py-1 rounded-lg text-xs font-semibold bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 cursor-pointer transition-colors">
                                            Reject
                                        </button>
                                    </div>

                                    <!-- Reject Dialog (Pure Tailwind) -->
                                    <div id="reject-modal-<?= $req['id'] ?>" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4 text-left">
                                        <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
                                            <form action="<?= base_url('faculty/agency-requests/' . $req['id'] . '/action') ?>" method="POST">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="action" value="rejected">
                                                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                                    <h3 class="text-sm font-bold text-rose-600">Decline Agency Placement</h3>
                                                    <button type="button" onclick="document.getElementById('reject-modal-<?= $req['id'] ?>').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-base cursor-pointer border-0 bg-transparent">&times;</button>
                                                </div>
                                                <div class="p-6 text-xs text-slate-600 space-y-3">
                                                    <p>Please enter the justification for declining <?= esc($req['first_name']) ?>'s placement at <strong><?= esc($req['agency_name']) ?></strong>.</p>
                                                    <div>
                                                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Rejection Remarks *</label>
                                                        <textarea name="remarks" required rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-rose-500" placeholder="e.g. Agency capacity filled / mismatch with trainee curriculum strand."></textarea>
                                                    </div>
                                                </div>
                                                <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                                                    <button type="button" onclick="document.getElementById('reject-modal-<?= $req['id'] ?>').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                                                    <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-rose-600 text-white hover:bg-rose-700 border-0 cursor-pointer shadow-xs">Confirm Rejection</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded bg-slate-50">Completed</span>
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
