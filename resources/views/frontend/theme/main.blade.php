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
		<header style="position:relative; margin-bottom:25px; margin-top:-20px;" width="100%">
			<img src="{{ asset('images/site/logo.jpg') }}" height="300px">
				<div style="position:absolute; top:20px; left:30px;">
					<h1>The Sentimental Gypsy</h1>
				</div>
				<div style="position:absolute;top:75%;left:45%;" >
					<h2 style="background-color:#5C6BC0; color:#fff; height:40px; width:100%; padding:5px 10px 15px 10px; border-radius:5px;">@yield('page-title')</h2>
				</div>
			</div>
		</header>
		<main class="container-fluid">
			@yield('content')
		</main>
		@include('frontend/theme/partials/footer')
		<script src="{{ asset('frontend/js/main.js') }}"></script>
		@yield('scripts')
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', 'UA-72381932-1', 'auto');
		  ga('send', 'pageview');
		</script>
	</body>
</html>