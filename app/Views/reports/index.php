<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Institutional Report Engine</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 11 & Principle III: Generate standardized, print-ready documents with CHED/DepEd format</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Card 1: Masterlist & Partnership Reports -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Cohort & Institutional Reports</h3>
                    <p class="text-[11px] text-slate-400">Masterlists, legal MOA summaries, and compliance matrices</p>
                </div>
            </div>

            <div class="space-y-3">
                <!-- Report Item 1 -->
                <div class="p-3.5 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-bold text-xs text-[#1B365D]">Document Submission Status Matrix</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Track legal, medical, and parental compliance across all trainees</div>
                    </div>
                    <a href="<?= base_url('reports/document-status') ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shrink-0 shadow-2xs transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print View</span>
                    </a>
                </div>

                <!-- Report Item 2 -->
                <div class="p-3.5 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-bold text-xs text-[#1B365D]">Immersion Deployment Masterlist</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Roster of assigned host companies, supervisors, and start dates</div>
                    </div>
                    <a href="<?= base_url('reports/deployment') ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shrink-0 shadow-2xs transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print View</span>
                    </a>
                </div>

                <!-- Report Item 3 -->
                <div class="p-3.5 rounded-xl border border-slate-200/80 bg-slate-50/50 flex items-center justify-between gap-4">
                    <div>
                        <div class="font-bold text-xs text-[#1B365D]">Memorandum of Agreement (MOA) Summary</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Vetted partner training agencies, validity periods, and capacity quotas</div>
                    </div>
                    <a href="<?= base_url('reports/moa') ?>" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shrink-0 shadow-2xs transition-colors flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Print View</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Individual Student Immersion Reports -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Individual Trainee Reports</h3>
                    <p class="text-[11px] text-slate-400">Targeted dossiers, application letters, and certification portfolios</p>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Select Student Trainee</label>
                <select id="selectedStudent" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] font-medium focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    <?php foreach ($students as $st): ?>
                        <option value="<?= $st['student_id'] ?>">
                            <?= esc($st['first_name'] . ' ' . $st['last_name']) ?> &bull; <?= esc($st['course'] ?? 'Trainee') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="space-y-2">
                <button type="button" onclick="openStudentReport('reports/personal-info/')" class="w-full text-left p-3 rounded-xl border border-slate-200/80 hover:bg-slate-50 flex items-center justify-between text-xs text-[#1B365D] font-medium transition-colors cursor-pointer bg-white">
                    <span>1. Personal Information Sheet</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </button>
                <button type="button" onclick="openStudentReport('reports/application-letter/')" class="w-full text-left p-3 rounded-xl border border-slate-200/80 hover:bg-slate-50 flex items-center justify-between text-xs text-[#1B365D] font-medium transition-colors cursor-pointer bg-white">
                    <span>2. Formal Application & Endorsement Letter</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </button>
                <button type="button" onclick="openStudentReport('reports/completion-dtr/')" class="w-full text-left p-3 rounded-xl border border-slate-200/80 hover:bg-slate-50 flex items-center justify-between text-xs text-[#1B365D] font-medium transition-colors cursor-pointer bg-white">
                    <span>3. Daily Time Record (DTR) & Completion Certificate</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </button>
                <button type="button" onclick="openStudentReport('reports/evaluation/')" class="w-full text-left p-3 rounded-xl border border-slate-200/80 hover:bg-slate-50 flex items-center justify-between text-xs text-[#1B365D] font-medium transition-colors cursor-pointer bg-white">
                    <span>4. Performance Evaluation Rating Report</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </button>
                <button type="button" onclick="openStudentReport('reports/portfolio/')" class="w-full text-left p-3 rounded-xl bg-[#1B365D] text-white hover:bg-[#152a48] flex items-center justify-between text-xs font-bold transition-colors cursor-pointer">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#E5A93C]"></span>
                        <span>5. Complete Student Immersion Portfolio (All-In-One)</span>
                    </span>
                    <svg class="w-3.5 h-3.5 text-[#E5A93C]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openStudentReport(routePrefix) {
    const studentId = document.getElementById('selectedStudent').value;
    if (studentId) {
        window.open('<?= base_url() ?>' + routePrefix + studentId, '_blank');
    }
}
</script>
<?= $this->endSection() ?>
