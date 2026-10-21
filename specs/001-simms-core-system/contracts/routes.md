# Interface Contracts: Web Routes & Controllers

**Feature**: `001-simms-core-system`  
**Framework**: CodeIgniter 4 Routes (`app/Config/Routes.php`)  
**Security Filter**: `AuthFilter` (`app/Filters/AuthFilter.php`)  

---

## 1. Authentication & Public Routes (`AuthController`)

| HTTP Method | Route | Controller Method | Access | Description | View Rendered / Action |
|-------------|-------|-------------------|--------|-------------|------------------------|
| `GET` | `/` | `AuthController::login` | Public | Entry point | `app/Views/auth/login.php` |
| `GET` | `/login` | `AuthController::login` | Public | Login form | `app/Views/auth/login.php` |
| `POST` | `/login/authenticate` | `AuthController::authenticate` | Public | Validate credentials | Redirects to role dashboard |
| `GET` | `/register` | `AuthController::register` | Public | Student self-registration | `app/Views/auth/register.php` |
| `POST` | `/register/store` | `AuthController::storeRegister` | Public | Create student account | Redirects to `/login` with flash |
| `GET` | `/logout` | `AuthController::logout` | Authenticated | Destroy session | Redirects to `/login` |

---

## 2. Administrator Module (`AdminController`)
**Filter Guard**: `AuthFilter` (Role: `admin`)

| HTTP Method | Route | Controller Method | Description | View Rendered / Action |
|-------------|-------|-------------------|-------------|------------------------|
| `GET` | `/admin/dashboard` | `AdminController::dashboard` | Admin analytics & metric cards | `app/Views/admin/dashboard.php` |
| `GET` | `/admin/users` | `AdminController::users` | User accounts listing | `app/Views/admin/users.php` |
| `POST` | `/admin/users/create` | `AdminController::createUser` | Create faculty/agency/admin user | JSON / Redirect with flash |
| `POST` | `/admin/users/toggle/:id` | `AdminController::toggleUserStatus` | Activate / Deactivate user | Redirect to `/admin/users` |
| `GET` | `/admin/faculty` | `AdminController::faculty` | Faculty profile assignments | `app/Views/admin/faculty.php` |
| `GET` | `/admin/subjects` | `AdminController::subjects` | Subject & hours setup | `app/Views/admin/subjects.php` |
| `POST` | `/admin/subjects/save` | `AdminController::saveSubject` | Add/update immersion subject | Redirect to `/admin/subjects` |
| `GET` | `/admin/settings` | `AdminController::settings` | System terms & configurations | `app/Views/admin/settings.php` |

---

## 3. Faculty Module (`FacultyController`)
**Filter Guard**: `AuthFilter` (Role: `faculty` or `admin`)

| HTTP Method | Route | Controller Method | Description | View Rendered / Action |
|-------------|-------|-------------------|-------------|------------------------|
| `GET` | `/faculty/dashboard` | `FacultyController::dashboard` | Coordinator dashboard | `app/Views/faculty/dashboard.php` |
| `GET` | `/faculty/students` | `FacultyController::students` | Assigned advisees list | `app/Views/faculty/students.php` |
| `GET` | `/faculty/student/:id` | `FacultyController::studentDetails` | Student profile & progress | `app/Views/faculty/student_view.php` |
| `GET` | `/faculty/agency-requests` | `FacultyController::agencyRequests` | Pending student agency requests | `app/Views/faculty/agency_requests.php` |
| `POST` | `/faculty/agency-requests/:id/action` | `FacultyController::processAgencyRequest` | Approve / Reject placement | Redirect with flash message |
| `GET` | `/faculty/documents` | `FacultyController::documentSubmissions`| Review uploaded requirements | `app/Views/faculty/documents.php` |
| `POST` | `/faculty/documents/:id/verify` | `FacultyController::verifyDocument` | Approve/Reject document | Redirect with flash message |

---

## 4. Student Module (`StudentController`)
**Filter Guard**: `AuthFilter` (Role: `student`)

| HTTP Method | Route | Controller Method | Description | View Rendered / Action |
|-------------|-------|-------------------|-------------|------------------------|
| `GET` | `/student/dashboard` | `StudentController::dashboard` | Student immersion overview | `app/Views/student/dashboard.php` |
| `GET` | `/student/profile` | `StudentController::profile` | View/edit profile details | `app/Views/student/profile.php` |
| `POST` | `/student/profile/update` | `StudentController::updateProfile` | Save student info & contacts | Redirect to `/student/profile` |
| `GET` | `/student/agencies` | `StudentController::agencies` | Browse accredited partner agencies | `app/Views/student/agencies.php` |
| `POST` | `/student/agencies/select` | `StudentController::selectAgency` | Submit placement choice | Redirect to `/student/agencies` |
| `GET` | `/student/documents` | `StudentController::documents` | Requirement upload tracker | `app/Views/student/documents.php` |
| `POST` | `/student/documents/upload` | `StudentController::uploadDocument` | Upload document attachment | Redirect to `/student/documents` |

---

## 5. Partner Agency Module (`AgencyController`)
**Filter Guard**: `AuthFilter` (Role: `agency` or `admin`)

| HTTP Method | Route | Controller Method | Description | View Rendered / Action |
|-------------|-------|-------------------|-------------|------------------------|
| `GET` | `/agency/dashboard` | `AgencyController::dashboard` | Agency supervisor dashboard | `app/Views/agency/dashboard.php` |
| `GET` | `/agency/trainees` | `AgencyController::trainees` | Assigned student trainees | `app/Views/agency/trainees.php` |
| `GET` | `/agency/profile` | `AgencyController::profile` | Agency information & MOA status | `app/Views/agency/profile.php` |
| `POST` | `/agency/profile/update` | `AgencyController::updateProfile` | Update contact & supervisor info | Redirect to `/agency/profile` |

---

## 6. Deployment & Letter Generation (`DeploymentController`)
**Filter Guard**: `AuthFilter` (Role: `faculty` or `admin`)

| HTTP Method | Route | Controller Method | Description | View Rendered / Action |
|-------------|-------|-------------------|-------------|------------------------|
| `GET` | `/deployment` | `DeploymentController::index` | Deployment masterlist | `app/Views/faculty/deployment.php` |
| `POST` | `/deployment/assign` | `DeploymentController::assign` | Schedule placement & hours | Redirect to `/deployment` |
| `GET` | `/application-letter/generate/:student_id`| `DeploymentController::generateLetter` | Generate formal letter | `app/Views/reports/application_letter.php` |

---

## 7. Daily Logs & DTR (`LogController`)
**Filter Guard**: `AuthFilter` (Authenticated)

| HTTP Method | Route | Controller Method | Role | Description | View Rendered / Action |
|-------------|-------|-------------------|------|-------------|------------------------|
| `GET` | `/logs` | `LogController::index` | Student/Agency | View daily logs & hours summary | `app/Views/student/logs.php` |
| `POST` | `/logs/store` | `LogController::store` | Student | Submit daily time-in/out & task | Redirect to `/logs` |
| `POST` | `/logs/approve/:id` | `LogController::approve` | Agency/Faculty | Approve daily rendered hours | Triggers progress calculation |
| `POST` | `/logs/reject/:id` | `LogController::reject` | Agency/Faculty | Reject daily log with remarks | Redirect to log list |

---

## 8. Real-Time Chat Messaging (`ChatController`)
**Filter Guard**: `AuthFilter` (Authenticated)

| HTTP Method | Route | Controller Method | Description | Output Format |
|-------------|-------|-------------------|-------------|---------------|
| `GET` | `/chat` | `ChatController::index` | Active conversations view | `app/Views/chat/index.php` |
| `GET` | `/chat/messages/:user_id`| `ChatController::getMessages` | Retrieve message history | JSON or partial HTML |
| `POST` | `/chat/send` | `ChatController::sendMessage` | Send message to recipient | JSON response |

---

## 9. Evaluation Module (`EvaluationController`)
**Filter Guard**: `AuthFilter` (Role: `agency`, `faculty`, `admin`)

| HTTP Method | Route | Controller Method | Role | Description | View Rendered / Action |
|-------------|-------|-------------------|------|-------------|------------------------|
| `GET` | `/evaluations` | `EvaluationController::index` | All | Trainee evaluations list | `app/Views/agency/evaluations.php` |
| `GET` | `/evaluations/rate/:student_id`| `EvaluationController::create` | Agency | Evaluation rubric form | `app/Views/agency/evaluation_form.php` |
| `POST` | `/evaluations/store` | `EvaluationController::store` | Agency | Save rubric scores & comments | Redirect to `/evaluations` |
| `GET` | `/evaluations/view/:id` | `EvaluationController::show` | Faculty/Admin | View completed evaluation | `app/Views/reports/evaluation_report.php` |

---

## 10. Printable Reports Module (`ReportController`)
**Filter Guard**: `AuthFilter` (Role: `admin`, `faculty`)

| HTTP Method | Route | Controller Method | Report Type | View Rendered |
|-------------|-------|-------------------|-------------|---------------|
| `GET` | `/reports` | `ReportController::index` | Reports Hub | `app/Views/reports/index.php` |
| `GET` | `/reports/personal-info/:student_id` | `ReportController::personalInfo` | Personal Information Sheet | `app/Views/reports/personal_info.php` |
| `GET` | `/reports/application-letter/:id` | `ReportController::applicationLetter`| Formal Application Letter | `app/Views/reports/application_letter.php` |
| `GET` | `/reports/document-status` | `ReportController::documentStatus`| Submission Status Matrix | `app/Views/reports/document_status.php` |
| `GET` | `/reports/deployment` | `ReportController::deploymentSummary`| Deployment Masterlist | `app/Views/reports/deployment_report.php` |
| `GET` | `/reports/completion-dtr/:student_id` | `ReportController::completionDTR`| DTR & Hours Completion | `app/Views/reports/dtr_report.php` |
| `GET` | `/reports/evaluation/:student_id` | `ReportController::evaluationReport`| Performance Evaluation | `app/Views/reports/evaluation_report.php` |
| `GET` | `/reports/portfolio/:student_id` | `ReportController::portfolio` | Trainee Immersion Portfolio | `app/Views/reports/portfolio_report.php` |
| `GET` | `/reports/moa` | `ReportController::moaReport` | Partner MOA Summary | `app/Views/reports/moa_report.php` |
