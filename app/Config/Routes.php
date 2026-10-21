<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// 1. Authentication & Public Access
$routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::login');
$routes->post('login/authenticate', 'AuthController::authenticate');
$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::storeRegister');
$routes->get('logout', 'AuthController::logout');

// 2. Administrator Module
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('users', 'AdminController::users');
    $routes->post('users/create', 'AdminController::createUser');
    $routes->post('users/toggle/(:num)', 'AdminController::toggleUserStatus/$1');
    $routes->get('faculty', 'AdminController::faculty');
    $routes->get('subjects', 'AdminController::subjects');
    $routes->post('subjects/save', 'AdminController::saveSubject');
    $routes->get('settings', 'AdminController::settings');
});

// 3. Faculty Coordinator Module
$routes->group('faculty', ['filter' => 'auth:faculty,admin'], static function ($routes) {
    $routes->get('dashboard', 'FacultyController::dashboard');
    $routes->get('students', 'FacultyController::students');
    $routes->get('student/(:num)', 'FacultyController::studentDetails/$1');
    $routes->get('agency-requests', 'FacultyController::agencyRequests');
    $routes->post('agency-requests/(:num)/action', 'FacultyController::processAgencyRequest/$1');
    $routes->get('documents', 'FacultyController::documentSubmissions');
    $routes->post('documents/(:num)/verify', 'FacultyController::verifyDocument/$1');
});

// 4. Student Trainee Module
$routes->group('student', ['filter' => 'auth:student'], static function ($routes) {
    $routes->get('dashboard', 'StudentController::dashboard');
    $routes->get('profile', 'StudentController::profile');
    $routes->post('profile/update', 'StudentController::updateProfile');
    $routes->get('agencies', 'StudentController::agencies');
    $routes->post('agencies/select', 'StudentController::selectAgency');
    $routes->get('documents', 'StudentController::documents');
    $routes->post('documents/upload', 'StudentController::uploadDocument');
});

// 5. Partner Host Agency Module
$routes->group('agency', ['filter' => 'auth:agency,admin'], static function ($routes) {
    $routes->get('dashboard', 'AgencyController::dashboard');
    $routes->get('trainees', 'AgencyController::trainees');
    $routes->get('profile', 'AgencyController::profile');
    $routes->post('profile/update', 'AgencyController::updateProfile');
});

// 6. Deployment & Letter Generation
$routes->group('deployment', ['filter' => 'auth:faculty,admin'], static function ($routes) {
    $routes->get('/', 'DeploymentController::index');
    $routes->post('assign', 'DeploymentController::assign');
});
$routes->get('application-letter/generate/(:num)', 'DeploymentController::generateLetter/$1', ['filter' => 'auth:faculty,admin']);

// 7. Daily Time Record (DTR) & Logs
$routes->group('logs', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'LogController::index');
    $routes->post('store', 'LogController::store');
    $routes->post('approve/(:num)', 'LogController::approve/$1');
    $routes->post('reject/(:num)', 'LogController::reject/$1');
});

// 8. Immersion Messaging / Chat System
$routes->group('chat', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'ChatController::index');
    $routes->post('send', 'ChatController::sendMessage');
});

// 9. Performance Evaluations
$routes->group('evaluations', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'EvaluationController::index');
    $routes->get('rate/(:num)', 'EvaluationController::create/$1');
    $routes->post('store', 'EvaluationController::store');
    $routes->get('view/(:num)', 'EvaluationController::show/$1');
});

// 10. Printable Reports Engine
$routes->group('reports', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'ReportController::index');
    $routes->get('personal-info/(:num)', 'ReportController::personalInfo/$1');
    $routes->get('application-letter/(:num)', 'ReportController::applicationLetter/$1');
    $routes->get('document-status', 'ReportController::documentStatus');
    $routes->get('deployment', 'ReportController::deploymentSummary');
    $routes->get('completion-dtr/(:num)', 'ReportController::completionDTR/$1');
    $routes->get('evaluation/(:num)', 'ReportController::evaluationReport/$1');
    $routes->get('portfolio/(:num)', 'ReportController::portfolio/$1');
    $routes->get('moa', 'ReportController::moaReport');
});
