<x-admin.dashboard>

    <x-slot name="title">Manage Settings</x-slot>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">System Settings</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin.settings.system.save') }}" enctype="multipart/form-data">

                @csrf

                <h5 class="mb-3 text-uppercase text-muted">Site Contact Details</h5>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="phone" name="phone" class="form-control" placeholder="enter phone number">
                </div>

                <h5 class="mb-3 mt-5 text-uppercase text-muted">Site Appearance</h5>
                <div class="mb-3">
                    <label class="form-label">Site name:</label>
                    <input type="name" name="name" class="form-control" placeholder="Enter Site name">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Site Logo:</label>
                    <input type="file" name="logo" class="form-control" placeholder="Enter email" accept="image/*">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Site Description</label>
                    <input type="desc" name="desc" class="form-control" placeholder="enter description">
                </div>
                
                <div class="row align-items-center">
                    <div class="col-lg-2 col-form-label">Theme:</div>
                    <div class="col-lg-10">
                        <div class="form-check">
                            <input type="radio" value="light" name="theme" class="form-check-input input-primary" id="customCheckinl31">
                            <label class="form-check-label" for="customCheckinl31">Light</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" value="dark" name="theme" class="form-check-input input-primary" id="customCheckinl31">
                            <label class="form-check-label" for="customCheckinl321">Dark</label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-warning mt-5">Submit</button>

            </form>
        </div>
    </div>


</x-admin.dashboard>