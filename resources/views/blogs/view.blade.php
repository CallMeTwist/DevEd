<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
{{--                        {{ dd($blog) }}--}}
                        <h1 class="text-anime-style-3">{{ $blog->title }}</h1>
                        <div class="post-single-meta wow fadeInUp" data-wow-delay="0.25s">
                            <ul>
                                <li><i class="fa-solid fa-calendar-days"></i>{{ $blog->created_at->format('F j, Y') }}</li>
                                <li><i class="fa-solid fa-tag"></i>{{ $blog->categories->title }}</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Single Post Page Start -->
    <div class="page-single-post">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Post Featured Image Start -->
                    <div class="post-single-image">
                        <figure class="image-anime reveal" style="width: 100%; height: auto; max-width: 1200px; max-height: 675px; object-fit: cover;">
                            <img src="{{ asset($blog->image) }}" alt="" >
                        </figure>
                    </div>
                    <!-- Post Featured Image Start -->

                    <!-- Post Content Start -->
                    <div class="post-content">
                        <!-- Post Entry Start -->
                        <div class="post-entry">
                            <p class="wow fadeInUp" data-wow-delay="0.25s">{!! $blog->body !!}</p>
                        <!-- Post Entry End -->

                        <!-- Post Extra Info Start -->
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <!-- Post Tags Start -->
                                <div class="post-tags wow fadeInUp" data-wow-delay="0.25s">
                                    <a class="btn-default" href="#">Website</a>
                                    <a class="btn-default" href="#">App Development</a>
                                    <a class="btn-default" href="#">SEO</a>
                                    <a class="btn-default" href="#">Graphics Design</a>
                                </div>
                                <!-- Post Tags End -->
                            </div>

                            <div class="col-lg-4">
                                <!-- Post Sharing Links Start -->
                                <div class="post-social-links wow fadeInUp" data-wow-delay="0.25s">
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Post Sharing Links End -->
                            </div>
                        </div>
                        <!-- Post Extra Info End -->
                    </div>
                    <!-- Post Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Single Post Page End -->

    <!-- Latest News Section Start -->
    <div class="latest-news related-articles">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">related articles</h3>
                        <h2 class="text-anime-style-3">You may also like this</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                @foreach($recentArticles as $index => $recent)
                <div class="col-lg-4 col-md-6">
                    <!-- Blog Item Start -->
                    <div class="blog-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                        <!-- Blog Image Start -->
                        <div class="post-featured-image">
                            <figure class="image-anime">
                                <a href="#"><img src="{{ asset($recent->image) }}" alt=""></a>
                            </figure>
                        </div>
                        <!-- Blog Image End -->

                        <!-- Blog Content Start -->
                        <div class="post-item-body">
                            <p><a href="#">{{ $recent->created_at->format('F j, Y') }}</a></p>
                            <h2><a href="#">{{ $recent->title }}</a></h2>
                        </div>
                        <!-- Blog Content End -->
                    </div>
                    <!-- Blog Item End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest News Section End -->
</x-website.master>
