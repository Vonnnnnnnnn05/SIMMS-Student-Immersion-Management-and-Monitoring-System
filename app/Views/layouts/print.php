<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($report_title ?? 'Official Immersion Report') ?> - SIMMS</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
            margin: 0;
            padding: 2rem 0;
        }
        .document-paper {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm 20mm 25mm 20mm;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            position: relative;
            box-sizing: border-box;
        }
        .letterhead {
            border-bottom: 2px solid #1B365D;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .letterhead h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1B365D;
        }
        .letterhead p {
            margin: 0;
            font-size: 0.85rem;
            color: #475569;
        }
        .report-header-title {
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
            margin-bottom: 1.5rem;
            color: #1B365D;
        }
        /* Crisp Printable Table System */
        table, .table, .table-report, .table-bordered {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 0.85rem !important;
            margin-top: 1rem !important;
            margin-bottom: 1.5rem !important;
            border: 1.5px solid #475569 !important;
        }
        table th, .table th, .table-report th, .table-bordered th {
            background-color: #f1f5f9 !important;
            border: 1px solid #64748b !important;
            padding: 8px 10px !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            color: #1B365D !important;
            text-transform: uppercase !important;
            letter-spacing: 0.03em !important;
        }
        table td, .table td, .table-report td, .table-bordered td {
            border: 1px solid #94a3b8 !important;
            padding: 8px 10px !important;
            font-size: 0.8125rem !important;
            color: #0f172a !important;
            vertical-align: middle !important;
        }
        .table-sm th, .table-sm td {
            padding: 5px 8px !important;
            font-size: 0.75rem !important;
        }

        /* Printable Grid & Utility Helpers */
        .row { display: flex; flex-wrap: wrap; margin-left: -0.5rem; margin-right: -0.5rem; }
        .col-8 { flex: 0 0 66.666667%; max-width: 66.666667%; padding-left: 0.5rem; padding-right: 0.5rem; box-sizing: border-box; }
        .col-4 { flex: 0 0 33.333333%; max-width: 33.333333%; padding-left: 0.5rem; padding-right: 0.5rem; box-sizing: border-box; }
        .col-6 { flex: 0 0 50%; max-width: 50%; padding-left: 0.5rem; padding-right: 0.5rem; box-sizing: border-box; }
        .col-12 { flex: 0 0 100%; max-width: 100%; padding-left: 0.5rem; padding-right: 0.5rem; box-sizing: border-box; }
        .mb-1 { margin-bottom: 0.25rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        .mb-3 { margin-bottom: 0.75rem !important; }
        .mb-4 { margin-bottom: 1rem !important; }
        .pb-1 { padding-bottom: 0.25rem !important; }
        .pb-2 { padding-bottom: 0.5rem !important; }
        .p-2 { padding: 0.5rem !important; }
        .p-3 { padding: 0.75rem !important; }
        .border { border: 1px solid #cbd5e1 !important; }
        .border-bottom { border-bottom: 1px solid #cbd5e1 !important; }
        .rounded { border-radius: 0.5rem !important; }
        .bg-light { background-color: #f8fafc !important; }
        .text-center { text-align: center !important; }
        .text-right, .text-end { text-align: right !important; }
        .fw-bold { font-weight: 700 !important; }
        .fw-semibold { font-weight: 600 !important; }
        .text-muted { color: #64748b !important; }
        .text-primary { color: #1B365D !important; }
        .text-success { color: #166534 !important; }
        .text-warning { color: #b45309 !important; }
        .text-danger { color: #dc2626 !important; }
        .text-uppercase { text-transform: uppercase !important; }
        .small { font-size: 0.75rem !important; }
        .d-flex { display: flex !important; }
        .align-items-center { align-items: center !important; }
        .justify-content-center { justify-content: center !important; }
        .justify-content-between { justify-content: space-between !important; }
        .g-3 { gap: 0.75rem !important; }
        .signature-section {
            margin-top: 3.5rem;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-line {
            border-bottom: 1px solid #0f172a;
            margin-bottom: 0.5rem;
            padding-top: 2rem;
        }

        /* Print Controls */
        .print-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            gap: 10px;
        }
        .btn-print {
            background-color: #E5A93C;
            color: #1B365D;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-back {
            background-color: #1B365D;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.8rem;
            padding: 0.6rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }
        .btn-print:hover { background-color: #d4962b; }
        .btn-back:hover { background-color: #152a48; }

        /* Screen vs Print rules */
        @media print {
            body {
                background: none;
                padding: 0;
            }
            .document-paper {
                box-shadow: none;
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 1.5cm;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Action Buttons -->
    <div class="print-controls no-print">
        <button onclick="window.print()" class="btn-print">
            <svg style="width:14px;height:14px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            <span>Print / Save as PDF</span>
        </button>
        <button onclick="window.history.back()" class="btn-back">
            <svg style="width:14px;height:14px" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            <span>Return to Portal</span>
        </button>
    </div>

    <!-- Document Paper Sheet -->
    <div class="document-paper">
        <!-- Institutional Letterhead -->
        <div class="letterhead">
            <h5>Student Immersion Management and Monitoring System</h5>
            <p>Industry Practicum & On-the-Job Training Coordination Office</p>
            <p style="font-size:0.75rem; color:#64748b; margin-top:2px;">Institutional Document Engine &bull; Academic Term 2026-2027</p>
        </div>

        <!-- Dynamic Content Body -->
        <?= $this->renderSection('print_content') ?>

        <!-- Official Certification Footer -->
        <div style="margin-top:2.5rem; padding-top:0.75rem; border-top:1px solid #e2e8f0; font-size:0.75rem; color:#64748b; display:flex; justify-content:space-between; align-items:center;">
            <span>Official Document Generated by SIMMS &bull; Authenticated via System Records</span>
            <span>Date: <?= date('F d, Y h:i A') ?></span>
        </div>
    </div>

</body>
</html>
