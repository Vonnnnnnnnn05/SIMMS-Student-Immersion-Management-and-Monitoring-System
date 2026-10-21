<?php

namespace App\Controllers;

use App\Models\EvaluationModel;
use App\Models\StudentModel;
use App\Models\AgencyModel;
use App\Models\DeploymentModel;

class EvaluationController extends BaseController
{
    protected EvaluationModel $evaluationModel;
    protected StudentModel $studentModel;
    protected AgencyModel $agencyModel;
    protected DeploymentModel $deploymentModel;

    public function __construct()
    {
        $this->evaluationModel = new EvaluationModel();
        $this->studentModel    = new StudentModel();
        $this->agencyModel     = new AgencyModel();
        $this->deploymentModel = new DeploymentModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $role = session()->get('role');
        $agencyId = (int) session()->get('role_ref_id');

        $builder = $db->table('evaluations')
            ->select('evaluations.*, users.first_name, users.last_name, students.course, agencies.name as agency_name')
            ->join('students', 'students.student_id = evaluations.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('agencies', 'agencies.agency_id = evaluations.agency_id')
            ->orderBy('evaluations.evaluation_id', 'DESC');

        if ($role === 'agency' && $agencyId) {
            $builder->where('evaluations.agency_id', $agencyId);
        }

        $evaluations = $builder->get()->getResultArray();

        return view('agency/evaluations', [
            'title'       => 'Trainee Performance Evaluations',
            'evaluations' => $evaluations,
            'role'        => $role,
        ]);
    }

    public function create($studentId)
    {
        $db = \Config\Database::connect();
        $student = $db->table('students')
            ->select('students.*, users.first_name, users.last_name, users.email')
            ->join('users', 'users.user_id = students.user_id')
            ->where('students.student_id', $studentId)
            ->get()->getRowArray();

        if (! $student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        $deployment = $this->deploymentModel->where('student_id', $studentId)->first();
        $agencyId = (int) ($deployment['agency_id'] ?? 1);

        $existing = $this->evaluationModel
            ->where('student_id', $studentId)
            ->where('agency_id', $agencyId)
            ->first();

        return view('agency/evaluation_form', [
            'title'      => 'Evaluate Trainee: ' . $student['first_name'] . ' ' . $student['last_name'],
            'student'    => $student,
            'agencyId'   => $agencyId,
            'existing'   => $existing,
        ]);
    }

    public function store()
    {
        $studentId = (int) $this->request->getPost('student_id');
        $agencyId  = (int) $this->request->getPost('agency_id');

        $quality       = (float) $this->request->getPost('quality_of_work');
        $communication = (float) $this->request->getPost('communication');
        $punctuality   = (float) $this->request->getPost('punctuality');
        $initiative    = (float) $this->request->getPost('initiative');
        $teamwork      = (float) $this->request->getPost('teamwork');
        $feedback      = trim($this->request->getPost('feedback') ?? '');

        // Calculate average composite rating (out of 5.0)
        $rating = round(($quality + $communication + $punctuality + $initiative + $teamwork) / 5, 2);

        $competencies = json_encode([
            'quality_of_work' => $quality,
            'communication'   => $communication,
            'punctuality'     => $punctuality,
            'initiative'      => $initiative,
            'teamwork'        => $teamwork,
        ]);

        $existing = $this->evaluationModel
            ->where('student_id', $studentId)
            ->where('agency_id', $agencyId)
            ->first();

        if ($existing) {
            $this->evaluationModel->update($existing['evaluation_id'], [
                'rating'       => $rating,
                'competencies' => $competencies,
                'feedback'     => $feedback,
                'evaluated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $this->evaluationModel->insert([
                'student_id'   => $studentId,
                'agency_id'    => $agencyId,
                'rating'       => $rating,
                'competencies' => $competencies,
                'feedback'     => $feedback,
                'evaluated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to(base_url('evaluations'))->with('success', 'Trainee performance evaluation submitted successfully.');
    }

    public function show($id)
    {
        return redirect()->to(base_url('reports/evaluation/' . $id));
    }
}
