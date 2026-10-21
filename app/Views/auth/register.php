<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="min-h-[85vh] flex flex-col items-center justify-center py-8 px-4">
    <div class="w-full max-w-xl">
        <!-- Figma Style Registration Card -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/[0.04] p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-xl bg-[#1B365D] text-[#E5A93C] flex items-center justify-center mx-auto mb-4 shadow-xs">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#1B365D] tracking-tight">Student Trainee Registration</h2>
                <p class="text-xs text-slate-500 mt-1">Enroll your profile into the SIMMS immersion directory</p>
            </div>

            <!-- Registration Form -->
            <form action="<?= base_url('register/store') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required placeholder="First name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                    <div>
                        <label for="last_name" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required placeholder="Last name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email Address *</label>
                    <input type="email" id="email" name="email" required placeholder="student@simms.edu.ph" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Password *</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Choose a secure password (min. 6 chars)" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="course" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Course / Strand *</label>
                        <select id="course" name="course" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                            <option value="" disabled selected>Select program</option>
                            <option value="BS Information Technology">BS Information Technology</option>
                            <option value="BS Computer Science">BS Computer Science</option>
                            <option value="BS Information Systems">BS Information Systems</option>
                            <option value="SHS - TVL ICT Track">SHS - TVL ICT Track</option>
                            <option value="SHS - STEM Strand">SHS - STEM Strand</option>
                        </select>
                    </div>

                    <div>
                        <label for="year_level" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Year / Grade Level *</label>
                        <select id="year_level" name="year_level" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                            <option value="" disabled selected>Select level</option>
                            <option value="4th Year">4th Year (College)</option>
                            <option value="3rd Year">3rd Year (College)</option>
                            <option value="Grade 12">Grade 12 (Senior High)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="contact_no" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Mobile Contact Number *</label>
                    <input type="tel" id="contact_no" name="contact_no" required placeholder="0917XXXXXXX" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <button type="submit" class="w-full py-2.5 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-colors cursor-pointer border-0 mt-4">
                    Complete Registration
                </button>

                <div class="text-center text-xs text-slate-500 pt-2">
                    Already enrolled in SIMMS?
                    <a href="<?= base_url('login') ?>" class="text-[#1B365D] font-bold hover:underline ml-1">Sign in here</a>
                </div>
            </form>
        </div>

        <!-- Return to Home Link -->
        <div class="text-center mt-5">
            <a href="<?= base_url() ?>" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-[#1B365D] font-medium transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                <span>Back to institutional overview</span>
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
