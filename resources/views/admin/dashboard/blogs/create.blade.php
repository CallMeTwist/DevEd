<x-admin.dashboard>

    <x-slot name="css">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    </x-slot>

    <x-slot name="title">Create Blog</x-slot>

    <form method="post" action="{{ route('admin.blogs.create') }}" enctype="multipart/form-data">

        @csrf

        <div class="form">
            <div class="form-group mb-3 row">
                <label class="col-xl-3 col-sm-4 mb-0">Title :</label>
                <div class="col-xl-8 col-sm-7">
                    <input class="form-control" name="title" type="text" required value="{{ old('name') }}" >
                </div>
            </div>
            <div class="form-group mb-3 row">
                <label class="col-xl-3 col-sm-4 mb-0">Images :</label>
                <div class="col-xl-8 col-sm-7">
                    <input class="form-control" name="image" type="file" accept="image/*" required>
                </div>
            </div>
            <div class="form-group row">
            <label for="category" class="col-xl-3 col-sm-4 mb-0">Category :</label>
            <div class="col-xl-8 col-sm-7">
                <select class="form-control" name="category" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
            <div class="form-group mb-3 row">
                <label class="col-xl-3 col-sm-4 mb-0">Tags :</label>
                <div class="col-xl-8 col-sm-7">
                    <input class="form-control" name="tag" type="text" required value="{{ old('tags') }}" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-sm-4">Add Body :</label>
                <div class="col-xl-8 col-sm-7 description-sm">
                    <textarea name="body" id="summernote" style="height: 325px"></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Save Blog</button>

    </form>

    <x-slot name="js">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote();
            });
          </script>
    </x-slot>

</x-admin.dashboard>
