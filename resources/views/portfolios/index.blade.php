<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">Portfolio</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">portfolio</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Projects Page Start -->
    <div class="our-projects">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- Sidebar Our Projects Nav start -->
                    <div class="our-projects-nav wow fadeInUp" data-wow-delay="0.25s">
{{--                        <ul>--}}
{{--                            <li><a href="#" class="active-btn" data-filter="*">all</a></li>--}}
{{--                            <li><a href="#" data-filter=".digital">digital marketing</a></li>--}}
{{--                            <li><a href="#" data-filter=".website">website development</a></li>--}}
{{--                            <li><a href="#" data-filter=".app">app development</a></li>--}}
{{--                            <li><a href="#" data-filter=".graphics">graphics design</a></li>--}}
{{--                        </ul>--}}
                    </div>
                    <!-- Sidebar Our Projects Nav End -->
                </div>

                <div class="col-lg-12">
                    <!-- Project Item Box start -->
                    <div class="row project-item-boxes">
                        @foreach($portfolios as $portfolio)
                        <div class="col-md-6 project-item-box website graphics">
                            <!-- Works Item Start -->
                            <div class="works-item">
                                <div class="works-image">
                                    <a href="{{ route('portfolios.view', str_slug($portfolio->name)) }}">
                                        <figure class="image-anime">
                                            <img src="{{ asset($portfolio->image) }}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="works-content">
                                    <h2>{{ $portfolio->name }}</h2>
                                    <p>{!! str_limit(str_replace('Project Overview', '', $portfolio->description), 130) !!}</p>
                                </div>
                            </div>
                            <!-- Works Item End -->
                        </div>
                        @endforeach
                    </div>
                    <!-- Project Item Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Projects Page End -->
</x-website.master>
