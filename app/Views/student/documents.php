<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Pre-Immersion Document Checklist</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 5: Upload mandatory legal clearances, medical consent, and institutional waivers</p>
    </div>
</div>

<!-- Checklist Card & Crisp Table -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Requirement</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Guidelines</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Type</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Submission Info</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                <?php foreach ($allDocs as $doc): ?>
                    <?php 
                        $sub = $submissions[$doc['document_id']] ?? null;
                        $status = $sub['status'] ?? 'missing';
                    ?>
                    <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                        <!-- Requirement -->
                        <td class="py-3.5 px-4 font-semibold text-[#1B365D] border-r border-slate-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 9.75m-2.25 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                <span><?= esc($doc['document_name']) ?></span>
                            </div>
                        </td>

                        <!-- Description -->
                        <td class="py-3.5 px-4 text-slate-500 max-w-xs border-r border-slate-200">
                            <?= esc($doc['description']) ?>
                        </td>

                        <!-- Mandatory -->
                        <td class="py-3.5 px-4 border-r border-slate-200">
                            <?php if ($doc['is_mandatory']): ?>
                                <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">Required</span>
                            <?php else: ?>
                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium rounded-full uppercase tracking-wider bg-slate-100 text-slate-600">Optional</span>
                            <?php endif; ?>
                        </td>

                        <!-- Status -->
                        <td class="py-3.5 px-4 border-r border-slate-200">
                            <?php if ($status === 'approved'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Verified</span>
                                </span>
                            <?php elseif ($status === 'pending'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    <span>In Review</span>
                                </span>
                            <?php elseif ($status === 'rejected'): ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Resubmit</span>
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-medium rounded-full uppercase tracking-wider bg-slate-100 text-slate-500 border border-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    <span>Not Submitted</span>
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Submission Info -->
                        <td class="py-3.5 px-4 text-slate-500 border-r border-slate-200">
                            <?php if ($sub): ?>
                                <div class="font-medium text-[#1B365D]"><?= date('M d, Y', strtotime($sub['uploaded_at'])) ?></div>
                                <?php if (!empty($sub['remarks'])): ?>
                                    <div class="text-[11px] text-slate-400 italic">"<?= esc($sub['remarks']) ?>"</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-slate-300">&mdash;</span>
                            <?php endif; ?>
                        </td>

                        <!-- Action -->
                        <td class="py-3.5 px-4 text-right">
                            <button type="button" onclick="openUploadModal('<?= $doc['document_id'] ?>', '<?= esc($doc['document_name'], 'js') ?>', '<?= esc($doc['description'], 'js') ?>')" class="px-3 py-1.5 rounded-lg text-xs font-bold <?= $sub ? 'bg-slate-100 text-slate-700 hover:bg-slate-200' : 'bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b]' ?> transition-colors cursor-pointer border-0 shadow-2xs">
                                <?= $sub ? 'Re-upload' : 'Upload' ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Upload Modal (Pure Tailwind) -->
<div id="uploadModal" class="hidden fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/5 max-w-md w-full p-6">
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
            <h3 class="text-sm font-bold text-[#1B365D]" id="modalDocTitle">Upload Requirement</h3>
            <button type="button" onclick="closeUploadModal()" class="text-slate-400 hover:text-slate-600 border-0 bg-transparent text-base cursor-pointer">&times;</button>
        </div>
        <form action="<?= base_url('student/documents/upload') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="document_id" id="modalDocId">
            
            <p class="text-xs text-slate-500" id="modalDocDesc"></p>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Select File (PDF, DOCX, JPG, PNG) *</label>
                <input type="file" name="document_file" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-[#1B365D] hover:file:bg-slate-200 border border-slate-200 rounded-xl p-2 bg-slate-50">
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeUploadModal()" class="px-4 py-2 rounded-xl text-xs font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors border-0 cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] transition-colors border-0 cursor-pointer shadow-2xs">
                    Submit File
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openUploadModal(docId, docName, docDesc) {
    document.getElementById('modalDocId').value = docId;
    document.getElementById('modalDocTitle').innerText = 'Upload ' + docName;
    document.getElementById('modalDocDesc').innerText = docDesc;
    document.getElementById('uploadModal').classList.remove('hidden');
}
function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
}
</script>
<?= $this->endSection() ?>
