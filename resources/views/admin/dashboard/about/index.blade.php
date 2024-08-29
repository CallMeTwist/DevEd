<x-admin.dashboard>

    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </x-slot>

    <x-slot name="title">Manage About Us</x-slot>

    @if(!$about)
        <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add About</a>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add About</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="{{ route('admin.about.add') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="header" class="form-label">Header</label>
                                <textarea name="header" id="summernote_add_header" class="form-control" style="height: 325px">{{ old('header') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Text</label>
                                <textarea name="text" id="summernote_add_text" class="form-control" style="height: 325px">{{ old('text') }}</textarea>
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
    @endif

    @if($about)
        <div class="row g-2">
            <div class="container mt-5">
                <h2>About Manager</h2>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{!! $about->header !!}</h5>
                        <p class="card-text">{!! $about->text !!}</p>
                        <button class="btn btn-primary" title="Edit About" data-bs-toggle="modal" data-bs-target="#editAboutModal">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade" id="editAboutModal" tabindex="-1" aria-labelledby="editAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAboutLabel">Edit About</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.about.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="header" class="form-label">Header</label>
                                <textarea name="header" id="summernote_edit_header" class="form-control" style="height: 325px">{{ old('header', $about->header) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Text</label>
                                <textarea name="text" id="summernote_edit_text" class="form-control" style="height: 325px">{{ old('text', $about->text) }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote_add_header, #summernote_add_text, #summernote_edit_header, #summernote_edit_text').summernote();
            });
        </script>
    </x-slot>

</x-admin.dashboard>
