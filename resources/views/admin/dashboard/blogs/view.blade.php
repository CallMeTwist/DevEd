<x-admin.dashboard>
    <x-slot name="title">Manage Blogs</x-slot>
    <style>
        .crop-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: .375rem;
        }
    </style>
    <article class="mb-5">
        
        {{-- {{dd($blog->image)}} --}}
        <div>
            <img src="{{ asset($blog->image) }}" alt="" class=" mb-3 w-100 h-auto crop-image">
        </div>
        
        <div class="tags">
            @foreach(explode(',', $blog->tags) as $tag)
            <span class="badge bg-warning text-dark">{{ $tag }}</span>
            @endforeach
        </div>
        <h1 class="display-4 mb-3">{{ $blog->title }}</h1>
        
        <div class="text-muted mb-4">
            <span>{{ $blog->created_at->format('F d, Y') }}</span>
            <span> | </span>
            <span>By: Deved</span>
        </div>
        <div class="mb-4">
            <p>{!!$blog->body!!}</p>
        </div>
        <div>
            <a class="btn btn-outline-secondary me-2" title="Manage blog" href="{{ route('admin.blogs.edit', $blog->code) }}">Edit Post</a>
            <button class="btn btn-outline-danger" title="Delete Blog" data-bs-toggle="modal" data-bs-target=".delete{{ $blog->code }}">Delete Post</button>
        </div>
    </article>

    <!-- Delete Modal -->
    <div class="modal fade delete{{ $blog->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.blogs.delete') }}">
                        @csrf

                        <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                        <div class="alert alert-danger">You are about to permanently delete <b>{{ $blog->title }}</b>, do you want to continue?</div>

                        <input type="hidden" name="blog" value="{{ $blog->code }}">
                        <button type="submit" class="btn btn-primary w-100">Delete {{ $blog->title }}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.dashboard>