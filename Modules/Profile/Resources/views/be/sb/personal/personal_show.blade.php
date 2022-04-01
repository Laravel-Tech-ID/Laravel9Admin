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
            <h1 class="h3 mb-0 text-gray-800">Tag Management</h1>
            <div class="d-none d-sm-inline-block">
                <a href="{{ route('admin.tag.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Add Tag</a>    
            </div>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Tag List</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="overflow-x:auto;padding:20px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Slug</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->slug }}</td>
                                        <td align="center">
                                          <a href="{{ route('admin.tag.edit',$tag->id) }}" class="btn btn-success btn-sm">Edit</a>
                                          <a href="{{ route('admin.tag.destroy',$tag->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Confirm Delete')">Delete</a>
                                      </td>
                                  </tr>
                                    @php $no++; @endphp                                
                                @endforeach
                              </tbody>
                        </table>        
                        <div class="d-none d-sm-inline-block" style="float:right;">
                          {{ $tags->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>          
                      </div>
                  </div>                
            </div>
        </div>
        @endsection
