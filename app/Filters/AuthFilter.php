<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (! $session->get('logged_in')) {
            return redirect()->to(base_url('login'))->with('error', 'Please log in to access this page.');
        }

        // If specific roles are passed as arguments (e.g. auth:admin,faculty)
        if (! empty($arguments)) {
            $userRole = $session->get('role');
            if (! in_array($userRole, $arguments, true)) {
                // Redirect user to their own role dashboard
                $redirectPath = match ($userRole) {
                    'admin'   => 'admin/dashboard',
                    'faculty' => 'faculty/dashboard',
                    'student' => 'student/dashboard',
                    'agency'  => 'agency/dashboard',
                    default   => 'login',
                };

                return redirect()->to(base_url($redirectPath))->with('error', 'Unauthorized access for your account role.');
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
