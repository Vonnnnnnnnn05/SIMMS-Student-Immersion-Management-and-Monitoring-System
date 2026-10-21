<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">System Settings & Evaluation Module</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 12 & Principle IV: Academic term configurations and ISO/IEC 25010 software quality metrics</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Card 1: Academic Term Configuration -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6">
        <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-slate-100">
            <div class="w-8 h-8 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-[#1B365D]">Academic Term Configuration</h3>
                <p class="text-[11px] text-slate-400">Current semester environment and connection parameters</p>
            </div>
        </div>

        <div class="space-y-4 text-xs">
            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Current Academic Year</label>
                <input type="text" value="2026-2027" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] font-semibold">
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Immersion Term / Semester</label>
                <select disabled class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] font-semibold">
                    <option selected>1st Semester (AY 2026-2027)</option>
                    <option>2nd Semester</option>
                    <option>Summer Practicum Term</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Database Engine</label>
                <input type="text" value="MySQLi &bull; moa_v2 (XAMPP Server)" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs font-mono text-[#1B365D]">
            </div>
        </div>
    </div>

    <!-- Card 2: Sprint 12 System Evaluation Module -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6">
        <div class="flex items-center gap-2.5 pb-4 mb-5 border-b border-slate-100">
            <div class="w-8 h-8 rounded-lg bg-[#E5A93C]/10 text-[#E5A93C] ring-1 ring-[#E5A93C]/20 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-[#1B365D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-[#1B365D]">Sprint 12: ISO/IEC 25010 Quality Evaluation</h3>
                <p class="text-[11px] text-slate-400">Software criteria benchmark and validation scorecards</p>
            </div>
        </div>

        <div class="space-y-4 text-xs">
            <!-- Criterion 1 -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="font-semibold text-slate-700">1. Functionality & Completeness</span>
                    <span class="font-bold text-[#1B365D]">4.92 / 5.0 (98.4%)</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#1B365D] h-2 rounded-full" style="width: 98.4%"></div>
                </div>
            </div>

            <!-- Criterion 2 -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="font-semibold text-slate-700">2. Accuracy (DTR & Report Precision)</span>
                    <span class="font-bold text-[#1B365D]">4.88 / 5.0 (97.6%)</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#E5A93C] h-2 rounded-full" style="width: 97.6%"></div>
                </div>
            </div>

            <!-- Criterion 3 -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="font-semibold text-slate-700">3. Reliability & Access Control</span>
                    <span class="font-bold text-[#1B365D]">4.95 / 5.0 (99.0%)</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#1B365D] h-2 rounded-full" style="width: 99.0%"></div>
                </div>
            </div>

            <!-- Criterion 4 -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <span class="font-semibold text-slate-700">4. Efficiency & Response Time</span>
                    <span class="font-bold text-[#1B365D]">4.85 / 5.0 (97.0%)</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#E5A93C] h-2 rounded-full" style="width: 97.0%"></div>
                </div>
            </div>

            <!-- Grand Mean Rating Banner -->
            <div class="mt-5 p-4 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Grand Mean Score</div>
                    <div class="text-2xl font-extrabold text-[#1B365D] leading-none mt-1">4.90 <span class="text-xs font-normal text-slate-500">/ 5.0</span></div>
                </div>
                <span class="px-3 py-1 text-[11px] font-bold rounded-full bg-[#E5A93C] text-[#1B365D] shadow-2xs">
                    Highly Acceptable
                </span>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
