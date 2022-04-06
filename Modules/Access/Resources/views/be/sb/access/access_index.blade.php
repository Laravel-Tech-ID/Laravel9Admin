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
            <h1 class="h3 mb-0 text-gray-800">Access Management</h1>
            <div class="d-none d-sm-inline-block">
              <form method="GET">
                @csrf
                <div class="form-group row">
                    <div class="col-md-8 mb-3 mb-sm-0">
                      <input id="search" type="text" class="form-control form-control-user @error('search') is-invalid @enderror" name="search" value="{{ (old('search')) ? old('search') : $search }}" autocomplete="description">
                      @error('search')
                          <span class="invalid-feedback" search="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>                                                                                
                    <div class="col-md-4 mb-3 mb-sm-0">
                      <button type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.access.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>
                        {{ __('Search') }}                              
                      </button>
                    </div>
                </div>
              </form>
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Access List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">

                      <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-sm-0">
                        </div>
                        <div class="col-md-6 mb-3 mb-sm-0">
                          <a style="float:left;margin-right:10px;margin-left:70px" href="{{ route('admin.v1.access.access.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Add Access</a>    
                          <form method="POST" >
                          @csrf
                          @method('POST')
                          <button style="float:left;margin-right:10px;" type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.access.activateall') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Activate</button>
                          <button style="float:left;margin-right:10px;" type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.access.inactivateall') }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Inactivate</button>            
                          <button style="float:left;" type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.access.deleteall') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="return confirm('Confirm Delete')"><i class="fas fa-edit fa-sm text-white-50"></i> Delete</button>            
                        </div>
                      </div>


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%"><input type="checkbox" id="checkall"/></th>
                                    <th width="5%">No</th>
                                    <th width="40%">Route Name</th>
                                    <th width="15%">Guard Name</th>
                                    <th width="15%">Status</th>
                                    <th width="20%">Description</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accesses as $access)
                                    <tr>
                                        <td><input name="access[]" value="{{ $access->id }}" type="checkbox" /></td>
                                        <td>{{($accesses->currentPage() - 1) * $accesses->perPage() + $loop->iteration}}</td>
                                        <td>{{ $access->name }}</td>
                                        <td>{{ $access->guard_name }}</td>
                                        <td>
                                        <center><img src="{{ ($access->status == 'Active') ? asset(config('access.media').'true.png') : asset(config('access.media').'false.png') }}" width="30px" height="30px"/></center>
                                        </td>
                                        <td>{{ $access->desc }}</td>
                                        <td align="center">
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Action
                                            </button>
                                            <div class="dropdown-menu">
                                              <a href="{{ route('admin.v1.access.access.status',$access->id) }}" class="dropdown-item">{{($access->status == 'Active') ? 'Inactivate' : 'Activate'}}</a>
                                              <a href="{{ route('admin.v1.access.access.edit',$access->id) }}" class="dropdown-item">Edit</a>
                                              <a href="{{ route('admin.v1.access.access.destroy',$access->id) }}" onclick="return confirm('Confirm Delete')" class="dropdown-item">Delete</a>
                                            </div>
                                          </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </form>
                              </tbody>
                        </table>
                        <div class="d-none d-sm-inline-block" style="float:right;">
                            {!! $accesses->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
                        </div>          
                      </div>
                  </div>                
            </div>
        </div>
        <script>
          $("#checkall").click(function(){
              $('input:checkbox').not(this).prop('checked', this.checked);
          });        
        </script>
        @endsection
