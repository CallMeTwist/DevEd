<x-website.master>
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3">FAQ's</h1>
                        <nav class="wow fadeInUp" data-wow-delay="0.25s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">FAQ's</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- FAQs Page Start -->
    <div class="faq-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1  col-md-12 offset-md-0">
                    <div class="faq-accordion" id="accordion">
                        <!-- FAQ Item start -->
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
                        <!-- FAQ Item End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Page Ends -->
</x-website.master>
