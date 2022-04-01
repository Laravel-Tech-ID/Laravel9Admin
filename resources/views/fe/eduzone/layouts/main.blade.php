<!DOCTYPE html>
<html lang="en">
	<head>
        @include(config('app.fe_layout').'.head')
	</head>
	<body id="bg">
	<div id="fb-root"></div>
		<!-- FACEBOOK SHARE BUTTON -->
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=1775589576023827&autoLogAppEvents=1" nonce="ATJiQ7Xx"></script>		
		<!-- END FACEBOOK SHARE BUTTON -->
		<div class="page-wraper">
			<div id="loading-area"></div>
            @include(config('app.fe_layout').'.header')
			@yield('content')
            @include(config('app.fe_layout').'.app')			
            @include(config('app.fe_layout').'.subscribe')			
            @include(config('app.fe_layout').'.footer')
		</div>
        @include(config('app.fe_layout').'.foot')
	</body>
</html>