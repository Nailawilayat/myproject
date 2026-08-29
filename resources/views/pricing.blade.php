@include('layouts.header')
@include('layouts.hero')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

{{-- ==================== HEADING SECTION ==================== --}}
<section class="pricing-heading text-center py-5">
    <div class="container">
        <h2 class="fw-bold text-uppercase">Our Pricing</h2>
        <p class="text-muted mx-auto" style="max-width: 1050px;">
            We are providing our services only for the sake of Allah. Program fees are not fixed.
            So that even one can learn him/herself and can easily encourage his/her children even
            others to learn Holy Quran education.
        </p>
        <div class="mx-auto mt-2" style="width: 40px; height: 2px; background-color: #b5651d;"></div>
    </div>
</section>

{{-- ==================== PRICING CARDS SECTION ==================== --}}
<section class="pricing-cards py-4">
    <div class="container">
        <div class="row g-4 justify-content-center align-items-stretch">
            @foreach ($pricings as $plan)
                <div class="col-12 col-sm-6 col-lg-3 d-flex">
                    <div class="pricing-card border w-100 d-flex flex-column">

                        {{-- Card Header --}}
                        <div class="pricing-card-header text-center bg-light py-4">
                            <h5 class="text-uppercase mb-2">{{ $plan->plan_name }}</h5>
                            <hr style="width:30px; border: 1px solid #b5651d; margin: 0 auto 15px;">
                            <h1 class="fw-bold mb-0" style="color:#b5651d;">{{ $plan->days_per_week }}</h1>
                            <p class="text-muted mb-0">days per week</p>
                        </div>

                        {{-- Card Body --}}
                        <div class="pricing-card-body p-4 d-flex flex-column flex-grow-1">
                            <ul class="list-unstyled text-start mb-4 flex-grow-1">
                                <li class="mb-3">
                                    <i class="fa fa-check text-success me-2"></i>
                                    <strong>{{ $plan->free_trial_days }}</strong> Days Free Trial
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success me-2"></i>
                                    <strong>{{ $plan->minutes_per_day }}</strong> Min/day
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success me-2"></i>
                                    {{ $plan->age_gender }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success me-2"></i>
                                    {{ $plan->support }}
                                </li>
                                <li class="mb-3">
                                    <i class="fa fa-check text-success me-2"></i>
                                    {{ $plan->class_type }}
                                </li>
                                <li class="mb-0">
                                    <i class="fa fa-check text-success me-2"></i>
                                    <strong>{{ $plan->days_per_week_text }}</strong>
                                </li>
                            </ul>

                            {{-- Apply Button -> Register Page (always bottom) --}}
                            <div class="text-center mt-auto">
                                <a href="{{ route('register') }}" class="btn btn-outline-custom rounded-pill px-4 py-2">
                                    Apply Now
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('layouts.footer')