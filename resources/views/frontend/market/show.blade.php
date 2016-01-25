@extends('frontend.theme.main')

@section('content')
	<main class="panel panel-default">
		<div class="panel-body row">
			<header class="col-xs-12 col-sm-6 col-md-4 text-center"> 
				<h1>{{ $market->type->title }}</h1>
				<img src="{{ $market->type->image }}">
			</header>
			<article class="col-xs-12 col-sm-6 col-md-4">
				<h2>{{ $market->title }}</h2>
				<hr>
				<ul class="list-inline">
					<li><b>Starts: {{ $market->start_at->format('l jS \\of F Y') }}</b></li>
					<li><b>Ends: {{ $market->end_at->format('l jS \\of F Y') }}</b></li>
					<li><b>Lasts for: {{ $market->times->count() }} Days</b></li>
				</ul>
				{!! $market->description !!}
				<ul class="list-unstyled">
					@foreach($market->times as $time)
						<li>
							<h4><b>{{ $time->start->format('l jS \\of F') }}</b></h4>
							<div class="row">
								<span class="col-xs-6">Open: {{ $time->start->format('h:i A') }}</span>
								<span class="col-xs-6">Close: {{ $time->end->format('h:i A') }}</span>
							</div>
						</li>
					@endforeach
				</ul>
			</article>
			<footer class="col-xs-12 col-sm-6 col-md-4 text-center">
				<h1>Directions</h1>
				<img src="{{ asset('images/placeholders/map.png') }}">
			</footer>
		</div>
	</main>
@endsection