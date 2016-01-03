<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>The Sentimental Gypsy</title>
		<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
		<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>
	<body>
		@include('frontend/theme/partials/top_nav')
		<header class="container-fluid">
			<div class="well">
				<h1>The Sentimental Gypsy</h1>
			</div>
		</header>
		<main class="container-fluid">
			@yield('content')
		</main>
		@include('frontend/theme/partials/footer')
		<script src="{{ asset('frontend/js/main.js') }}"></script>
		@yield('scripts')
	</body>
</html>