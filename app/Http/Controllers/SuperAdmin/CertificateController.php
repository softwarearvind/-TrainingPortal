<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Student;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with([
            'student',
            'course',
            'batch'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.certificates.index',
            compact('certificates')
        );
    }

    public function create()
    {
        $students = Student::with('user')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.certificates.create',
            compact(
                'students',
                'courses',
                'batches'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'student_id' => [
                'required',
                'exists:students,id'
            ],

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'batch_id' => [
                'required',
                'exists:batches,id'
            ],

            'certificate_title' => [
                'required',
                'string',
                'max:255'
            ],

            'marks' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'total_marks' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'grade' => [
                'nullable',
                'string',
                'max:50'
            ],

            'completion_date' => [
                'nullable',
                'date'
            ],

            'issue_date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);

        $data['certificate_no'] =
            $this->generateCertificateNumber();

        $data['verification_code'] =
            strtoupper(Str::random(16));

        $certificate = Certificate::create($data);

        return redirect()
            ->route(
                'super-admin.certificates.show',
                $certificate
            )
            ->with(
                'success',
                'Certificate created successfully.'
            );
    }

    public function show(Certificate $certificate)
    {
        $certificate->load([
            'student.user',
            'course',
            'batch'
        ]);

        return view(
            'super-admin.certificates.show',
            compact('certificate')
        );
    }

    public function edit(Certificate $certificate)
    {
        $students = Student::with('user')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.certificates.edit',
            compact(
                'certificate',
                'students',
                'courses',
                'batches'
            )
        );
    }

    public function update(
        Request $request,
        Certificate $certificate
    ) {
        $data = $request->validate([

            'student_id' => [
                'required',
                'exists:students,id'
            ],

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'batch_id' => [
                'required',
                'exists:batches,id'
            ],

            'certificate_title' => [
                'required',
                'string',
                'max:255'
            ],

            'marks' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'total_marks' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'grade' => [
                'nullable',
                'string',
                'max:50'
            ],

            'completion_date' => [
                'nullable',
                'date'
            ],

            'issue_date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'boolean'
            ],
        ]);

        $certificate->update($data);

        return redirect()
            ->route(
                'super-admin.certificates.index'
            )
            ->with(
                'success',
                'Certificate updated successfully.'
            );
    }

    public function destroy(Certificate $certificate)
    {
        if (
            $certificate->certificate_file &&
            File::exists(
                public_path(
                    $certificate->certificate_file
                )
            )
        ) {
            File::delete(
                public_path(
                    $certificate->certificate_file
                )
            );
        }

        $certificate->delete();

        return back()->with(
            'success',
            'Certificate deleted successfully.'
        );
    }

    public function download(Certificate $certificate)
    {
        $certificate->load([
            'student.user',
            'course',
            'batch'
        ]);

        $verificationUrl = route(
            'super-admin.certificate.verify',
            $certificate->verification_code
        );

        $pdf = Pdf::loadView(
            'super-admin.certificates.pdf',
            compact(
                'certificate',
                'verificationUrl'
            )
        );

        return $pdf->download(
            $certificate->certificate_no . '.pdf'
        );
    }

    private function generateCertificateNumber(): string
    {
        do {

            $number =
                'CERT-' .
                now()->format('Y') .
                '-' .
                strtoupper(
                    Str::random(8)
                );

        } while (
            Certificate::where(
                'certificate_no',
                $number
            )->exists()
        );

        return $number;
    }
}
