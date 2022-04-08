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
                      <div class="btn-group btn-sm nospiner" >
                        <a  href="{{ route('admin.v1.access.user.create') }}"  class="btn btn-success btn-sm" >
                          <i class="fas fa-fw fa-plus"></i> Add Data
                        </a>
                        <button type="submit" form="selection" formmethod="post" formaction="{{ route('admin.v1.access.user.delete.selected') }}" onclick="return confirm('Confirm Delete')" class="btn btn-danger btn-sm">
                          <i class="fas fa-fw fa-times"></i> Delete Selected
                        </button>
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
                                      <select name="paging" id="paging"  class="form-control form-control-user @error('paging') is-invalid @enderror" value="{{ old('paging') }}" autocomplete="paging">
                                          <option value="10" {{ ((!isset($paging)) ? 'selected' : ($paging == 10)) ? 'selected' : ''}}>10</option>
                                          <option value="20" {{ ((!isset($paging)) ? '' : ($paging == 20)) ? 'selected' : ''}}>20</option>
                                          <option value="50" {{ ((!isset($paging)) ? '' : ($paging == 50)) ? 'selected' : ''}}>50</option>
                                          <option value="100" {{ ((!isset($paging)) ? '' : ($paging == 100)) ? 'selected' : ''}}>100</option>
                                      </select>
                                    </th>
                                    <th width="10%">
                                      <input id="q_code" type="text" class="form-control form-control-user @error('q_code') is-invalid @enderror" name="q_code" value="{{ (isset($q_code)) ? $q_code : '' }}" autocomplete="q_code">
                                    </th>
                                    <th width="20%">
                                      <input id="q_name" type="text" class="form-control form-control-user @error('q_name') is-invalid @enderror" name="q_name" value="{{ (isset($q_name)) ? $q_name : '' }}" autocomplete="q_name">
                                    </th>
                                    <th width="10%">
                                      <input id="q_phone" type="text" class="form-control form-control-user @error('q_phone') is-invalid @enderror" name="q_phone" value="{{ (isset($q_phone)) ? $q_phone : '' }}" autocomplete="q_phone">
                                    </th>
                                    <th width="15%">
                                      <input id="q_email" type="text" class="form-control form-control-user @error('q_email') is-invalid @enderror" name="q_email" value="{{ (isset($q_email)) ? $q_email : '' }}" autocomplete="q_email">
                                    </th>
                                    <th width="12%">
                                      <select name="q_role" id="q_role"  class="form-control form-control-user @error('q_role') is-invalid @enderror" value="{{ old('q_role') }}" autocomplete="q_role">
                                          <option disabled="disabled" selected="selected">Select</option>                                        
                                          @foreach($roles as $role)
                                              <option value="{{$role->id}}" {{ ((!isset($q_role)) ? '' : ($q_role == $role->id)) ? 'selected' : ''}}>{{$role->name}}</option>
                                          @endforeach
                                      </select>
                                    </th>
                                    <th width="10%">
                                      <select name="q_status" id="q_status"  class="form-control form-control-user @error('q_status') is-invalid @enderror" value="{{ old('q_status') }}" autocomplete="q_status">
                                          <option disabled="disabled" selected="selected">Select</option>                                        
                                          <option value="Active" {{ ((!isset($q_status)) ? '' : ($q_status == 'Active')) ? 'selected' : ''}}>Active</option>
                                          <option value="Inactive" {{ ((!isset($q_status)) ? '' : ($q_status == 'Inactive')) ? 'selected' : ''}}>Inactive</option>
                                      </select>
                                    </th>
                                    <th width="5%"></th>
                                    <th width="5%" class="text-center align-middle">
                                      <div class="btn-group nospiner" >
                                        <button type="submit" form="searchform" class="btn btn-sm btn-success">
                                          <i class="fas fa-fw fa-search"></i>
                                        </button>
                                        <a  href="{{ route('admin.v1.access.user.index') }}"  class="btn btn-sm btn-danger">
                                          <i class="fas fa-fw fa-times"></i>                                            
                                        </a>
                                      </div>                                      
                                    </th>
                                </tr>                              
                                <tr>
                                    <th width="5%"><input type="checkbox" id="checkall"/></th>
                                    <th width="5%">No</th>
                                    <th width="15%">Code</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Phone</th>
                                    <th width="15%">Email</th>
                                    <th width="10%">Roles</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Photo</th>
                                    <th width="5%">Action</th>
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
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>
                                          @foreach($data->roles as $role)
                                            {{ $role->name }}
                                          @endforeach
                                        </td>
                                        <td>{{ ucwords($data->status) }}</td>
                                        <td align="center"><img src="{{ ($data->picture) ? route('admin.v1.access.user.file',$data->picture) : asset(config('access.media').'user/user.png') }}" width="100px" height="100px"/></td>
                                        <td align="center">
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Action
                                            </button>
                                            <div class="dropdown-menu">
                                              <a href="{{ route('admin.v1.access.user.edit',$data->id) }}" class="dropdown-item">Edit</a>
                                              <a href="{{ route('admin.v1.access.user.destroy',$data->id) }}" onclick="return confirm('Confirm Delete')" class="dropdown-item">Delete</a>                                              
                                            </div>
                                          </div>
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