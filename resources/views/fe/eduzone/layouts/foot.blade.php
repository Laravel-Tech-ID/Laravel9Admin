		<!-- JAVASCRIPT FILES ========================================= -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/wow/wow.js') }}"></script><!-- WOW JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/bootstrap/js/popper.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/bootstrap/js/bootstrap.min.js') }}"></script><!-- BOOTSTRAP.MIN JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script> <!-- FORM JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script><!-- FORM JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/magnific-popup/magnific-popup.js') }}"></script><!-- MAGNIFIC POPUP JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/imagesloaded/imagesloaded.js') }}"></script><!-- IMAGESLOADED -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/masonry/masonry-3.1.4.js') }}"></script><!-- MASONRY -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/masonry/masonry.filter.js') }}"></script><!-- MASONRY -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/owl-carousel/owl.carousel.js') }}"></script><!-- OWL SLIDER -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/lightgallery/js/lightgallery-all.min.js') }}"></script><!-- Lightgallery -->
		<script src="{{ asset(config('app.fe_asset').'/js/custom.js') }}"></script><!-- CUSTOM FUCTIONS  -->
		<script src="{{ asset(config('app.fe_asset').'/js/dz.carousel.min.js') }}"></script><!-- SORTCODE FUCTIONS  -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/countdown/jquery.countdown.js') }}"></script><!-- COUNTDOWN FUCTIONS  -->
		<script src="{{ asset(config('app.fe_asset').'/js/dz.ajax.js') }}"></script><!-- CONTACT JS  -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/rangeslider/rangeslider.js') }}" ></script><!-- Rangeslider -->

		<script src="{{ asset(config('app.fe_asset').'/js/jquery.lazy.min.js') }}"></script>
		<!-- REVOLUTION JS FILES -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
		<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
		<script src="{{ asset(config('app.fe_asset').'/js/rev.slider.js') }}"></script>
		<script>
		jQuery(document).ready(function() {
			'use strict';
			dz_rev_slider_5();	
			$('.lazy').Lazy();
		});	/*ready*/
		</script>