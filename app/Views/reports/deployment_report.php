<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Immersion Deployment & Placement Masterlist
</div>
<p class="text-center text-muted small mb-4">Official roster of student trainees assigned to partner host establishments &bull; Academic Term 2026-2027</p>

<table class="table-report mb-4">
    <thead>
        <tr>
            <th class="ps-2">Ref #</th>
            <th>Student Trainee</th>
            <th>Degree Program</th>
            <th>Assigned Host Agency</th>
            <th>Supervisor</th>
            <th>Immersion Schedule</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($deployments as $dep): ?>
            <tr>
                <td class="ps-2 fw-bold text-muted">#DEP-<?= $dep['deployment_id'] ?></td>
                <td class="fw-semibold"><?= esc($dep['first_name'] . ' ' . $dep['last_name']) ?></td>
                <td class="small"><?= esc($dep['course']) ?></td>
                <td><strong><?= esc($dep['agency_name']) ?></strong></td>
                <td><?= esc($dep['contact_person'] ?? 'TBD') ?></td>
                <td class="small">
                    <?= date('M d, Y', strtotime($dep['start_date'])) ?> &mdash; <?= $dep['end_date'] ? date('M d, Y', strtotime($dep['end_date'])) : 'Open' ?>
                </td>
                <td class="text-center">
                    <span class="badge bg-<?= $dep['status'] === 'active' ? 'success' : ($dep['status'] === 'completed' ? 'primary' : 'secondary') ?>">
                        <?= strtoupper($dep['status']) ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance, MIT</div>
        <div class="text-muted small">Immersion Coordinator</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Institutional Director</div>
        <div class="text-muted small">Office of Student Affairs & Linkages</div>
    </div>
</div>
<?= $this->endSection() ?>
