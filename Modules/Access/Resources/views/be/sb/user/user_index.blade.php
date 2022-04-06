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
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
            <div class="d-none d-sm-inline-block">
                <a href="{{ route('admin.v1.access.user.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Add User</a>    
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                    <form method="GET" action="{{ route('admin.v1.access.user.index') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-10 mb-3 mb-sm-0">
                              <input id="search" type="text" class="form-control form-control-user @error('search') is-invalid @enderror" name="search" value="{{ (old('search')) ? old('search') : $search }}" autocomplete="description">
                              @error('search')
                                  <span class="invalid-feedback" search="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>                                                                                
                            <div class="col-md-2 mb-3 mb-sm-0">
                              <button type="submit" class="btn btn-user btn-success btn-block">
                                {{ __('Search') }}
                              </button>
                            </div>
                        </div>
                      </form>                    
                    <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Code</th>
                                    <th width="20%">Name</th>
                                    <th width="15%">Email</th>
                                    <th width="10%">Roles</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Photo</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{($users->currentPage() - 1) * $users->perPage() + $loop->iteration}}</td>
                                        <td>{{ $user->code }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                          @foreach($user->roles as $role)
                                            {{ $role->name }}
                                          @endforeach
                                        </td>
                                        <td>{{ ucwords($user->status) }}</td>
                                        <td align="center"><img src="{{ ($user->picture) ? route('admin.v1.access.user.file',$user->picture) : asset(config('access.media').'user/user.png') }}" width="100px" height="100px"/></td>
                                        <td align="center">
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Action
                                            </button>
                                            <div class="dropdown-menu">
                                              <a href="{{ route('admin.v1.access.user.edit',$user->id) }}" class="dropdown-item">Edit</a>
                                              <form action="{{ route('admin.v1.access.user.destroy',$user->id) }}" method="post">
                                                <input type="submit" value="Delete" class="dropdown-item" onclick="return confirm('Confirm Delete')"/>
                                                @method('DELETE')
                                                @csrf
                                              </form>                                              
                                            </div>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                        </table>
                        <div class="d-none d-sm-inline-block" style="float:right;">
                          {!! $users->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
                        </div>          
                    </div>
                </div>                
            </div>
          </div>
        @endsection