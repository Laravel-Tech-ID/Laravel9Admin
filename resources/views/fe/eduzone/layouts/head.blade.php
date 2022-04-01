    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="{{ 'AlQudwah.Id | '.setting('name').' | '.session('title') }}" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="{{ asset(config('app.fe_asset').'/images/favicon.ico') }}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('setting.media').setting('icon')) }}" />
	
	<!-- PAGE TITLE HERE -->
	<title>{!! 'AlQudwah.Id | '.setting('name').' | '.session('title') !!}</title>
	<meta property="og:url" content="{{ session('url') }}">
	<meta property="og:type" content="website">
	<meta property="og:title" content="{{ session('title') }}">
	<meta property="og:description" content="{{ session('title') }}">
	<meta property="og:site_name" content="{{ setting('name') }}">
	<meta property="og:image" content="{{ session('image') }}">	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="{{ asset(config('app.fe_asset').'/js/html5shiv.min.js') }}"></script>
	<script src="{{ asset(config('app.fe_asset').'/js/respond.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset(config('app.fe_asset').'/js/jquery.min.js') }}"></script><!-- JQUERY.MIN JS -->
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="{{ asset(config('app.fe_asset').'/css/plugins.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset(config('app.fe_asset').'/css/style.css') }}">
	<link class="skin" rel="stylesheet" type="text/css" href="{{ asset(config('app.fe_asset').'/css/skin/skin-2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset(config('app.fe_asset').'/css/templete.css') }}">
	<!-- Google Font -->
	<style>
	/* @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'); */
	</style>
	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" />
	<link rel="stylesheet" type="text/css" href="{{ asset(config('app.fe_asset').'/plugins/revolution/revolution/css/revolution.min.css') }}">
	