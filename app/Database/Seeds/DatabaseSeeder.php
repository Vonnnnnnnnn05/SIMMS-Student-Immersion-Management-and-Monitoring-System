<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Users
        $users = [
            [
                'user_id'    => 1,
                'first_name' => 'System',
                'last_name'  => 'Administrator',
                'email'      => 'admin@simms.edu.ph',
                'password'   => password_hash('admin123', PASSWORD_BCRYPT),
                'role'       => 'admin',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 2,
                'first_name' => 'Prof. Eleanor',
                'last_name'  => 'Vance',
                'email'      => 'faculty@simms.edu.ph',
                'password'   => password_hash('faculty123', PASSWORD_BCRYPT),
                'role'       => 'faculty',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 3,
                'first_name' => 'Juan',
                'last_name'  => 'Dela Cruz',
                'email'      => 'student@simms.edu.ph',
                'password'   => password_hash('student123', PASSWORD_BCRYPT),
                'role'       => 'student',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'    => 4,
                'first_name' => 'Roberto',
                'last_name'  => 'Gomez',
                'email'      => 'agency@partner.com',
                'password'   => password_hash('agency123', PASSWORD_BCRYPT),
                'role'       => 'agency',
                'status'     => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('users')->insertBatch($users);

        // 2. Faculty
        $this->db->table('faculty')->insert([
            'faculty_id' => 1,
            'user_id'    => 2,
            'department' => 'College of Information and Communications Technology',
            'contact_no' => '09171234567',
        ]);

        // 3. Students
        $this->db->table('students')->insert([
            'student_id'       => 1,
            'user_id'          => 3,
            'course'           => 'BS Information Technology',
            'year_level'       => '4th Year',
            'contact_no'       => '09189876543',
            'address'          => 'Unit 402, Acacia Heights, Metro Manila',
            'guardian_name'    => 'Maria Dela Cruz',
            'guardian_contact' => '09191112233',
        ]);

        // 4. Partner Agencies
        $this->db->table('agencies')->insert([
            'agency_id'      => 1,
            'name'           => 'TechSolutions Innovations Inc.',
            'address'        => 'Building 4, Cyberzone IT Park, Pasig City',
            'contact_person' => 'Roberto Gomez',
            'contact_no'     => '09205556677',
            'email'          => 'agency@partner.com',
            'status'         => 'active',
            'capacity'       => 15,
        ]);

        // 5. MOA
        $this->db->table('moa')->insert([
            'moa_id'     => 1,
            'agency_id'  => 1,
            'start_date' => '2026-01-15',
            'end_date'   => '2027-01-15',
            'status'     => 'active',
            'file_path'  => 'signed_moa_techsolutions.pdf',
        ]);

        // 6. Immersion Subjects
        $this->db->table('subjects')->insert([
            'subject_id'     => 1,
            'subject_name'   => 'IT 412 - Practicum / Industry Immersion (80 Hours)',
            'faculty_id'     => 1,
            'required_hours' => 80,
        ]);

        // 7. Mandatory Documents
        $documents = [
            [
                'document_id'   => 1,
                'document_name' => 'Medical & Health Examination Clearance',
                'description'   => 'Physician-certified diagnostic clearance proving fitness for on-site immersion duties.',
                'is_mandatory'  => 1,
            ],
            [
                'document_id'   => 2,
                'document_name' => 'Parent / Guardian Consent & Liability Waiver',
                'description'   => 'Signed consent authorization from legal guardian for corporate deployment.',
                'is_mandatory'  => 1,
            ],
            [
                'document_id'   => 3,
                'document_name' => 'Student Trainee Resume / Curriculum Vitae',
                'description'   => 'Standardized institutional format resume highlighting course competencies.',
                'is_mandatory'  => 1,
            ],
            [
                'document_id'   => 4,
                'document_name' => 'Host Agency Acceptance Slip',
                'description'   => 'Countersigned acceptance memorandum from partner training establishment.',
                'is_mandatory'  => 1,
            ],
        ];
        $this->db->table('documents')->insertBatch($documents);

        // 8. Student Agency Selection
        $this->db->table('student_agency')->insert([
            'id'            => 1,
            'student_id'    => 1,
            'agency_id'     => 1,
            'status'        => 'approved',
            'date_selected' => '2026-09-01',
            'remarks'       => 'Endorsed for Software & Systems Support Immersion Track',
        ]);

        // 9. Student Documents
        $studentDocs = [
            [
                'student_doc_id' => 1,
                'student_id'     => 1,
                'document_id'    => 1,
                'file_path'      => 'uploads/documents/medical_delacruz.pdf',
                'status'         => 'approved',
                'remarks'        => 'Medical certificate verified by university clinic.',
                'uploaded_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'student_doc_id' => 2,
                'student_id'     => 1,
                'document_id'    => 2,
                'file_path'      => 'uploads/documents/parent_consent_delacruz.pdf',
                'status'         => 'approved',
                'remarks'        => 'Signed consent verified with guardian contact.',
                'uploaded_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'student_doc_id' => 3,
                'student_id'     => 1,
                'document_id'    => 3,
                'file_path'      => 'uploads/documents/resume_delacruz.pdf',
                'status'         => 'approved',
                'remarks'        => 'Resume meets departmental immersion standards.',
                'uploaded_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('student_documents')->insertBatch($studentDocs);

        // 10. Deployment
        $this->db->table('deployment')->insert([
            'deployment_id' => 1,
            'student_id'    => 1,
            'agency_id'     => 1,
            'start_date'    => '2026-09-15',
            'end_date'      => '2026-11-20',
            'status'        => 'active',
        ]);

        // 11. Daily Logs
        $logs = [
            [
                'log_id'             => 1,
                'student_id'         => 1,
                'log_date'           => '2026-10-14',
                'time_in'            => '08:00:00',
                'time_out'           => '17:00:00',
                'hours_rendered'     => 8.00,
                'tasks_done'         => 'Company orientation, IT infrastructure walkthrough, and workstation credential configuration.',
                'status'             => 'approved',
                'supervisor_remarks' => 'Punctual and engaged during systems onboarding.',
            ],
            [
                'log_id'             => 2,
                'student_id'         => 1,
                'log_date'           => '2026-10-15',
                'time_in'            => '08:00:00',
                'time_out'           => '17:00:00',
                'hours_rendered'     => 8.00,
                'tasks_done'         => 'Database backup routine verification and basic SQL reporting queries.',
                'status'             => 'approved',
                'supervisor_remarks' => 'Good comprehension of query optimization.',
            ],
            [
                'log_id'             => 3,
                'student_id'         => 1,
                'log_date'           => '2026-10-16',
                'time_in'            => '08:00:00',
                'time_out'           => '17:00:00',
                'hours_rendered'     => 8.00,
                'tasks_done'         => 'Assisted senior systems engineer in network cable diagnostics and switch port mapping.',
                'status'             => 'approved',
                'supervisor_remarks' => 'Diligent and careful with networking hardware.',
            ],
            [
                'log_id'             => 4,
                'student_id'         => 1,
                'log_date'           => '2026-10-19',
                'time_in'            => '08:00:00',
                'time_out'           => '17:00:00',
                'hours_rendered'     => 8.00,
                'tasks_done'         => 'Reviewed user support ticketing queue and resolved 4 level-one desktop printer/VPN issues.',
                'status'             => 'approved',
                'supervisor_remarks' => 'Demonstrated excellent communication skills with staff.',
            ],
            [
                'log_id'             => 5,
                'student_id'         => 1,
                'log_date'           => '2026-10-20',
                'time_in'            => '08:00:00',
                'time_out'           => '17:00:00',
                'hours_rendered'     => 8.00,
                'tasks_done'         => 'Drafted internal user guide for office wireless onboarding and guest credential generation.',
                'status'             => 'approved',
                'supervisor_remarks' => 'Clear documentation and effective presentation.',
            ],
        ];
        $this->db->table('daily_logs')->insertBatch($logs);

        // 12. Progress
        $this->db->table('progress')->insert([
            'progress_id'     => 1,
            'student_id'      => 1,
            'total_hours'     => 40.00,
            'required_hours'  => 80.00,
            'status'          => 'in_progress',
            'completion_date' => null,
        ]);

        // 13. Application Letter
        $this->db->table('application_letters')->insert([
            'letter_id'      => 1,
            'student_id'     => 1,
            'agency_id'      => 1,
            'date_generated' => '2026-09-05',
            'letter_content' => 'Official Endorsement Letter addressed to Mr. Roberto Gomez for Juan Dela Cruz.',
        ]);

        // 14. Chat Messages
        $messages = [
            [
                'message_id'  => 1,
                'sender_id'   => 3, // Student
                'receiver_id' => 2, // Faculty
                'message'     => 'Good morning Prof. Vance, I have submitted all 3 pre-immersion clearance documents for verification.',
                'is_read'     => 1,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'message_id'  => 2,
                'sender_id'   => 2, // Faculty
                'receiver_id' => 3, // Student
                'message'     => 'Received and approved Juan! Please report to TechSolutions Innovations on Monday at 8:00 AM.',
                'is_read'     => 1,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'message_id'  => 3,
                'sender_id'   => 4, // Agency
                'receiver_id' => 3, // Student
                'message'     => 'Welcome to the team Juan. Please look for me at the 4th floor reception upon arrival.',
                'is_read'     => 0,
                'created_at'  => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
        ];
        $this->db->table('messages')->insertBatch($messages);

        // 15. Sample Evaluation
        $this->db->table('evaluations')->insert([
            'evaluation_id' => 1,
            'student_id'    => 1,
            'agency_id'     => 1,
            'rating'        => 4.85,
            'competencies'  => json_encode([
                'quality_of_work' => 5,
                'communication'   => 5,
                'punctuality'     => 5,
                'initiative'      => 4,
                'teamwork'        => 5,
            ]),
            'feedback'      => 'Juan is an exceptional trainee with strong technical skills and professional work ethics.',
            'evaluated_at'  => date('Y-m-d H:i:s'),
        ]);

        // 16. Reports log
        $this->db->table('reports')->insert([
            'report_id'    => 1,
            'student_id'   => 1,
            'report_type'  => 'personal_info',
            'generated_by' => 2,
            'generated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
