<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AgencyModel;
use App\Models\StudentAgencyModel;
use App\Models\DeploymentModel;
use App\Models\ApplicationLetterModel;

class DeploymentController extends BaseController
{
    protected StudentModel $studentModel;
    protected AgencyModel $agencyModel;
    protected StudentAgencyModel $studentAgencyModel;
    protected DeploymentModel $deploymentModel;
    protected ApplicationLetterModel $applicationLetterModel;

    public function __construct()
    {
        $this->studentModel          = new StudentModel();
        $this->agencyModel           = new AgencyModel();
        $this->studentAgencyModel    = new StudentAgencyModel();
        $this->deploymentModel       = new DeploymentModel();
        $this->applicationLetterModel = new ApplicationLetterModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $deployments = $db->table('deployment')
            ->select('deployment.*, users.first_name, users.last_name, students.course, agencies.name as agency_name, agencies.contact_person')
            ->join('students', 'students.student_id = deployment.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id')
            ->orderBy('deployment.deployment_id', 'DESC')
            ->get()->getResultArray();

        // Approved students awaiting deployment assignment
        $approvedStudents = $db->table('student_agency')
            ->select('student_agency.*, students.student_id, users.first_name, users.last_name, agencies.agency_id, agencies.name as agency_name')
            ->join('students', 'students.student_id = student_agency.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->where('student_agency.status', 'approved')
            ->get()->getResultArray();

        return view('faculty/deployment', [
            'title'            => 'Student Placement & Deployment Scheduling',
            'deployments'      => $deployments,
            'approvedStudents' => $approvedStudents,
        ]);
    }

    public function assign()
    {
        $studentId = (int) $this->request->getPost('student_id');
        $agencyId  = (int) $this->request->getPost('agency_id');
        $startDate = $this->request->getPost('start_date');
        $endDate   = $this->request->getPost('end_date');

        if (! $studentId || ! $agencyId || empty($startDate)) {
            return redirect()->back()->with('error', 'Please specify student, partner agency, and immersion start date.');
        }

        // Check if existing deployment
        $existing = $this->deploymentModel
            ->where('student_id', $studentId)
            ->first();

        if ($existing) {
            $this->deploymentModel->update($existing['deployment_id'], [
                'agency_id'  => $agencyId,
                'start_date' => $startDate,
                'end_date'   => $endDate ?: null,
                'status'     => 'active',
            ]);
        } else {
            $this->deploymentModel->insert([
                'student_id' => $studentId,
                'agency_id'  => $agencyId,
                'start_date' => $startDate,
                'end_date'   => $endDate ?: null,
                'status'     => 'active',
            ]);
        }

        return redirect()->to(base_url('deployment'))->with('success', 'Student officially deployed and scheduled.');
    }

    public function generateLetter($studentId)
    {
        $db = \Config\Database::connect();
        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        $placement = $db->table('student_agency')
            ->select('student_agency.*, agencies.name as agency_name, agencies.address, agencies.contact_person')
            ->join('agencies', 'agencies.agency_id = student_agency.agency_id')
            ->where('student_agency.student_id', $studentId)
            ->where('student_agency.status', 'approved')
            ->get()->getRowArray();

        if (! $student || ! $placement) {
            return redirect()->back()->with('error', 'Student must have an approved agency selection to generate an application letter.');
        }

        // Log generated letter
        $this->applicationLetterModel->insert([
            'student_id'     => $studentId,
            'agency_id'      => $placement['agency_id'],
            'date_generated' => date('Y-m-d'),
            'letter_content' => 'Official application and endorsement letter issued.',
        ]);

        return redirect()->to(base_url('reports/application-letter/' . $studentId));
    }
}
