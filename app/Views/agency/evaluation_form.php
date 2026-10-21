<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <div class="flex items-center gap-2">
            <a href="<?= base_url('agency/trainees') ?>" class="text-xs text-slate-400 hover:text-[#1B365D]">&larr; Back to Trainees</a>
        </div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight mt-1">Trainee Performance Appraisal</h1>
        <p class="text-xs text-slate-500 mt-0.5">Sprint 10: Standardized performance rubric for <strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong></p>
    </div>
</div>

<?php 
    $comp = [];
    if (!empty($existing['competencies'])) {
        $comp = json_decode($existing['competencies'], true) ?: [];
    }
?>

<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-6 max-w-4xl">
    <div class="pb-4 mb-5 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-[#1B365D]">Immersion Competency Rubric</h2>
            <p class="text-[11px] text-slate-400">Scale: 5.0 (Outstanding) to 1.0 (Needs Improvement)</p>
        </div>
        <div class="text-[11px] text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl hidden sm:block">
            5.0 Outstanding &bull; 4.0 Very Satisfactory &bull; 3.0 Satisfactory
        </div>
    </div>

    <form action="<?= base_url('evaluations/store') ?>" method="POST" class="space-y-5">
        <?= csrf_field() ?>
        <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
        <input type="hidden" name="agency_id" value="<?= $agencyId ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- 1. Quality of Work -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                <label class="block text-xs font-bold text-[#1B365D] mb-1">1. Quality of Work & Technical Skills *</label>
                <p class="text-[11px] text-slate-400 mb-2.5">Accuracy, thoroughness, problem solving, and adherence to company standards.</p>
                <select name="quality_of_work" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required>
                    <option value="5.0" <?= ($comp['quality_of_work'] ?? '') == 5.0 ? 'selected' : '' ?>>5.0 - Outstanding</option>
                    <option value="4.0" <?= ($comp['quality_of_work'] ?? '') == 4.0 ? 'selected' : '' ?>>4.0 - Very Satisfactory</option>
                    <option value="3.0" <?= ($comp['quality_of_work'] ?? '') == 3.0 ? 'selected' : '' ?>>3.0 - Satisfactory</option>
                    <option value="2.0" <?= ($comp['quality_of_work'] ?? '') == 2.0 ? 'selected' : '' ?>>2.0 - Fair</option>
                    <option value="1.0" <?= ($comp['quality_of_work'] ?? '') == 1.0 ? 'selected' : '' ?>>1.0 - Needs Improvement</option>
                </select>
            </div>

            <!-- 2. Communication -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                <label class="block text-xs font-bold text-[#1B365D] mb-1">2. Communication & Interpersonal Skills *</label>
                <p class="text-[11px] text-slate-400 mb-2.5">Clarity in verbal and written reports; respectful and professional interaction.</p>
                <select name="communication" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required>
                    <option value="5.0" <?= ($comp['communication'] ?? '') == 5.0 ? 'selected' : '' ?>>5.0 - Outstanding</option>
                    <option value="4.0" <?= ($comp['communication'] ?? '') == 4.0 ? 'selected' : '' ?>>4.0 - Very Satisfactory</option>
                    <option value="3.0" <?= ($comp['communication'] ?? '') == 3.0 ? 'selected' : '' ?>>3.0 - Satisfactory</option>
                    <option value="2.0" <?= ($comp['communication'] ?? '') == 2.0 ? 'selected' : '' ?>>2.0 - Fair</option>
                    <option value="1.0" <?= ($comp['communication'] ?? '') == 1.0 ? 'selected' : '' ?>>1.0 - Needs Improvement</option>
                </select>
            </div>

            <!-- 3. Attendance -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                <label class="block text-xs font-bold text-[#1B365D] mb-1">3. Attendance & Punctuality *</label>
                <p class="text-[11px] text-slate-400 mb-2.5">Consistency in daily shift attendance, promptness in reporting to work.</p>
                <select name="punctuality" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required>
                    <option value="5.0" <?= ($comp['punctuality'] ?? '') == 5.0 ? 'selected' : '' ?>>5.0 - Outstanding</option>
                    <option value="4.0" <?= ($comp['punctuality'] ?? '') == 4.0 ? 'selected' : '' ?>>4.0 - Very Satisfactory</option>
                    <option value="3.0" <?= ($comp['punctuality'] ?? '') == 3.0 ? 'selected' : '' ?>>3.0 - Satisfactory</option>
                    <option value="2.0" <?= ($comp['punctuality'] ?? '') == 2.0 ? 'selected' : '' ?>>2.0 - Fair</option>
                    <option value="1.0" <?= ($comp['punctuality'] ?? '') == 1.0 ? 'selected' : '' ?>>1.0 - Needs Improvement</option>
                </select>
            </div>

            <!-- 4. Initiative -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                <label class="block text-xs font-bold text-[#1B365D] mb-1">4. Initiative & Professional Work Attitude *</label>
                <p class="text-[11px] text-slate-400 mb-2.5">Resourcefulness, enthusiasm, willingness to learn, and dependability.</p>
                <select name="initiative" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required>
                    <option value="5.0" <?= ($comp['initiative'] ?? '') == 5.0 ? 'selected' : '' ?>>5.0 - Outstanding</option>
                    <option value="4.0" <?= ($comp['initiative'] ?? '') == 4.0 ? 'selected' : '' ?>>4.0 - Very Satisfactory</option>
                    <option value="3.0" <?= ($comp['initiative'] ?? '') == 3.0 ? 'selected' : '' ?>>3.0 - Satisfactory</option>
                    <option value="2.0" <?= ($comp['initiative'] ?? '') == 2.0 ? 'selected' : '' ?>>2.0 - Fair</option>
                    <option value="1.0" <?= ($comp['initiative'] ?? '') == 1.0 ? 'selected' : '' ?>>1.0 - Needs Improvement</option>
                </select>
            </div>
        </div>

        <!-- 5. Teamwork -->
        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
            <label class="block text-xs font-bold text-[#1B365D] mb-1">5. Teamwork & Organizational Contribution *</label>
            <p class="text-[11px] text-slate-400 mb-2.5">Collaboration with co-trainees, staff, and supervisors on host company tasks.</p>
            <select name="teamwork" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" required>
                <option value="5.0" <?= ($comp['teamwork'] ?? '') == 5.0 ? 'selected' : '' ?>>5.0 - Outstanding</option>
                <option value="4.0" <?= ($comp['teamwork'] ?? '') == 4.0 ? 'selected' : '' ?>>4.0 - Very Satisfactory</option>
                <option value="3.0" <?= ($comp['teamwork'] ?? '') == 3.0 ? 'selected' : '' ?>>3.0 - Satisfactory</option>
                <option value="2.0" <?= ($comp['teamwork'] ?? '') == 2.0 ? 'selected' : '' ?>>2.0 - Fair</option>
                <option value="1.0" <?= ($comp['teamwork'] ?? '') == 1.0 ? 'selected' : '' ?>>1.0 - Needs Improvement</option>
            </select>
        </div>

        <!-- Qualitative Remarks -->
        <div>
            <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Supervisor Narrative Remarks & Qualitative Feedback</label>
            <textarea name="feedback" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]" placeholder="Detail student performance highlights, areas for growth, and overall evaluation summary..."><?= esc($existing['feedback'] ?? '') ?></textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex justify-end">
            <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] shadow-2xs transition-colors cursor-pointer border-0">
                Submit Official Appraisal
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
