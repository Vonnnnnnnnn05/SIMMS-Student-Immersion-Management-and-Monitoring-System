<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Faculty Coordinator Desk</h1>
        <p class="text-xs text-slate-500 mt-1">Monitor advisee progress, approve agency applications, and manage document compliance</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?= base_url('deployment') ?>" class="px-3.5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors flex items-center gap-1.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
            <span>Deployment Desk</span>
        </a>
    </div>
</div>

<!-- 4 Monochromatic Metric Cards (Figma 70-20-10) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Metric 1: Assigned Students -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Assigned Advisees</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $total_students ?></div>
        <div class="text-[11px] text-slate-400 mt-1">Active student trainees</div>
    </div>

    <!-- Metric 2: Pending Agency Requests -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Agency Requests</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $pending_requests ?></div>
        <div class="text-[11px] text-slate-400 mt-1">Pending review & sign-off</div>
    </div>

    <!-- Metric 3: Pending Requirements -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Requirements</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $pending_documents ?></div>
        <div class="text-[11px] text-slate-400 mt-1">Submissions to verify</div>
    </div>

    <!-- Metric 4: Active Immersion -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div class="flex items-center justify-between mb-3">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Active Deployed</span>
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-[#1B365D]"><?= $active_deployments ?></div>
        <div class="text-[11px] text-slate-400 mt-1">Rendered on-site immersion</div>
    </div>
</div>

<!-- Main Section: Queue Table + Coordinator Links -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left 2 Cols: Pending Agency Requests Table with Crisp Borders -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
            <div>
                <h2 class="text-sm font-bold text-[#1B365D]">Pending Placement Requests</h2>
                <p class="text-[11px] text-slate-400">Sprint 4: Partner agency selection queue awaiting approval</p>
            </div>
            <a href="<?= base_url('faculty/agency-requests') ?>" class="text-xs font-bold text-[#1B365D] hover:underline">View All &rarr;</a>
        </div>

        <div class="overflow-x-auto border border-slate-200 rounded-xl">
            <table class="w-full text-left border-collapse" style="margin-bottom:0;">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Trainee</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Requested Host Agency</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Date</th>
                        <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    <?php if (empty($pendingAgencyQueue)): ?>
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-slate-400 text-xs">No pending student placement applications.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendingAgencyQueue as $req): ?>
                            <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                                <td class="py-3.5 px-4 font-semibold text-[#1B365D] border-r border-slate-200">
                                    <?= esc($req['first_name'] . ' ' . $req['last_name']) ?>
                                </td>
                                <td class="py-3.5 px-4 text-slate-700 border-r border-slate-200">
                                    <?= esc($req['agency_name']) ?>
                                </td>
                                <td class="py-3.5 px-4 text-slate-400 border-r border-slate-200">
                                    <?= date('M d, Y', strtotime($req['date_selected'])) ?>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="<?= base_url('faculty/agency-requests') ?>" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] transition-colors shadow-2xs">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right 1 Col: Coordinator Shortcuts -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5 flex flex-col justify-between">
        <div>
            <div class="pb-3 mb-4 border-b border-slate-100">
                <h2 class="text-sm font-bold text-[#1B365D]">Coordinator Quick Links</h2>
                <p class="text-[11px] text-slate-400">Immersion lifecycle management desks</p>
            </div>

            <div class="space-y-2">
                <a href="<?= base_url('faculty/students') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                        <span>Advisee Trainee List</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>

                <a href="<?= base_url('faculty/documents') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        <span>Verify Student Documents</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>

                <a href="<?= base_url('deployment') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                        <span>Deployment Schedule</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>

                <a href="<?= base_url('reports') ?>" class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors text-xs text-[#1B365D] font-semibold">
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Printable Reports Engine</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
