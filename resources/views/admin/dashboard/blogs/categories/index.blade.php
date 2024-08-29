<x-admin.dashboard>
    <x-slot name="title">Manage Categories</x-slot>

    <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Category</a>

    <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
    </button> --}}
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('admin.categories.add') }}">
            @csrf
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="category-title" class="form-label">Category Title</label>
                        <input type="text" class="form-control" id="category-title" name="title" required>
                    </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    @foreach($categories->chunk(4) as $chunk)
        <div class="row g-2">
            @foreach($chunk as $category)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="m-l-20">
                                    <h4 class="mb-0">
                                        <a href="{{ route('admin.categories.view', $category->code) }}" class="text-decoration-none">
                                            {{ $category->title }}
                                        </a
                                    </h4>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-sm me-2" title="Edit category" data-bs-toggle="modal" data-bs-target=".edit{{ $category->code }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" title="Delete category" data-bs-toggle="modal" data-bs-target=".delete{{ $category->code }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Modal -->
                <div class="modal fade edit{{ $category->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit category</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.categories.update') }}">
                                    @csrf
                                    <input type="hidden" name="category" value="{{ $category->code }}">
                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Category Title</label>
                                        <input class="form-control" name="title" type="text" placeholder="Enter category title here" value="{{ old('title', $category->title) }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-info mt-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div class="modal fade delete{{ $category->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.categories.delete') }}">

                                    @csrf

                                    <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                    <div class="alert alert-danger">You are about to permanently delete <b>{{ $category->title }}</b>, do you want to continue?</div>

                                    <input type="hidden" name="category" value="{{ $category->code }}">
                                    <button type="submit" class="btn btn-primary w-100">Delete {{ $category->title }}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</x-admin.dashboard>