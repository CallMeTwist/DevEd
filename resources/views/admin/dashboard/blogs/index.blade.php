<x-admin.dashboard>
    <x-slot name="title">Manage Blogs</x-slot>

    <a href="{{ route('admin.blogs.add') }}" class="w-100 btn btn-success mb-4">Add New Blog</a>

    @foreach($blogs->chunk(4) as $chunk)
            <div class="row g-2">
                @foreach($chunk as $blog)
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-start">
                                    <img src="{{ asset($blog->image) }}" class="rounded img-fluid" width="60px" />
                                    <div class="m-l-20">
                                        <div class="mb-1">
                                            <span class="badge bg-primary">{{$blog->category}}</span>
                                        </div>
                                        <h4 class="mb-0">
                                            <a href="{{ route('admin.blogs.view', $blog->code) }}" class="text-decoration-none">
                                                {{ $blog->title }}
                                            </a
                                        </h4>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <div class="m-t-20 text-center">
                                        <a class="btn btn-dark btn-xs" title="Manage blogs" href="{{ route('admin.blogs.view', $blog->code) }}"><i class="fa fa-cog"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach  
            </div>
    @endforeach


</x-admin.dashboard>