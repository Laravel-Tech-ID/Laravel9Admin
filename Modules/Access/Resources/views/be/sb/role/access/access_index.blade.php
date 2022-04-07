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
          <h1 class="h3 mb-0 text-gray-800">{{ $role->name }} Access Management</h1>
            <div class="d-none d-sm-inline-block">
              <form method="GET">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 mb-3 mb-sm-0">
                      <input id="search" type="text" class="form-control form-control-user @error('search') is-invalid @enderror" name="search" value="{{ (old('search')) ? old('search') : $search }}" autocomplete="description">
                      @error('search')
                          <span class="invalid-feedback" search="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>                                                                                
                    <div class="col-md-3 mb-3 mb-sm-0">
                      <button type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.role.access.index',$role->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i>
                        {{ __('Search') }}                              
                      </button>
                    </div>
              </form>
                    <div class="col-md-3 mb-3 mb-sm-0">
                      <a href="{{ route('admin.v1.access.role.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-chevron-left fa-sm text-white-50"></i> Kembali</a>    
                    </div>
                  </div>
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">{{ $role->name }} Access List</h6>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">

                      <form method="POST" >

                      <div class="form-group row">
                        <div class="col-md-9 mb-3 mb-sm-0">
                        </div>                                                                                
                        <div class="col-md-3 mb-3 mb-sm-0">
                          <button style="float:left;" type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.role.access.assignall',$role->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Assign All</button>
                          <button style="float:right;" type="submit" name="assignbutton" formaction="{{ route('admin.v1.access.role.access.revokeall',$role->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Revoke All</button>            
                        </div>
                      </div>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%"><input type="checkbox" id="checkall"/></th>
                                    <th width="5%">No</th>
                                    <th width="35%">Route Name</th>
                                    <th width="20%">Guard Name</th>
                                    <th width="20%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @foreach ($datas as $data)
                                    <tr>
                                        <td><input name="access[]" value="{{ $data->id }}" type="checkbox" /></td>
                                        <td>{{($datas->currentPage() - 1) * $datas->perPage() + $loop->iteration}}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->guard_name }}</td>
                                        <td>
                                        <center><img src="{{ ($role->hasAccess($data->name)) ? asset(config('access.media').'true.png') : asset(config('access.media').'false.png') }}" width="30px" height="30px"/></center>
                                        </td>
                                        <td align="center">
                                          <a href="{{ route('admin.v1.access.role.access.assign',['role' => $role->id,'access' => $data->id]) }}"
                                          <button type="button" class="btn btn-sm btn-{{($role->hasAccess($data->name)) ? 'warning' : 'primary'}}" aria-haspopup="true" aria-expanded="false">
                                          {{($role->hasAccess($data->name)) ? 'Revoke' : 'Assign'}}
                                          </button>
                                        </td>
                                    </tr>
                                @endforeach
                              </form>
                              </tbody>
                        </table>
                        <div class="d-none d-sm-inline-block" style="float:right;">
                          {!! $datas->appends(request()->input())->links('vendor.pagination.bootstrap-4') !!}
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
