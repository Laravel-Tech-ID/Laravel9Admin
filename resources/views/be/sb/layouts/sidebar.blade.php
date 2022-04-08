    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.v1.dashboard.index') }}">
          <div class="sidebar-brand-icon">
            <img src="{{ asset(config('setting.media').setting('logo')) }}" width="75px" height="50 px"></i>
          </div>
          <div class="sidebar-brand-text mx-3">{{ setting('initial') }}</div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.v1.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
               
        @access('admin.v1.setting.index','admin.access.user.index')
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#system"
              aria-expanded="true" aria-controls="system">
              <i class="fas fa-fw fa-wrench"></i>
              <span>System</span>
          </a>
          <div id="system" class="collapse" aria-labelledby="headingUtilities"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom Utilities:</h6>
                  @access('admin.v1.access.access.index')
                    <a class="collapse-item" href="{{ route('admin.v1.access.access.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Access</span></a>
                  @endaccess
                  @access('admin.v1.access.role.index')
                    <a class="collapse-item" href="{{ route('admin.v1.access.role.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Role</span></a>
                  @endaccess
                  @access('admin.v1.access.user.index')
                    <a class="collapse-item" href="{{ route('admin.v1.access.user.index') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>User</span></a>
                  @endaccess
                  @access('admin.v1.setting.edit')
                    <a class="collapse-item" href="{{ route('admin.v1.setting.edit') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Setting</span></a>
                  @endaccess
              </div>
          </div>
        </li>
        @endaccess
        
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>        
    </ul>
      <!-- End of Sidebar -->
      