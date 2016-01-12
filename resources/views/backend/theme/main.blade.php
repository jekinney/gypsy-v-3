<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<title>The Sentimental Gypsy | Dashboard</title>
	  	<!-- Tell the browser to be responsive to screen width -->
	  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  	<!-- Bootstrap 3.3.5 -->
	  	<link href="{{ elixir('backend/css/main.css') }}" rel="stylesheet">
	  	<link href="{{ asset('backend/js/iCheck/all.css') }}" rel="stylesheet">
		@yield('css')
	  	<!--[if lt IE 9]>
  		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  		<![endif]-->
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			@include('backend.theme.partials.header')
			@include('backend.theme.partials.left_nav')
		    <div class="content-wrapper">
		    	@yield('content')
		    </div>
		</div>
	
		<script src="{{ elixir('backend/js/main.js') }}"></script>
		<script src="{{ asset('backend/js/datepicker/bootstrap-datepicker.js') }}"></script>
		@yield('scripts')
	</body>
</html>
