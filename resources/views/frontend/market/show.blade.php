@extends('frontend.theme.main')

@section('content')
	<section class="well">
		<div class="row">
		<header class="colxs-12 col-sm-6 col-md-4"> 
			<img src="{{ $market->type->image }}" class="img-responsive">
			<h1 class="text-center">{{ $market->type->title }}</h1>
		</header>
		<article class="col-xs-12 col-sm-6 col-md-8">
			<h2>{{ $market->title }}</h2>
			<ul class="list-inline">
				<li><b>Starts: {{ $market->start_at->format('l jS \\of F Y') }}</b></li>
				<li><b>Ends: {{ $market->end_at->format('l jS \\of F Y') }}</b></li>
				<li><b>Lasts for: {{ $market->times->count() }} Days</b></li>
			</ul>
			<p>{{ $market->description }}</p>
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
	</section>
@endsection