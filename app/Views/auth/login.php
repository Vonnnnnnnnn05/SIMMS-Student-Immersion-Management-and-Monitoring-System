<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="min-h-[85vh] flex flex-col items-center justify-center py-8 px-4">
    <div class="w-full max-w-md">
        <!-- Figma Style Login Card -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/[0.04] p-8">
            <!-- Brand / Header -->
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-xl bg-[#1B365D] text-[#E5A93C] flex items-center justify-center mx-auto mb-4 shadow-xs">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#1B365D] tracking-tight">Sign in to SIMMS</h2>
                <p class="text-xs text-slate-500 mt-1">Student Immersion Management and Monitoring System</p>
            </div>

            <!-- Login Form -->
            <form action="<?= base_url('login/authenticate') ?>" method="POST" class="space-y-4">
                <?= csrf_field() ?>

                <div>
                    <label for="email" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" required autofocus placeholder="name@domain.edu.ph" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Password</label>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs text-[#1B365D] placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <button type="submit" class="w-full py-2.5 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-colors cursor-pointer border-0 mt-2">
                    Sign In to Portal
                </button>

                <div class="text-center text-xs text-slate-500 pt-2">
                    Are you a student needing an account?
                    <a href="<?= base_url('register') ?>" class="text-[#1B365D] font-bold hover:underline ml-1">Register here</a>
                </div>
            </form>

            <!-- Demo Fast-Login Credentials Helper -->
            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-3">Fast Demo Fill Credentials</div>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <button type="button" onclick="fillCreds('admin@simms.edu.ph', 'admin123')" class="px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-[11px] border border-slate-200 cursor-pointer transition-colors">
                        Admin Desk
                    </button>
                    <button type="button" onclick="fillCreds('faculty@simms.edu.ph', 'faculty123')" class="px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-[11px] border border-slate-200 cursor-pointer transition-colors">
                        Faculty Desk
                    </button>
                    <button type="button" onclick="fillCreds('student@simms.edu.ph', 'student123')" class="px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-[11px] border border-slate-200 cursor-pointer transition-colors">
                        Student Portal
                    </button>
                    <button type="button" onclick="fillCreds('agency@partner.com', 'agency123')" class="px-2.5 py-1.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 font-medium text-[11px] border border-slate-200 cursor-pointer transition-colors">
                        Agency Desk
                    </button>
                </div>
            </div>
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

<?= $this->section('scripts') ?>
<script>
function fillCreds(email, password) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = password;
}
</script>
<?= $this->endSection() ?>
