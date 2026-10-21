# Quickstart Validation Guide: SIMMS

**Feature**: `001-simms-core-system`  
**Purpose**: End-to-end runnable validation guide for all 12 Agile Sprints of SIMMS.

---

## 1. Prerequisites & Environment Setup

1. **Web Server & PHP**:
   - PHP 8.1+ (with `mysqli`, `intl`, `mbstring`, `json` enabled)
   - Apache / XAMPP running locally.
2. **Database**:
   - MySQL service active on `localhost:3306`.
   - Create the target database:
     ```sql
     CREATE DATABASE IF NOT EXISTS moa_v2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     ```
3. **Environment Configuration**:
   - Ensure `.env` is configured with:
     ```ini
     CI_ENVIRONMENT = development
     app.baseURL = 'http://localhost/capstones/moa_v2/public/'
     database.default.hostname = localhost
     database.default.database = moa_v2
     database.default.username = root
     database.default.password = 
     database.default.DBDriver = MySQLi
     ```

---

## 2. Default Seed Accounts for Testing

| Role | Email | Password | Purpose |
|------|-------|----------|---------|
| **Admin** | `admin@simms.edu.ph` | `admin123` | System management & configuration |
| **Faculty** | `faculty@simms.edu.ph` | `faculty123` | Adviser review, approvals, deployment |
| **Student** | `student@simms.edu.ph` | `student123` | Trainee profile, logs, requirements |
| **Agency** | `agency@partner.com` | `agency123` | Supervisor log approvals & evaluation |

---

## 3. Sprint-by-Sprint Validation Scenarios

### Sprints 1 & 2: User Authentication & Administrator Module
- **Step 1**: Navigate to `/login`.
- **Step 2**: Log in with `admin@simms.edu.ph` / `admin123`.
- **Expected Outcome**: Redirected to `/admin/dashboard`. Dashboard metrics display student, faculty, and partner agency totals.
- **Step 3**: Access `/admin/users` and `/admin/subjects`. Verify faculty profile and subject hours configuration.

### Sprint 3: Student Registration & Profiling
- **Step 1**: Log out and navigate to `/register`.
- **Step 2**: Submit student self-registration form.
- **Step 3**: Log in as `student@simms.edu.ph`.
- **Step 4**: Open `/student/profile`. Complete personal info, course, year level, and emergency guardian contact.
- **Expected Outcome**: Profile status indicates "Complete".

### Sprint 4: Agency Selection & Approval
- **Step 1**: As student, navigate to `/student/agencies`.
- **Step 2**: Select an accredited partner agency and submit selection request. Status updates to `Pending`.
- **Step 3**: Log in as `faculty@simms.edu.ph` and open `/faculty/agency-requests`.
- **Step 4**: Click "Approve".
- **Expected Outcome**: Student placement updates to `Approved` and is queued for deployment.

### Sprint 5: Document Management
- **Step 1**: As student, open `/student/documents`.
- **Step 2**: Upload files for Parent Consent, Medical Clearance, and Waiver.
- **Step 3**: Log in as faculty, navigate to `/faculty/documents`, and click "Verify" on submitted files.
- **Expected Outcome**: Submission completeness updates to 100% verified.

### Sprint 6: Application Letter Generation
- **Step 1**: As faculty coordinator, navigate to `/deployment`.
- **Step 2**: Click "Generate Letter" for the approved student.
- **Expected Outcome**: Formatted application and endorsement letter renders with populated student and company details.

### Sprint 7: Deployment & Scheduling
- **Step 1**: On `/deployment`, click "Assign Deployment".
- **Step 2**: Specify start date, agency supervisor, and required hours quota (80.00 hours).
- **Expected Outcome**: Student status transitions to `Active Immersion`.

### Sprint 8: Daily Logs & Progress Tracking (Automatic Completion)
- **Step 1**: As student, open `/logs` and submit a daily log (e.g., Date: Today, 8.00 hours, accomplishment narrative).
- **Step 2**: Log in as `agency@partner.com`. Navigate to `/logs` and click "Approve".
- **Step 3**: Progress accumulates to 8.00 / 80.00 hours.
- **Step 4**: When cumulative approved logs reach 80.00 hours, verify status automatically transitions to `Immersion Completed`.

### Sprint 9: Internal Chat System
- **Step 1**: Open `/chat` as student.
- **Step 2**: Send a direct message to the assigned faculty adviser.
- **Step 3**: Log in as faculty and open `/chat`. Verify message appears in conversation thread.

### Sprint 10: Trainee Evaluation & Feedback
- **Step 1**: As partner supervisor, open `/evaluations/rate/:student_id`.
- **Step 2**: Fill in criteria scores across competencies, attitude, and work habits; submit.
- **Expected Outcome**: Evaluation composite score is calculated and stored in `evaluations`.

### Sprint 11: Printable Report Generation Engine
- **Step 1**: Open `/reports` as faculty/admin.
- **Step 2**: Click each report link:
  - Personal Information Sheet (`/reports/personal-info/:student_id`)
  - Application Letter (`/reports/application-letter/:id`)
  - Document Status (`/reports/document-status`)
  - Deployment Masterlist (`/reports/deployment`)
  - Completion & DTR (`/reports/completion-dtr/:student_id`)
  - Evaluation Report (`/reports/evaluation/:student_id`)
  - Portfolio Report (`/reports/portfolio/:student_id`)
  - MOA Status (`/reports/moa`)
- **Step 3**: Click "Print / Save as PDF".
- **Expected Outcome**: Print preview renders cleanly with `@media print` styling, no UI chrome/sidebars, and proper page breaks.

### Sprint 12: System Evaluation Module
- **Step 1**: Access `/admin/settings` or the system evaluation questionnaire.
- **Step 2**: Submit test respondent ratings across Functionality, Accuracy, Reliability, and Efficiency.
- **Expected Outcome**: Composite mean ratings are aggregated and viewable.
