<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">{{ $project->name }}</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item"><a href="#">projects</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $project->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Project Single Page Start -->
    <div class="page-project-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Project Feature Image Start -->
                    <div class="project-feature-image text-center" style="width: 100%; overflow: hidden;">
                        <figure class="image-anime reveal" style="margin: 0; padding: 0;">
                            <img src="{{ asset($project->image) }}" alt="" style="width: 100%; height: auto;">
                        </figure>
                    </div>
                    <!-- Project Feature Image End -->
                </div>
                <div class="col-lg-4">
                    <!-- Project Sidebar Start -->
                    <div class="project-sidebar wow fadeInUp" data-wow-delay="0.25s">
                        <!-- About Project Box Start -->
                        <div class="about-project-box wow fadeInUp">
                            <!-- Project Info Box Start -->
                            <div class="project-info-box">
                                <div class="project-icon">
                                    <img src="/assets/images/icon-date.svg" alt="">
                                </div>
                                <p>Date</p>
                                <h3>10 April 2024</h3>
                            </div>
                            <!-- Project Info Box End -->

                            <!-- Project Info Box Start -->
                            <div class="project-info-box">
                                <div class="project-icon">
                                    <img src="/assets/images/icon-client.svg" alt="">
                                </div>

                                <p>Client</p>
                                <h3>{{ $project->client }}</h3>
                            </div>
                            <!-- Project Info Box End -->

                            <!-- Project Info Box Start -->
                            <div class="project-info-box">
                                <div class="project-icon">
                                    <img src="/assets/images/icon-website.svg" alt="">
                                </div>

                                <p>Website</p>
                                <h3><a href="{{ $project->link }}" target="_blank" style="word-wrap: break-word; word-break: break-all;">{{ str_replace('https://', '', $project->link) }}</a></h3>
                            </div>
                            <!-- Project Info Box End -->

                            <!-- Project Info Box Start -->
                            <div class="project-info-box">
                                <div class="project-icon">
                                    <img src="/assets/images/icon-location-1.svg" alt="">
                                </div>
                                <p>Location</p>
                                <h3>{{ $project->location }}</h3>
                            </div>
                            <!-- Project Info Box End -->
                        </div>
                        <!-- About Project Box End -->
                    </div>
                    <!-- Project Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Project Content Start -->
                    <div class="project-content">
                        <!-- Project Entry Start -->
                        <div class="project-entry">
                            <p>{!! $project->description !!}</p>
                        </div>
                        <!-- Project Entry End -->
                    </div>
                    <!-- Project Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Project Single Page End -->
</x-website.master>
