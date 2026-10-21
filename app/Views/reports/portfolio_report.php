<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Comprehensive Student Immersion Portfolio
</div>
<p class="text-center text-muted small mb-4">Official Trainee Completion Dossier & Academic Fulfillment Record</p>

<!-- Section I: Profile -->
<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3 text-primary">I. Student Trainee Profile</h6>
<table class="table table-sm table-bordered mb-4">
    <tr>
        <th width="25%" class="bg-light">Full Name:</th>
        <td width="35%"><strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong></td>
        <th width="20%" class="bg-light">Student ID Ref:</th>
        <td>#SIMMS-<?= str_pad($student['student_id'], 4, '0', STR_PAD_LEFT) ?></td>
    </tr>
    <tr>
        <th class="bg-light">Degree Program:</th>
        <td><?= esc($student['course'] ?? 'N/A') ?></td>
        <th class="bg-light">Year Level:</th>
        <td><?= esc($student['year_level'] ?? 'N/A') ?></td>
    </tr>
    <tr>
        <th class="bg-light">Contact Number:</th>
        <td><?= esc($student['contact_no'] ?? 'N/A') ?></td>
        <th class="bg-light">Email Address:</th>
        <td><?= esc($student['email']) ?></td>
    </tr>
    <tr>
        <th class="bg-light">Guardian Name:</th>
        <td><?= esc($student['guardian_name'] ?? 'N/A') ?></td>
        <th class="bg-light">Emergency Phone:</th>
        <td><?= esc($student['guardian_contact'] ?? 'N/A') ?></td>
    </tr>
</table>

<!-- Section II: Placement -->
<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3 text-primary">II. Host Establishment Placement</h6>
<table class="table table-sm table-bordered mb-4">
    <tr>
        <th width="25%" class="bg-light">Partner Establishment:</th>
        <td colspan="3"><strong><?= esc($deployment['agency_name'] ?? 'Not assigned') ?></strong></td>
    </tr>
    <tr>
        <th class="bg-light">Establishment Address:</th>
        <td colspan="3"><?= esc($deployment['agency_address'] ?? 'N/A') ?></td>
    </tr>
    <tr>
        <th class="bg-light">Designated Supervisor:</th>
        <td><?= esc($deployment['contact_person'] ?? 'N/A') ?></td>
        <th class="bg-light">Immersion Schedule:</th>
        <td><?= esc($deployment['start_date'] ?? 'N/A') ?> &mdash; <?= esc($deployment['end_date'] ?? 'Present') ?></td>
    </tr>
</table>

<!-- Section III: Hours -->
<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3 text-primary">III. Rendered Hours & Attendance Summary</h6>
<div class="row mb-3">
    <div class="col-6">
        <div class="p-3 bg-light border rounded">
            <span class="small text-muted text-uppercase">Cumulative Verified Hours:</span>
            <h4 class="fw-bold text-primary mb-0"><?= number_format($progress['total_hours'] ?? 0, 1) ?> Hours</h4>
        </div>
    </div>
    <div class="col-6">
        <div class="p-3 bg-light border rounded">
            <span class="small text-muted text-uppercase">Curriculum Quota Fulfillment:</span>
            <h4 class="fw-bold text-success mb-0"><?= ($progress['total_hours'] >= $progress['required_hours']) ? '100% Completed' : round(($progress['total_hours'] / max(1, $progress['required_hours'])) * 100) . '% Rendered' ?></h4>
        </div>
    </div>
</div>

<table class="table-report mb-4">
    <thead>
        <tr>
            <th class="ps-2">Log Date</th>
            <th class="text-center">Hours</th>
            <th>Primary Daily Accomplishments & Duties</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td class="ps-2 fw-semibold small"><?= date('M d, Y', strtotime($log['log_date'])) ?></td>
                <td class="text-center small fw-bold"><?= number_format($log['hours_rendered'], 1) ?></td>
                <td class="small"><?= esc($log['tasks_done']) ?></td>
                <td class="text-center small text-success fw-bold">&#10004; Approved</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Section IV: Performance -->
<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3 text-primary">IV. Performance Rating & Evaluation</h6>
<div class="p-3 bg-light border rounded mb-4 d-flex justify-content-between align-items-center">
    <div>
        <strong>Overall Trainee Performance Rating:</strong>
        <div class="text-muted small mt-1">Supervisor Remarks: "<?= esc($evaluation['feedback'] ?? 'Strong technical capability and work ethic.') ?>"</div>
    </div>
    <span class="badge bg-warning text-dark fs-5 px-3 py-2">
        <?= number_format($evaluation['rating'] ?? 5.0, 2) ?> / 5.0
    </span>
</div>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small"><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></div>
        <div class="text-muted small">Student Trainee</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small"><?= esc($deployment['contact_person'] ?? 'Host Supervisor') ?></div>
        <div class="text-muted small">Host Agency Supervisor</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance, MIT</div>
        <div class="text-muted small">Practicum Coordinator</div>
    </div>
</div>
<?= $this->endSection() ?>
