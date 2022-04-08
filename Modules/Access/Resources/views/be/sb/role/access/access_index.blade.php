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
                      <div class="btn-group btn-sm nospiner" >
                        <button type="submit" form="selection" formmethod="post" formaction="{{ route('admin.v1.access.role.access.assign.selected',$role->id) }}" class="btn btn-primary btn-sm">
                          <i class="fas fa-fw fa-check"></i> Assign Selected
                        </button>
                        <button type="submit" form="selection" formmethod="post" formaction="{{ route('admin.v1.access.role.access.revoke.selected',$role->id) }}" class="btn btn-warning btn-sm">
                          <i class="fas fa-fw fa-times"></i> Revoke Selected
                        </button>
                        <a href="{{ route('admin.v1.access.role.index') }}" class="btn btn-danger btn-sm">
                          <i class="fas fa-fw fa-chevron-left"></i> Back
                        </a>
                      </div>                      
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                              <form id="searchform">
                                @csrf
                                <tr>
                                    <th width="2%"></th>
                                    <th width="7%">
                                      <select name="q_paging" id="q_paging"  class="form-control form-control-user @error('q_paging') is-invalid @enderror" value="{{ old('q_paging') }}" autocomplete="q_paging">
                                          <option value="10" {{ ((!isset($q_paging)) ? 'selected' : ($q_paging == 10)) ? 'selected' : ''}}>10</option>
                                          <option value="20" {{ ((!isset($q_paging)) ? '' : ($q_paging == 20)) ? 'selected' : ''}}>20</option>
                                          <option value="50" {{ ((!isset($q_paging)) ? '' : ($q_paging == 50)) ? 'selected' : ''}}>50</option>
                                          <option value="100" {{ ((!isset($q_paging)) ? '' : ($q_paging == 100)) ? 'selected' : ''}}>100</option>
                                      </select>
                                    </th>
                                    <th width="40%">
                                      <input id="q_name" type="text" class="form-control form-control-user @error('q_name') is-invalid @enderror" name="q_name" value="{{ (isset($q_name)) ? $q_name : '' }}" autocomplete="q_name">
                                    </th>
                                    <th width="15%">
                                      <select name="q_guard_name" id="q_guard_name"  class="form-control form-control-user @error('q_guard_name') is-invalid @enderror" value="{{ old('q_guard_name') }}" autocomplete="q_guard_name">
                                          <option disabled="disabled" selected="selected">Select an option</option>                                        
                                          @foreach($guards as $guard)
                                              <option value="{{$guard->guard_name}}" {{ ((!isset($q_guard_name)) ? '' : ($q_guard_name == $guard->guard_name)) ? 'selected' : ''}}>{{$guard->guard_name}}</option>
                                          @endforeach
                                      </select>
                                    </th>
                                    <th width="15%">
                                      <select name="q_status" id="q_status"  class="form-control form-control-user @error('q_status') is-invalid @enderror" value="{{ old('q_status') }}" autocomplete="q_status">
                                          <option disabled="disabled" selected="selected">Select</option>                                        
                                          <option value="Active" {{ ((!isset($q_status)) ? '' : ($q_status == 'Active')) ? 'selected' : ''}}>Active</option>
                                          <option value="Inactive" {{ ((!isset($q_status)) ? '' : ($q_status == 'Inactive')) ? 'selected' : ''}}>Inactive</option>
                                      </select>
                                    </th>
                                    <th width="5%" class="text-center align-middle">
                                      <div class="btn-group nospiner" >
                                        <button type="submit" form="searchform" formmethod="get" formaction="{{ route('admin.v1.access.role.access.index', $role->id) }}" class="btn btn-sm btn-success">
                                          <i class="fas fa-fw fa-search"></i>
                                        </button>
                                        <a  href="{{ route('admin.v1.access.role.access.index',$role->id) }}"  class="btn btn-sm btn-danger">
                                          <i class="fas fa-fw fa-times"></i>                                            
                                        </a>
                                      </div>                                      
                                    </th>
                                </tr>
                                <tr>
                                    <th width="5%"><input type="checkbox" id="checkall"/></th>
                                    <th width="5%">No</th>
                                    <th width="35%">Route Name</th>
                                    <th width="20%">Guard Name</th>
                                    <th width="20%">Status</th>
                                    <th width="15%">Action</th>
                                </tr>
                              </form>
                            </thead>
                            <tbody>
                              <form id="selection">
                                @csrf
                                @foreach ($datas as $data)
                                    <tr>
                                        <td><input name="selected[]" value="{{ $data->id }}" type="checkbox" /></td>
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
