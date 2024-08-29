<x-admin.dashboard>


    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </x-slot>


    <x-slot name="title">Manage Testimonials</x-slot>

    <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Testimonial</a>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Testimonial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.testimonials.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="testimonial-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="testimonial-name" name="name" required>
                        </div>   
                        <div class="mb-3">
                            <label for="testimonial-image" class="form-label">Reviewer Image</label>
                            <input type="file" class="form-control" id="reviewer-image" name="image" accept="image/*" required>
                        </div>

                        <textarea class="form-control mt-2" id="message" name="message" rows="4" required></textarea>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="visible" name="visible" value="1">
                            <label class="form-check-label" for="visible">Visible</label>
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
    
    @foreach($testimonials->chunk(4) as $chunk)
        <div class="row g-3">
            @foreach($chunk as $testimonial)
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body d-flex">
                        <img src="{{ asset($testimonial->image) }}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $testimonial->name }}">
                        <div>
                            <h5 class="card-title mb-3">{{ $testimonial->name }}</h5>
                            <p class="card-text mb-1">{!! str_limit($testimonial->message, 100) !!}</p>
                            <p class="text-muted mb-2">Reviewed on {{ $testimonial->created_at->format('d/m/Y') }}</p>
                            <div class="mt-auto">
                                <button class="btn btn-primary btn-sm me-2" title="Edit Testimonial" data-bs-toggle="modal" data-bs-target=".edit{{ $testimonial->code }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" title="Delete Testimonial" data-bs-toggle="modal" data-bs-target=".delete{{ $testimonial->code }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

                <!-- Update Modal -->
                <div class="modal fade edit{{ $testimonial->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit testimonial</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.testimonials.update') }}" enctype="multipart/form-data">

                                    @csrf

                                    <input type="hidden" name="testimonial" value="{{ $testimonial->code }}">

                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Reviewer Name</label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter reviewer's name here" value="{{ old('title', $testimonial->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Reviewer Image</label>
                                        <input class="form-control" name="image" type="file" value="{{ old('image') }}" accept="image/*">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label pt-0 mt-3"><span>*</span>Reviewer Message</label>
                                        <textarea class="form-control" id="message" value="{{ old('message') }}" name="message" rows="4" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-info mt-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="view{{ $testimonial->code }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel{{ $testimonial->code }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewLabel{{ $testimonial->code }}">{{ $testimonial->name }}</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Content for the modal, like project details -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset($testimonial->image) }}" class="img-fluid rounded" />
                                    </div>
                                    <div class="col-md-8 mt-auto mb-auto">
                                        <h4>{{ $testimonial->name }}</h4>
                                        {!! $testimonial->message !!}
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade delete{{ $testimonial->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.testimonials.delete') }}">

                                    @csrf

                                    <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                    <div class="alert alert-danger">You are about to permanently delete <b>{{ $testimonial->name }}</b>, do you want to continue?</div>

                                    <input type="hidden" name="testimonial" value="{{ $testimonial->code }}">
                                    <button type="submit" class="btn btn-primary w-100">Delete {{ $testimonial->name }}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    @endforeach

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
            @foreach($testimonials as $testimonial)
            $(document).ready(function() {
                $('#summernote{{ $testimonial->code }}').summernote();
            });
            @endforeach
            </script> --}}
    </x-slot>
    
</x-admin.dashboard>