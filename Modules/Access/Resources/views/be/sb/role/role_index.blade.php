@extends(config('app.be_layout').'.main')
@section('content')
            @if(session('error'))
                <div class="card shadow bg-danger text-white" style="margin-bottom:20px;">
                    <div class="card-body" style="overflow-x:auto;padding:10px;">{!! session('error') !!}</div>
                </div>
            @endif
            @if(session('success'))
                <div class="card shadow bg-success text-white" style="margin-bottom:20px;">
                    <div class="card-body" style="overflow-x:auto;padding:10px;">{!! session('success') !!}</div>
                </div>
            @endif

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
            <div class="d-none d-sm-inline-block">
                <a href="{{ route('admin.v1.access.role.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Add Role</a>    
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Role List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="40%">Name</th>
                                    <th width="20%">Status</th>
                                    <th width="20%">Description</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                      <td>{{($roles->currentPage() - 1) * $roles->perPage() + $loop->iteration}}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                        <center><img src="{{ ($role->status == 'Active') ? asset(config('access.media').'true.png') : asset(config('access.media').'false.png') }}" width="30px" height="30px"/></center>
                                        </td>
                                        <td>{{ $role->desc }}</td>
                                        <td align="center">
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Action
                                            </button>
                                            <div class="dropdown-menu">
                                              <a href="{{ route('admin.v1.access.role.access.index',$role->id) }}" class="dropdown-item">Access</a>
                                              <a href="{{ route('admin.v1.access.role.edit',$role->id) }}" class="dropdown-item">Edit</a>
                                              <a href="{{ route('admin.v1.access.role.destroy',$access->id) }}" onclick="return confirm('Confirm Delete')" class="dropdown-item">Delete</a>
                                            </div>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                        </table>
                        <div class="d-none d-sm-inline-block" style="float:right;">
                          {!! $roles->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                      </div>
                  </div>                
            </div>
        </div>
        @endsection
