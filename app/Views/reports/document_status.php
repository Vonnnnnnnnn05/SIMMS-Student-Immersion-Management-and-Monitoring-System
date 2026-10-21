<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="report-header-title">
    Document Submission & Requirement Compliance Report
</div>
<p class="text-center text-muted small mb-4">Official institutional matrix tracking student pre-immersion clearance documents</p>

<table class="table-report mb-4">
    <thead>
        <tr>
            <th class="ps-2">Student Trainee</th>
            <th>Program</th>
            <?php foreach ($documents as $doc): ?>
                <th class="text-center"><?= esc($doc['document_name']) ?></th>
            <?php endforeach; ?>
            <th class="text-center">Compliance</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $st): ?>
            <?php 
                $approvedCount = 0;
                $totalMandatory = count($documents);
            ?>
            <tr>
                <td class="ps-2 fw-semibold"><?= esc($st['first_name'] . ' ' . $st['last_name']) ?></td>
                <td class="small"><?= esc($st['course']) ?></td>
                <?php foreach ($documents as $doc): ?>
                    <?php 
                        $status = $subMap[$st['student_id']][$doc['document_id']] ?? 'missing';
                        if ($status === 'approved') {
                            $approvedCount++;
                        }
                    ?>
                    <td class="text-center">
                        <?php if ($status === 'approved'): ?>
                            <span class="text-success fw-bold">&#10004; Verified</span>
                        <?php elseif ($status === 'pending'): ?>
                            <span class="text-warning">&#9203; Pending</span>
                        <?php else: ?>
                            <span class="text-danger">&#10008; Missing</span>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
                <td class="text-center fw-bold">
                    <?php if ($approvedCount === $totalMandatory): ?>
                        <span class="text-success">100% Complete</span>
                    <?php else: ?>
                        <span class="text-muted"><?= round(($approvedCount / max(1, $totalMandatory)) * 100) ?>% Complete</span>
                    <?php endif; ?>
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
        <div class="text-muted small">Practicum Coordinator</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="fw-bold small">Dean of Academic Affairs</div>
        <div class="text-muted small">College of Computer Studies</div>
    </div>
</div>
<?= $this->endSection() ?>
