<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">Blog</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item active">blog</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="latest-news our-blog">
        <div class="container">
            <div class="row">
                @foreach($blogs as $index => $blog)
                    <div class="col-lg-4 col-md-6">
                    <!-- Blog Item Start -->
                    <div class="blog-item wow fadeInUp" data-wow-delay="{{ 0.25 * ($index + 1) }}s">
                        <!-- Blog Image Start -->
                        <div class="post-featured-image">
                            <figure class="image-anime">
                                <a href="#"><img src="{{ $blog->image }}" style="pointer-events: auto; display: block;" alt=""></a>
                            </figure>
                        </div>
                        <!-- Blog Image End -->

                        <!-- Blog Content Start -->
                        <div class="post-item-body">
                            <p><a href="#">{{ $blog->created_at->format('F j, Y') }}</a></p>
                            <h2><a href="{{ route('blogs.view', $blog->slug) }}">{{ $blog->title }}</a></h2>
                        </div>
                        <!-- Blog Content End -->
                    </div>
                    <!-- Blog Item End -->
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Post Pagination Start -->
                    <div class="post-pagination wow fadeInUp" data-wow-delay="1.50s">
                        <ul class="pagination">
                            <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                        </ul>
                    </div>
                    <!-- Post Pagination End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Latest News Section End -->
</x-website.master>
