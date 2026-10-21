<?= $this->extend('layouts/print') ?>

<?= $this->section('print_content') ?>
<div class="mb-4">
    <div class="text-end text-muted small mb-4">
        Date: <?= date('F d, Y') ?>
    </div>

    <div class="mb-4">
        <strong><?= esc($placement['contact_person'] ?? 'The Human Resources Director') ?></strong><br>
        <?= esc($placement['agency_name'] ?? 'Host Training Establishment') ?><br>
        <?= esc($placement['agency_address'] ?? 'Corporate Office Address') ?>
    </div>

    <div class="mb-3">
        <strong>Dear <?= esc($placement['contact_person'] ?? 'Sir/Madam') ?>:</strong>
    </div>

    <p style="text-align: justify; line-height: 1.6;">
        Greetings from the institution!
    </p>

    <p style="text-align: justify; line-height: 1.6;">
        In partial fulfillment of the academic requirements for the degree program <strong><?= esc($student['course'] ?? 'Information Technology') ?></strong>, our students are required to undergo a comprehensive on-the-job training / industry immersion for a minimum of <strong>80 hours</strong>. This program aims to bridge classroom theoretical knowledge with practical industry competencies, corporate ethics, and cutting-edge operational workflows.
    </p>

    <p style="text-align: justify; line-height: 1.6;">
        In this regard, we take great pride in formally endorsing our student trainee, <strong><?= esc($student['first_name'] . ' ' . $student['last_name']) ?></strong> (Reference: #SIMMS-<?= str_pad($student['student_id'], 4, '0', STR_PAD_LEFT) ?>), to render his/her immersion in your esteemed establishment. We are confident that <?= esc($student['first_name']) ?> possesses the foundational discipline, technical aptitude, and professionalism to be an asset to your team.
    </p>

    <p style="text-align: justify; line-height: 1.6;">
        Attached herewith are the trainee's Personal Information Sheet, Parent/Guardian Consent, and Medical Clearance for your perusal. Thank you very much for your continuous partnership in developing future industry professionals.
    </p>

    <div class="mt-4">
        Very truly yours,<br><br><br>
        <strong>Prof. Eleanor Vance, MIT</strong><br>
        <span>Immersion & Practicum Coordinator</span><br>
        <span class="text-muted small">College of Information and Communications Technology</span>
    </div>

    <div class="mt-5 pt-3 border-top">
        <h6 class="fw-bold small text-uppercase">Partner Establishment Acceptance Confirmation:</h6>
        <div class="row mt-4">
            <div class="col-6">
                <div class="signature-line" style="width: 80%;"></div>
                <div class="small fw-semibold">Signature over Printed Name</div>
                <div class="text-muted small">Authorized Establishment Representative</div>
            </div>
            <div class="col-6 text-end">
                <div class="signature-line ms-auto" style="width: 80%;"></div>
                <div class="small fw-semibold">Date of Official Acceptance</div>
                <div class="text-muted small">Designated Training Department</div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
