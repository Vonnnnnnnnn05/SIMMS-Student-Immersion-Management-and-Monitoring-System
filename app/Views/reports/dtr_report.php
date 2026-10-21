<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Daily Time Record (DTR) & Certificate of Completion
</div>

<div class="row mb-4">
    <div class="col-8">
        <table class="table table-sm table-bordered">
            <tr>
                <th width="35%" class="bg-light">Student Trainee:</th>
                <td><strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong></td>
            </tr>
            <tr>
                <th class="bg-light">Course / Strand:</th>
                <td><?= esc($student['course'] ?? 'N/A') ?></td>
            </tr>
            <tr>
                <th class="bg-light">Training Establishment:</th>
                <td><strong><?= esc($deployment['agency_name'] ?? 'Partner Establishment') ?></strong></td>
            </tr>
            <tr>
                <th class="bg-light">Supervisor:</th>
                <td><?= esc($deployment['contact_person'] ?? 'Supervisor') ?></td>
            </tr>
        </table>
    </div>
    <div class="col-4">
        <div class="border p-3 rounded bg-light text-center">
            <span class="small text-muted text-uppercase fw-semibold">Total Rendered Hours</span>
            <h2 class="fw-bold text-primary mb-1"><?= number_format($progress['total_hours'] ?? 0, 1) ?> hrs</h2>
            <div class="small fw-semibold <?= ($progress['total_hours'] >= $progress['required_hours']) ? 'text-success' : 'text-warning' ?>">
                <?= ($progress['total_hours'] >= $progress['required_hours']) ? '&#10004; Quota Completed' : 'In Progress' ?>
            </div>
        </div>
    </div>
</div>

<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-2">Itemized Daily Time Log Entries</h6>
<table class="table-report mb-4">
    <thead>
        <tr>
            <th width="15%" class="ps-2">Date</th>
            <th width="15%" class="text-center">Time In</th>
            <th width="15%" class="text-center">Time Out</th>
            <th width="12%" class="text-center">Hours</th>
            <th>Accomplishments / Narrative Tasks</th>
            <th width="12%" class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($logs)): ?>
            <tr><td colspan="6" class="text-center py-3 text-muted">No DTR attendance entries logged.</td></tr>
        <?php else: ?>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td class="ps-2 fw-semibold"><?= date('M d, Y', strtotime($log['log_date'])) ?></td>
                    <td class="text-center small"><?= esc($log['time_in'] ?? '08:00:00') ?></td>
                    <td class="text-center small"><?= esc($log['time_out'] ?? '17:00:00') ?></td>
                    <td class="text-center fw-bold"><?= number_format($log['hours_rendered'], 1) ?></td>
                    <td class="small"><?= esc($log['tasks_done']) ?></td>
                    <td class="text-center">
                        <span class="badge bg-<?= $log['status'] === 'approved' ? 'success' : 'warning text-dark' ?>">
                            <?= ucfirst($log['status']) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr class="table-light">
            <th colspan="3" class="text-end ps-2">Total Verified Hours:</th>
            <th class="text-center fw-bold text-primary"><?= number_format($progress['total_hours'] ?? 0, 1) ?> hrs</th>
            <th colspan="2" class="small text-muted">Required: <?= number_format($progress['required_hours'] ?? 80, 0) ?> Hours</th>
        </tr>
    </tfoot>
</table>

<!-- Completion Certificate Statement -->
<div class="p-3 bg-light border rounded mb-4" style="text-align: justify; font-size: 0.9rem;">
    <strong>Institutional Certification:</strong> This document certifies that <strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong> has rendered a total of <strong><?= number_format($progress['total_hours'] ?? 0, 1) ?> hours</strong> of industry immersion under the direct supervision of <?= esc($deployment['agency_name'] ?? 'Host Establishment') ?>, fulfilling all requirements of the immersion curriculum.
</div>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small"><?= esc($deployment['contact_person'] ?? 'Host Agency Supervisor') ?></div>
        <div class="text-muted small">Supervisor Signature over Printed Name</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance, MIT</div>
        <div class="text-muted small">Faculty Practicum Coordinator</div>
    </div>
</div>
<?= $this->endSection() ?>
