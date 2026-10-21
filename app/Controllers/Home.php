<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AgencyModel;
use App\Models\FacultyModel;
use App\Models\DeploymentModel;

class Home extends BaseController
{
    public function index(): string
    {
        $studentModel    = new StudentModel();
        $agencyModel     = new AgencyModel();
        $facultyModel    = new FacultyModel();
        $deploymentModel = new DeploymentModel();

        $data = [
            'title'              => 'SIMMS | Student Immersion Management and Monitoring System',
            'total_students'     => $studentModel->countAllResults(),
            'total_agencies'     => $agencyModel->countAllResults(),
            'total_faculty'      => $facultyModel->countAllResults(),
            'active_deployments' => $deploymentModel->where('status', 'active')->countAllResults(),
            'featured_agencies'  => $agencyModel->orderBy('agency_id', 'ASC')->findAll(6),
        ];

        return view('home/index', $data);
    }
}
