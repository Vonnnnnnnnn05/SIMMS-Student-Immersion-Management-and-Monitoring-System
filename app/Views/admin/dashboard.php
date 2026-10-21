<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section (Figma Style: Quiet, clean hierarchy, no heavy borders) -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Executive Dashboard</h1>
        <p class="text-xs text-slate-500 mt-1">Live immersion metrics, trainee progression, and host establishment governance</p>
    </div>
    <div class="flex items-center gap-2.5">
        <!-- Primary Action CTA (Scholastic Gold #E5A93C) -->
        <a href="<?= base_url('admin/users') ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
            <span>Provision User</span>
        </a>
    </div>
</div>

<!-- 4 Metric Cards (Figma Style: Soft elevation, rounded-2xl, no heavy borders, strictly monochromatic) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Card 1: Trainee Students -->
    <div class="bg-white rounded-2xl p-5 shadow-xs ring-1 ring-slate-900/[0.04] hover:shadow-sm transition-all duration-200 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase block">Trainee Students</span>
            <span class="text-2xl font-extrabold text-[#1B365D] tracking-tight mt-1 block"><?= $total_students ?></span>
            <span class="text-[11px] text-slate-400 font-normal mt-0.5 block">Enrolled candidates</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/>
            </svg>
        </div>
    </div>

    <!-- Card 2: Faculty Advisers -->
    <div class="bg-white rounded-2xl p-5 shadow-xs ring-1 ring-slate-900/[0.04] hover:shadow-sm transition-all duration-200 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase block">Faculty Advisers</span>
            <span class="text-2xl font-extrabold text-[#1B365D] tracking-tight mt-1 block"><?= $total_faculty ?></span>
            <span class="text-[11px] text-slate-400 font-normal mt-0.5 block">Department coordinators</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
        </div>
    </div>

    <!-- Card 3: Partner Agencies -->
    <div class="bg-white rounded-2xl p-5 shadow-xs ring-1 ring-slate-900/[0.04] hover:shadow-sm transition-all duration-200 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase block">Partner Agencies</span>
            <span class="text-2xl font-extrabold text-[#1B365D] tracking-tight mt-1 block"><?= $total_agencies ?></span>
            <span class="text-[11px] text-slate-400 font-normal mt-0.5 block">Accredited hosts</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
    </div>

    <!-- Card 4: Active Deployments -->
    <div class="bg-white rounded-2xl p-5 shadow-xs ring-1 ring-slate-900/[0.04] hover:shadow-sm transition-all duration-200 flex items-center justify-between">
        <div>
            <span class="text-[11px] font-semibold text-slate-400 tracking-wider uppercase block">Active Deployments</span>
            <span class="text-2xl font-extrabold text-[#1B365D] tracking-tight mt-1 block"><?= $active_deployments ?></span>
            <span class="text-[11px] text-slate-400 font-normal mt-0.5 block">Trainees currently deployed</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-50 ring-1 ring-slate-900/5 text-[#1B365D] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
            </svg>
        </div>
    </div>
</div>

<!-- Main Workspace Grid (Figma Style: Clean cards, soft borders) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column (Span 2): Recently Created User Accounts -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] overflow-hidden">
            <div class="px-5 py-4 flex items-center justify-between border-b border-slate-100">
                <div>
                    <h2 class="text-xs font-bold text-[#1B365D] uppercase tracking-wider">Recently Registered Users</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Authentication & role assignment log</p>
                </div>
                <a href="<?= base_url('admin/users') ?>" class="text-xs font-semibold text-slate-500 hover:text-[#1B365D] flex items-center gap-1 transition-colors">
                    <span>Manage all</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto border border-slate-200 rounded-xl">
                <table class="w-full text-left border-collapse" style="margin-bottom:0;">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">User</th>
                            <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">System Role</th>
                            <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Status</th>
                            <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Created</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        <?php if (empty($recent_users)): ?>
                            <tr>
                                <td colspan="4" class="py-8 px-4 text-center text-slate-400 text-xs">No user records currently present.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recent_users as $user): ?>
                                <tr class="hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0">
                                    <td class="py-3 px-4 border-r border-slate-200">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-full bg-slate-100 text-[#1B365D] font-bold text-xs flex items-center justify-center shrink-0">
                                                <?= esc(strtoupper(substr($user['first_name'], 0, 1))) ?>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-[#1B365D]"><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></div>
                                                <div class="text-[11px] text-slate-400 font-normal"><?= esc($user['email']) ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 border-r border-slate-200">
                                        <?php
                                            $roleClasses = [
                                                'admin'   => 'bg-purple-50 text-purple-700 border-purple-200',
                                                'faculty' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                'student' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'agency'  => 'bg-amber-50 text-amber-700 border-amber-200',
                                            ];
                                            $roleStyle = $roleClasses[$user['role']] ?? 'bg-slate-100 text-slate-700 border-slate-200';
                                        ?>
                                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider border <?= $roleStyle ?>">
                                            <?= esc($user['role']) ?>
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-r border-slate-200">
                                        <?php if ($user['status'] === 'active'): ?>
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
                                    <td class="py-3 px-4 text-slate-400 text-[11px] text-right">
                                        <?= date('M d, Y', strtotime($user['created_at'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column (Span 1): Administrative Utilities (Non-navigation triggers) -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
            <div class="mb-3">
                <h2 class="text-xs font-bold text-[#1B365D] uppercase tracking-wider">Administrative Utilities</h2>
                <p class="text-[11px] text-slate-400 mt-0.5">Quick triggers & operational tools</p>
            </div>

            <div class="space-y-1.5">
                <!-- Utility 1: Export Summary -->
                <button type="button" onclick="window.print()" class="w-full text-left p-3 rounded-xl hover:bg-slate-50 transition-colors flex items-center justify-between group cursor-pointer border-0 bg-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-xs text-[#1B365D]">Export Summary</div>
                            <div class="text-[10px] text-slate-400">Print or save executive briefing</div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>

                <!-- Utility 2: Bulk Import -->
                <button type="button" onclick="document.getElementById('modal-bulk-import').classList.remove('hidden')" class="w-full text-left p-3 rounded-xl hover:bg-slate-50 transition-colors flex items-center justify-between group cursor-pointer border-0 bg-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-xs text-[#1B365D]">Bulk Import Roster</div>
                            <div class="text-[10px] text-slate-400">Batch import students or agencies</div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>

                <!-- Utility 3: System Integrity -->
                <button type="button" onclick="document.getElementById('modal-integrity').classList.remove('hidden')" class="w-full text-left p-3 rounded-xl hover:bg-slate-50 transition-colors flex items-center justify-between group cursor-pointer border-0 bg-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-xs text-[#1B365D]">System Integrity Check</div>
                            <div class="text-[10px] text-slate-400">Validate 16 database tables</div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>

                <!-- Utility 4: Broadcast Alert -->
                <button type="button" onclick="document.getElementById('modal-broadcast').classList.remove('hidden')" class="w-full text-left p-3 rounded-xl hover:bg-slate-50 transition-colors flex items-center justify-between group cursor-pointer border-0 bg-transparent">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/></svg>
                        </div>
                        <div>
                            <div class="font-semibold text-xs text-[#1B365D]">Broadcast Announcement</div>
                            <div class="text-[10px] text-slate-400">Dispatch cohort notification</div>
                        </div>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-300 group-hover:text-slate-500 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Figma Modals (Clean, rounded-2xl, soft backdrop blur, pure Tailwind) -->

<!-- Modal 1: Bulk Import -->
<div id="modal-bulk-import" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#1B365D] uppercase tracking-wider">Bulk Import Records</h3>
            <button type="button" onclick="document.getElementById('modal-bulk-import').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-base cursor-pointer border-0 bg-transparent">&times;</button>
        </div>
        <div class="p-5 text-xs text-slate-600 space-y-3">
            <p>Upload a structured CSV spreadsheet containing student rosters or accredited agency profiles for batch validation.</p>
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:bg-slate-50/50 cursor-pointer transition-colors">
                <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"/></svg>
                <div class="font-semibold text-[#1B365D]">Select CSV file to upload</div>
                <div class="text-[10px] text-slate-400 mt-1">UTF-8 encoded &bull; Maximum file size: 5MB</div>
            </div>
        </div>
        <div class="px-5 py-3 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2">
            <button type="button" onclick="document.getElementById('modal-bulk-import').classList.add('hidden')" class="px-3.5 py-1.5 rounded-lg text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
            <button type="button" onclick="alert('File queued for batch parsing.'); document.getElementById('modal-bulk-import').classList.add('hidden')" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Process File</button>
        </div>
    </div>
</div>

<!-- Modal 2: System Integrity -->
<div id="modal-integrity" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#1B365D] uppercase tracking-wider">System Integrity Diagnostic</h3>
            <button type="button" onclick="document.getElementById('modal-integrity').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-base cursor-pointer border-0 bg-transparent">&times;</button>
        </div>
        <div class="p-5 text-xs text-slate-600 space-y-3">
            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                <span class="text-slate-500">Database Schema:</span>
                <span class="font-bold text-[#1B365D]">16 Active Tables</span>
            </div>
            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                <span class="text-slate-500">Authentication Filter:</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#E5A93C] text-[#1B365D]">Active & Enforced</span>
            </div>
            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                <span class="text-slate-500">Framework Engine:</span>
                <span class="font-semibold text-slate-700">CodeIgniter 4.6.1 (PHP 8.2)</span>
            </div>
            <div class="flex items-center justify-between py-1.5">
                <span class="text-slate-500">Database Engine:</span>
                <span class="font-semibold text-slate-700">MySQL &bull; `moa_v2`</span>
            </div>
        </div>
        <div class="px-5 py-3 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end">
            <button type="button" onclick="document.getElementById('modal-integrity').classList.add('hidden')" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#1B365D] text-white hover:bg-[#152a48] border-0 cursor-pointer shadow-xs">Dismiss</button>
        </div>
    </div>
</div>

<!-- Modal 3: Broadcast Announcement -->
<div id="modal-broadcast" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-md w-full overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#1B365D] uppercase tracking-wider">Broadcast Immersion Alert</h3>
            <button type="button" onclick="document.getElementById('modal-broadcast').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 text-base cursor-pointer border-0 bg-transparent">&times;</button>
        </div>
        <div class="p-5 text-xs text-slate-600 space-y-3">
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Target Cohort</label>
                <select class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    <option value="all">All Participants (Students, Advisers, Supervisors)</option>
                    <option value="students">Active Trainee Students</option>
                    <option value="faculty">Faculty Immersion Coordinators</option>
                    <option value="agencies">Host Establishment Supervisors</option>
                </select>
            </div>
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Message Content</label>
                <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-3 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" placeholder="Enter announcement or schedule notice..."></textarea>
            </div>
        </div>
        <div class="px-5 py-3 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2">
            <button type="button" onclick="document.getElementById('modal-broadcast').classList.add('hidden')" class="px-3.5 py-1.5 rounded-lg text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
            <button type="button" onclick="alert('Notice broadcasted to selected cohort.'); document.getElementById('modal-broadcast').classList.add('hidden')" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Dispatch Alert</button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
