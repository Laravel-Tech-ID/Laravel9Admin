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
            <div class="row">
              <div class="col"><h1 class="h3 mb-0 text-gray-800">Dashboard</h1></div>
              @access('admin.v1.ppdb.pendaftaran.index','admin.ppdb.sd.index','admin.ppdb.smp.index','admin.ppdb.sma.index','admin.ppdb.boarding.index')
                <div class="col">
                  {{ $data }}
                </div>
              @endaccess
            </div>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>
          <script>
            $('#tahun_ajaran_id').change(function(){
              location.href = "<?php echo route('admin.v1.dashboard.index'); ?>" + "?tahun_ajaran=" + document.getElementById("tahun_ajaran_id").value;
            });
          </script>
          <!-- Content Row -->
    @endsection
