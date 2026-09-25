@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Super Admin Dashboard')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                @if($certificate)
                    <div style="height:6px;background:linear-gradient(90deg,#28a745,#20c997);"></div>
                @else
                    <div style="height:6px;background:linear-gradient(90deg,#dc3545,#e4606d);"></div>
                @endif

                <div class="card-body p-5 text-center">

                    @if($certificate)

                        <div class="mb-4">
                            <div
                                class="rounded-circle bg-success bg-gradient text-white d-inline-flex align-items-center justify-content-center shadow-sm"
                                style="width:90px;height:90px;">
                                <i class="bi bi-patch-check-fill" style="font-size:2.5rem;"></i>
                            </div>
                        </div>

                        <span class="badge rounded-pill text-bg-success-subtle text-success-emphasis px-3 py-2 mb-2 fw-semibold">
                            Verified
                        </span>

                        <h2 class="fw-bold text-success mb-1">
                            Certificate Verified
                        </h2>

                        <p class="text-muted mb-0">
                            This certificate is valid and has been successfully authenticated.
                        </p>

                        <hr class="my-4">

                        <p class="text-uppercase small text-muted fw-semibold mb-1" style="letter-spacing:1px;">
                            {{ $certificate->certificate_title }}
                        </p>

                        <h2 class="fw-bold mb-2">
                            {{ $certificate->student->user->name ?? '-' }}
                        </h2>

                        <p class="text-muted mb-1">
                            has successfully completed
                        </p>

                        <h4 class="fw-bold text-primary">
                            {{ $certificate->course->name }}
                        </h4>

                        <div class="row mt-4 g-3 text-start">

                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <div class="text-muted small text-uppercase fw-semibold" style="letter-spacing:.5px;">
                                        <i class="bi bi-hash"></i> Certificate Number
                                    </div>
                                    <div class="fw-bold mt-1">
                                        {{ $certificate->certificate_no }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <div class="text-muted small text-uppercase fw-semibold" style="letter-spacing:.5px;">
                                        <i class="bi bi-people-fill"></i> Batch
                                    </div>
                                    <div class="fw-bold mt-1">
                                        {{ $certificate->batch->name ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <div class="text-muted small text-uppercase fw-semibold" style="letter-spacing:.5px;">
                                        <i class="bi bi-star-fill"></i> Grade
                                    </div>
                                    <div class="fw-bold mt-1">
                                        {{ $certificate->grade ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <div class="text-muted small text-uppercase fw-semibold" style="letter-spacing:.5px;">
                                        <i class="bi bi-calendar-check"></i> Issue Date
                                    </div>
                                    <div class="fw-bold mt-1">
                                        {{ $certificate->issue_date?->format('d M Y') ?? '-' }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-success d-flex align-items-center gap-2 mt-4 mb-0 rounded-3">
                            <i class="bi bi-shield-check fs-5"></i>
                            <span>Certificate authenticity has been verified successfully.</span>
                        </div>

                    @else

                        <div class="mb-4">
                            <div
                                class="rounded-circle bg-danger bg-gradient text-white d-inline-flex align-items-center justify-content-center shadow-sm"
                                style="width:90px;height:90px;">
                                <i class="bi bi-x-lg" style="font-size:2.2rem;"></i>
                            </div>
                        </div>

                        <span class="badge rounded-pill text-bg-danger-subtle text-danger-emphasis px-3 py-2 mb-2 fw-semibold">
                            Not Verified
                        </span>

                        <h2 class="fw-bold text-danger mb-1">
                            Invalid Certificate
                        </h2>

                        <p class="text-muted mb-0">
                            The certificate could not be verified. Please check the link or certificate number and try again.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
