# Data Model: SIMMS (Student Immersion Management and Monitoring System)

**Feature**: `001-simms-core-system`  
**Database**: `moa_v2`  
**Driver**: `MySQLi`  

---

## 1. Entity-Relationship Overview

The database schema models the complete immersion lifecycle across 16 tables adhering to Chapter III of the SIMMS thesis manuscript:

```
[users] ──┬── 1:1 ── [students] ──┬── 1:N ── [student_agency] ──── N:1 ── [agencies] ── 1:1 ── [moa]
          │                       ├── 1:N ── [student_documents] ─ N:1 ── [documents]
          │                       ├── 1:N ── [deployment] ──────── N:1 ── [agencies]
          │                       ├── 1:N ── [daily_logs]
          │                       ├── 1:1 ── [progress]
          │                       ├── 1:N ── [evaluations] ─────── N:1 ── [agencies]
          │                       ├── 1:N ── [reports]
          │                       └── 1:N ── [application_letters]─ N:1 ── [agencies]
          │
          ├── 1:1 ── [faculty] ── 1:N ── [subjects]
          │
          └── 1:N ── [messages] (as sender_id or receiver_id)
```

---

## 2. Table Specifications (16 Tables)

### 1. `users`
Stores user credentials, access roles, and account statuses.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `user_id` | INT(11) | PK, AUTO_INCREMENT | Unique user identifier |
| `first_name` | VARCHAR(100) | NOT NULL | User first name |
| `last_name` | VARCHAR(100) | NOT NULL | User last name |
| `email` | VARCHAR(150) | NOT NULL, UNIQUE | User login email address |
| `password` | VARCHAR(255) | NOT NULL | Password hash (`password_hash`) |
| `role` | ENUM('admin', 'faculty', 'student', 'agency') | NOT NULL | Access control role |
| `status` | ENUM('active', 'inactive', 'pending') | DEFAULT 'active' | Account lifecycle state |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Account creation timestamp |

### 2. `students`
Stores extended academic and personal profiling data for trainees.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `student_id` | INT(11) | PK, AUTO_INCREMENT | Unique student record ID |
| `user_id` | INT(11) | FK -> users(user_id) | Associated user account |
| `course` | VARCHAR(100) | NOT NULL | Degree program / Senior High Strand |
| `year_level` | VARCHAR(50) | NOT NULL | Academic year / grade level |
| `contact_no` | VARCHAR(20) | NOT NULL | Student primary mobile phone number |
| `address` | TEXT | NULL | Residential address |
| `guardian_name` | VARCHAR(150) | NULL | Parent/guardian emergency contact name |
| `guardian_contact` | VARCHAR(20) | NULL | Parent/guardian contact phone number |

### 3. `faculty`
Stores faculty coordinator and adviser profiles.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `faculty_id` | INT(11) | PK, AUTO_INCREMENT | Unique faculty record ID |
| `user_id` | INT(11) | FK -> users(user_id) | Associated user account |
| `department` | VARCHAR(100) | NOT NULL | Academic college / department |
| `contact_no` | VARCHAR(20) | NOT NULL | Faculty official contact number |

### 4. `agencies`
Stores accredited partner host training establishments.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `agency_id` | INT(11) | PK, AUTO_INCREMENT | Unique partner agency ID |
| `name` | VARCHAR(150) | NOT NULL | Company / Host Establishment Name |
| `address` | TEXT | NOT NULL | Physical company address |
| `contact_person` | VARCHAR(150) | NOT NULL | Designated supervisor / focal person |
| `contact_no` | VARCHAR(20) | NOT NULL | Agency official contact number |
| `email` | VARCHAR(150) | NULL | Agency official contact email |
| `status` | ENUM('active', 'inactive') | DEFAULT 'active' | Partnership availability status |
| `capacity` | INT(5) | DEFAULT 10 | Maximum student placement quota |

### 5. `subjects`
Stores immersion subjects/courses assigned to faculty advisers.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `subject_id` | INT(11) | PK, AUTO_INCREMENT | Unique subject ID |
| `subject_name` | VARCHAR(150) | NOT NULL | Subject course code and title |
| `faculty_id` | INT(11) | FK -> faculty(faculty_id) | Assigned faculty adviser/coordinator |
| `required_hours`| INT(5) | DEFAULT 80 | Immersion hours required for completion |

### 6. `student_agency`
Tracks student agency selection requests and faculty approvals.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `id` | INT(11) | PK, AUTO_INCREMENT | Unique selection record ID |
| `student_id` | INT(11) | FK -> students(student_id) | Student applying for placement |
| `agency_id` | INT(11) | FK -> agencies(agency_id) | Chosen partner agency |
| `status` | ENUM('pending', 'approved', 'rejected') | DEFAULT 'pending' | Placement application state |
| `date_selected`| DATE | NOT NULL | Date student submitted selection |
| `remarks` | TEXT | NULL | Faculty feedback or rejection reason |

### 7. `documents`
Defines required pre-immersion document categories.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `document_id` | INT(11) | PK, AUTO_INCREMENT | Unique document type ID |
| `document_name`| VARCHAR(150) | NOT NULL | Requirement name (e.g., Parent Consent) |
| `description` | TEXT | NULL | Instructions or guidelines for student |
| `is_mandatory` | TINYINT(1) | DEFAULT 1 | Whether requirement blocks deployment |

### 8. `student_documents`
Tracks file uploads and faculty verification of pre-immersion requirements.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `student_doc_id`| INT(11) | PK, AUTO_INCREMENT | Unique submission record ID |
| `student_id` | INT(11) | FK -> students(student_id) | Uploading student |
| `document_id` | INT(11) | FK -> documents(document_id) | Requirement category |
| `file_path` | VARCHAR(255) | NOT NULL | Uploaded file path in `writable/uploads/` |
| `status` | ENUM('pending', 'approved', 'rejected') | DEFAULT 'pending' | Verification status |
| `remarks` | TEXT | NULL | Verification notes from faculty |
| `uploaded_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Submission timestamp |

### 9. `deployment`
Records official student placement, supervisor assignment, and schedule.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `deployment_id`| INT(11) | PK, AUTO_INCREMENT | Unique deployment record ID |
| `student_id` | INT(11) | FK -> students(student_id) | Assigned student |
| `agency_id` | INT(11) | FK -> agencies(agency_id) | Assigned partner agency |
| `start_date` | DATE | NOT NULL | Official immersion start date |
| `end_date` | DATE | NULL | Expected or actual completion date |
| `status` | ENUM('scheduled', 'active', 'completed', 'cancelled') | DEFAULT 'scheduled' | Placement lifecycle state |

### 10. `daily_logs`
Stores daily attendance, rendered hours, and task accomplishments (DTR).

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `log_id` | INT(11) | PK, AUTO_INCREMENT | Unique log entry ID |
| `student_id` | INT(11) | FK -> students(student_id) | Log author |
| `log_date` | DATE | NOT NULL | Work date |
| `time_in` | TIME | NULL | Morning/shift check-in time |
| `time_out` | TIME | NULL | Afternoon/shift check-out time |
| `hours_rendered`| DECIMAL(4,2) | NOT NULL | Hours worked for the day |
| `tasks_done` | TEXT | NULL | Narrative summary of accomplishments |
| `status` | ENUM('pending', 'approved', 'rejected') | DEFAULT 'pending' | Supervisor approval status |
| `supervisor_remarks` | TEXT | NULL | Supervisor comments |

### 11. `progress`
Maintains cumulative approved hours and automated completion status.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `progress_id` | INT(11) | PK, AUTO_INCREMENT | Unique progress record ID |
| `student_id` | INT(11) | FK -> students(student_id) | Associated student |
| `total_hours` | DECIMAL(6,2) | DEFAULT 0.00 | Total approved hours rendered |
| `required_hours`| DECIMAL(6,2) | DEFAULT 80.00 | Total hours required for subject |
| `status` | ENUM('in_progress', 'completed') | DEFAULT 'in_progress' | Immersion completion state |
| `completion_date`| DATE | NULL | Date required hours were fulfilled |

### 12. `messages`
Stores internal database-backed chat messages between participants.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `message_id` | INT(11) | PK, AUTO_INCREMENT | Unique message ID |
| `sender_id` | INT(11) | FK -> users(user_id) | Message author |
| `receiver_id` | INT(11) | FK -> users(user_id) | Intended recipient |
| `message` | TEXT | NOT NULL | Message text body |
| `is_read` | TINYINT(1) | DEFAULT 0 | 0 = Unread, 1 = Read |
| `created_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Dispatch timestamp |

### 13. `evaluations`
Stores supervisor ratings and feedback on student performance.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `evaluation_id`| INT(11) | PK, AUTO_INCREMENT | Unique evaluation ID |
| `student_id` | INT(11) | FK -> students(student_id) | Evaluated student |
| `agency_id` | INT(11) | FK -> agencies(agency_id) | Evaluating agency |
| `rating` | DECIMAL(4,2) | NOT NULL | Composite performance rating |
| `competencies` | JSON / TEXT | NULL | Itemized rubric criteria ratings |
| `feedback` | TEXT | NULL | Supervisor qualitative comments |
| `evaluated_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Submission timestamp |

### 14. `reports`
Maintains the registry of generated official immersion reports.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `report_id` | INT(11) | PK, AUTO_INCREMENT | Unique report log ID |
| `student_id` | INT(11) | NULL, FK -> students | Target student (or NULL for batch) |
| `report_type` | VARCHAR(100) | NOT NULL | Report category identifier |
| `generated_by` | INT(11) | FK -> users(user_id) | User who generated the report |
| `generated_at` | DATETIME | DEFAULT CURRENT_TIMESTAMP | Generation timestamp |

### 15. `application_letters`
Stores generated formal application/endorsement letters.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `letter_id` | INT(11) | PK, AUTO_INCREMENT | Unique letter ID |
| `student_id` | INT(11) | FK -> students(student_id) | Endorsed student |
| `agency_id` | INT(11) | FK -> agencies(agency_id) | Addressed partner agency |
| `date_generated`| DATE | NOT NULL | Formal letter issue date |
| `letter_content`| TEXT | NULL | Rendered text or signature block |

### 16. `moa`
Tracks formal Memorandum of Agreement partnerships with agencies.

| Field | Type | Attributes | Description |
|-------|------|------------|-------------|
| `moa_id` | INT(11) | PK, AUTO_INCREMENT | Unique MOA record ID |
| `agency_id` | INT(11) | FK -> agencies(agency_id) | Associated partner agency |
| `start_date` | DATE | NOT NULL | MOA partnership effective date |
| `end_date` | DATE | NULL | MOA expiration date |
| `status` | ENUM('active', 'expired', 'pending_renewal') | DEFAULT 'active' | Agreement validity state |
| `file_path` | VARCHAR(255) | NULL | Scanned copy of signed MOA |

---

## 3. State Transitions

### Placement Selection Lifecycle (`student_agency`)
```
[Select Agency] ──> pending ──┬── (Faculty Approves) ──> approved ──> (Proceeds to Deployment)
                              └── (Faculty Rejects)  ──> rejected ──> (Select Another Agency)
```

### Document Verification Lifecycle (`student_documents`)
```
[Upload File] ──> pending ──┬── (Faculty Verifies) ──> approved
                            └── (Faculty Rejects)  ──> rejected ──> (Student Resubmits)
```

### Immersion & Completion Lifecycle (`progress` & `deployment`)
```
[Deployment Active] ──> in_progress
                              │
                    (Daily Logs Approved)
                              │
                      [Cumulative Sum >= Required Hours]
                              │
                              v
                        completed (Triggers Immersion Finished status)
```
