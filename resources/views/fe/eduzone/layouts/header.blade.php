			<!-- header -->
			<header class="site-header mo-left header-transparent box-header navstyle5 header">
				<div class="top-bar">
					<div class="container" style="color:black;">
						<div class="row d-flex justify-content-between align-items-center">
							<div class="dlab-topbar-left">
								<ul>
									<li><i class="la la-phone-volume text-black"></i> {{ setting('phone') }}</li>
									<li><i class="las la-map-marker text-black"></i> {{ setting('address_short') }}</li>
								</ul>
							</div>
							<div class="dlab-topbar-right">
								<ul>
									<li><i class="la la-clock text-black"></i>  {{ setting('working_hour') }}</li>
									<li><i class="las la-envelope-open text-black"></i> {{ setting('email') }}</li>
								</ul>				
							</div>
						</div>
					</div>
				</div>
				<!-- main header -->
				<div class="sticky-header main-bar-wraper navbar-expand-lg">
					<div class="main-bar clearfix ">
						<div class="container clearfix">
							<!-- website logo -->
							<div class="logo-header mostion logo-dark">
								<a href="{{ route('home') }}"><img src="{{ asset(config('setting.media').setting('logo')) }}" alt=""></a>
							</div>
							<!-- nav toggle button -->
							<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
								<span></span>
								<span></span>
								<span></span>
							</button>
							<!-- extra nav -->
							<div class="extra-nav">
								<a href="{{ route('admin.dashboard.index') }}" class="site-button radius-no">LOGIN</a>
							</div>
							<!-- Quik search -->
							<div class="dlab-quik-search ">
								<form action="#">
									<input name="search" value="" type="text" class="form-control" placeholder="Type to search">
									<span id="quik-search-remove"><i class="ti-close"></i></span>
								</form>
							</div>
							<!-- main nav -->
							<div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
								<div class="logo-header d-md-block d-lg-none">
									<a href="{{ route('home') }}"><img src="{{ asset(config('setting.media').setting('logo')) }}" alt=""></a>
								</div>
								<ul class="nav navbar-nav">
									@include(config('app.fe_layout').'.menu')
								</ul>	
								<div class="dlab-social-icon">
									<ul>
										<li><a class="site-button sharp-sm fa fa-facebook" href="javascript:void(0);"></a></li>
										<li><a class="site-button sharp-sm fa fa-twitter" href="javascript:void(0);"></a></li>
										<li><a class="site-button sharp-sm fa fa-linkedin" href="javascript:void(0);"></a></li>
										<li><a class="site-button sharp-sm fa fa-instagram" href="javascript:void(0);"></a></li>
									</ul>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<!-- main header END -->
			</header>
			<!-- header END -->