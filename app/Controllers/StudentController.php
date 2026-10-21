<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AgencyModel;
use App\Models\StudentAgencyModel;
use App\Models\DocumentModel;
use App\Models\StudentDocumentModel;
use App\Models\DeploymentModel;
use App\Models\DailyLogModel;
use App\Models\ProgressModel;

class StudentController extends BaseController
{
    protected StudentModel $studentModel;
    protected AgencyModel $agencyModel;
    protected StudentAgencyModel $studentAgencyModel;
    protected DocumentModel $documentModel;
    protected StudentDocumentModel $studentDocumentModel;
    protected DeploymentModel $deploymentModel;
    protected DailyLogModel $dailyLogModel;
    protected ProgressModel $progressModel;

    public function __construct()
    {
        $this->studentModel         = new StudentModel();
        $this->agencyModel          = new AgencyModel();
        $this->studentAgencyModel   = new StudentAgencyModel();
        $this->documentModel        = new DocumentModel();
        $this->studentDocumentModel = new StudentDocumentModel();
        $this->deploymentModel      = new DeploymentModel();
        $this->dailyLogModel        = new DailyLogModel();
        $this->progressModel        = new ProgressModel();
    }

    protected function getStudentId(): int
    {
        $userId = (int) session()->get('user_id');
        $student = $this->studentModel->where('user_id', $userId)->first();
        return (int) ($student['student_id'] ?? 0);
    }

    public function dashboard()
    {
        $studentId = $this->getStudentId();
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $progress = $this->progressModel->where('student_id', $studentId)->first();
        if (! $progress) {
            $this->progressModel->insert([
                'student_id'     => $studentId,
                'total_hours'    => 0.00,
                'required_hours' => 80.00,
                'status'         => 'in_progress',
            ]);
            $progress = $this->progressModel->where('student_id', $studentId)->first();
        }

        // Active placement
        $placement = $db->table('student_agency')
            ->select('student_agency.*, agencies.name as agency_name, agencies.address, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->where('student_agency.student_id', $studentId)
            ->orderBy('student_agency.id', 'DESC')
            ->get()->getRowArray();

        // Documents status
        $totalDocs = $this->documentModel->countAllResults();
        $approvedDocs = $this->studentDocumentModel
            ->where('student_id', $studentId)
            ->where('status', 'approved')
            ->countAllResults();

        // Recent Logs
        $recentLogs = $this->dailyLogModel
            ->where('student_id', $studentId)
            ->orderBy('log_date', 'DESC')
            ->findAll(5);

        return view('student/dashboard', [
            'title'        => 'Student Immersion Dashboard',
            'student'      => $student,
            'progress'     => $progress,
            'placement'    => $placement,
            'totalDocs'    => $totalDocs,
            'approvedDocs' => $approvedDocs,
            'recentLogs'   => $recentLogs,
        ]);
    }

    public function profile()
    {
        $studentId = $this->getStudentId();
        $db = \Config\Database::connect();

        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        return view('student/profile', [
            'title'   => 'My Trainee Profile',
            'student' => $student,
        ]);
    }

    public function updateProfile()
    {
        $studentId = $this->getStudentId();

        $data = [
            'course'           => trim($this->request->getPost('course') ?? ''),
            'year_level'       => trim($this->request->getPost('year_level') ?? ''),
            'contact_no'       => trim($this->request->getPost('contact_no') ?? ''),
            'address'          => trim($this->request->getPost('address') ?? ''),
            'guardian_name'    => trim($this->request->getPost('guardian_name') ?? ''),
            'guardian_contact' => trim($this->request->getPost('guardian_contact') ?? ''),
        ];

        $this->studentModel->update($studentId, $data);

        return redirect()->to(base_url('student/profile'))->with('success', 'Profile information updated successfully.');
    }

    public function agencies()
    {
        $studentId = $this->getStudentId();
        $agencies  = $this->agencyModel->where('status', 'active')->findAll();

        $existingSelection = $this->studentAgencyModel
            ->where('student_id', $studentId)
            ->orderBy('id', 'DESC')
            ->first();

        return view('student/agencies', [
            'title'             => 'Accredited Partner Agencies',
            'agencies'          => $agencies,
            'existingSelection' => $existingSelection,
        ]);
    }

    public function selectAgency()
    {
        $studentId = $this->getStudentId();
        $agencyId  = (int) $this->request->getPost('agency_id');

        if (! $agencyId) {
            return redirect()->back()->with('error', 'Please select a valid partner agency.');
        }

        // Check if existing pending or approved request
        $existing = $this->studentAgencyModel
            ->where('student_id', $studentId)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You already have an active or pending agency selection.');
        }

        $this->studentAgencyModel->insert([
            'student_id'    => $studentId,
            'agency_id'     => $agencyId,
            'status'        => 'pending',
            'date_selected' => date('Y-m-d'),
            'remarks'       => 'Pending Faculty Coordinator review and endorsement.',
        ]);

        return redirect()->to(base_url('student/agencies'))->with('success', 'Agency selection submitted! Awaiting coordinator review.');
    }

    public function documents()
    {
        $studentId = $this->getStudentId();
        $allDocs   = $this->documentModel->findAll();

        $db = \Config\Database::connect();
        $submissions = $db->table('student_documents')
            ->where('student_id', $studentId)
            ->get()->getResultArray();

        $subMap = [];
        foreach ($submissions as $sub) {
            $subMap[$sub['document_id']] = $sub;
        }

        return view('student/documents', [
            'title'       => 'Pre-Immersion Requirements',
            'allDocs'     => $allDocs,
            'submissions' => $subMap,
        ]);
    }

    public function uploadDocument()
    {
        $studentId  = $this->getStudentId();
        $documentId = (int) $this->request->getPost('document_id');
        $file       = $this->request->getFile('document_file');

        if (! $file || ! $file->isValid()) {
            return redirect()->back()->with('error', 'Please choose a valid document file to upload.');
        }

        // Ensure target directory exists
        $uploadDir = WRITEPATH . 'uploads/documents/';
        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newName = $studentId . '_' . $documentId . '_' . time() . '.' . $file->getExtension();
        $file->move($uploadDir, $newName);

        $existing = $this->studentDocumentModel
            ->where('student_id', $studentId)
            ->where('document_id', $documentId)
            ->first();

        if ($existing) {
            $this->studentDocumentModel->update($existing['student_doc_id'], [
                'file_path'   => 'uploads/documents/' . $newName,
                'status'      => 'pending',
                'remarks'     => 'Re-uploaded document pending verification.',
                'uploaded_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $this->studentDocumentModel->insert([
                'student_id'  => $studentId,
                'document_id' => $documentId,
                'file_path'   => 'uploads/documents/' . $newName,
                'status'      => 'pending',
                'remarks'     => 'Initial document upload submitted.',
                'uploaded_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to(base_url('student/documents'))->with('success', 'Document successfully uploaded! Faculty will review it shortly.');
    }
}
