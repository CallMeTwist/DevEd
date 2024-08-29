@php
use Illuminate\Support\Str;
@endphp

<x-admin.dashboard>


        <x-slot name="css">
            <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        </x-slot>


        <x-slot name="title">Manage Services</x-slot>

        <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Service</a>

        <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Launch static backdrop modal
      </button> --}}

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Services</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('admin.services.add') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                        <div class="mb-3">
                            <label for="service-title" class="form-label">Service Title</label>
                            <input type="text" class="form-control" id="service-title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="service-summary" class="form-label">Service Summary</label>
                            <input type="text" class="form-control" id="service-summary" name="summary" required>
                        </div>

                        <div class="mb-3">
                            <label for="service-image" class="form-label">Service Image</label>
                            <input type="file" class="form-control" id="service-image" name="image" accept="image/*" required>
                        </div>
                        <textarea name="description" id="summernote" style="height: 325px"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      @foreach($services->chunk(4) as $chunk)
            <div class="row g-2">
                @foreach($chunk as $service)
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-start">
                                    <img src="{{ asset($service->image) }}" class="rounded img-fluid" width="60px" />
                                    <div class="m-l-20">
                                        <h4 class="mb-0">
                                            <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#view{{ $service->code }}">
                                                {{ $service->title }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary btn-sm me-2" title="Edit Service" data-bs-toggle="modal" data-bs-target=".edit{{ $service->code }}"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" title="Delete Service" data-bs-toggle="modal" data-bs-target=".delete{{ $service->code }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Modal -->
                    <div class="modal fade edit{{ $service->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('admin.services.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="service" value="{{ $service->code }}">
                                        <div class="form-group">
                                            <label class="col-form-label pt-0"><span>*</span>Service Title</label>
                                            <input class="form-control" name="title" type="text" placeholder="Enter service title here" value="{{ old('title', $service->title) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0"><span>*</span>Service Image</label>
                                            <input class="form-control" name="image" type="file" value="{{ old('image') }}" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label pt-0"><span>*</span>Service Summary</label>
                                            <input class="form-control" name="summary" type="text" placeholder="Enter summaries here"value="{{ old('summary', $service->summary ? implode(', ', json_decode($service->summary, true)) : '') }}""
                                            required>
                                        </div>
                                        <textarea name="description" id="summernote{{ $service->code }}" style="height: 325px">{!! $service->description !!}</textarea>
                                        <button type="submit" class="btn btn-info mt-3">Update</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View Modal -->
                    <div class="modal fade" id="view{{ $service->code }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel{{ $service->code }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewLabel{{ $service->code }}">{{ $service->name }}</h5>
                                </div>
                                <div class="modal-body">
                                    <!-- Content for the modal, like project details -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset($service->image) }}" class="img-fluid rounded" />
                                        </div>
                                        <div class="col-md-8 mt-auto mb-auto">
                                            <h4>{{ $service->title }}</h4>
                                            <p>{!! $service->description !!}</p>
                                            <ul>
                                                @foreach (json_decode($service->summary, true) as $summaryItem)
                                                    <li>{{ $summaryItem }}</li>
                                                @endforeach
                                            </ul>

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
                    <div class="modal fade delete{{ $service->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form method="post" action="{{ route('admin.services.delete') }}">

                                        @csrf

                                        <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                        <div class="alert alert-danger">You are about to permanently delete <b>{{ $service->name }}</b>, do you want to continue?</div>

                                        <input type="hidden" name="service" value="{{ $service->code }}">
                                        <button type="submit" class="btn btn-primary w-100">Delete {{ $service->title }}</button>

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
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
                @foreach($services as $service)
                $(document).ready(function() {
                    $('#summernote{{ $service->code }}').summernote();
                });
                @endforeach
              </script>
        </x-slot>

</x-admin.dashboard>
