# Technical Research & Architecture Decisions: SIMMS

**Feature**: Student Immersion Management and Monitoring System (SIMMS)  
**Date**: 2026-10-21  
**Status**: Completed  

---

## 1. CodeIgniter 4 MVC Architecture & Zero-Build UI

### Decision
Implement SIMMS using native CodeIgniter 4 MVC architecture (`app/Controllers`, `app/Models`, `app/Views`) coupled with Bootstrap 5.3 CDN and Bootstrap Icons CDN loaded directly in standard view layouts.

### Rationale
- Complies strictly with Principle I of the Project Constitution (Zero Node/NPM build complexity).
- Native PHP views in `app/Views/` allow direct variable rendering, reusable partials (`header`, `footer`, `sidebar`, `navbar`), and rapid prototyping without build step overhead.
- CDN assets ensure modern aesthetics (cards, badges, modals, toast alerts, data tables, responsive navigation) without requiring local build tooling or compilation steps.

### Alternatives Considered
- *Inertia.js + Vue/React*: Rejected because it introduces Node/NPM packaging, build compilation, and violates the Constitution.
- *Raw CSS*: Rejected because maintaining a responsive, aesthetically modern UI across 10 controllers and 5 view suites from scratch is error-prone and time-consuming.

---

## 2. Database & Data Access Layer (`moa_v2`)

### Decision
Connect to the designated MySQL database `moa_v2` using CI4's MySQLi driver. Configure all CI4 Models (`CodeIgniter\Model`) with:
```php
protected $protectFields = false;
protected $returnType    = 'array';
```

### Rationale
- Conforms directly to Constitution Stack Rule 1 and Thesis Chapter III requirements.
- `$protectFields = false` eliminates field whitelist mismatches when saving form inputs across the 16 entity models.
- `$returnType = 'array'` provides uniform data structures for views, avoiding object/array casting friction.
- MySQLi is standard in PHP 8.1+ and native to XAMPP environments.

### Alternatives Considered
- *Entity Object Mapping (`$returnType = 'object'` or custom entities)*: Rejected for simplicity and adherence to the user's explicit model guidelines.
- *Doctrine / External ORMs*: Rejected to preserve native CI4 Model simplicity.

---

## 3. Session Management & Role-Based Access Control (`AuthFilter`)

### Decision
Implement session-based authentication using native CodeIgniter `session()` services and enforce role-based access through a dedicated `AuthFilter` (`app/Filters/AuthFilter.php`).

### Rationale
- Roles: `admin`, `faculty`, `student`, `agency`.
- Session keys:
  - `user_id`: Primary key referencing `users.user_id`
  - `role`: Role string (`admin`, `faculty`, `student`, `agency`)
  - `logged_in`: Boolean flag
  - Role-specific reference ID (`student_id`, `faculty_id`, `agency_id`) stored on login to avoid redundant joins.
- `AuthFilter` verifies active session state before route execution. Route filters check required role permissions and redirect unauthorized attempts to `/login` or respective dashboards with a flash alert.

### Alternatives Considered
- *JWT (JSON Web Tokens)*: Unnecessary complexity for a server-rendered web application; requires client-side storage management and header injection.
- *CodeIgniter Shield*: Adds heavy external package dependencies; custom lightweight `AuthFilter` is transparent, educational, and aligns with academic capstone review standards.

---

## 4. Printable Reports & Document Engine

### Decision
Implement server-rendered print-ready HTML views for all 8 mandatory report types using dedicated `@media print` CSS stylesheets and a client-side `window.print()` trigger ("Print / Save as PDF").

### Rationale
- Fulfills Principle III of the Project Constitution.
- Web browsers natively convert clean HTML/CSS documents into high-fidelity PDFs via their print subsystems.
- Avoids server-side binary PDF dependencies (e.g., Dompdf, TCPDF, wkhtmltopdf) which often suffer from CSS flexbox/grid layout bugs, font rendering issues, and memory bloat.
- Print stylesheets strip headers, navigation sidebars, and interactive buttons, rendering clean letterhead, tabular data, page numbering, and institutional signature blocks.

### Alternatives Considered
- *Dompdf / mPDF*: Rejected due to styling limitations (poor flexbox support), PHP extension requirements, and increased maintenance overhead.
- *Client-side canvas/jsPDF*: Rejected because text searchability and print resolution are inferior compared to browser-native print rendering.

---

## 5. Daily Time Records (DTR) & Automated Completion Detection

### Decision
Calculate rendered hours on each daily log entry and automatically update the `progress` table upon supervisor approval. When `progress.total_hours >= required_hours` (e.g., 80/120/240 hours), automatically transition `progress.status` and `deployment.status` to `Completed`.

### Rationale
- Eliminates manual faculty audits for immersion completion.
- Tracks daily progress in real time, alerting both the student and agency supervisor when completion thresholds are met.
- Directly satisfies Thesis Objective 8 and Sprint 8 requirements.

### Alternatives Considered
- *Manual completion marking by faculty*: Rejected because automatic completion detection is an explicit research requirement of Sprint 8.

---

## 6. Real-Time Chat System Architecture

### Decision
Implement the internal messaging system using database-backed polling over the `messages` table (`message_id`, `sender_id`, `receiver_id`, `message`, `created_at`, `status`).

### Rationale
- Zero additional socket server infrastructure required (runs cleanly on standard Apache/PHP without requiring Node.js, Ratchet, or external SaaS like Pusher).
- Messages are persisted immediately in `moa_v2`.
- Lightweight AJAX polling or instant view refresh provides responsive message exchange suitable for academic and immersion coordination.

### Alternatives Considered
- *WebSockets (Ratchet / Socket.io)*: Rejected because running a persistent daemon process on shared or basic XAMPP environments introduces fragile runtime dependencies.
- *Third-party APIs (Firebase / Pusher)*: Rejected because offline/intranet capability and zero external cost/keys are capstone priorities.

---

## 7. Schema Mapping & Table Normalization (Chapter III Compliance)

### Decision
Map all 16 database tables exactly as specified in the thesis manuscript Chapter III schema while maintaining standard integer primary keys and foreign key constraints:
1. `users` - Core identity and role credentials
2. `students` - Student academic and contact profile
3. `faculty` - Faculty department and assignments
4. `agencies` - Host training establishments
5. `subjects` - Immersion courses mapped to faculty
6. `student_agency` - Placement selection requests and statuses
7. `documents` - Pre-immersion requirement categories
8. `student_documents` - Requirement file uploads and approval status
9. `deployment` - Official internship deployment records
10. `daily_logs` - Daily attendance and accomplishment logs
11. `progress` - Cumulative rendered hours and completion status
12. `messages` - Immersion communication messages
13. `evaluations` - Supervisor trainee performance rubric ratings
14. `reports` - Generated system report registry
15. `application_letters` - Endorsement letter metadata
16. `moa` - Memorandum of Agreement tracking for partner agencies
