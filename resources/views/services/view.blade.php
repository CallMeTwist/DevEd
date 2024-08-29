<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">{{ $service->title }}</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item"><a href="#">services</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Single Service Page Start -->
    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Service Content Start -->
                    <div class="service-single-content">
                        <!-- Service Featured Image Start -->
                        <div class="service-featured-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset($service->image) }}" alt="">
                            </figure>
                        </div>
                        <!-- Service Featured Image End -->

                        <!-- Service Entry Content Start -->
                        <div class="service-entry">
                            <p class="wow fadeInUp" data-wow-delay="0.25s">{!! $service->description !!}</p>
                        </div>
                        <!-- Service Entry Content End -->
                    </div>
                    <!-- Service Content End -->
                </div>

                <div class="col-lg-4">
                    <div class="service-sidebar">
                        <!-- Service List Box Start -->
                        <div class="services-list-box wow fadeInUp" data-wow-delay="0.5s">
                            <div class="icon-box">
                                <img src="/assets/images/icon-service-list.svg" alt="">
                            </div>
                            <h3>website development</h3>
                            <ul>
                                @foreach (json_decode($service->summary, true) as $summaryItem)
                                    <li><a href="#">{{ $summaryItem }}</a></li>
                                @endforeach
                            </ul>
                            <a href="{{ route('contact.page') }}" class="btn-default">contact now</a>
                        </div>
                        <!-- Service List Box End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Service Page End -->
    <!-- Our Services Section Start -->
    <div class="our-services">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-7 col-md-7">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">related services</h3>
                        <h2 class="text-anime-style-3">Explore our related services</h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-lg-5 col-md-5">
                    <!-- Section Btn Start -->
                    <div class="section-btn">
                        <a href="{{ route('about') }}" class="btn-default wow fadeInUp" data-wow-delay="0.25s">view all services</a>
                    </div>
                    <!-- Section Btn End -->
                </div>
            </div>

            <div class="row">
                @foreach($relatedServices as $index => $erelated)
                <div class="col-lg-4 col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                        <div class="service-content">
                            <div class="service-content-title">
                                <h2>{{ $erelated->title }}</h2>
                                <a href="{{ route('services.view', str_slug($erelated->title)) }}"><img src="/assets/images/arrow.svg" alt=""></a>
                            </div>
                            <p>{!! str_limit($erelated->description, 130) !!}</p>
                        </div>
                        <div class="service-image">
                            <figure class="image-anime">
                                <img src="{{ asset($erelated->image) }}" alt="">
                            </figure>
                        </div>
                    </div>
                    <!-- Service Item End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Our Services Section End -->

    <!-- FAQs Page Start -->
    <div class="service-faqs">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">FAQ's</h3>
                        <h2 class="text-anime-style-3">Frequently asked question</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="faq-accordion" id="accordion">
                        @foreach($faqs as $index => $faq)
                            <!-- FAQ Item start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        {!! $faq->question !!}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}"
                                     data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <p>{!! $faq->answer !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ask-question wow fadeInUp" data-wow-delay="0.5s">
                        <div class="ask-question-content">
                            <h3>You still have question?</h3>
                            <p>We’re here to assist with all your queries and provide the answers you need to make informed decisions.</p>
                        </div>
                        <div class="ask-contact-list">
                            <div class="icon-box">
                                <a href="#"><img src="/assets/images/icon-phone.svg" alt=""></a>
                            </div>
                            <a href="#"><span>Phone:</span> {{ get_settings()->phone }}</a>
                        </div>

                        <div class="ask-contact-list">
                            <div class="icon-box">
                                <a href="#"><img src="/assets/images/icon-mail.svg" alt=""></a>
                            </div>
                            <a href="mailto:{{ get_settings()->email }}"><span>Email:</span> {{ get_settings()->email }}</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Page Ends -->
</x-website.master>
