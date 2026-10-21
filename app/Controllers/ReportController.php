<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\FacultyModel;
use App\Models\AgencyModel;
use App\Models\DocumentModel;
use App\Models\StudentDocumentModel;
use App\Models\DeploymentModel;
use App\Models\DailyLogModel;
use App\Models\ProgressModel;
use App\Models\EvaluationModel;
use App\Models\MoaModel;
use App\Models\ReportModel;

class ReportController extends BaseController
{
    protected StudentModel $studentModel;
    protected FacultyModel $facultyModel;
    protected AgencyModel $agencyModel;
    protected DocumentModel $documentModel;
    protected StudentDocumentModel $studentDocumentModel;
    protected DeploymentModel $deploymentModel;
    protected DailyLogModel $dailyLogModel;
    protected ProgressModel $progressModel;
    protected EvaluationModel $evaluationModel;
    protected MoaModel $moaModel;
    protected ReportModel $reportModel;

    public function __construct()
    {
        $this->studentModel         = new StudentModel();
        $this->facultyModel         = new FacultyModel();
        $this->agencyModel          = new AgencyModel();
        $this->documentModel        = new DocumentModel();
        $this->studentDocumentModel = new StudentDocumentModel();
        $this->deploymentModel      = new DeploymentModel();
        $this->dailyLogModel        = new DailyLogModel();
        $this->progressModel        = new ProgressModel();
        $this->evaluationModel      = new EvaluationModel();
        $this->moaModel             = new MoaModel();
        $this->reportModel          = new ReportModel();
    }

    protected function logReport(string $type, ?int $studentId = null)
    {
        $this->reportModel->insert([
            'student_id'   => $studentId,
            'report_type'  => $type,
            'generated_by' => (int) session()->get('user_id'),
            'generated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $students = $db->table('students')
            ->select('students.student_id, users.first_name, users.last_name, students.course')
            ->join('users', 'users.user_id = students.user_id')
            ->get()->getResultArray();

        return view('reports/index', [
            'title'    => 'Institutional Immersion Reports Engine',
            'students' => $students,
        ]);
    }

    // 1. Personal Information Report
    public function personalInfo($studentId = null)
    {
        $studentId = (int) ($studentId ?: session()->get('role_ref_id'));
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $placement = $db->table('student_agency')
            ->select('student_agency.*, agencies.name as agency_name, agencies.address as agency_address')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->where('student_agency.student_id', $studentId)
            ->get()->getRowArray();

        $this->logReport('personal_info', $studentId);

        return view('reports/personal_info', [
            'report_title' => 'Student Personal Information Sheet',
            'student'      => $student,
            'placement'    => $placement,
        ]);
    }

    // 2. Application Letter Report
    public function applicationLetter($studentId = null)
    {
        $studentId = (int) ($studentId ?: session()->get('role_ref_id'));
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $placement = $db->table('student_agency')
            ->select('student_agency.*, agencies.name as agency_name, agencies.address as agency_address, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->where('student_agency.student_id', $studentId)
            ->get()->getRowArray();

        $this->logReport('application_letter', $studentId);

        return view('reports/application_letter', [
            'report_title' => 'Formal Immersion Endorsement & Application Letter',
            'student'      => $student,
            'placement'    => $placement,
        ]);
    }

    // 3. Document Submission Status Report
    public function documentStatus()
    {
        $db = \Config\Database::connect();
        $matrix = $db->table('students')
            ->select('students.student_id, users.first_name, users.last_name, students.course')
            ->join('users', 'users.user_id = students.user_id')
            ->get()->getResultArray();

        $documents = $this->documentModel->findAll();

        $submissions = $db->table('student_documents')->get()->getResultArray();
        $subMap = [];
        foreach ($submissions as $sub) {
            $subMap[$sub['student_id']][$sub['document_id']] = $sub['status'];
        }

        $this->logReport('document_status');

        return view('reports/document_status', [
            'report_title' => 'Student Requirement & Document Submission Status Report',
            'students'     => $matrix,
            'documents'    => $documents,
            'subMap'       => $subMap,
        ]);
    }

    // 4. Deployment Masterlist Report
    public function deploymentSummary()
    {
        $db = \Config\Database::connect();
        $deployments = $db->table('deployment')
            ->select('deployment.*, users.first_name, users.last_name, students.course, agencies.name as agency_name, agencies.contact_person')
            ->join('students', 'students.student_id = deployment.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id')
            ->get()->getResultArray();

        $this->logReport('deployment_masterlist');

        return view('reports/deployment_report', [
            'report_title' => 'Immersion Deployment & Student Placement Masterlist',
            'deployments'  => $deployments,
        ]);
    }

    // 5. Completion / DTR Report
    public function completionDTR($studentId = null)
    {
        $studentId = (int) ($studentId ?: session()->get('role_ref_id'));
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $progress = $this->progressModel->where('student_id', $studentId)->first();
        $logs = $this->dailyLogModel
            ->where('student_id', $studentId)
            ->orderBy('log_date', 'ASC')
            ->findAll();

        $deployment = $db->table('deployment')
            ->select('deployment.*, agencies.name as agency_name, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id')
            ->where('deployment.student_id', $studentId)
            ->get()->getRowArray();

        $this->logReport('completion_dtr', $studentId);

        return view('reports/dtr_report', [
            'report_title' => 'Daily Time Record (DTR) & Certificate of Completion',
            'student'      => $student,
            'progress'     => $progress,
            'logs'         => $logs,
            'deployment'   => $deployment,
        ]);
    }

    // 6. Performance Evaluation Report
    public function evaluationReport($studentId = null)
    {
        $studentId = (int) ($studentId ?: session()->get('role_ref_id'));
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $evaluation = $db->table('evaluations')
            ->select('evaluations.*, agencies.name as agency_name, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = evaluations.agency_id')
            ->where('evaluations.student_id', $studentId)
            ->get()->getRowArray();

        $this->logReport('evaluation_report', $studentId);

        return view('reports/evaluation_report', [
            'report_title' => 'Trainee Performance Evaluation Report',
            'student'      => $student,
            'evaluation'   => $evaluation,
        ]);
    }

    // 7. Student Immersion Portfolio
    public function portfolio($studentId = null)
    {
        $studentId = (int) ($studentId ?: session()->get('role_ref_id'));
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $progress = $this->progressModel->where('student_id', $studentId)->first();
        $deployment = $db->table('deployment')
            ->select('deployment.*, agencies.name as agency_name, agencies.address as agency_address, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id')
            ->where('deployment.student_id', $studentId)
            ->get()->getRowArray();

        $logs = $this->dailyLogModel
            ->where('student_id', $studentId)
            ->orderBy('log_date', 'ASC')
            ->findAll();

        $evaluation = $this->evaluationModel
            ->where('student_id', $studentId)
            ->first();

        $documents = $db->table('student_documents')
            ->select('student_documents.*, documents.document_name')
            ->join('documents', 'documents.document_id = student_documents.document_id')
            ->where('student_documents.student_id', $studentId)
            ->get()->getResultArray();

        $this->logReport('portfolio_report', $studentId);

        return view('reports/portfolio_report', [
            'report_title' => 'Official Immersion Trainee Portfolio',
            'student'      => $student,
            'progress'     => $progress,
            'deployment'   => $deployment,
            'logs'         => $logs,
            'evaluation'   => $evaluation,
            'documents'    => $documents,
        ]);
    }

    // 8. MOA Partnership Report
    public function moaReport()
    {
        $db = \Config\Database::connect();
        $moaList = $db->table('moa')
            ->select('moa.*, agencies.name as agency_name, agencies.address, agencies.contact_person, agencies.contact_no, agencies.capacity')
            ->join('agencies', 'agencies.agency_id = moa.agency_id')
            ->get()->getResultArray();

        $this->logReport('moa_summary');

        return view('reports/moa_report', [
            'report_title' => 'Memorandum of Agreement (MOA) Partnership Status Report',
            'moaList'      => $moaList,
        ]);
    }
}
