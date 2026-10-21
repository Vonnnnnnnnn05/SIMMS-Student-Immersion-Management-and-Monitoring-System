# Feature Specification: Student Immersion Management and Monitoring System (SIMMS)

**Feature Branch**: `001-simms-core-system`

**Created**: 2026-10-21

**Status**: Draft

**Input**: User description: "The system shall fulfill the following core feature modules derived from the 15 specific objectives: 1. User & Role Management (Sprint 1 & 2): Secure role-based login and dashboards for Admin, Faculty, Students, and Partner Agencies. 2. Administrator Module (Sprint 2): Manage system setup, user accounts, faculty profiles, subjects, and system configurations. 3. Student Registration & Profiling (Sprint 3): Allow students to register and input personal, course, and contact information. 4. Agency Selection & Approval (Sprint 4): Enable students to select partner agencies, and faculty to review/approve them. 5. Document Management (Sprint 5): Allow students to upload required documents and track submission completeness. 6. Application Letter Generation (Sprint 6): Automatically generate formatted application letters using student and agency records. 7. Deployment & Scheduling (Sprint 7): Assign students to partner agencies and manage immersion schedules and duration. 8. Daily Logs & Progress Tracking (Sprint 8): Record daily tasks/accomplishments, track rendered hours, and automatically detect immersion completion. 9. Chat System (Sprint 9): Enable real-time database-backed messaging between students, faculty, and partner agencies. 10. Evaluation & Feedback (Sprint 10): Enable partner agencies to rate student performance and provide feedback. 11. Report Generation Module (Sprint 11): Generate comprehensive reports (Personal Info, Application Letters, Submission Status, Deployment, Completion, Evaluation, Portfolio, MOA). 12. System Evaluation Module (Sprint 12): Evaluate system performance in terms of functionality, accuracy, reliability, and efficiency."

## User Scenarios & Testing *(mandatory)*

### User Story 1 - Multi-Role Authentication & Access Control (Priority: P1)

As an Administrator, Faculty Adviser, Student Trainee, or Partner Agency Supervisor,
I want to log in using secure credentials and be routed to my role-specific dashboard,
So that I can access features and student records authorized specifically for my role.

**Why this priority**: Authentication and role partitioning form the entry point and foundational security perimeter for all subsequent student immersion activities.

**Independent Test**: Can be independently tested by creating test accounts across all 4 roles (Admin, Faculty, Student, Agency) and verifying that authenticating redirects to the correct dashboard while blocking unauthorized cross-role endpoints.

**Acceptance Scenarios**:

1. **Given** a registered user with valid credentials, **When** they submit their login form, **Then** the system authenticates them and opens their corresponding role dashboard (Admin, Faculty, Student, or Partner Agency).
2. **Given** an unauthenticated visitor, **When** they attempt to access protected system pages, **Then** the system redirects them to the login screen with an unauthorized notice.
3. **Given** an authenticated Student, **When** they attempt to access Faculty or Admin management routes, **Then** the system denies access and keeps them within student-permitted boundaries.

---

### User Story 2 - Student Registration & Profile Management (Priority: P1)

As a Student Trainee,
I want to register an account and complete my comprehensive personal, academic, contact, and guardian profile,
So that the institution has accurate data required for immersion eligibility, insurance, and company endorsements.

**Why this priority**: Complete student profiles are required to generate application letters, verify pre-immersion requirements, and execute deployment scheduling.

**Independent Test**: Can be tested by filling out a new student registration, logging in, updating emergency contact and academic information, and verifying the completed profile view.

**Acceptance Scenarios**:

1. **Given** a new student, **When** they submit the registration form with valid institutional details, **Then** an account is provisioned in pending or active status according to institutional rules.
2. **Given** an authenticated student on their profile page, **When** they enter their emergency contact, guardian name, degree program, and strand/track, **Then** the system saves the record and flags the profile as complete.
3. **Given** an incomplete student profile, **When** the student attempts to apply for an agency, **Then** the system prompts them to finish required profile fields first.

---

### User Story 3 - Partner Agency Selection & Faculty Approval (Priority: P2)

As a Student Trainee and Faculty Adviser,
I want the student to browse accredited partner agencies and submit a placement choice, and the faculty adviser to review and approve or reject the request,
So that students are deployed only to verified companies aligned with their specialization.

**Why this priority**: Validated placement intent is the prerequisite for generating legal application letters, Memorandum of Agreement (MOA) tracking, and formal deployment.

**Independent Test**: Can be tested by having a student select an available agency, having faculty view the pending application queue, and confirming that approving updates the student's placement status.

**Acceptance Scenarios**:

1. **Given** an accredited partner agency with open placement slots, **When** a qualified student submits a selection request, **Then** the status transitions to "Pending Faculty Review".
2. **Given** a pending agency selection, **When** the faculty adviser approves the placement, **Then** the student's status updates to "Approved for Endorsement" and notifies the student.
3. **Given** an inappropriate agency selection, **When** the faculty adviser rejects it with remarks, **Then** the student is notified to select an alternate accredited partner.

---

### User Story 4 - Pre-Immersion Document Management (Priority: P2)

As a Student Trainee and Faculty Coordinator,
I want the student to upload mandatory pre-immersion documents (medical clearance, parent consent, insurance, resume) and track their submission status,
So that faculty coordinators can verify legal compliance before deployment.

**Why this priority**: Ensures health, safety, and legal institutional compliance before students report to host training establishments.

**Independent Test**: Can be tested by uploading document attachments under required document categories and verifying that the progress tracker reflects percentage completeness.

**Acceptance Scenarios**:

1. **Given** a student with required document checklists, **When** they upload a valid file for a requirement (e.g., Parent Consent Form), **Then** the system logs the file upload and updates the requirement status to "Submitted".
2. **Given** submitted documents, **When** faculty reviews and marks them verified, **Then** the student's document compliance indicator updates toward 100% completion.
3. **Given** an illegible or incorrect document submission, **When** faculty rejects it with feedback notes, **Then** the requirement status reverts to "Resubmission Required".

---

### User Story 5 - Automated Application Letter Generation & Official Deployment (Priority: P2)

As a Faculty Coordinator,
I want the system to generate standardized, formatted application and endorsement letters merging student details and agency head information, and schedule official deployment,
So that students receive professional paperwork without manual document formatting delays.

**Why this priority**: Bridges the preparation stage into active field placement with institutional branding and standardized endorsement.

**Independent Test**: Can be tested by initiating letter generation for an approved student-agency pair, inspecting the populated fields, and assigning immersion start/end dates and hour targets.

**Acceptance Scenarios**:

1. **Given** an approved student and partner agency record, **When** the coordinator generates an application letter, **Then** the system automatically populates the student name, program, agency address, signatory names, and institutional date.
2. **Given** an issued endorsement letter, **When** the coordinator confirms deployment with target hours (e.g., 80 hours) and dates, **Then** the student status transitions to "Deployed / Active Immersion".

---

### User Story 6 - Daily Logs, Time Tracking (DTR), & Completion Detection (Priority: P2)

As a Deployed Student Trainee and Agency Supervisor,
I want the student to record daily tasks, morning/afternoon time entries, and accomplishments, and the supervisor to approve rendered hours,
So that progress toward the required immersion hours is monitored and completion is automatically triggered when targets are reached.

**Why this priority**: Daily accountability and hourly verification represent the core operational purpose of the immersion monitoring system.

**Independent Test**: Can be tested by submitting daily log entries with time-in and time-out values, approving logs as a supervisor, and verifying that total rendered hours update and flag completion when the target is reached.

**Acceptance Scenarios**:

1. **Given** an active deployed student, **When** they submit a daily log with time-in, time-out, and narrative accomplishments, **Then** the record is stored as "Pending Supervisor Sign-Off" and pending hours are calculated.
2. **Given** a supervisor reviewing daily logs, **When** they approve the log entry, **Then** approved hours are credited toward the student's cumulative total.
3. **Given** a student whose approved cumulative hours reach or exceed the target requirement, **When** the final qualifying log is approved, **Then** the system automatically transitions the student status to "Immersion Completed".

---

### User Story 7 - Trainee Performance Evaluation & Agency Feedback (Priority: P3)

As a Partner Agency Supervisor,
I want to complete a multi-criteria evaluation rubric assessing student competencies, work attitude, and professionalism,
So that academic coordinators have quantitative ratings to compute final immersion grades.

**Why this priority**: Required for academic grading, accreditation records, and student competency assessment.

**Independent Test**: Can be tested by submitting numerical ratings and qualitative feedback on an evaluation form and confirming the system calculates weighted totals and displays results to authorized faculty.

**Acceptance Scenarios**:

1. **Given** an immersion student nearing or at completion, **When** the supervisor fills the evaluation rubric and submits scores, **Then** the system calculates total/average performance metrics.
2. **Given** a submitted evaluation, **When** the faculty coordinator opens the student's evaluation tab, **Then** the itemized scores and supervisor comments are viewable and locked against unauthorized modification.

---

### User Story 8 - Real-Time Immersion Messaging & Support Chat (Priority: P3)

As a Student Trainee, Faculty Adviser, or Partner Supervisor,
I want to exchange direct messages within the system,
So that immersion inquiries, concerns, or emergency notifications can be communicated quickly without leaving the platform.

**Why this priority**: Enhances communication and rapid coordination during off-campus immersion activities.

**Independent Test**: Can be tested by sending a message from a student account to their assigned faculty coordinator and verifying the message appears in the conversation thread.

**Acceptance Scenarios**:

1. **Given** an authenticated user, **When** they compose and send a message to their designated immersion adviser or supervisor, **Then** the message is saved and displays in chronological conversation order.
2. **Given** incoming messages, **When** the recipient checks their messages view, **Then** unread indicators clearly distinguish new incoming communications.

---

### User Story 9 - Standardized Report Generation & Immersion Portfolio (Priority: P3)

As an Administrator or Faculty Coordinator,
I want to generate standardized, print-ready reports (Personal Info, Application Letters, Document Submission Status, Deployment, Completion/DTR, Evaluation, Portfolio, and MOA summary),
So that physical institutional documentation, compliance audits, and accreditation records can be printed or saved as PDFs.

**Why this priority**: Fulfills institutional reporting, memorandum of agreement documentation, and thesis document engine requirements.

**Independent Test**: Can be tested by selecting any of the 8 report types, applying filters (by student, section, or agency), and verifying print view rendering with zero formatting truncation.

**Acceptance Scenarios**:

1. **Given** immersion records across students, **When** an administrator or faculty selects a report type (e.g., Deployment Summary or DTR Sheet), **Then** the system renders a clean, print-formatted view with headers, data tables, and signature blocks.
2. **Given** a printable report view, **When** the user clicks "Print / Save as PDF", **Then** the browser print dialog opens with clean margins and print styling.

---

### User Story 10 - System Administration & System Evaluation Module (Priority: P4)

As an Administrator and Research Evaluator,
I want to manage system configurations, curriculum subjects, academic periods, user accounts, and administer system evaluation questionnaires (functionality, accuracy, reliability, and efficiency),
So that the platform can be configured for institutional terms and evaluated under academic research criteria.

**Why this priority**: Enables ongoing operational administration and validates the thesis system evaluation research objective (Sprint 12).

**Independent Test**: Can be tested by updating academic term settings, provisioning accounts, and submitting system evaluation survey responses to verify aggregated metric summaries.

**Acceptance Scenarios**:

1. **Given** an administrator, **When** they configure academic years, faculty assignments, and immersion subjects, **Then** the system updates operational options across the platform.
2. **Given** respondents completing the Sprint 12 System Evaluation survey, **When** ratings across functionality, accuracy, reliability, and efficiency are submitted, **Then** the system tabulates descriptive mean scores and evaluation summaries.

---

### Edge Cases

- **Unauthorized Session Access**: What happens when an unauthenticated user or user with an inappropriate role attempts direct URL access? System immediately terminates access, logs the attempt, and redirects to the login screen with a descriptive error message.
- **Concurrent Log Entries**: What happens if a student attempts to log overlapping time-in/time-out periods for the same day? System prevents duplicate or overlapping daily log submissions and alerts the student.
- **Maximum Daily Hours Cap**: How does the system handle single-day entries exceeding standard work shifts (e.g., >8 or 10 hours)? System warns the user and requires supervisor justification or caps creditable hours.
- **Incomplete Pre-Requisites**: What happens if a student attempts to request deployment before submitting mandatory legal waivers or parent consents? System prevents deployment scheduling and highlights missing documents.
- **Agency Slot Exhaustion**: What happens when an agency reaches its maximum student quota? The agency is marked as "Full" and cannot accept further student placement requests until capacity expands.
- **Evaluations After Completion**: What happens if an evaluation is attempted after grades are finalized? Submitted evaluations become read-only and cannot be altered without administrator override.
- **Network Interruptions during File Upload**: How does the system handle failed document uploads? System verifies file receipt, validates supported file formats, and informs the user if an upload was incomplete.

## Requirements *(mandatory)*

### Functional Requirements

- **FR-001**: System MUST provide authenticated access with distinct role profiles for Administrator, Faculty, Student, and Partner Agency.
- **FR-002**: System MUST enforce role-based access control across all administrative and operational views.
- **FR-003**: System MUST provide administrative management for user accounts, faculty profiles, subjects/sections, and institutional configurations.
- **FR-004**: System MUST allow students to register and maintain personal information, contact numbers, emergency contacts, degree program, and strand details.
- **FR-005**: System MUST maintain an accredited directory of partner host agencies including contact persons, address, industry classification, and student capacity.
- **FR-006**: System MUST enable students to browse accredited partner agencies and submit placement preference applications.
- **FR-007**: System MUST provide faculty advisers with an approval interface to review, approve, or reject student agency selections with feedback.
- **FR-008**: System MUST allow students to upload required pre-immersion documents (medical records, parent consent forms, waivers, resumes).
- **FR-009**: System MUST track individual and batch document submission completeness with clear verified/pending/rejected indicators.
- **FR-010**: System MUST automatically generate standardized application and endorsement letters merging stored student and agency contact details.
- **FR-011**: System MUST support managing student deployment schedules, assigned supervisors, target hours, and designated start/end dates.
- **FR-012**: System MUST allow deployed students to submit daily time records (DTR) and narrative task accomplishment logs.
- **FR-013**: System MUST allow partner agency supervisors to review, adjust, and approve student daily time logs.
- **FR-014**: System MUST calculate cumulative rendered hours and automatically flag student records as "Immersion Completed" once the required target hours are fulfilled.
- **FR-015**: System MUST provide an integrated chat messaging system enabling communication between students, faculty advisers, and partner agency supervisors.
- **FR-016**: System MUST enable partner agency supervisors to complete structured performance evaluation rubrics for student trainees.
- **FR-017**: System MUST calculate overall and categorical evaluation scores and make finalized evaluations accessible to faculty coordinators.
- **FR-018**: System MUST generate standardized printable reports for:
  - Student Personal Information Profiles
  - Formal Application & Endorsement Letters
  - Document Submission Status Matrices
  - Student Deployment & Schedule Masterlists
  - Daily Time Record (DTR) & Completion Summaries
  - Supervisor Performance Evaluation Reports
  - Student Immersion Portfolios
  - Memorandum of Agreement (MOA) Partnership Status Records
- **FR-019**: All printable reports MUST render cleanly in dedicated print-ready views with print stylesheets and single-click "Print / Save as PDF" capabilities.
- **FR-020**: System MUST provide a System Evaluation Module to collect and tabulate user feedback across ISO/academic criteria (functionality, accuracy, reliability, and efficiency).

### Key Entities *(include if feature involves data)*

- **UserAccount**: Core identity entity containing login credentials, assigned role (Admin, Faculty, Student, Partner), status (Active, Inactive, Suspended), and timestamps.
- **StudentProfile**: Extended student details including student ID number, full name, gender, contact number, home address, emergency/guardian contact, program/strand, and section.
- **FacultyProfile**: Faculty coordinator information including employee ID, full name, department, contact number, and assigned student advisees.
- **PartnerAgency**: Host training establishment entity including company name, business address, industry, contact person, designation, contact email/phone, active MOA status, and placement slot capacity.
- **DocumentSubmission**: Pre-immersion requirement record linking student, document category (Parent Consent, Medical, Waiver, Resume), uploaded file reference, verification status, reviewer remarks, and submission timestamp.
- **ApplicationLetter**: Record of generated endorsement letter linking student, agency, generation date, academic coordinator signatory, and reference code.
- **DeploymentRecord**: Formal placement record specifying student, partner agency, assigned supervisor, immersion start date, expected end date, target required hours, and deployment status.
- **DailyLogDTR**: Attendance and task log containing date, time-in, time-out, rendered hours, accomplishment summary, supervisor approval status, and supervisor comments.
- **ChatMessage**: Internal messaging entity containing sender ID, recipient ID, message body, read status, and sent timestamp.
- **PerformanceEvaluation**: Structured evaluation record containing student ID, agency evaluator ID, evaluation criteria ratings, qualitative remarks, calculated composite score, and submission timestamp.
- **SystemEvaluationRating**: Research evaluation survey record capturing user role, category ratings (Functionality, Accuracy, Reliability, Efficiency), qualitative feedback, and submission date.

## Success Criteria *(mandatory)*

### Measurable Outcomes

- **SC-001**: New students can complete registration and profile submission in under 5 minutes without administrative assistance.
- **SC-002**: 100% of generated application and endorsement letters populate with accurate student, agency, and institutional information without manual data entry errors.
- **SC-003**: Cumulative immersion hours calculated by the system match approved DTR records with 100% mathematical accuracy.
- **SC-004**: System automatically detects and triggers "Immersion Completed" status within 10 seconds of the final required hour sign-off.
- **SC-005**: Partner supervisors can complete and submit a trainee performance evaluation in under 5 minutes.
- **SC-006**: 100% of the 8 designated institutional reports render without layout truncation or formatting degradation when printed or exported to PDF.
- **SC-007**: Chat messages between students, faculty, and partner supervisors deliver and update in conversation threads within 3 seconds under normal network conditions.
- **SC-008**: System evaluation responses across functionality, accuracy, reliability, and efficiency achieve an aggregate mean score meeting or exceeding "Satisfactory" (>= 4.0 out of 5.0) in user testing.

## Assumptions

- **Standard Immersion Hours**: The default immersion quota is configurable per curriculum/subject (e.g., 80, 120, or 240 hours) and set by the administrator or coordinator.
- **Browser Accessibility**: Users access the web application through standard modern desktop or mobile web browsers.
- **Supervisor Role Assignment**: Host partner agencies assign at least one designated supervisor/focal person per registered student cohort.
- **Pre-Deployment Policy**: Verification of mandatory pre-immersion documents (Parent Consent, Medical Clearance) is required before a student can be marked officially deployed.
- **Document Storage**: Uploaded pre-immersion files and student portfolios are stored in secure web server storage and mapped to database records.
