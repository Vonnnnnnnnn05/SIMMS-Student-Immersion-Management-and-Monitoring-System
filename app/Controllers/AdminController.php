<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;
use App\Models\FacultyModel;
use App\Models\AgencyModel;
use App\Models\SubjectModel;
use App\Models\DeploymentModel;
use App\Models\ProgressModel;
use App\Models\MoaModel;

class AdminController extends BaseController
{
    protected UserModel $userModel;
    protected StudentModel $studentModel;
    protected FacultyModel $facultyModel;
    protected AgencyModel $agencyModel;
    protected SubjectModel $subjectModel;
    protected DeploymentModel $deploymentModel;
    protected ProgressModel $progressModel;
    protected MoaModel $moaModel;

    public function __construct()
    {
        $this->userModel       = new UserModel();
        $this->studentModel     = new StudentModel();
        $this->facultyModel     = new FacultyModel();
        $this->agencyModel      = new AgencyModel();
        $this->subjectModel     = new SubjectModel();
        $this->deploymentModel  = new DeploymentModel();
        $this->progressModel    = new ProgressModel();
        $this->moaModel         = new MoaModel();
    }

    public function dashboard()
    {
        $data = [
            'title'              => 'Administrator Dashboard',
            'total_students'     => $this->studentModel->countAllResults(),
            'total_faculty'      => $this->facultyModel->countAllResults(),
            'total_agencies'     => $this->agencyModel->countAllResults(),
            'active_deployments' => $this->deploymentModel->where('status', 'active')->countAllResults(),
            'completed_students' => $this->progressModel->where('status', 'completed')->countAllResults(),
            'active_moa'         => $this->moaModel->where('status', 'active')->countAllResults(),
            'recent_users'       => $this->userModel->orderBy('created_at', 'DESC')->findAll(6),
        ];

        return view('admin/dashboard', $data);
    }

    public function users()
    {
        $users = $this->userModel->orderBy('user_id', 'DESC')->findAll();

        return view('admin/users', [
            'title' => 'User Account Management',
            'users' => $users,
        ]);
    }

    public function createUser()
    {
        $firstName = trim($this->request->getPost('first_name') ?? '');
        $lastName  = trim($this->request->getPost('last_name') ?? '');
        $email     = trim($this->request->getPost('email') ?? '');
        $password  = (string) $this->request->getPost('password');
        $role      = trim($this->request->getPost('role') ?? 'faculty');

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Please fill in all required fields.');
        }

        if ($this->userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'A user with this email already exists.');
        }

        $userId = $this->userModel->insert([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'role'       => $role,
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($role === 'faculty') {
            $department = trim($this->request->getPost('department') ?? 'College of Computing');
            $contactNo  = trim($this->request->getPost('contact_no') ?? '09XXXXXXXXX');
            $this->facultyModel->insert([
                'user_id'    => $userId,
                'department' => $department,
                'contact_no' => $contactNo,
            ]);
        } elseif ($role === 'agency') {
            $agencyName = trim($this->request->getPost('agency_name') ?? ($firstName . ' ' . $lastName . ' Firm'));
            $this->agencyModel->insert([
                'name'           => $agencyName,
                'address'        => 'Metro Manila',
                'contact_person' => $firstName . ' ' . $lastName,
                'contact_no'     => '09XXXXXXXXX',
                'email'          => $email,
                'status'         => 'active',
            ]);
        }

        return redirect()->to(base_url('admin/users'))->with('success', 'New user account provisioned successfully.');
    }

    public function toggleUserStatus($userId)
    {
        $user = $this->userModel->find($userId);
        if (! $user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $newStatus = ($user['status'] === 'active') ? 'inactive' : 'active';
        $this->userModel->update($userId, ['status' => $newStatus]);

        return redirect()->to(base_url('admin/users'))->with('success', "User status updated to {$newStatus}.");
    }

    public function faculty()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('faculty')
            ->select('faculty.*, users.first_name, users.last_name, users.email, users.status')
            ->join('users', 'users.user_id = faculty.user_id');
        $facultyList = $builder->get()->getResultArray();

        return view('admin/faculty', [
            'title'       => 'Faculty Profiles & Coordinators',
            'facultyList' => $facultyList,
        ]);
    }

    public function subjects()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('subjects')
            ->select('subjects.*, users.first_name, users.last_name')
            ->join('faculty', 'faculty.faculty_id = subjects.faculty_id', 'left')
            ->join('users', 'users.user_id = faculty.user_id', 'left');
        $subjects = $builder->get()->getResultArray();

        $allFaculty = $db->table('faculty')
            ->select('faculty.faculty_id, users.first_name, users.last_name')
            ->join('users', 'users.user_id = faculty.user_id')
            ->get()->getResultArray();

        return view('admin/subjects', [
            'title'      => 'Immersion Subjects & Hours Configuration',
            'subjects'   => $subjects,
            'allFaculty' => $allFaculty,
        ]);
    }

    public function saveSubject()
    {
        $subjectName   = trim($this->request->getPost('subject_name') ?? '');
        $facultyId     = (int) $this->request->getPost('faculty_id');
        $requiredHours = (int) ($this->request->getPost('required_hours') ?? 80);

        if (empty($subjectName)) {
            return redirect()->back()->with('error', 'Subject title is required.');
        }

        $this->subjectModel->insert([
            'subject_name'   => $subjectName,
            'faculty_id'     => $facultyId ?: null,
            'required_hours' => $requiredHours,
        ]);

        return redirect()->to(base_url('admin/subjects'))->with('success', 'Immersion subject created successfully.');
    }

    public function settings()
    {
        return view('admin/settings', [
            'title' => 'System Settings & Institutional Configurations',
        ]);
    }
}
