<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Student Trainee Personal Information Sheet
</div>

<div class="mb-4">
    <div class="row g-3">
        <div class="col-8">
            <table class="table table-sm table-bordered">
                <tr>
                    <th width="35%" class="bg-light">Full Name:</th>
                    <td><strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong></td>
                </tr>
                <tr>
                    <th class="bg-light">Trainee Reference ID:</th>
                    <td>#SIMMS-<?= str_pad($student['student_id'], 4, '0', STR_PAD_LEFT) ?></td>
                </tr>
                <tr>
                    <th class="bg-light">Degree Program / Strand:</th>
                    <td><?= esc($student['course'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="bg-light">Academic Year Level:</th>
                    <td><?= esc($student['year_level'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="bg-light">Contact Mobile:</th>
                    <td><?= esc($student['contact_no'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th class="bg-light">Email Address:</th>
                    <td><?= esc($student['email']) ?></td>
                </tr>
                <tr>
                    <th class="bg-light">Permanent Address:</th>
                    <td><?= esc($student['address'] ?? 'N/A') ?></td>
                </tr>
            </table>
        </div>
        <div class="col-4 text-center">
            <div class="border p-4 d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                <span class="text-muted small">2x2 Recent Photograph</span>
            </div>
        </div>
    </div>
</div>

<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3">Emergency & Parent/Guardian Contact</h6>
<table class="table table-sm table-bordered mb-4">
    <tr>
        <th width="30%" class="bg-light">Parent / Guardian Name:</th>
        <td><?= esc($student['guardian_name'] ?? 'Not specified') ?></td>
    </tr>
    <tr>
        <th class="bg-light">Emergency Contact No:</th>
        <td><?= esc($student['guardian_contact'] ?? 'Not specified') ?></td>
    </tr>
</table>

<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-3">Host Establishment Placement</h6>
<table class="table table-sm table-bordered mb-4">
    <tr>
        <th width="30%" class="bg-light">Assigned Partner Agency:</th>
        <td><strong><?= esc($placement['agency_name'] ?? 'Pending Placement') ?></strong></td>
    </tr>
    <tr>
        <th class="bg-light">Corporate Address:</th>
        <td><?= esc($placement['agency_address'] ?? 'N/A') ?></td>
    </tr>
    <tr>
        <th class="bg-light">Placement Status:</th>
        <td><?= strtoupper(esc($placement['status'] ?? 'pending')) ?></td>
    </tr>
</table>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small"><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></div>
        <div class="text-muted small">Student Trainee Signature</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance</div>
        <div class="text-muted small">Immersion Coordinator / Adviser</div>
    </div>
</div>
<?= $this->endSection() ?>
