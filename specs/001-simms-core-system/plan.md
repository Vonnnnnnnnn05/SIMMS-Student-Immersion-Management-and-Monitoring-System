# Implementation Plan: Student Immersion Management and Monitoring System (SIMMS)

**Branch**: `001-simms-core-system` | **Date**: 2026-10-21 | **Spec**: [specs/001-simms-core-system/spec.md](spec.md)

**Input**: Feature specification from `specs/001-simms-core-system/spec.md`

## Summary

Implement the comprehensive full-stack SIMMS application to fulfill all 15 specific research objectives and 12 Agile Sprints defined in the thesis manuscript. The implementation utilizes native CodeIgniter 4 MVC architecture connecting to the `moa_v2` MySQL database, Zero-Build Bootstrap 5.3 CDN + Bootstrap Icons client styling, native CI4 `session()` role-based authentication guarded by `AuthFilter`, and an `@media print` printable document engine covering all 8 institutional reports.

## Technical Context

**Language/Version**: PHP 8.1+ / CodeIgniter 4 (v4.4+)  
**Primary Dependencies**: Bootstrap 5.3 CDN, Bootstrap Icons CDN (Zero-build client stack, zero Node/NPM dependencies)  
**Storage**: MySQL (MySQLi driver) database `moa_v2`  
**Testing**: PHPUnit / manual browser verification against 12 sprint validation workflows  
**Target Platform**: Cross-platform web running on Apache/XAMPP and modern desktop/mobile web browsers  
**Project Type**: Full-stack MVC Web Application  
**Performance Goals**: Page responses < 500ms; sub-3 second internal chat exchange; instant print rendering  
**Constraints**: Standard CI4 Model configuration (`$protectFields = false; $returnType = 'array';`), native CI4 `session()` authentication, no external JavaScript bundling or build steps  
**Scale/Scope**: 12 Agile Sprints, 15 Thesis Research Objectives, 4 user roles (Admin, Faculty, Student, Agency), 16 database tables, 10 controllers, 8 printable report types  

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

- **Gate 1: Core Framework & Stack Rules**: CodeIgniter 4 on PHP 8.1+ with MySQLi driver connected to `moa_v2` database; native CI4 views in `app/Views/` using Bootstrap 5.3 CDN and Bootstrap Icons; zero Node/NPM build complexity. **STATUS: PASSED**
- **Gate 2: Data Access & Session Management**: CI4 Models inherit `CodeIgniter\Model` with `$protectFields = false;` and `$returnType = 'array';`; session-based authentication using native CI4 `session()` (`role`, `user_id`) protected by `AuthFilter`. **STATUS: PASSED**
- **Gate 3: Thesis Objectives & Sprint Compliance**: Direct mapping across all 15 research objectives (Chapter I) and 12 sequential Agile Sprints (Chapter III). **STATUS: PASSED**
- **Gate 4: Printable Reports & Document Engine**: All 8 institutional reports render via dedicated print-ready HTML views with `@media print` CSS and "Print / Save as PDF" integration. **STATUS: PASSED**

## Project Structure

### Documentation (this feature)

```text
specs/001-simms-core-system/
├── plan.md              # This implementation plan
├── research.md          # Phase 0: Technical choices, architectural decisions & alternatives
├── data-model.md        # Phase 1: 16-table schema specification, relationships & state transitions
├── contracts/           # Phase 1: Route contracts and controller action specifications
│   └── routes.md
├── quickstart.md        # Phase 1: End-to-end runnable validation guide for all 12 sprints
├── checklists/
│   └── requirements.md  # Spec quality validation checklist
└── tasks.md             # Phase 2: Actionable task list (generated via /speckit-tasks)
```

### Source Code (repository root)

```text
app/
├── Config/
│   ├── Database.php              # Configured for moa_v2 database connection
│   ├── Filters.php               # AuthFilter alias registration
│   └── Routes.php                # Route definitions mapping 10 controllers
├── Controllers/
│   ├── AuthController.php        # Sprints 1 & 2: Login, student registration, logout
│   ├── AdminController.php       # Sprint 2: System setup, users, subjects, settings
│   ├── FacultyController.php     # Sprints 4 & 5: Student profiling, agency requests, docs
│   ├── StudentController.php     # Sprints 3, 4, 5: Profile, agency selection, doc uploads
│   ├── AgencyController.php      # Sprints 7 & 10: Trainees list, supervisor profile
│   ├── DeploymentController.php  # Sprints 6 & 7: Letters, deployment scheduling
│   ├── LogController.php         # Sprint 8: Daily logs, DTR, automatic completion detection
│   ├── ChatController.php        # Sprint 9: Internal database-backed messaging
│   ├── EvaluationController.php  # Sprint 10: Performance rubric evaluation
│   └── ReportController.php      # Sprints 11 & 12: 8 printable reports & system evaluation
├── Filters/
│   └── AuthFilter.php            # Role-based route guard and session verifier
├── Models/
│   ├── UserModel.php             # Table: users
│   ├── StudentModel.php          # Table: students
│   ├── FacultyModel.php          # Table: faculty
│   ├── AgencyModel.php           # Table: agencies
│   ├── SubjectModel.php          # Table: subjects
│   ├── StudentAgencyModel.php    # Table: student_agency
│   ├── DocumentModel.php         # Table: documents
│   ├── StudentDocumentModel.php  # Table: student_documents
│   ├── DeploymentModel.php       # Table: deployment
│   ├── DailyLogModel.php         # Table: daily_logs
│   ├── ProgressModel.php         # Table: progress
│   ├── MessageModel.php          # Table: messages
│   ├── EvaluationModel.php       # Table: evaluations
│   ├── ReportModel.php           # Table: reports
│   ├── ApplicationLetterModel.php# Table: application_letters
│   └── MoaModel.php              # Table: moa
└── Views/
    ├── layouts/
    │   ├── main.php              # Shared Bootstrap 5.3 CDN master layout
    │   ├── print.php             # Clean @media print layout with letterhead & signature block
    │   └── partials/             # Sidebar, navbar, flash alert components
    ├── auth/                     # login.php, register.php
    ├── admin/                    # dashboard.php, users.php, faculty.php, subjects.php, settings.php
    ├── faculty/                  # dashboard.php, students.php, student_view.php, agency_requests.php, documents.php, deployment.php
    ├── student/                  # dashboard.php, profile.php, agencies.php, documents.php, logs.php
    ├── agency/                   # dashboard.php, trainees.php, evaluations.php, evaluation_form.php, profile.php
    ├── chat/                     # index.php
    └── reports/                  # personal_info.php, application_letter.php, document_status.php, deployment_report.php, dtr_report.php, evaluation_report.php, portfolio_report.php, moa_report.php
```

**Structure Decision**: Standard CodeIgniter 4 full-stack MVC architecture matching existing repository structure, utilizing native PHP views in `app/Views/` organized by role module and printable report format.

## Complexity Tracking

| Violation | Why Needed | Simpler Alternative Rejected Because |
|-----------|------------|-------------------------------------|
| *None* | N/A | Fully adheres to Constitution and native CI4 patterns |
