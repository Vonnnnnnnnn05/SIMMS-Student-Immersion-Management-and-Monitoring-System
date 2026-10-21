<?php

namespace App\Controllers;

use App\Models\DailyLogModel;
use App\Models\ProgressModel;
use App\Models\DeploymentModel;
use App\Models\StudentModel;

class LogController extends BaseController
{
    protected DailyLogModel $dailyLogModel;
    protected ProgressModel $progressModel;
    protected DeploymentModel $deploymentModel;
    protected StudentModel $studentModel;

    public function __construct()
    {
        $this->dailyLogModel    = new DailyLogModel();
        $this->progressModel    = new ProgressModel();
        $this->deploymentModel  = new DeploymentModel();
        $this->studentModel     = new StudentModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $db   = \Config\Database::connect();

        if ($role === 'student') {
            $student = $this->studentModel->where('user_id', session()->get('user_id'))->first();
            $studentId = (int) ($student['student_id'] ?? 0);

            $logs = $this->dailyLogModel
                ->where('student_id', $studentId)
                ->orderBy('log_date', 'DESC')
                ->findAll();

            $progress = $this->progressModel->where('student_id', $studentId)->first();

            return view('student/logs', [
                'title'       => 'Daily Time Record (DTR) & Work Accomplishments',
                'logs'        => $logs,
                'progress'    => $progress,
                'isStudent'   => true,
                'studentId'   => $studentId,
            ]);
        }

        // Faculty or Agency or Admin viewing all logs
        $builder = $db->table('daily_logs')
            ->select('daily_logs.*, users.first_name, users.last_name, students.course, agencies.name as agency_name')
            ->join('students', 'students.student_id = daily_logs.student_id')
            ->join('users', 'users.user_id = students.user_id')
            ->join('deployment', 'deployment.student_id = students.student_id AND deployment.status = "active"', 'left')
            ->join('agencies', 'agencies.agency_id = deployment.agency_id', 'left')
            ->orderBy('daily_logs.log_date', 'DESC');

        $logs = $builder->get()->getResultArray();

        return view('student/logs', [
            'title'     => 'Immersion Attendance & DTR Verification Desk',
            'logs'      => $logs,
            'isStudent' => false,
            'progress'  => null,
        ]);
    }

    public function store()
    {
        $student = $this->studentModel->where('user_id', session()->get('user_id'))->first();
        if (! $student) {
            return redirect()->back()->with('error', 'Student profile not found.');
        }

        $studentId     = (int) $student['student_id'];
        $logDate       = $this->request->getPost('log_date');
        $timeIn        = $this->request->getPost('time_in');
        $timeOut       = $this->request->getPost('time_out');
        $hoursRendered = (float) $this->request->getPost('hours_rendered');
        $tasksDone     = trim($this->request->getPost('tasks_done') ?? '');

        if (empty($logDate) || $hoursRendered <= 0 || empty($tasksDone)) {
            return redirect()->back()->with('error', 'Please enter a valid work date, hours, and accomplishment summary.');
        }

        $this->dailyLogModel->insert([
            'student_id'     => $studentId,
            'log_date'       => $logDate,
            'time_in'        => $timeIn ?: null,
            'time_out'       => $timeOut ?: null,
            'hours_rendered' => $hoursRendered,
            'tasks_done'     => $tasksDone,
            'status'         => 'pending',
        ]);

        return redirect()->to(base_url('logs'))->with('success', 'Daily attendance and tasks logged! Pending supervisor verification.');
    }

    public function approve($id)
    {
        $log = $this->dailyLogModel->find($id);
        if (! $log) {
            return redirect()->back()->with('error', 'Daily log not found.');
        }

        $this->dailyLogModel->update($id, [
            'status'             => 'approved',
            'supervisor_remarks' => 'Verified and credited by supervisor.',
        ]);

        // Recalculate student total progress
        $studentId = $log['student_id'];
        $db = \Config\Database::connect();
        $sumResult = $db->table('daily_logs')
            ->selectSum('hours_rendered', 'total_rendered')
            ->where('student_id', $studentId)
            ->where('status', 'approved')
            ->get()->getRowArray();

        $totalApproved = (float) ($sumResult['total_rendered'] ?? 0);

        $progress = $this->progressModel->where('student_id', $studentId)->first();
        $required = (float) ($progress['required_hours'] ?? 80.00);

        // Automated Immersion Completion Trigger (Sprint 8)
        $isCompleted = ($totalApproved >= $required);
        $completionDate = $isCompleted ? date('Y-m-d') : null;
        $status = $isCompleted ? 'completed' : 'in_progress';

        $this->progressModel->where('student_id', $studentId)->set([
            'total_hours'     => $totalApproved,
            'status'          => $status,
            'completion_date' => $completionDate,
        ])->update();

        if ($isCompleted) {
            $this->deploymentModel->where('student_id', $studentId)->set([
                'status'   => 'completed',
                'end_date' => date('Y-m-d'),
            ])->update();
        }

        $msg = "Log approved. Cumulative rendered hours updated to {$totalApproved} hrs.";
        if ($isCompleted) {
            $msg .= " Immersion quota fulfilled! Student status automatically transitioned to Completed!";
        }

        return redirect()->to(base_url('logs'))->with('success', $msg);
    }

    public function reject($id)
    {
        $remarks = trim($this->request->getPost('remarks') ?? 'Log rejected by supervisor.');
        $this->dailyLogModel->update($id, [
            'status'             => 'rejected',
            'supervisor_remarks' => $remarks,
        ]);

        return redirect()->to(base_url('logs'))->with('success', 'Daily log rejected with remarks.');
    }
}
