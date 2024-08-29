<x-website.master>
<!-- Hero Section Start -->
<div class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">about our Company</h3>
                        <h1 class="text-anime-style-3">Web Design, SEO & Digital Solutions For <span>Your Business</span></h1>
                    </div>
                    <!-- Section Title End -->

                    <!-- Hero Body Start -->
                    <div class="hero-body">
                        <p class="wow fadeInUp" data-wow-delay="0.5s">Empower your business with top-notch web and app development, eye-catching graphic design, and effective project management. We deliver tailored digital solutions to elevate your brand's success.</p>
                    </div>
                    <!-- Hero Body End -->

                    <!-- Hero Footer Start -->
                    <div class="hero-footer">
                        <a href="{{ route('contact.page') }}" class="btn-default wow fadeInUp" data-wow-delay="0.75s">Free Consultation</a>
                    </div>
                    <!-- Hero Footer End -->
                </div>
                <!-- Hero Left Content End -->
            </div>

            <div class="col-lg-4">
                <!-- Hero Video Image Start -->
                <div class="hero-video-image">
                    <!-- Hero Slider Start -->
                    <div class="hero-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <!-- Hero Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Slider Image Start -->
                                    <div class="hero-slider-image">
                                        <img src="/assets/images/hero-img.jpg" alt="">
                                    </div>
                                    <!-- Slider Image End -->
                                </div>
                                <!-- Hero Slide End -->

                                <!-- Hero Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Slider Image Start -->
                                    <div class="hero-slider-image">
                                        <img src="/assets/images/hero-img-2.jpg" alt="">
                                    </div>
                                    <!-- Slider Image End -->
                                </div>
                                <!-- Hero Slide End -->

                                <!-- Hero Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Slider Image Start -->
                                    <div class="hero-slider-image">
                                        <img src="/assets/images/hero-img.jpg" alt="">
                                    </div>
                                    <!-- Slider Image End -->
                                </div>
                                <!-- Hero Slide End -->

                                <!-- Hero Slide Start -->
                                <div class="swiper-slide">
                                    <!-- Slider Image Start -->
                                    <div class="hero-slider-image">
                                        <img src="/assets/images/hero-img-2.jpg" alt="">
                                    </div>
                                    <!-- Slider Image End -->
                                </div>
                                <!-- Hero Slide End -->
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="hero-play-button">
                        <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video"><i class="fa-solid fa-play"></i></a>
                    </div>
                </div>
                <!-- Hero Video Image End -->
            </div>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- About Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-8">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">about Company</h3>
                    <h2 class="text-anime-style-3">{!! $abouts->header !!} </h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- About Us Image Start -->
                <div class="about-image">
                    <div class="about-img">
                        <figure class="image-anime reveal">
                            <img src="/assets/images/about-us-img.jpg" alt="">
                        </figure>
                    </div>
                    <div class="about-consultation">
                        <figure>
                            <img src="/assets/images/about-circle.png" alt="">
                        </figure>
                    </div>
                </div>
                <!-- About Us Image End -->
            </div>

            <div class="col-lg-6">
                <!-- About Us Content Start -->
                <div class="about-content">
                    <p class="wow fadeInUp" data-wow-delay="0.25s">{!!$abouts->text!!}</p>

                    <ul class="wow fadeInUp" data-wow-delay="1s">
                        <li>Innovative Design</li>
                        <li>Seamless Integration</li>
                        <li>Engaging User Experience</li>
                        <li>Strategic SEO</li>
                        <li>Full Flexibility</li>
                        <li>Comprehensive Support</li>
                    </ul>

                    <a href="{{ route('contact.page') }}" class="btn-default wow fadeInUp" data-wow-delay="1.25s">free consultation</a>
                </div>
                <!-- About Us Content End -->
            </div>
        </div>
    </div>
</div>
<!-- About Section End -->

<!-- Our Services Section Start -->
<div class="our-services">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-7 col-md-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">our services</h3>
                    <h2 class="text-anime-style-3">What we can offer today</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-5 col-md-5">
                <!-- Section Btn Start -->
                <div class="section-btn">
                    <a href="{{ route('services.index') }}" class="btn-default wow fadeInUp" data-wow-delay="0.25s">view all services</a>
                </div>
                <!-- Section Btn End -->
            </div>
        </div>

        <div class="row">
            @foreach($services as $index => $service)
            <div class="col-lg-4 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                    <div class="service-content">
                        <div class="service-content-title">
                            <h2>{{ $service->title }}</h2>
                            <a href="{{ route('services.view', $service->code) }}"><img src="/assets/images/arrow.svg" alt=""></a>
                        </div>
                        <p>{!! str_limit($service->description, 130) !!}</p>
                    </div>
                    <div class="service-image">
                        <a href="{{ route('services.view', $service->code) }}">
                            <figure class="image-anime">
                                <img src="{{ $service->image }}" alt="">
                            </figure>
                        </a>
                    </div>
                </div>
                <!-- Service Item End -->
            </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Our Services Section End -->

<!-- Our Work Section Start -->
<div class="our-work">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-8 col-md-9">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">our works</h3>
                    <h2 class="text-anime-style-3">Excellence from concept to completion</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-4 col-md-3">
                <!-- Section Btn Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                    <a href="{{ route('portfolios.index') }}" class="btn-default">all portfolio</a>
                </div>
                <!-- Section Btn End -->
            </div>
        </div>

        <div class="row">
            @foreach($projects as $index => $project)
            <div class="col-md-6">
                <!-- Works Item Start -->
                <div class="works-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                    <div class="works-image">
                        <figure class="image-anime">
                            <img src="{{ $project->image }}" alt="" class="img-fluid" style="max-height: 300px; object-fit: cover;">
                        </figure>
                    </div>
                    <div class="works-content">
                        <h2>{{ $project->name }}</h2>
                        <p>{!! str_limit(str_replace('Project Overview', '', $project->description), 130) !!}</p>

                    </div>
                </div>
                <!-- Works Item End -->
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Work Section End -->

<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-8 col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">why choose us</h3>
                    <h2 class="text-anime-style-3">What Sets Us Apart ?</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- Why Choose Item Start -->
                <div class="why-choose-us-item wow fadeInUp" data-wow-delay="0.25s">
                    <div class="icon-box">
                        <img src="/assets/images/icon-whyus-1.svg" alt="">
                    </div>
                    <h3>Innovation</h3>
                    <p>We stay ahead of the curve, bringing cutting-edge solutions to meet your business needs.</p>
                </div>
                <!-- Why Choose Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Why Choose Item Start -->
                <div class="why-choose-us-item wow fadeInUp" data-wow-delay="0.5s">
                    <div class="icon-box">
                        <img src="/assets/images/icon-whyus-2.svg" alt="">
                    </div>
                    <h3>Quality-focused</h3>
                    <p>Our commitment to excellence ensures top-notch results in every project we undertake.</p>
                </div>
                <!-- Why Choose Item End -->
            </div>

            <div class="col-lg-4">
                <!-- Why Choose Item Start -->
                <div class="why-choose-us-item wow fadeInUp" data-wow-delay="0.75s">
                    <div class="icon-box">
                        <img src="/assets/images/icon-whyus-3.svg" alt="">
                    </div>
                    <h3>Value for money</h3>
                    <p>We deliver exceptional services that offer great returns on your investment.</p>
                </div>
                <!-- Why Choose Item End -->
            </div>

            <div class="col-md-12">
                <!-- Why Us Explore Item Start -->
                <div class="why-us-explore-item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="why-us-section-title">
                                <!-- Section Title Start -->
                                <div class="section-title">
                                    <h2 class="text-anime-style-3">Do you want to explore our outstanding work?</h2>
                                </div>
                                <!-- Section Title End -->

                                <!-- Explore Item Icon Start -->
                                <div class="explore-item-icon">
                                    <img src="/assets/images/icon-whyus-4.svg" alt="">
                                </div>
                                <!-- Explore Item Icon End -->
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <!-- Explore Item Content Start -->
                            <div class="explore-item-content wow fadeInUp" data-wow-delay="0.25s">
                                <p>Discover how we transform ideas into reality with our portfolio of successful projects. Each one showcases our dedication to innovation, quality, and client satisfaction. Explore now and see the difference we can make for your business.</p>
                            </div>
                            <!-- Explore Item Content End -->
                        </div>

                        <div class="col-lg-6">
                            <!-- Explore Item Content Start -->
                            <div class="explore-item-tags wow fadeInUp" data-wow-delay="0.25s">
                                <ul>
                                    <li><a href="#" class="btn-default">github</a></li>
                                    <li><a href="#" class="btn-default">linkedin</a></li>
                                    <li><a href="{{ route('contact.page') }}" class="btn-default">contact Us</a></li>
                                </ul>
                            </div>
                            <!-- Explore Item Content End -->
                        </div>
                    </div>
                </div>
                <!-- Why Us Explore Item End -->
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->

<!-- Exclusive Partners Section Start -->
<div class="exclusive-partners">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Executive partners</h3>
                    <h2 class="text-anime-style-3">Partners</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @foreach($partners as $partner)
            <div class="col-lg-3 col-6">
                <!-- Partners Logo Start -->
                <div class="partners-logo wow fadeInUp" data-wow-delay="0.2s">
                    <img src="{{ $partner->logo }}" alt="">
                </div>
                <!-- Partners Logo End -->
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Exclusive Partners Section End -->

<!-- Clients Testimonials Section Start -->
<div class="clients-testimonials">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-8 col-md-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Client testimonials</h3>
                    <h2 class="text-anime-style-3">Our customers love us.</h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Testimonial Slider Start -->
                <div class="testimonial-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                            <!-- Testimonial Slide Start -->
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-rating">
                                        <img src="/assets/images/icon-star.svg" alt="">
                                    </div>

                                    <div class="testimonial-content">
                                        <p>{!! $testimonial->message !!}</p>
                                    </div>

                                    <div class="testimonial-body">
                                        <figure class="image-anime">
                                            <img src="{{ $testimonial->image }}" alt="">
                                        </figure>
                                        <div class="testimonial-author-title">
                                            <h2>{{ $testimonial->name }}</h2>
                                            <p>{{ $testimonial->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- Testimonial Slider End -->
            </div>
        </div>
    </div>
</div>
<!-- Clients Testimonials Section End -->

<!-- Latest News Section Start -->
<div class="latest-news">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6 col-md-8">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Latest Blog & Articles</h3>
                    <h2 class="text-anime-style-3">The latest insights you need to know</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6 col-md-4">
                <!-- Section Btn Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                    <a href="#" class="btn-default">view all articles</a>
                </div>
                <!-- Section Btn End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.25s">
                    <!-- Blog Image Start -->
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="/assets/images/post-1.jpg" alt=""></a>
                        </figure>
                    </div>
                    <!-- Blog Image End -->

                    <!-- Blog Content Start -->
                    <div class="post-item-body">
                        <p><a href="#">10 April 2024</a></p>
                        <h2><a href="#">Unlocking the Potential of AI in Business Success</a></h2>
                    </div>
                    <!-- Blog Content End -->
                </div>
                <!-- Blog Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.5s">
                    <!-- Blog Image Start -->
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="/assets/images/post-2.jpg" alt=""></a>
                        </figure>
                    </div>
                    <!-- Blog Image End -->

                    <!-- blog content Start -->
                    <div class="post-item-body">
                        <p><a href="#">10 April 2024</a></p>
                        <h2><a href="#">Strategies for Building a Successful Distributed Team</a></h2>
                    </div>
                    <!-- Blog Content End -->
                </div>
                <!-- Blog Item End -->
            </div>

            <div class="col-lg-4 col-md-6">
                <!-- Blog Item Start -->
                <div class="blog-item wow fadeInUp" data-wow-delay="0.75s">
                    <!-- Blog Image Start -->
                    <div class="post-featured-image">
                        <figure class="image-anime">
                            <a href="#"><img src="/assets/images/post-3.jpg" alt=""></a>
                        </figure>
                    </div>
                    <!-- Blog Image End -->

                    <!-- Blog Content Start -->
                    <div class="post-item-body">
                        <p><a href="#">10 April 2024</a></p>
                        <h2><a href="#">Empowering Citizen Developers and Accelerating Innovation</a></h2>
                    </div>
                    <!-- Blog Content End -->
                </div>
                <!-- Blog Item End -->
            </div>
        </div>
    </div>
</div>
<!-- Latest News Section End -->

</x-website.master>
