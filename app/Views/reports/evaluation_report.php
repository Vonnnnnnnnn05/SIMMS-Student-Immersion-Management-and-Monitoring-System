<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Trainee Performance Evaluation Report
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
                <th class="bg-light">Host Training Establishment:</th>
                <td><strong><?= esc($evaluation['agency_name'] ?? 'Partner Establishment') ?></strong></td>
            </tr>
            <tr>
                <th class="bg-light">Evaluating Supervisor:</th>
                <td><?= esc($evaluation['contact_person'] ?? 'Supervisor') ?></td>
            </tr>
        </table>
    </div>
    <div class="col-4">
        <div class="border p-3 rounded bg-light text-center">
            <span class="small text-muted text-uppercase fw-semibold">Composite Performance Rating</span>
            <h2 class="fw-bold text-primary mb-1"><?= number_format($evaluation['rating'] ?? 0, 2) ?> <span class="fs-6 text-muted">/ 5.0</span></h2>
            <div class="small fw-semibold text-success">
                <?php 
                    $r = (float) ($evaluation['rating'] ?? 0);
                    if ($r >= 4.5) echo 'Outstanding';
                    elseif ($r >= 3.5) echo 'Very Satisfactory';
                    elseif ($r >= 2.5) echo 'Satisfactory';
                    else echo 'Fair';
                ?>
            </div>
        </div>
    </div>
</div>

<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-2">Itemized Rubric Criteria Ratings (Scale 1.0 - 5.0)</h6>
<?php 
    $comp = [];
    if (!empty($evaluation['competencies'])) {
        $comp = json_decode($evaluation['competencies'], true) ?: [];
    }
?>
<table class="table-report mb-4">
    <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th>Competency / Performance Dimension</th>
            <th width="20%" class="text-center">Score (Max: 5.0)</th>
            <th width="25%" class="text-center">Descriptive Rating</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center">1</td>
            <td><strong>Quality of Work & Technical Competence:</strong> Accuracy, problem solving, mastery of technical tools.</td>
            <td class="text-center fw-bold"><?= number_format($comp['quality_of_work'] ?? 5, 1) ?></td>
            <td class="text-center small">Outstanding</td>
        </tr>
        <tr>
            <td class="text-center">2</td>
            <td><strong>Communication & Interpersonal Skills:</strong> Collaboration, professional ethics, prompt reporting.</td>
            <td class="text-center fw-bold"><?= number_format($comp['communication'] ?? 5, 1) ?></td>
            <td class="text-center small">Outstanding</td>
        </tr>
        <tr>
            <td class="text-center">3</td>
            <td><strong>Attendance & Punctuality:</strong> Adherence to corporate shift schedules and diligence.</td>
            <td class="text-center fw-bold"><?= number_format($comp['punctuality'] ?? 5, 1) ?></td>
            <td class="text-center small">Outstanding</td>
        </tr>
        <tr>
            <td class="text-center">4</td>
            <td><strong>Initiative & Professional Attitude:</strong> Willingness to take on tasks, proactiveness, resourcefulness.</td>
            <td class="text-center fw-bold"><?= number_format($comp['initiative'] ?? 4, 1) ?></td>
            <td class="text-center small">Very Satisfactory</td>
        </tr>
        <tr>
            <td class="text-center">5</td>
            <td><strong>Teamwork & Organizational Fit:</strong> Positive interaction with team members and company staff.</td>
            <td class="text-center fw-bold"><?= number_format($comp['teamwork'] ?? 5, 1) ?></td>
            <td class="text-center small">Outstanding</td>
        </tr>
    </tbody>
</table>

<h6 class="fw-bold text-uppercase border-bottom pb-1 mb-2">Supervisor Qualitative Remarks & Growth Feedback</h6>
<div class="p-3 bg-light border rounded mb-4" style="line-height: 1.6; font-size: 0.95rem;">
    "<?= esc($evaluation['feedback'] ?? 'The student trainee exhibited exemplary dedication, technical aptitude, and professionalism throughout the entire immersion period.') ?>"
</div>

<!-- Signatures -->
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small"><?= esc($evaluation['contact_person'] ?? 'Host Agency Supervisor') ?></div>
        <div class="text-muted small">Designated Immediate Supervisor</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Prof. Eleanor Vance, MIT</div>
        <div class="text-muted small">Practicum Coordinator & Faculty Reviewer</div>
    </div>
</div>
<?= $this->endSection() ?>
