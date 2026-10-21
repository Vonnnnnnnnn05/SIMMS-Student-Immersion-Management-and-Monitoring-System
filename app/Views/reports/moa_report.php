<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Memorandum of Agreement (MOA) Partnership Status Report
</div>
<p class="text-center text-muted small mb-4">Official roster of accredited host training establishments & institutional industry linkages</p>

<table class="table-report mb-4">
    <thead>
        <tr>
            <th class="ps-2">MOA Ref</th>
            <th>Host Partner Establishment</th>
            <th>Establishment Address</th>
            <th>Focal Person / Supervisor</th>
            <th>MOA Effective Period</th>
            <th class="text-center">Quota</th>
            <th class="text-center">MOA Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($moaList as $m): ?>
            <tr>
                <td class="ps-2 fw-bold text-muted">#MOA-<?= $m['moa_id'] ?></td>
                <td class="fw-semibold text-dark"><?= esc($m['agency_name']) ?></td>
                <td class="small"><?= esc($m['address']) ?></td>
                <td class="small">
                    <div><?= esc($m['contact_person']) ?></div>
                    <div class="text-muted"><?= esc($m['contact_no']) ?></div>
                </td>
                <td class="small">
                    <?= date('M d, Y', strtotime($m['start_date'])) ?> &mdash; <?= $m['end_date'] ? date('M d, Y', strtotime($m['end_date'])) : 'Open' ?>
                </td>
                <td class="text-center fw-bold"><?= esc($m['capacity']) ?> slots</td>
                <td class="text-center">
                    <span class="badge bg-<?= $m['status'] === 'active' ? 'success' : 'warning text-dark' ?>">
                        <?= strtoupper($m['status']) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="p-3 bg-light border rounded mb-4 small" style="line-height: 1.6;">
    <strong>Linkages Certification:</strong> This document certifies that the listed partner industry establishments maintain active and verified Memoranda of Agreement (MOA) in full compliance with institutional immersion policies, CHED/DepEd internship guidelines, and health & safety standards.
</div>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance, MIT</div>
        <div class="text-muted small">Industry Linkages Coordinator</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">University Legal & Executive Counsel</div>
        <div class="text-muted small">Office of the University President</div>
    </div>
</div>
<?= $this->endSection() ?>
