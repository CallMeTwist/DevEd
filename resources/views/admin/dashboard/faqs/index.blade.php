<x-admin.dashboard>

    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </x-slot>


    <x-slot name="title">Manage Faqs</x-slot>

    <a href="#" class="w-100 btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New FAQ</a>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Faq</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('admin.faqs.add') }}">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="questions" class="form-label">Question</label>
                            <textarea name="question" id="summernote_add" style="height: 325px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answers</label>
                            <textarea name="answer" id="summernote_add_answer" style="height: 325px"></textarea>
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

    <div class="container mt-5">
        <h2>FAQ Manager</h2>
        <hr>
        @foreach($faqs as $faq)

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{!! $faq->question !!}</h4>
                    <p class="card-text">{!! $faq->answer !!}</p>
                    <button class="btn btn-primary" title="Edit Faq" data-bs-toggle="modal" data-bs-target=".edit{{ $faq->code }}">Edit</button>
                    <button class="btn btn-danger" title="delete Faq" data-bs-toggle="modal" data-bs-target=".delete{{ $faq->code }}">Delete</button>
                </div>
            </div>

            <!-- Update Modal -->
            <div class="modal fade edit{{ $faq->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Faq</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.faqs.update') }}">

                                @csrf

                                <input type="hidden" name="faq" value="{{ $faq->code }}">

                                <div class="mb-3">
                                    <label for="question" class="form-label">Question</label>
                                    <textarea name="question" id="summernote{{$faq->code}}" style="height: 325px">{{ old('question', $faq->question) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="answers" class="form-label">Answers</label>
                                    <textarea name="answer" id="summernote1{{$faq->code}}" style="height: 325px">{{ old('answer', $faq->answer) }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-info mt-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Modal -->
            <div class="modal fade" id="view{{ $faq->code }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel{{ $faq->code }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewLabel{{ $faq->code }}">{{ $faq->question }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 mt-auto mb-auto">
                                    <h4>{{ $faq->question }}</h4>
                                    <p class="text-muted">{{ $faq->answer }}</p>
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
            <div class="modal fade delete{{ $faq->code }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.faqs.delete') }}">
                                @csrf
                                <div class="text-center"><i class="fa fa-trash fa-4x mb-3 font-primary"></i></div>
                                <div class="alert alert-danger">You are about to permanently delete <b>{{ $faq->question }}</b> brand, do you want to continue?</div>

                                <input type="hidden" name="faq" value="{{ $faq->code }}">
                                <button type="submit" class="btn btn-primary w-100">Delete Faq</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote_add').summernote();
            });
            $(document).ready(function() {
                $('#summernote_add_answer').summernote();
            });
            @foreach($faqs as $faq)
            $(document).ready(function() {
                $('#summernote{{ $faq->code }}').summernote();
            });
            $(document).ready(function() {
                $('#summernote1{{$faq->code}}').summernote();
            });
            @endforeach
        </script>
    </x-slot>

</x-admin.dashboard>
