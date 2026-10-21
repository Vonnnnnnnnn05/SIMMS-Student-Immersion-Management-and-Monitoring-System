<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Header Section (Figma Style) -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl font-bold text-[#1B365D] tracking-tight">User Account Directory</h1>
        <p class="text-xs text-slate-500 mt-1">Provision institutional credentials and configure role-based system permissions</p>
    </div>
    <div>
        <!-- Primary Action CTA (Scholastic Gold #E5A93C) -->
        <button type="button" onclick="openCreateUserModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] font-bold text-xs rounded-xl shadow-xs transition-all cursor-pointer border-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/></svg>
            <span>Add New User</span>
        </button>
    </div>
</div>

<!-- Figma Search & Filter Bar -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-3 mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    <!-- Search Input -->
    <div class="relative flex-1 max-w-md">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
        </div>
        <input type="text" id="user-search" onkeyup="filterUsers()" placeholder="Search by name, email, or role..." class="w-full bg-slate-50 border-0 rounded-xl pl-9 pr-4 py-2 text-xs text-[#1B365D] placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
    </div>

    <!-- Role Filter Pills -->
    <div class="flex items-center gap-1.5 overflow-x-auto text-[11px] font-medium text-slate-500">
        <button type="button" onclick="filterRole('all')" class="role-filter-btn px-3 py-1.5 rounded-lg bg-slate-100 text-[#1B365D] font-bold border-0 cursor-pointer">All</button>
        <button type="button" onclick="filterRole('admin')" class="role-filter-btn px-3 py-1.5 rounded-lg hover:bg-slate-50 border-0 bg-transparent cursor-pointer">Admin</button>
        <button type="button" onclick="filterRole('faculty')" class="role-filter-btn px-3 py-1.5 rounded-lg hover:bg-slate-50 border-0 bg-transparent cursor-pointer">Faculty</button>
        <button type="button" onclick="filterRole('student')" class="role-filter-btn px-3 py-1.5 rounded-lg hover:bg-slate-50 border-0 bg-transparent cursor-pointer">Student</button>
        <button type="button" onclick="filterRole('agency')" class="role-filter-btn px-3 py-1.5 rounded-lg hover:bg-slate-50 border-0 bg-transparent cursor-pointer">Agency</button>
    </div>
</div>

<!-- Users Table Card (Figma Style) -->
<div class="bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/[0.04] p-5">
    <div class="overflow-x-auto border border-slate-200 rounded-xl">
        <table class="w-full text-left border-collapse" id="users-table" style="margin-bottom:0;">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">User Identity</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Role</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Status</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 border-r border-slate-200">Registered</th>
                    <th class="py-3 px-4 text-[11px] uppercase tracking-wider font-bold text-slate-500 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-xs">
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="py-8 px-4 text-center text-slate-400 text-xs">No registered accounts found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="user-row hover:bg-slate-50/60 transition-colors border-b border-slate-200 last:border-b-0" data-role="<?= esc(strtolower($user['role'])) ?>" data-search="<?= esc(strtolower($user['first_name'] . ' ' . $user['last_name'] . ' ' . $user['email'] . ' ' . $user['role'])) ?>">
                            <!-- User Identity -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-[#1B365D] font-bold text-xs flex items-center justify-center shrink-0">
                                        <?= esc(strtoupper(substr($user['first_name'], 0, 1))) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-[#1B365D]"><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></div>
                                        <div class="text-[11px] text-slate-400 font-normal"><?= esc($user['email']) ?></div>
                                    </div>
                                </div>
                            </td>

                            <!-- Role Badge -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
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

                            <!-- Status Badge -->
                            <td class="py-3.5 px-4 border-r border-slate-200">
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

                            <!-- Created Date -->
                            <td class="py-3.5 px-4 text-slate-400 text-[11px] border-r border-slate-200">
                                <?= date('M d, Y', strtotime($user['created_at'])) ?>
                            </td>

                            <!-- Action -->
                            <td class="py-3.5 px-4 text-right">
                                <?php if ($user['user_id'] !== session()->get('user_id')): ?>
                                    <form action="<?= base_url('admin/users/toggle/' . $user['user_id']) ?>" method="POST" class="inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-[11px] font-semibold transition-colors cursor-pointer border-0 <?= $user['status'] === 'active' ? 'bg-slate-100 text-slate-600 hover:bg-rose-50 hover:text-rose-600' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' ?>">
                                            <?= $user['status'] === 'active' ? 'Deactivate' : 'Activate' ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-[10px] font-medium text-slate-400 px-2 py-1 rounded bg-slate-50">Current</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create User Modal (Pure Figma Style, Zero Bootstrap) -->
<div id="modal-create-user" class="hidden fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl ring-1 ring-slate-900/10 max-w-lg w-full overflow-hidden">
        <form action="<?= base_url('admin/users/create') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Provision System Account</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Create coordinator, agency, or admin credentials</p>
                </div>
                <button type="button" onclick="closeCreateUserModal()" class="text-slate-400 hover:text-slate-600 text-lg cursor-pointer border-0 bg-transparent">&times;</button>
            </div>

            <div class="p-6 text-xs text-[#1B365D] space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">First Name *</label>
                        <input type="text" name="first_name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Last Name *</label>
                        <input type="text" name="last_name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Email Address *</label>
                    <input type="email" name="email" required placeholder="user@simms.edu.ph" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Initial Password *</label>
                    <input type="password" name="password" required minlength="6" placeholder="Minimum 6 characters" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div>
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">System Role *</label>
                    <select name="role" id="roleSelector" onchange="toggleRoleFields(this.value)" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                        <option value="faculty">Faculty Coordinator / Adviser</option>
                        <option value="agency">Partner Host Agency Supervisor</option>
                        <option value="admin">System Administrator</option>
                    </select>
                </div>

                <div id="deptField">
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Department</label>
                    <input type="text" name="department" value="College of Computer Studies" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>

                <div id="agencyField" class="hidden">
                    <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Partner Establishment Name</label>
                    <input type="text" name="agency_name" placeholder="Company / Partner Host Name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-xs text-[#1B365D] focus:outline-none focus:ring-1 focus:ring-[#1B365D]">
                </div>
            </div>

            <div class="px-6 py-3.5 bg-slate-50/70 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateUserModal()" class="px-4 py-2 rounded-xl text-xs font-medium text-slate-500 hover:bg-slate-100 border-0 bg-transparent cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-[#E5A93C] text-[#1B365D] hover:bg-[#d4962b] border-0 cursor-pointer shadow-xs">Save Account</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function openCreateUserModal() {
    document.getElementById('modal-create-user').classList.remove('hidden');
}
function closeCreateUserModal() {
    document.getElementById('modal-create-user').classList.add('hidden');
}

function toggleRoleFields(role) {
    const deptField = document.getElementById('deptField');
    const agencyField = document.getElementById('agencyField');
    if (role === 'agency') {
        deptField.classList.add('hidden');
        agencyField.classList.remove('hidden');
    } else if (role === 'faculty') {
        deptField.classList.remove('hidden');
        agencyField.classList.add('hidden');
    } else {
        deptField.classList.add('hidden');
        agencyField.classList.add('hidden');
    }
}

function filterRole(role) {
    // Update active filter button styling
    const buttons = document.querySelectorAll('.role-filter-btn');
    buttons.forEach(btn => {
        btn.classList.remove('bg-slate-100', 'text-[#1B365D]', 'font-bold');
        btn.classList.add('hover:bg-slate-50', 'bg-transparent');
    });
    event.target.classList.add('bg-slate-100', 'text-[#1B365D]', 'font-bold');
    event.target.classList.remove('hover:bg-slate-50', 'bg-transparent');

    const rows = document.querySelectorAll('.user-row');
    rows.forEach(row => {
        if (role === 'all' || row.dataset.role === role) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterUsers() {
    const q = document.getElementById('user-search').value.toLowerCase();
    const rows = document.querySelectorAll('.user-row');
    rows.forEach(row => {
        if (row.dataset.search.includes(q)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
<?= $this->endSection() ?>
