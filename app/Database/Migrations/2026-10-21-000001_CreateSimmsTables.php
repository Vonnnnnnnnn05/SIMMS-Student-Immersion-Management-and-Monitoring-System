<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSimmsTables extends Migration
{
    public function up()
    {
        // 1. users
        $this->forge->addField([
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'faculty', 'student', 'agency'],
                'default'    => 'student',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'pending'],
                'default'    => 'active',
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users', true);

        // 2. students
        $this->forge->addField([
            'student_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'course' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'year_level' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'guardian_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'guardian_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('student_id', true);
        $this->forge->createTable('students', true);

        // 3. faculty
        $this->forge->addField([
            'faculty_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('faculty_id', true);
        $this->forge->createTable('faculty', true);

        // 4. agencies
        $this->forge->addField([
            'agency_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'contact_person' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'contact_no' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default'    => 'active',
            ],
            'capacity' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 10,
            ],
        ]);
        $this->forge->addKey('agency_id', true);
        $this->forge->createTable('agencies', true);

        // 5. subjects
        $this->forge->addField([
            'subject_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'subject_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'faculty_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'required_hours' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 80,
            ],
        ]);
        $this->forge->addKey('subject_id', true);
        $this->forge->createTable('subjects', true);

        // 6. student_agency
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'agency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'date_selected' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('student_agency', true);

        // 7. documents
        $this->forge->addField([
            'document_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'document_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_mandatory' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);
        $this->forge->addKey('document_id', true);
        $this->forge->createTable('documents', true);

        // 8. student_documents
        $this->forge->addField([
            'student_doc_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'document_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'uploaded_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('student_doc_id', true);
        $this->forge->createTable('student_documents', true);

        // 9. deployment
        $this->forge->addField([
            'deployment_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'agency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['scheduled', 'active', 'completed', 'cancelled'],
                'default'    => 'scheduled',
            ],
        ]);
        $this->forge->addKey('deployment_id', true);
        $this->forge->createTable('deployment', true);

        // 10. daily_logs
        $this->forge->addField([
            'log_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'log_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'time_in' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'time_out' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'hours_rendered' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
            ],
            'tasks_done' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'supervisor_remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('log_id', true);
        $this->forge->createTable('daily_logs', true);

        // 11. progress
        $this->forge->addField([
            'progress_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'total_hours' => [
                'type'       => 'DECIMAL',
                'constraint' => '6,2',
                'default'    => 0.00,
            ],
            'required_hours' => [
                'type'       => 'DECIMAL',
                'constraint' => '6,2',
                'default'    => 80.00,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['in_progress', 'completed'],
                'default'    => 'in_progress',
            ],
            'completion_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('progress_id', true);
        $this->forge->createTable('progress', true);

        // 12. messages
        $this->forge->addField([
            'message_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sender_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'receiver_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'is_read' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('message_id', true);
        $this->forge->createTable('messages', true);

        // 13. evaluations
        $this->forge->addField([
            'evaluation_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'agency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'rating' => [
                'type'       => 'DECIMAL',
                'constraint' => '4,2',
                'default'    => 0.00,
            ],
            'competencies' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'feedback' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'evaluated_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('evaluation_id', true);
        $this->forge->createTable('evaluations', true);

        // 14. reports
        $this->forge->addField([
            'report_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'report_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'generated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'generated_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('report_id', true);
        $this->forge->createTable('reports', true);

        // 15. application_letters
        $this->forge->addField([
            'letter_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'agency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'date_generated' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'letter_content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('letter_id', true);
        $this->forge->createTable('application_letters', true);

        // 16. moa
        $this->forge->addField([
            'moa_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'agency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'start_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'expired', 'pending_renewal'],
                'default'    => 'active',
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('moa_id', true);
        $this->forge->createTable('moa', true);
    }

    public function down()
    {
        $tables = [
            'moa',
            'application_letters',
            'reports',
            'evaluations',
            'messages',
            'progress',
            'daily_logs',
            'deployment',
            'student_documents',
            'documents',
            'student_agency',
            'subjects',
            'agencies',
            'faculty',
            'students',
            'users',
        ];

        foreach ($tables as $table) {
            $this->forge->dropTable($table, true);
        }
    }
}
