<!-- =====================================================
     TRAINERS
===================================================== -->

<section
    class="section-padding bg-light"
    id="trainers"
>

    <div class="container">

        <div class="mb-5 section-title">

            <span>Our Trainers</span>

            <h2>
                Learn From Experienced Trainers
            </h2>

            <p>
                Get guidance from professionals with
                practical experience.
            </p>

        </div>


        <div class="row g-4">

            @forelse($homeTrainers as $trainer)

                <div class="col-md-4">

                    <div class="trainer-card">

                        @if($trainer->image)

                            <img
                                src="{{ asset('uploads/trainers/' . basename($trainer->image)) }}"
                                alt="{{ $trainer->name }}"
                            >

                        @else

                            <div
                                style="height:280px;"
                                class="text-white bg-dark d-flex align-items-center justify-content-center"
                            >

                                <i class="bi bi-person-circle fs-1"></i>

                            </div>

                        @endif


                        <div class="trainer-info">

                            <h5>
                                {{ $trainer->name }}
                            </h5>

                            <p>
                                {{ $trainer->specialization ?? 'Professional Trainer' }}
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center col-12">

                    <p class="text-muted">
                        Our trainers will be available soon.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>
