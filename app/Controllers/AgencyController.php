<?php

namespace App\Controllers;

use App\Models\AgencyModel;
use App\Models\DeploymentModel;
use App\Models\DailyLogModel;
use App\Models\EvaluationModel;
use App\Models\MoaModel;

class AgencyController extends BaseController
{
    protected AgencyModel $agencyModel;
    protected DeploymentModel $deploymentModel;
    protected DailyLogModel $dailyLogModel;
    protected EvaluationModel $evaluationModel;
    protected MoaModel $moaModel;

    public function __construct()
    {
        $this->agencyModel     = new AgencyModel();
        $this->deploymentModel  = new DeploymentModel();
        $this->dailyLogModel    = new DailyLogModel();
        $this->evaluationModel  = new EvaluationModel();
        $this->moaModel         = new MoaModel();
    }

    protected function getAgencyId(): int
    {
        $email = session()->get('email');
        $agency = $this->agencyModel->where('email', $email)->first();
        return (int) ($agency['agency_id'] ?? 1);
    }

    public function dashboard()
    {
        $agencyId = $this->getAgencyId();
        $db = \Config\Database::connect();

        $agency = $this->agencyModel->find($agencyId);
        $moa = $this->moaModel->where('agency_id', $agencyId)->first();

        $traineesCount = $this->deploymentModel
            ->where('agency_id', $agencyId)
            ->where('status', 'active')
            ->countAllResults();

        // Pending log approvals
        $pendingLogsCount = $db->table('daily_logs')
            ->join('deployment', 'deployment.student_id = daily_logs.student_id')
            ->where('deployment.agency_id', $agencyId)
            ->where('daily_logs.status', 'pending')
            ->countAllResults();

        $evaluationsCount = $this->evaluationModel
            ->where('agency_id', $agencyId)
            ->countAllResults();

        return view('agency/dashboard', [
            'title'            => 'Partner Agency Supervisor Desk',
            'agency'           => $agency,
            'moa'              => $moa,
            'traineesCount'    => $traineesCount,
            'pendingLogsCount' => $pendingLogsCount,
            'evaluationsCount' => $evaluationsCount,
        ]);
    }

    public function trainees()
    {
        $agencyId = $this->getAgencyId();
        $db = \Config\Database::connect();

        $trainees = $db->table('deployment')
            ->select('deployment.*, students.student_id, students.course, students.contact_no, users.first_name, users.last_name, users.email, progress.total_hours, progress.required_hours, progress.status as progress_status, evaluations.evaluation_id, evaluations.rating')
            ->join('students', 'students.student_id = deployment.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('progress', 'progress.student_id = students.student_id', 'left')
            ->join('evaluations', 'evaluations.student_id = students.student_id AND evaluations.agency_id = deployment.agency_id', 'left')
            ->where('deployment.agency_id', $agencyId)
            ->get()->getResultArray();

        return view('agency/trainees', [
            'title'    => 'Assigned Student Trainees',
            'trainees' => $trainees,
        ]);
    }

    public function profile()
    {
        $agencyId = $this->getAgencyId();
        $agency = $this->agencyModel->find($agencyId);
        $moa = $this->moaModel->where('agency_id', $agencyId)->first();

        return view('agency/profile', [
            'title'  => 'Partner Establishment Profile & MOA',
            'agency' => $agency,
            'moa'    => $moa,
        ]);
    }

    public function updateProfile()
    {
        $agencyId = $this->getAgencyId();

        $data = [
            'address'        => trim($this->request->getPost('address') ?? ''),
            'contact_person' => trim($this->request->getPost('contact_person') ?? ''),
            'contact_no'     => trim($this->request->getPost('contact_no') ?? ''),
        ];

        $this->agencyModel->update($agencyId, $data);

        return redirect()->to(base_url('agency/profile'))->with('success', 'Agency details updated successfully.');
    }
}
