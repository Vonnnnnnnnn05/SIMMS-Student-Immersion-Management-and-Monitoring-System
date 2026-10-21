<!--
Sync Impact Report:
- Version change: Unratified Draft -> 1.0.0
- Modified principles:
  - [PRINCIPLE_1_NAME] -> I. Core Framework & Stack Rules
  - [PRINCIPLE_2_NAME] -> II. Thesis Objectives & Sprint Compliance
  - [PRINCIPLE_3_NAME] -> III. Printable Reports & Document Engine
- Added sections:
  - Technical Architecture & Constraints (Section 2)
  - Agile Development & Delivery Workflow (Section 3)
  - Governance (populated with compliance review, amendment procedure, and versioning rules)
- Removed sections:
  - Placeholder principles 4 and 5 consolidated into 3 comprehensive core principles and technical constraints
- Follow-up TODOs: None
-->

# SIMMS (Student Immersion Management and Monitoring System) Constitution

## Core Principles

### I. Core Framework & Stack Rules
The system MUST be developed strictly using CodeIgniter 4 (PHP 8.1+ / MySQLi) and interface with the designated `moa_v2` database as specified in the thesis manuscript.
- **Views**: All presentation views MUST reside in `app/Views/` using native CI4 PHP views styled with Bootstrap 5.3 CDN and Bootstrap Icons. Node/NPM build workflows or bundling steps are strictly prohibited to ensure zero-build deployment simplicity.
- **Data Access**: Data persistence MUST use standard CI4 Models (`CodeIgniter\Model`) configured with `$protectFields = false;` and `$returnType = 'array';`.
- **Session & Security**: Native CI4 `session()` authentication MUST manage session state (e.g., `session()->get('role')`, `session()->get('user_id')`) and MUST be strictly enforced across protected endpoints using an `AuthFilter`.

### II. Thesis Objectives & Sprint Compliance
Development MUST directly align with and validate the academic requirements of the SIMMS research document.
- **Thesis Objectives**: The system MUST satisfy all 15 specific research objectives outlined in Chapter I of the SIMMS thesis manuscript.
- **Sprint Compliance**: The development lifecycle MUST strictly execute and adhere to the 12 Agile Sprints defined in Chapter III (progressing sequentially from User Authentication through System Evaluation).
- **Traceability**: Every specification, plan, and implemented task MUST map to an explicit thesis objective and sprint milestone.

### III. Printable Reports & Document Engine
Official academic and institutional immersion records MUST be generated cleanly and accurately for physical and electronic archiving.
- **Report Coverage**: All specified institutional reports—including Personal Information, Application Letters, Document Submission Status, Deployment, Completion/DTR, Evaluation, Portfolio, and MOA—MUST render via standardized, print-ready HTML views.
- **Print Optimization**: All printable templates MUST include `@media print` CSS rules optimizing page breaks, margins, and typography, accompanied by an accessible "Print / Save as PDF" user interface.

## Technical Architecture & Constraints
- **Database Engine**: MySQL 5.7+ / MariaDB via CI4 MySQLi driver connected to database `moa_v2`. Schema migrations and seeders MUST align with the thesis entity-relationship specifications.
- **Environment**: Compatible with PHP 8.1+ running on Apache/XAMPP environments. Application settings MUST be manageable via the root `env` / `.env` configuration file.
- **Zero Build Dependencies**: Frontend assets MUST rely on CDN delivery or pre-downloaded static assets under `public/assets/`. No Webpack, Vite, or npm scripts are required to run the application.

## Agile Development & Delivery Workflow
- **12-Sprint Phasing**: Development is organized into 12 structured Agile Sprints as documented in Chapter III:
  1. User Authentication & Role Management
  2. Student Profile & Personal Information Management
  3. Partner Company & MOA Management
  4. Application Letter & Requirement Processing
  5. Document Submission Status Tracking
  6. Student Placement & Deployment Management
  7. Daily Time Record (DTR) & Attendance Monitoring
  8. Trainee Performance Evaluation Management
  9. Student Immersion Portfolio Compilation
  10. System Reports & Document Engine
  11. System Administration & Audit Logging
  12. System Evaluation & User Acceptance Testing
- **Quality Gates**: Code updates MUST maintain standard CodeIgniter 4 conventions, valid PHP syntax, strict role-based access checks, and consistent layout templates.

## Governance
- **Supremacy**: This Constitution represents the primary project governing baseline. Architectural decisions, code implementations, and sprint deliverables MUST comply with these principles.
- **Amendments**: Amendments require formal documentation, justification relative to thesis objectives, and an updated constitution version.
- **Versioning Policy**: Semantic versioning (MAJOR for breaking architectural or objective changes, MINOR for added principles or major scope adjustments, PATCH for editorial refinements).
- **Compliance Review**: All Spec Kit artifacts (`spec.md`, `plan.md`, `tasks.md`) MUST be validated against this Constitution prior to implementation.

**Version**: 1.0.0 | **Ratified**: 2026-10-21 | **Last Amended**: 2026-10-21
