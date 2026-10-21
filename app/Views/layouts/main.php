<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SIMMS') ?> - Student Immersion Management and Monitoring System</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Pure Tailwind CSS (Zero Bootstrap Dependency) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1B365D',
                        gold: '#E5A93C',
                    },
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Universal Figma-Grade Component & Table Design System (Ensures 100% Visual Consistency Across All Links) -->
    <style>
        :root {
            --simms-navy: #1B365D;
            --simms-gold: #E5A93C;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #F8FAFC;
            color: #1B365D;
            margin: 0;
            padding: 0;
        }

        /* 1. Universal Crisp Table System (Ensures 100% visible, high-contrast borders everywhere) */
        table, .table {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            background-color: #FFFFFF !important;
            border: 1px solid #CBD5E1 !important;
            border-radius: 0.75rem !important;
            overflow: hidden !important;
            margin-bottom: 1.25rem !important;
            text-align: left !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04) !important;
        }
        th, .table th, table thead th {
            background-color: #F8FAFC !important;
            color: #334155 !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            padding: 0.75rem 1rem !important;
            border-bottom: 1.5px solid #CBD5E1 !important;
            border-right: 1px solid #E2E8F0 !important;
            white-space: nowrap !important;
        }
        td, .table td, table tbody td {
            padding: 0.75rem 1rem !important;
            font-size: 0.8125rem !important;
            color: #1B365D !important;
            border-bottom: 1px solid #E2E8F0 !important;
            border-right: 1px solid #E2E8F0 !important;
            vertical-align: middle !important;
            background-color: #FFFFFF !important;
        }
        th:last-child, td:last-child, .table th:last-child, .table td:last-child {
            border-right: none !important;
        }
        tbody tr:last-child td, .table tbody tr:last-child td {
            border-bottom: none !important;
        }
        tbody tr:hover td, .table tbody tr:hover td {
            background-color: #F8FAFC !important;
        }
        .table-responsive, .overflow-x-auto {
            overflow-x: auto !important;
            width: 100% !important;
            -webkit-overflow-scrolling: touch !important;
            border-radius: 0.75rem !important;
        }
        .table-responsive > table, .table-responsive > .table {
            margin-bottom: 0 !important;
        }

        /* 2. Universal Figma Elevated Cards */
        .card {
            background: #FFFFFF;
            border-radius: 1rem;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.15s ease;
        }
        .card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 1rem 1.25rem;
            font-weight: 700;
            color: #1B365D;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-body {
            padding: 1.25rem;
        }
        .card-stat {
            background: #FFFFFF;
            border-radius: 1rem;
            border: 1px solid #E2E8F0;
            padding: 1.25rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04);
        }

        /* 3. Universal Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.15s ease;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid transparent;
            line-height: 1.25;
        }
        .btn-primary {
            background-color: #E5A93C;
            color: #1B365D;
            border-color: #E5A93C;
            font-weight: 700;
        }
        .btn-primary:hover {
            background-color: #d4962b;
            border-color: #d4962b;
            color: #1B365D;
        }
        .btn-secondary {
            background-color: #F1F5F9;
            color: #475569;
            border-color: #E2E8F0;
        }
        .btn-secondary:hover {
            background-color: #E2E8F0;
            color: #1B365D;
        }
        .btn-outline-primary {
            background-color: transparent;
            color: #1B365D;
            border-color: #1B365D;
        }
        .btn-outline-primary:hover {
            background-color: #1B365D;
            color: #FFFFFF;
        }
        .btn-outline-danger {
            background-color: transparent;
            color: #dc2626;
            border-color: #fca5a5;
        }
        .btn-outline-danger:hover {
            background-color: #fef2f2;
        }
        .btn-outline-success {
            background-color: transparent;
            color: #166534;
            border-color: #86efac;
        }
        .btn-outline-success:hover {
            background-color: #f0fdf4;
        }
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 0.375rem;
        }

        /* 4. Form Controls */
        .form-control, .form-select {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
            color: #1B365D;
            background-color: #F8FAFC;
            border: 1px solid #CBD5E1;
            border-radius: 0.5rem;
            box-sizing: border-box;
            outline: none;
            transition: all 0.15s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #1B365D;
            background-color: #FFFFFF;
            box-shadow: 0 0 0 2px rgba(27, 54, 93, 0.1);
        }
        .form-label {
            display: block;
            font-size: 0.6875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748B;
            margin-bottom: 0.35rem;
        }
        .form-text {
            font-size: 0.6875rem;
            color: #64748B;
            margin-top: 0.25rem;
        }

        /* 5. Status & Role Badges */
        .badge, .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.2rem 0.65rem;
            font-size: 0.6875rem;
            font-weight: 700;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.2;
            border: 1px solid transparent;
        }
        .badge.bg-success, .badge-success, .badge-active, .badge-approved, .badge-verified, .badge-completed {
            background-color: #ECFDF5;
            color: #047857;
            border-color: #A7F3D0;
        }
        .badge.bg-danger, .badge-danger, .badge-inactive, .badge-rejected, .badge-declined, .badge-disputed {
            background-color: #FFF1F2;
            color: #BE123C;
            border-color: #FECDD3;
        }
        .badge.bg-warning, .badge-warning, .badge-pending, .badge-in-progress, .badge-review {
            background-color: #FFFBEB;
            color: #B45309;
            border-color: #FDE68A;
        }
        .badge.bg-primary, .badge.bg-info, .badge-info {
            background-color: #EFF6FF;
            color: #1D4ED8;
            border-color: #BFDBFE;
        }
        .badge.bg-secondary, .badge-secondary {
            background-color: #F1F5F9;
            color: #475569;
            border-color: #CBD5E1;
        }
        .badge-admin {
            background-color: #FAF5FF;
            color: #7E22CE;
            border-color: #E9D5FF;
        }
        .badge-faculty {
            background-color: #EFF6FF;
            color: #1D4ED8;
            border-color: #BFDBFE;
        }
        .badge-student {
            background-color: #ECFDF5;
            color: #047857;
            border-color: #A7F3D0;
        }
        .badge-agency {
            background-color: #FFFBEB;
            color: #B45309;
            border-color: #FDE68A;
        }

        /* 6. Progress Bars */
        .progress {
            background-color: #E2E8F0;
            border-radius: 9999px;
            overflow: hidden;
            display: flex;
            height: 6px;
        }
        .progress-bar {
            height: 100%;
            border-radius: 9999px;
            background-color: #1B365D;
            transition: width 0.3s ease;
        }
        .progress-bar.bg-success { background-color: #10B981; }
        .progress-bar.bg-primary { background-color: #1B365D; }
        .progress-bar.bg-warning { background-color: #E5A93C; }

        /* 7. Grid & Responsive Layout System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -0.75rem;
            margin-right: -0.75rem;
        }
        [class*="col-"] {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            box-sizing: border-box;
            width: 100%;
        }
        @media (min-width: 768px) {
            .col-md-6 { flex: 0 0 50%; max-width: 50%; }
            .col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-md-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
            .col-md-3 { flex: 0 0 25%; max-width: 25%; }
        }
        @media (min-width: 992px) {
            .col-lg-6 { flex: 0 0 50%; max-width: 50%; }
            .col-lg-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .col-lg-8 { flex: 0 0 66.666667%; max-width: 66.666667%; }
            .col-lg-3 { flex: 0 0 25%; max-width: 25%; }
            .col-lg-12 { flex: 0 0 100%; max-width: 100%; }
        }
        .g-3 > * { margin-bottom: 1rem; }
        .g-4 > * { margin-bottom: 1.5rem; }
        .d-flex { display: flex; }
        .d-inline { display: inline-block; }
        .justify-content-between { justify-content: space-between; }
        .align-items-center { align-items: center; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .mb-0 { margin-bottom: 0 !important; }
        .mb-1 { margin-bottom: 0.25rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-3 { margin-bottom: 0.75rem !important; }
        .mb-4 { margin-bottom: 1rem !important; }
        .mt-1 { margin-top: 0.25rem !important; }
        .mt-2 { margin-top: 0.5rem !important; }
        .mt-3 { margin-top: 0.75rem !important; }
        .mt-4 { margin-top: 1rem !important; }
        .fw-bold { font-weight: 700 !important; }
        .fw-semibold { font-weight: 600 !important; }
        .text-muted { color: #64748B !important; }
        .text-dark { color: #1B365D !important; }
        .text-primary { color: #1B365D !important; }
        .text-success { color: #166534 !important; }
        .text-danger { color: #dc2626 !important; }
        .text-end { text-align: right !important; }
        .text-center { text-align: center !important; }
        .ps-3 { padding-left: 0.75rem !important; }
        .pe-3 { padding-right: 0.75rem !important; }
        .p-0 { padding: 0 !important; }
        .p-2 { padding: 0.5rem !important; }
        .p-3 { padding: 0.75rem !important; }
        .p-4 { padding: 1rem !important; }
        .rounded-circle { border-radius: 9999px !important; }
        .rounded-2 { border-radius: 0.5rem !important; }
        .rounded-3 { border-radius: 0.75rem !important; }
        .rounded-4 { border-radius: 1rem !important; }
        .list-group { display: flex; flex-direction: column; padding: 0; margin: 0; list-style: none; }
        .list-group-item { position: relative; display: block; padding: 0.75rem 1rem; background-color: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 0.5rem; margin-bottom: 0.5rem; }

        /* Custom subtle scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Sticky & Scrollable Sidebar Layout Pattern */
        .layout-container {
            display: flex !important;
            align-items: flex-start !important;
            width: 100% !important;
            min-height: 100vh !important;
        }

        aside, .sidebar-sticky {
            position: sticky !important;
            top: 0 !important;
            height: 100vh !important;
            overflow-y: auto !important;
            flex-shrink: 0 !important;
        }

        /* Subtle scrollbar for dark sidebar */
        aside::-webkit-scrollbar, .sidebar-sticky::-webkit-scrollbar {
            width: 5px;
        }
        aside::-webkit-scrollbar-track, .sidebar-sticky::-webkit-scrollbar-track {
            background: transparent;
        }
        aside::-webkit-scrollbar-thumb, .sidebar-sticky::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
        }
        aside::-webkit-scrollbar-thumb:hover, .sidebar-sticky::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1B365D] min-h-screen antialiased selection:bg-[#E5A93C]/30 selection:text-[#1B365D]">

    <!-- Layout Container (Flex container with align-items: flex-start to prevent sidebar stretch) -->
    <div class="layout-container min-h-screen w-full flex items-start bg-[#F8FAFC]" style="display: flex; align-items: flex-start;">
        <?php if (session()->get('logged_in')): ?>
            <!-- Sticky & Scrollable Sidebar: Oxford Navy #1B365D, w-60 -->
            <aside class="w-60 bg-[#1B365D] text-slate-300 flex flex-col justify-between shrink-0 border-r border-white/5 z-30 sidebar-sticky" style="position: sticky; top: 0; height: 100vh; overflow-y: auto; flex-shrink: 0;">
                <!-- Sidebar Top: Brand Identity -->
                <div class="h-14 px-4 flex items-center border-b border-white/10 shrink-0">
                    <a href="<?= base_url() ?>" class="flex items-center gap-2.5 text-white no-underline font-semibold text-sm hover:opacity-95 transition-opacity">
                        <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-[#E5A93C]">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                            </svg>
                        </div>
                        <div class="tracking-tight leading-none">
                            <span class="font-bold text-white text-sm">SIMMS</span>
                            <span class="font-normal text-xs text-slate-300 ml-1.5 hidden sm:inline">| Immersion</span>
                        </div>
                    </a>
                </div>

                <!-- Scrollable Navigation Items -->
                <div class="flex-1 py-4 px-3 overflow-y-auto space-y-1">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 mb-2">Immersion Portal</div>
                    <nav class="space-y-0.5">
                        <?php $role = session()->get('role'); ?>

                        <?php if ($role === 'admin'): ?>
                            <!-- Admin Navigation -->
                            <a href="<?= base_url('admin/dashboard') ?>" class="<?= uri_string() === 'admin/dashboard' ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?= base_url('admin/users') ?>" class="<?= str_starts_with(uri_string(), 'admin/users') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                <span>User Accounts</span>
                            </a>
                            <a href="<?= base_url('admin/faculty') ?>" class="<?= str_starts_with(uri_string(), 'admin/faculty') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                                <span>Faculty Profiles</span>
                            </a>
                            <a href="<?= base_url('admin/subjects') ?>" class="<?= str_starts_with(uri_string(), 'admin/subjects') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                <span>Immersion Subjects</span>
                            </a>
                            <a href="<?= base_url('reports') ?>" class="<?= str_starts_with(uri_string(), 'reports') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                                <span>Report Engine</span>
                            </a>
                            <a href="<?= base_url('admin/settings') ?>" class="<?= str_starts_with(uri_string(), 'admin/settings') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/></svg>
                                <span>System Settings</span>
                            </a>
                        <?php elseif ($role === 'faculty'): ?>
                            <a href="<?= base_url('faculty/dashboard') ?>" class="<?= uri_string() === 'faculty/dashboard' ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                                <span>Coordinator Desk</span>
                            </a>
                            <a href="<?= base_url('faculty/students') ?>" class="<?= str_starts_with(uri_string(), 'faculty/students') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                <span>Advisee Students</span>
                            </a>
                            <a href="<?= base_url('faculty/agency-requests') ?>" class="<?= str_starts_with(uri_string(), 'faculty/agency-requests') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                <span>Agency Approvals</span>
                            </a>
                            <a href="<?= base_url('faculty/documents') ?>" class="<?= str_starts_with(uri_string(), 'faculty/documents') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                <span>Document Review</span>
                            </a>
                            <a href="<?= base_url('deployment') ?>" class="<?= str_starts_with(uri_string(), 'deployment') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                                <span>Student Deployment</span>
                            </a>
                            <a href="<?= base_url('reports') ?>" class="<?= str_starts_with(uri_string(), 'reports') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24-1.076-.673-2.074-1.259-2.968m12.078 2.968a9.98 9.98 0 00-1.258-2.968m-1.393 5.438c-.378.378-.804.708-1.268.98m-6.758 0a9.96 9.96 0 01-1.268-.98m1.268-8.998a9.96 9.96 0 011.268-.98m6.758 0c.464.272.89.602 1.268.98m-8.026 8.998a9.963 9.963 0 006.758 0m-6.758-8.998a9.963 9.963 0 016.758 0"/></svg>
                                <span>Printable Reports</span>
                            </a>
                        <?php elseif ($role === 'student'): ?>
                            <a href="<?= base_url('student/dashboard') ?>" class="<?= uri_string() === 'student/dashboard' ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                                <span>My Dashboard</span>
                            </a>
                            <a href="<?= base_url('student/profile') ?>" class="<?= str_starts_with(uri_string(), 'student/profile') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z"/></svg>
                                <span>Personal Profile</span>
                            </a>
                            <a href="<?= base_url('student/agencies') ?>" class="<?= str_starts_with(uri_string(), 'student/agencies') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Partner Agencies</span>
                            </a>
                            <a href="<?= base_url('student/documents') ?>" class="<?= str_starts_with(uri_string(), 'student/documents') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <span>My Requirements</span>
                            </a>
                            <a href="<?= base_url('logs') ?>" class="<?= str_starts_with(uri_string(), 'logs') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>DTR & Daily Logs</span>
                            </a>
                        <?php elseif ($role === 'agency'): ?>
                            <a href="<?= base_url('agency/dashboard') ?>" class="<?= uri_string() === 'agency/dashboard' ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                                <span>Supervisor Desk</span>
                            </a>
                            <a href="<?= base_url('agency/trainees') ?>" class="<?= str_starts_with(uri_string(), 'agency/trainees') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                <span>Assigned Trainees</span>
                            </a>
                            <a href="<?= base_url('logs') ?>" class="<?= str_starts_with(uri_string(), 'logs') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Verify Daily DTR</span>
                            </a>
                            <a href="<?= base_url('evaluations') ?>" class="<?= str_starts_with(uri_string(), 'evaluations') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                                <span>Evaluations</span>
                            </a>
                            <a href="<?= base_url('agency/profile') ?>" class="<?= str_starts_with(uri_string(), 'agency/profile') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span>Agency Info</span>
                            </a>
                        <?php endif; ?>

                        <!-- Dedicated Messages link -->
                        <div class="pt-2">
                            <a href="<?= base_url('chat') ?>" class="<?= str_starts_with(uri_string(), 'chat') ? 'bg-[#E5A93C] text-[#1B365D] font-semibold shadow-2xs' : 'text-slate-300 hover:text-white hover:bg-white/[0.08] font-medium' ?> px-3 py-1.5 rounded-lg text-xs flex items-center gap-2.5 transition-colors">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.502 49.188 49.188 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/></svg>
                                <span>Messages</span>
                            </a>
                        </div>
                    </nav>
                </div>

            </aside>
        <?php endif; ?>

        <!-- Right Workspace Column (Header + Main Content) -->
        <div class="flex-1 flex flex-col min-w-0 w-full min-h-screen">
            <?php if (session()->get('logged_in')): ?>
                <!-- Top Navigation Bar (Figma Style: Compact h-14, Oxford Navy #1B365D) -->
                <header class="h-14 bg-[#1B365D] px-4 sm:px-6 flex items-center justify-between sticky top-0 z-20 text-white shrink-0 shadow-2xs border-b border-white/10">
                    <!-- Left Header: Portal Context -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full bg-white/10 text-white">
                                <?= esc(strtoupper(session()->get('role'))) ?> WORKSPACE
                            </span>
                        </div>
                    </div>

                    <!-- Right Side: User Profile & Quick Actions -->
                    <div class="flex items-center gap-3">
                        <?php $role = session()->get('role'); ?>

                        <!-- Messages Trigger -->
                        <a href="<?= base_url('chat') ?>" class="text-slate-300 hover:text-white p-1.5 rounded-lg hover:bg-white/10 transition-colors" title="Messages">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a.75.75 0 01-1.074-.85 6.002 6.002 0 001.378-3.082C4.184 15.65 3 13.926 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/>
                            </svg>
                        </a>

                        <!-- User Dropdown (Pure Tailwind + Minimal Vanilla JS) -->
                        <div class="relative">
                            <button id="user-menu-btn" onclick="toggleUserMenu()" class="flex items-center gap-2 text-white hover:opacity-90 focus:outline-none border-0 bg-transparent p-0 cursor-pointer text-xs">
                                <div class="w-7 h-7 rounded-full bg-[#E5A93C] text-[#1B365D] font-bold text-xs flex items-center justify-center shrink-0 shadow-2xs">
                                    <?= esc(strtoupper(substr(session()->get('first_name') ?? 'U', 0, 1))) ?>
                                </div>
                                <span class="font-medium hidden md:inline-block text-white">
                                    <?= esc(session()->get('first_name') . ' ' . session()->get('last_name')) ?>
                                </span>
                                <span class="px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider rounded-full bg-white/10 text-white">
                                    <?= esc($role) ?>
                                </span>
                                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                </svg>
                            </button>

                            <!-- Dropdown Content -->
                            <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg ring-1 ring-slate-900/5 py-1 z-50 text-xs">
                                <div class="px-3.5 py-2 border-b border-slate-100 text-[11px] text-slate-500">
                                    Signed in as <strong class="text-[#1B365D] block truncate"><?= esc(session()->get('email')) ?></strong>
                                </div>
                                <?php if ($role === 'student'): ?>
                                    <a href="<?= base_url('student/profile') ?>" class="flex items-center gap-2 px-3.5 py-2 text-[#1B365D] hover:bg-slate-50 font-medium">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                        <span>My Profile</span>
                                    </a>
                                <?php endif; ?>
                                <a href="<?= base_url('logout') ?>" class="flex items-center gap-2 px-3.5 py-2 text-rose-600 hover:bg-rose-50 font-medium border-t border-slate-50">
                                    <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
                                    <span>Sign Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
            <?php endif; ?>

            <!-- Main Content Area: Figma Canvas (#F8FAFC) -->
            <main class="flex-1 p-5 sm:p-7 bg-[#F8FAFC]">
                <!-- Flash Alerts -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-5 p-3.5 bg-white rounded-xl shadow-xs ring-1 ring-slate-900/5 border-l-4 border-l-[#E5A93C] text-xs text-[#1B365D] flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#E5A93C] shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                            <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 cursor-pointer border-0 bg-transparent text-sm">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-5 p-3.5 bg-white rounded-xl shadow-xs ring-1 ring-slate-900/5 border-l-4 border-l-rose-500 text-xs text-rose-700 flex items-center justify-between" role="alert">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-rose-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                            <span class="font-medium"><?= session()->getFlashdata('error') ?></span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 cursor-pointer border-0 bg-transparent text-sm">&times;</button>
                    </div>
                <?php endif; ?>

                <!-- Render Body Content -->
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- Minimal Dropdown Script -->
    <script>
    function toggleUserMenu() {
        const menu = document.getElementById('user-menu-dropdown');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('user-menu-btn');
        const menu = document.getElementById('user-menu-dropdown');
        if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
