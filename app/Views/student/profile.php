<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">Trainee Academic Profile</h1>
        <p class="text-xs text-slate-500 mt-1">Sprint 3: Manage your student enrollment, degree specialization, and emergency contact</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Card: Identity Card -->
    <div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6 text-center flex flex-col items-center">
        <div class="w-20 h-20 rounded-full bg-[#1B365D] text-[#E5A93C] font-bold text-2xl flex items-center justify-center mb-4 shadow-xs">
            <?= esc(strtoupper(substr($student['first_name'] ?? 'S', 0, 1))) ?>
        </div>
        <h2 class="text-base font-bold text-[#1B365D]"><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></h2>
        <p class="text-xs text-slate-400 mt-0.5"><?= esc($student['email']) ?></p>
        
        <div class="mt-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold rounded-full uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Active Trainee</span>
            </span>
        </div>

        <div class="w-full border-t border-slate-100 my-5"></div>

        <div class="w-full text-left space-y-3 text-xs">
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Degree Program</span>
                <span class="font-semibold text-[#1B365D]"><?= esc($student['course'] ?? 'Not specified') ?></span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Year Level</span>
                <span class="font-semibold text-[#1B365D]"><?= esc($student['year_level'] ?? 'Not specified') ?></span>
            </div>
            <div>
                <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">SIMMS Trainee Code</span>
                <span class="font-mono text-[11px] text-[#1B365D] font-bold">#SIMMS-<?= str_pad($student['student_id'], 4, '0', STR_PAD_LEFT) ?></span>
            </div>
        </div>
    </div>

    <!-- Right Card: Profile Update Form -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6">
        <div class="pb-4 mb-5 border-b border-slate-100">
            <h2 class="text-sm font-bold text-[#1B365D]">Edit Trainee Record</h2>
            <p class="text-[11px] text-slate-400">Keep your academic records and emergency details up to date</p>
        </div>

        <form action="<?= base_url('student/profile/update') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Course / Degree Program *</label>
                    <input type="text" name="course" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($student['course'] ?? '') ?>" required>
                </div>
                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Year / Grade Level *</label>
                    <input type="text" name="year_level" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($student['year_level'] ?? '') ?>" required>
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Mobile Contact Number *</label>
                <input type="tel" name="contact_no" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($student['contact_no'] ?? '') ?>" required>
            </div>

            <div>
                <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Permanent Home Address</label>
                <textarea name="address" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]"><?= esc($student['address'] ?? '') ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <div class="text-xs font-bold text-[#1B365D] mb-3">Emergency Guardian Information</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Parent / Guardian Name</label>
                        <input type="text" name="guardian_name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($student['guardian_name'] ?? '') ?>" placeholder="Full name of guardian">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Guardian Contact Number</label>
                        <input type="tel" name="guardian_contact" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" value="<?= esc($student['guardian_contact'] ?? '') ?>" placeholder="09XXXXXXXXX">
                    </div>
                </div>
            </div>

            <div class="pt-4 text-right">
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors cursor-pointer border-0">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
