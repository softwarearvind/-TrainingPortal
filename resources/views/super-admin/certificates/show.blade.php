@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

 <div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <div>

            <h3 class="fw-bold">
                Certificate Details
            </h3>

            <p class="text-muted">
                {{ $certificate->certificate_no }}
            </p>

        </div>

        <div>

            <a
                href="{{ route('super-admin.certificates.download', $certificate) }}"
                class="btn btn-success">

                <i class="bi bi-download"></i>
                Download PDF

            </a>

        </div>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <p>
                        <strong>Certificate No:</strong>
                        {{ $certificate->certificate_no }}
                    </p>

                    <p>
                        <strong>Student:</strong>
                        {{ $certificate->student->user->name ?? '-' }}
                    </p>

                    <p>
                        <strong>Course:</strong>
                        {{ $certificate->course->name ?? '-' }}
                    </p>

                    <p>
                        <strong>Batch:</strong>
                        {{ $certificate->batch->name ?? '-' }}
                    </p>

                    <p>
                        <strong>Marks:</strong>
                        {{ $certificate->marks ?? '-' }}
                        /
                        {{ $certificate->total_marks ?? '-' }}
                    </p>

                    <p>
                        <strong>Grade:</strong>
                        {{ $certificate->grade ?? '-' }}
                    </p>

                    <p>
                        <strong>Issue Date:</strong>
                        {{ $certificate->issue_date?->format('d M Y') }}
                    </p>

                </div>


                <div class="col-md-6">

                    <div class="text-center">

                        <h6 class="fw-bold">
                            Verification URL
                        </h6>

                        <div class="alert alert-light">

                            {{ route(
                                'super-admin.certificate.verify',
                                $certificate->verification_code
                            ) }}

                        </div>

                        <a
                            href="{{ route( 'super-admin.certificate.verify',
                                $certificate->verification_code
                            ) }}"
                            target="_blank"
                            class="btn btn-outline-primary">

                            <i class="bi bi-shield-check"></i>

                            Verify Certificate

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection
