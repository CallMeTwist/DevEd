<x-admin.dashboard>

    <x-slot name="title">Manage Settings</x-slot>
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title"><h2 class="mb-0">Account Settings</h2></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.settings.account.save') }}">
        
                        @csrf
        
                        <h5 class="mb-3 text-uppercase text-muted">Account Details</h5>
                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="name" name="name" class="form-control" placeholder="Enter name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>

                        <button class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.settings.password.save')}}">
        
                        @csrf
        
                        <h5 class="mb-3 text-uppercase text-muted">Password Settings</h5>
                        <div class="mb-3">
                            <label class="form-label">Old Password:</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">New Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Confirm New Password:</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>
                        

                        <button class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>
        

</x-admin.dashboard>