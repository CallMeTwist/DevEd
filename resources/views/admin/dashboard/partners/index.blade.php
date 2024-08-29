<x-admin.dashboard>


    <x-slot name="title">Manage Partners</x-slot>

    <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Partner</a>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Partner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.partners.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="testimonial-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="partner-name" name="name" required>
                        </div>   
                        <div class="mb-3">
                            <label for="partner-logo" class="form-label">Parner Logo</label>
                            <input type="file" class="form-control" id="partner-logo" name="logo" accept="image/*" required>
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
    
    @foreach($partners->chunk(4) as $chunk)
        <div class="row g-3">
            @foreach($chunk as $partner)
            <div class="col-sm-4">
                <div class="card h-100">
                    <div class="card-body d-flex">
                        <img src="{{ asset($partner->logo) }}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $partner->name }}">
                        <div>
                            <h5 class="card-title mb-3">{{ $partner->name }}</h5>
                            <div class="mt-auto">
                                <button class="btn btn-primary btn-sm me-2" title="Edit Partner" data-bs-toggle="modal" data-bs-target=".edit{{ $partner->code }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" title="Delete Partner" data-bs-toggle="modal" data-bs-target=".delete{{ $partner->code }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

                <!-- Update Modal -->
                <div class="modal fade edit{{ $partner->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Partner</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.partners.update') }}" enctype="multipart/form-data">

                                    @csrf

                                    <input type="hidden" name="partner" value="{{ $partner->code }}">

                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>partner Name</label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter partner's name here" value="{{ old('name', $partner->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>partner Image</label>
                                        <input class="form-control" name="logo" type="file" value="{{ old('logo') }}" accept="image/*">
                                    </div>
                                    <button type="submit" class="btn btn-info mt-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="view{{ $partner->code }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel{{ $partner->code }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewLabel{{ $partner->code }}">{{ $partner->name }}</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Content for the modal, like project details -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset($partner->logo) }}" class="img-fluid rounded" />
                                    </div>
                                    <div class="col-md-8 mt-auto mb-auto">
                                        <h4>{{ $partner->name }}</h4>
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
                <div class="modal fade delete{{ $partner->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.partners.delete') }}">

                                    @csrf

                                    <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                    <div class="alert alert-danger">You are about to permanently delete <b>{{ $partner->name }}</b>, do you want to continue?</div>

                                    <input type="hidden" name="partner" value="{{ $partner->code }}">
                                    <button type="submit" class="btn btn-primary w-100">Delete {{ $partner->name }}</button>

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