<?php

namespace App\Http\Controllers;

use App\Models\Certificate;

class CertificateVerificationController extends Controller
{
    public function verify(string $code)
    {
        $certificate = Certificate::with([
            'student.user',
            'course',
            'batch'
        ])
        ->where(
            'verification_code',
            $code
        )
        ->where('status', true)
        ->first();

        return view(
            'certificates.verify',compact('certificate')
        );
    }
}
