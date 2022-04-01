			<!-- Footer -->
			<footer class="site-footer text-uppercase footer-white bgpt1">
				<div class="footer-top">
					<div class="container saf-footer">
						<div class="row">
							<div class="col-md-6 col-lg-3 col-sm-6 footer-col-4">
								<div class="widget widget_getintuch">
									<h5 class="m-b30">Hubungi Kami</h5>
									<ul>
										<li><i class="ti-location-pin"></i><strong>address</strong> {!! setting('address_long') !!}</li>
										<li><i class="ti-mobile"></i><strong>phone</strong>{{ setting('phone') }}</li>
										<li><i class="ti-email"></i><strong>email</strong>{{ setting('email') }}</li>
									</ul>
								</div>
							</div>
							
							<div class="col-md-6 col-lg-3 col-sm-6 col-5 footer-col-4">
								<div class="widget widget_services border-0">
									<h5 class="m-b30">Lembaga</h5>
									<ul>
										@foreach($footer1menus as $menu)
											<li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
							
							<div class="col-md-6 col-lg-3 col-sm-6 col-7 footer-col-4">
								<div class="widget widget_services border-0">
									<h5 class="m-b30">Kategori</h5>
									<ul>
										@foreach($categories as $category)
											<li><a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-lg-3 col-sm-6 footer-col-4">
								<div class="widget widget_gallery gallery-grid-4">
									<h5 class="m-b30">Gallery</h5>
									<ul>
										@foreach($galleries as $gallery)
											<li class="img-effect2"> <a href="javascript:void(0);"><img src="{{ asset(config('web.media').'album/gallery/'.$gallery->picture) }}" alt=""></a> </li>
										@endforeach
									</ul>
								</div>
							</div>                    
						</div>
					</div>
				</div>
				<!-- footer bottom part -->
				<div class="footer-bottom">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-6 text-left "> <span>Copyright © @php echo date('Y'); @endphp | Sekolah Terpadu Al-Qudwah | Developed by <a href="https://flazhost.com">FlazHost.Com</a></span> </div>
							<div class="col-md-6 col-sm-6 text-right "> 
								<div class="widget-link "> 
									<ul>
										<li><a href="help-desk.html"> Help Desk</a></li> 
										<li><a href="privacy-policy.html"> Privacy Policy</a></li> 
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<button class="scroltop style1 white icon-up" type="button"><i class="fa fa-arrow-up"></i></button>
			<!-- Footer END -->