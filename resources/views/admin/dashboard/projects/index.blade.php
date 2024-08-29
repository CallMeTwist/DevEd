@php
use Illuminate\Support\Str;
@endphp

<x-admin.dashboard>

    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </x-slot>


    <x-slot name="title">Manage Projects</x-slot>

    <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Project</a>

    <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button> --}}

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Projects</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('admin.portfolios.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                    <div class="mb-3">
                        <label for="project-name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="project-link" class="form-label">Project Link</label>
                        <input type="text" class="form-control" id="project-link" name="link" required>
                    </div>
                    <div class="mb-3">
                        <label for="project-image" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="project-image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="project-client" class="form-label">Project Client</label>
                        <input type="text" class="form-control" id="project-client" name="client" required>
                    </div>
                    <div class="mb-3">
                        <label for="project-location" class="form-label">Project Location</label>
                        <input type="text" class="form-control" id="project-location" name="location" required>
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

  @foreach($projects->chunk(4) as $chunk)
        <div class="row g-2">
            @foreach($chunk as $project)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-start">
                                <img src="{{ asset($project->image) }}" class="rounded img-fluid" width="60px" />
                                <div class="m-l-20">
                                    <h4 class="mb-0">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#view{{ $project->code }}">
                                            {{ $project->name }}
                                        </a>
                                    </h4>
                                    <h5 class="mb-0 text-muted small text-truncate w-100 d-inline-block">
                                        {{ Str::limit($project->link, 20) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary btn-sm me-2" title="Edit Project" data-bs-toggle="modal" data-bs-target=".edit{{ $project->code }}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm" title="Delete Project" data-bs-toggle="modal" data-bs-target=".delete{{ $project->code }}"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Modal -->
                <div class="modal fade edit{{ $project->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Project</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.portfolios.update') }}" enctype="multipart/form-data">

                                    @csrf

                                    <input type="hidden" name="project" value="{{ $project->code }}">

                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Project Name</label>
                                        <input class="form-control" name="name" type="text" placeholder="Enter project name here" value="{{ old('name', $project->name) }}" required>
                                    </div>
									<div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Project Link</label>
                                        <input class="form-control" name="link" type="text" placeholder="Enter project link here" value="{{ old('link', $project->link) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Project Image</label>
                                        <input class="form-control" name="image" type="file" value="{{ old('image') }}" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Project Client</label>
                                        <input class="form-control" name="client" type="text" placeholder="Enter project client here" value="{{ old('client', $project->client) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0"><span>*</span>Project Location</label>
                                        <input class="form-control" name="location" type="text" placeholder="Enter project location here" value="{{ old('location', $project->location) }}" required>
                                    </div>

                                    <textarea name="description" id="summernote{{ $project->code }}" style="height: 325px">{{ old('description', $project->description) }}</textarea>

                                    <button type="submit" class="btn btn-info mt-3">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="view{{ $project->code }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel{{ $project->code }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewLabel{{ $project->code }}">{{ $project->name }}</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset($project->image) }}" class="img-fluid rounded" />
                                    </div>
                                    <div class="col-md-8 mt-auto mb-auto">
                                        <h4>{{ $project->name }}</h4>
                                        <h5 class="text-muted"><a href="{{ $project->link }}" target="_blank">{{ $project->link }}</a></h5>
                                        <p>{!! $project->location !!}</p>
                                        <p>{!! $project->client !!}</p>
                                        <p>{!! str_limit($project->description, 500) !!}</p>
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
                <div class="modal fade delete{{ $project->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin.portfolios.delete') }}">

                                    @csrf

                                    <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                    <div class="alert alert-danger">You are about to permanently delete <b>{{ $project->name }}</b> project, do you want to continue?</div>
                                    <input type="hidden" name="project" value="{{ $project->code }}">
                                    <button type="submit" class="btn btn-primary w-100">Delete {{ $project->name }}</button>

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
            @foreach($projects as $project)
            $(document).ready(function() {
                $('#summernote{{ $project->code }}').summernote();
            });
            @endforeach
          </script>
    </x-slot>

</x-admin.dashboard>
