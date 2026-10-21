<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SIMMS | Student Immersion Management and Monitoring System') ?></title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
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
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-[#E5A93C]/30 selection:text-[#1B365D]">

    <!-- Top Institutional Navbar (Figma style, sticky blurred header) -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <!-- Brand Identity -->
            <a href="<?= base_url() ?>" class="flex items-center gap-2.5 text-decoration-none group">
                <div class="w-9 h-9 rounded-lg bg-[#1B365D] flex items-center justify-center text-[#E5A93C] shadow-xs group-hover:scale-105 transition-transform">
                    <!-- Mortarboard SVG -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z"/>
                    </svg>
                </div>
                <div>
                    <div class="font-bold text-[#1B365D] text-sm tracking-tight leading-none flex items-center gap-1.5">
                        <span>SIMMS</span>
                        <span class="text-[10px] uppercase font-semibold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600">v1.0</span>
                    </div>
                    <div class="text-[11px] text-slate-500 font-medium leading-none mt-1">Student Immersion Portal</div>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-xs font-medium text-slate-600">
                <a href="#overview" class="hover:text-[#1B365D] transition-colors">Program Overview</a>
                <a href="#modules" class="hover:text-[#1B365D] transition-colors">Core Modules</a>
                <a href="#workflow" class="hover:text-[#1B365D] transition-colors">Immersion Lifecycle</a>
                <a href="#agencies" class="hover:text-[#1B365D] transition-colors">Partner Agencies</a>
                <a href="#specs" class="hover:text-[#1B365D] transition-colors">Standards & Guidelines</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <a href="<?= base_url('login') ?>" class="text-xs font-semibold text-[#1B365D] hover:bg-slate-100 px-3.5 py-2 rounded-lg transition-colors">
                    Sign In
                </a>
                <a href="<?= base_url('register') ?>" class="text-xs font-bold bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] px-4 py-2 rounded-lg shadow-xs transition-colors flex items-center gap-1.5">
                    <span>Student Register</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 lg:pt-20 lg:pb-28 overflow-hidden bg-gradient-to-b from-white via-white to-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Accreditation Pill -->
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200/80 text-[11px] font-semibold text-[#1B365D] mb-6 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-[#E5A93C]"></span>
                    <span>CHED & DepEd Work Immersion Aligned Framework</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#1B365D] tracking-tight leading-[1.15]">
                    Next-Generation Student Immersion & Monitoring System
                </h1>

                <!-- Subtitle -->
                <p class="mt-5 text-sm sm:text-base text-slate-600 leading-relaxed font-normal max-w-2xl mx-auto">
                    The unified institutional platform connecting students, faculty advisers, and host partner agencies. Streamlining MOA governance, biometric DTR logs, requirements compliance, and standardized evaluations.
                </p>

                <!-- CTA Row -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-3.5">
                    <a href="<?= base_url('login') ?>" class="px-5 py-2.5 rounded-lg bg-[#1B365D] hover:bg-[#152a48] text-white text-xs font-semibold shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#E5A93C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                        </svg>
                        <span>Portal Sign In</span>
                    </a>
                    <a href="<?= base_url('register') ?>" class="px-5 py-2.5 rounded-lg bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] text-xs font-bold shadow-xs transition-all flex items-center gap-2">
                        <span>Student Trainee Registration</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>
                    <a href="#overview" class="px-4 py-2.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-medium transition-colors">
                        Learn More
                    </a>
                </div>
            </div>

            <!-- Live Metrics Counter Strip (Figma Clean Card) -->
            <div class="mt-14 max-w-4xl mx-auto bg-white rounded-2xl shadow-xs ring-1 ring-slate-900/5 p-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-2xl font-bold text-[#1B365D]"><?= esc($total_students ?? 0) ?></div>
                    <div class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Enrolled Trainees</div>
                </div>
                <div class="border-t sm:border-t-0 sm:border-l border-slate-100 pt-4 sm:pt-0">
                    <div class="text-2xl font-bold text-[#1B365D]"><?= esc($total_agencies ?? 0) ?></div>
                    <div class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Partner Agencies</div>
                </div>
                <div class="border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0">
                    <div class="text-2xl font-bold text-[#1B365D]"><?= esc($active_deployments ?? 0) ?></div>
                    <div class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Active Deployments</div>
                </div>
                <div class="border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0">
                    <div class="text-2xl font-bold text-[#1B365D]"><?= esc($total_faculty ?? 0) ?></div>
                    <div class="text-xs font-medium text-slate-500 uppercase tracking-wider mt-1">Faculty Advisers</div>
                </div>
            </div>

            <!-- Interactive Figma-Style Dashboard Preview Card -->
            <div class="mt-12 max-w-4xl mx-auto bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 overflow-hidden">
                <div class="bg-[#1B365D] px-6 py-3.5 flex items-center justify-between text-white">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-[#E5A93C]"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                        <span class="ml-3 text-xs font-mono text-slate-300">SIMMS &bull; Institutional Overview Desk</span>
                    </div>
                    <span class="text-[11px] font-semibold text-[#E5A93C] uppercase tracking-wider bg-white/10 px-2.5 py-0.5 rounded-full">Live Operational</span>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 bg-slate-50/50">
                    <div class="bg-white p-4 rounded-xl ring-1 ring-slate-900/5 shadow-2xs">
                        <div class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Trainee Compliance</div>
                        <div class="text-xl font-bold text-[#1B365D] mt-1">98.4%</div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                            <div class="bg-[#E5A93C] h-1.5 rounded-full" style="width: 98.4%"></div>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-1">Required documents verified</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl ring-1 ring-slate-900/5 shadow-2xs">
                        <div class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">Total Hours Rendered</div>
                        <div class="text-xl font-bold text-[#1B365D] mt-1">14,820 hrs</div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                            <div class="bg-[#1B365D] h-1.5 rounded-full" style="width: 82%"></div>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-1">Across 8 host industry clusters</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl ring-1 ring-slate-900/5 shadow-2xs">
                        <div class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">MOA Active Status</div>
                        <div class="text-xl font-bold text-[#1B365D] mt-1">100% Vetted</div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mt-2">
                            <div class="bg-[#E5A93C] h-1.5 rounded-full" style="width: 100%"></div>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-1">Legal compliance secured</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Modules Section (Figma style cards) -->
    <section id="modules" class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-xs font-bold uppercase tracking-wider text-[#1B365D]/70">Comprehensive Modules</h2>
                <p class="text-2xl sm:text-3xl font-extrabold text-[#1B365D] mt-1">Engineered for Academic Excellence</p>
                <p class="text-xs text-slate-500 mt-2">Everything students, coordinators, and company supervisors need to complete the immersion curriculum.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Module 1 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Partner Agency Directory</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Browse accredited partner companies with active MOA records, contact persons, and trainee slot availability.</p>
                </div>

                <!-- Module 2 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Daily Time Record (DTR)</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Students submit daily work hours and task descriptions, reviewed and verified in real time by company supervisors.</p>
                </div>

                <!-- Module 3 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Automated Letter Generator</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Instantly generate standardized endorsement and application letters pre-populated with student and agency metadata.</p>
                </div>

                <!-- Module 4 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Document Management</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Medical clearances, parent consents, and waivers uploaded digitally with instant approval tracking by advisers.</p>
                </div>

                <!-- Module 5 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">Host Agency Evaluation</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Standardized 5-criteria performance rating sheets with automatic grade computation and certificate generation.</p>
                </div>

                <!-- Module 6 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs hover:shadow-md transition-shadow">
                    <div class="w-10 h-10 rounded-lg bg-slate-50 text-[#1B365D] ring-1 ring-slate-900/5 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-[#1B365D]">CHED Printable Reports</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">All 8 mandatory institutional immersion reports exportable and printable in standard letterhead format.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Immersion Lifecycle Workflow -->
    <section id="workflow" class="py-20 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-xs font-bold uppercase tracking-wider text-[#1B365D]/70">Structured Progression</h2>
                <p class="text-2xl sm:text-3xl font-extrabold text-[#1B365D] mt-1">The 4-Stage Immersion Journey</p>
                <p class="text-xs text-slate-500 mt-2">A clear, accountable trajectory from student onboarding to final completion.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs relative">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">Step 01</div>
                    <h4 class="text-sm font-bold text-[#1B365D] mt-2">Student Profiling</h4>
                    <p class="text-xs text-slate-500 mt-1">Register personal information, strand/course details, and submit baseline consent documents.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs relative">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">Step 02</div>
                    <h4 class="text-sm font-bold text-[#1B365D] mt-2">Agency Matching</h4>
                    <p class="text-xs text-slate-500 mt-1">Select from vetted partner agencies and obtain coordinator endorsement and application letters.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs relative">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">Step 03</div>
                    <h4 class="text-sm font-bold text-[#1B365D] mt-2">Active Traineeship</h4>
                    <p class="text-xs text-slate-500 mt-1">Log daily work hours, record tasks, and maintain certified attendance with host supervisors.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-xl p-5 ring-1 ring-slate-900/5 shadow-xs relative">
                    <div class="text-xs font-bold text-[#E5A93C] uppercase tracking-wider">Step 04</div>
                    <h4 class="text-sm font-bold text-[#1B365D] mt-2">Final Evaluation</h4>
                    <p class="text-xs text-slate-500 mt-1">Receive supervisor competency ratings, finalize clearance, and generate completion certificates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner Agencies Section -->
    <section id="agencies" class="py-20 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-[#1B365D]/70">Industry Partners</h2>
                    <p class="text-2xl sm:text-3xl font-extrabold text-[#1B365D] mt-1">Accredited Host Establishments</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="<?= base_url('login') ?>" class="text-xs font-semibold text-[#1B365D] hover:underline flex items-center gap-1">
                        <span>Sign in to browse full directory</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <?php if (!empty($featured_agencies)): ?>
                    <?php foreach ($featured_agencies as $agency): ?>
                        <div class="bg-white rounded-xl p-4 ring-1 ring-slate-900/5 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded-full bg-[#E5A93C] text-[#1B365D]">Verified MOA</span>
                                    <span class="text-[10px] text-slate-400">ID #<?= esc($agency['agency_id']) ?></span>
                                </div>
                                <h4 class="text-sm font-bold text-[#1B365D] mt-2.5"><?= esc($agency['name']) ?></h4>
                                <p class="text-xs text-slate-500 mt-1"><?= esc($agency['address'] ?? 'Official Host Partner') ?></p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-500">
                                <span>Supervisor: <strong><?= esc($agency['contact_person'] ?? 'Coordinator') ?></strong></span>
                                <span><?= esc($agency['contact_no'] ?? 'N/A') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center py-8 text-xs text-slate-500">
                        Partner establishment roster is populated in the administrative desk.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Institutional CTA Banner -->
    <section class="py-16 bg-[#1B365D] text-white">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Ready to Begin Your Immersion Traineeship?</h2>
            <p class="mt-3 text-xs sm:text-sm text-slate-300 max-w-xl mx-auto">
                Sign in to your institutional account or register as a student to explore approved partner agencies and begin logging your daily hours.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="<?= base_url('login') ?>" class="px-6 py-2.5 rounded-lg bg-[#E5A93C] hover:bg-[#d4962b] text-[#1B365D] text-xs font-bold shadow-xs transition-colors">
                    Access System Portal
                </a>
                <a href="<?= base_url('register') ?>" class="px-6 py-2.5 rounded-lg bg-white/10 hover:bg-white/20 text-white text-xs font-semibold transition-colors">
                    Register New Student
                </a>
            </div>
        </div>
    </section>

    <!-- Institutional Footer -->
    <footer class="bg-white border-t border-slate-200/80 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded bg-[#1B365D] text-[#E5A93C] flex items-center justify-center font-bold text-xs">S</div>
                <span class="font-semibold text-[#1B365D]">SIMMS</span> &bull; <span>Student Immersion Management & Monitoring System</span>
            </div>
            <div>
                moa_v2 Database &bull; CodeIgniter 4 Framework &bull; Academic Year 2026–2027
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <a href="<?= base_url('login') ?>" class="hover:text-[#1B365D]">Sign In</a>
                <a href="<?= base_url('register') ?>" class="hover:text-[#1B365D]">Registration</a>
                <a href="#overview" class="hover:text-[#1B365D]">Overview</a>
            </div>
        </div>
    </footer>

</body>
</html>
