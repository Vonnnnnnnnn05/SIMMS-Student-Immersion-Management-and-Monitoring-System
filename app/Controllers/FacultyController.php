<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AgencyModel;
use App\Models\StudentAgencyModel;
use App\Models\StudentDocumentModel;
use App\Models\DeploymentModel;
use App\Models\ProgressModel;
use App\Models\DailyLogModel;

class FacultyController extends BaseController
{
    protected StudentModel $studentModel;
    protected AgencyModel $agencyModel;
    protected StudentAgencyModel $studentAgencyModel;
    protected StudentDocumentModel $studentDocumentModel;
    protected DeploymentModel $deploymentModel;
    protected ProgressModel $progressModel;
    protected DailyLogModel $dailyLogModel;

    public function __construct()
    {
        $this->studentModel         = new StudentModel();
        $this->agencyModel          = new AgencyModel();
        $this->studentAgencyModel   = new StudentAgencyModel();
        $this->studentDocumentModel = new StudentDocumentModel();
        $this->deploymentModel      = new DeploymentModel();
        $this->progressModel        = new ProgressModel();
        $this->dailyLogModel        = new DailyLogModel();
    }

    public function dashboard()
    {
        $db = \Config\Database::connect();

        $data = [
            'title'               => 'Faculty Coordinator Desk',
            'total_students'      => $this->studentModel->countAllResults(),
            'pending_requests'    => $this->studentAgencyModel->where('status', 'pending')->countAllResults(),
            'pending_documents'   => $this->studentDocumentModel->where('status', 'pending')->countAllResults(),
            'active_deployments'  => $this->deploymentModel->where('status', 'active')->countAllResults(),
            'completed_students'  => $this->progressModel->where('status', 'completed')->countAllResults(),
            'pendingAgencyQueue'  => $db->table('student_agency')
                ->select('student_agency.*, users.first_name, users.last_name, agencies.name as agency_name')
                ->join('students', 'students.student_id = student_agency.student_id')
                ->join('users', 'users.user_id = students.user_id')
                ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
                ->where('student_agency.status', 'pending')
                ->limit(5)->get()->getResultArray(),
        ];

        return view('faculty/dashboard', $data);
    }

    public function students()
    {
        $db = \Config\Database::connect();
        $students = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email, progress.total_hours, progress.required_hours, progress.status as progress_status, agencies.name as agency_name')
            ->join('users', 'users.user_id = students.user_id')
            ->join('progress', 'progress.student_id = students.student_id', 'left')
            ->join('deployment', 'deployment.student_id = students.student_id AND deployment.status = "active"', 'left')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id', 'left')
            ->get()->getResultArray();

        return view('faculty/students', [
            'title'    => 'Advisee Immersion Trainees',
            'students' => $students,
        ]);
    }

    public function studentDetails($studentId)
    {
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        if (! $student) {
            return redirect()->to(base_url('faculty/students'))->with('error', 'Student not found.');
        }

        $progress = $this->progressModel->where('student_id', $studentId)->first();
        $deployment = $db->table('deployment')
            ->select('deployment.*, agencies.name as agency_name, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id')
            ->where('deployment.student_id', $studentId)
            ->get()->getRowArray();

        $documents = $db->table('student_documents')
            ->select('student_documents.*, documents.document_name')
            ->join('documents', 'documents.document_id = student_documents.document_id')
            ->where('student_documents.student_id', $studentId)
            ->get()->getResultArray();

        $logs = $this->dailyLogModel
            ->where('student_id', $studentId)
            ->orderBy('log_date', 'DESC')
            ->findAll();

        return view('faculty/student_view', [
            'title'      => 'Trainee Dossier: ' . $student['first_name'] . ' ' . $student['last_name'],
            'student'    => $student,
            'progress'   => $progress,
            'deployment' => $deployment,
            'documents'  => $documents,
            'logs'       => $logs,
        ]);
    }

    public function agencyRequests()
    {
        $db = \Config\Database::connect();
        $requests = $db->table('student_agency')
            ->select('student_agency.*, users.first_name, users.last_name, students.course, agencies.name as agency_name, agencies.address as agency_address')
            ->join('students', 'students.student_id = student_agency.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->orderBy('student_agency.id', 'DESC')
            ->get()->getResultArray();

        return view('faculty/agency_requests', [
            'title'    => 'Student Placement & Agency Requests',
            'requests' => $requests,
        ]);
    }

    public function processAgencyRequest($id)
    {
        $action  = $this->request->getPost('action'); // approved or rejected
        $remarks = trim($this->request->getPost('remarks') ?? '');

        if (! in_array($action, ['approved', 'rejected'], true)) {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $request = $this->studentAgencyModel->find($id);
        if (! $request) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        $this->studentAgencyModel->update($id, [
            'status'  => $action,
            'remarks' => $remarks ?: ($action === 'approved' ? 'Approved for deployment processing.' : 'Placement rejected.'),
        ]);

        return redirect()->to(base_url('faculty/agency-requests'))->with('success', "Placement selection marked as {$action}.");
    }

    public function documentSubmissions()
    {
        $db = \Config\Database::connect();
        $submissions = $db->table('student_documents')
            ->select('student_documents.*, users.first_name, users.last_name, documents.document_name')
            ->join('students', 'students.student_id = student_documents.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('documents', 'documents.document_id = student_documents.document_id')
            ->orderBy('student_documents.student_doc_id', 'DESC')
            ->get()->getResultArray();

        return view('faculty/documents', [
            'title'       => 'Document Verification Desk',
            'submissions' => $submissions,
        ]);
    }

    public function verifyDocument($studentDocId)
    {
        $action  = $this->request->getPost('action'); // approved or rejected
        $remarks = trim($this->request->getPost('remarks') ?? '');

        if (! in_array($action, ['approved', 'rejected'], true)) {
            return redirect()->back()->with('error', 'Invalid action.');
        }

        $this->studentDocumentModel->update($studentDocId, [
            'status'  => $action,
            'remarks' => $remarks ?: ($action === 'approved' ? 'Verified valid by coordinator.' : 'Requirement rejected.'),
        ]);

        return redirect()->to(base_url('faculty/documents'))->with('success', "Document verification updated to {$action}.");
    }
}
