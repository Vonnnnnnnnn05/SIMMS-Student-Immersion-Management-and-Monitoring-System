<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;
use App\Models\FacultyModel;
use App\Models\AgencyModel;
use App\Models\ProgressModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;
    protected StudentModel $studentModel;
    protected FacultyModel $facultyModel;
    protected AgencyModel $agencyModel;
    protected ProgressModel $progressModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
        $this->facultyModel = new FacultyModel();
        $this->agencyModel = new AgencyModel();
        $this->progressModel = new ProgressModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return $this->redirectByRole(session()->get('role'));
        }

        return view('auth/login', [
            'title' => 'Sign In',
        ]);
    }

    public function authenticate()
    {
        $email = trim($this->request->getPost('email') ?? '');
        $password = (string) $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Please enter your email and password.');
        }

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid email or password credentials.');
        }

        if ($user['status'] !== 'active') {
            return redirect()->back()->with('error', 'Your account is currently inactive or pending approval.');
        }

        // Retrieve role-specific primary keys
        $roleRefId = null;
        if ($user['role'] === 'student') {
            $student = $this->studentModel->where('user_id', $user['user_id'])->first();
            $roleRefId = $student['student_id'] ?? null;
        } elseif ($user['role'] === 'faculty') {
            $faculty = $this->facultyModel->where('user_id', $user['user_id'])->first();
            $roleRefId = $faculty['faculty_id'] ?? null;
        } elseif ($user['role'] === 'agency') {
            // Find agency record by email or user ID
            $agency = $this->agencyModel->where('email', $user['email'])->first();
            $roleRefId = $agency['agency_id'] ?? null;
        }

        // Set session
        session()->set([
            'user_id' => $user['user_id'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'role_ref_id' => $roleRefId,
            'logged_in' => true,
        ]);

        return $this->redirectByRole($user['role'])->with('success', 'Welcome back, ' . $user['first_name'] . '!');
    }

    public function register()
    {
        if (session()->get('logged_in')) {
            return $this->redirectByRole(session()->get('role'));
        }

        return view('auth/register', [
            'title' => 'Student Registration',
        ]);
    }

    public function storeRegister()
    {
        $firstName = trim($this->request->getPost('first_name') ?? '');
        $lastName = trim($this->request->getPost('last_name') ?? '');
        $email = trim($this->request->getPost('email') ?? '');
        $password = (string) $this->request->getPost('password');
        $course = trim($this->request->getPost('course') ?? '');
        $yearLevel = trim($this->request->getPost('year_level') ?? '');
        $contactNo = trim($this->request->getPost('contact_no') ?? '');

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Please complete all required fields.');
        }

        // Check if email already registered
        if ($this->userModel->where('email', $email)->first()) {
            return redirect()->back()->with('error', 'This email address is already registered.');
        }

        // Create User record
        $userId = $this->userModel->insert([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => 'student',
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Create Student profile
        $studentId = $this->studentModel->insert([
            'user_id' => $userId,
            'course' => $course,
            'year_level' => $yearLevel,
            'contact_no' => $contactNo,
        ]);

        // Initialize progress
        $this->progressModel->insert([
            'student_id' => $studentId,
            'total_hours' => 0.00,
            'required_hours' => 80.00,
            'status' => 'in_progress',
        ]);

        return redirect()->to(base_url('login'))->with('success', 'Registration successful! You may now sign in to your student portal.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))->with('info', 'You have been safely signed out.');
    }

    protected function redirectByRole(string $role)
    {
        return match ($role) {
            'admin' => redirect()->to(base_url('admin/dashboard')),
            'faculty' => redirect()->to(base_url('faculty/dashboard')),
            'student' => redirect()->to(base_url('student/dashboard')),
            'agency' => redirect()->to(base_url('agency/dashboard')),
            default => redirect()->to(base_url('login')),
        };
    }
}
