<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ResumeController extends Controller
{
    public function view(): Response
    {
        $path = storage_path('app/private/resume.pdf');

        abort_unless(file_exists($path), 404, 'Resume not available.');

        return response(file_get_contents($path), 200, [
            'Content-Type'           => 'application/pdf',
            'Content-Disposition'    => 'inline; filename="resume.pdf"',
            'Cache-Control'          => 'no-store, no-cache, must-revalidate, private',
            'Pragma'                 => 'no-cache',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
