@include('layouts.header')
@include('layouts.hero')

<section class="py-5">
    <div class="container">
        <div class="row">

            <!-- LEFT - WE'LL ANSWER YOUR QUERY -->
            <div class="col-lg-6 mb-5 mb-lg-0">

                <h4 class="fw-bold">WE'LL ANSWER YOUR QUERY</h4>
                <p class="text-muted">Don't hesitate to leave us your query/message. We response accordingly.</p>
                <hr style="width:40px; border:2px solid orange; margin:0 0 30px 0;">

                <!-- Phone -->
                <div class="d-flex align-items-start mb-4">
                    <i class="fas fa-phone-alt fa-lg text-primary me-3 mt-1"></i>
                    <div>
                        <strong>Phone</strong><br>
                        <span class="text-muted">+92 343 3367079</span>
                    </div>
                </div>

                <!-- Email -->
                <div class="d-flex align-items-start mb-4">
                    <i class="fas fa-envelope fa-lg text-primary me-3 mt-1"></i>
                    <div>
                        <strong>Email</strong><br>
                        <span class="text-muted">info@sultanaquranacademy.com</span>
                    </div>
                </div>

                <!-- Location -->
                <div class="d-flex align-items-start mb-4">
                    <i class="fas fa-map-marker-alt fa-lg text-primary me-3 mt-1"></i>
                    <div>
                        <strong>Location</strong><br>
                        <span class="text-muted">Sultana Quran Academy, Pakistan</span>
                    </div>
                </div>

            </div>

            <!-- RIGHT - CONTACT US FORM -->
            <div class="col-lg-6">

                <h4 class="fw-bold">CONTACT US</h4>
                <p class="text-muted">Your email address will not be published. Required fields are marked.</p>
                <hr style="width:40px; border:2px solid orange; margin:0 0 30px 0;">

                {{-- SUCCESS ALERT --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control border-0 border-bottom rounded-0"
                                       placeholder="Name *"
                                       required>
                            </div>

                            <div class="mb-3">
                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control border-0 border-bottom rounded-0"
                                       placeholder="Email *"
                                       required>
                            </div>

                            <div class="mb-3">
                                <input type="text"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       class="form-control border-0 border-bottom rounded-0"
                                       placeholder="Subject">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <textarea name="message"
                                          class="form-control rounded-0"
                                          rows="6"
                                          placeholder="Message *"
                                          required>{{ old('message') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <button type="submit"
                            class="btn fw-bold text-white px-4 py-2"
                            style="background-color:#c0622b; border-radius:30px;">
                        SEND A MESSAGE
                    </button>

                </form>

            </div>

        </div>
    </div>
</section>

@include('layouts.footer')