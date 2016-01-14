@extends('frontend.theme.main')

@section('content')
	<div class="row">
		<section class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			@foreach($markets->chunk(3) as $chunk)
				<section class="row">
					@foreach($chunk as $market)
						<div class="col-xs-12 col-sm-6 col-md-4">
							<div class="thumbnail">
								<header>
									<img src="{{ asset($market->type->image) }}" class="img-responsive">
								</header>
								<article class="caption">
									<h2 class="text-center">{{ $market->type->title }}</h2>
									<ul class="list-inline">
										<li>Starts: {{ $market->start_at->format('l jS \\of F Y') }}</li>
										<li>Ends: {{ $market->end_at->format('l jS \\of F Y') }}</li>
										<li>For {{ $market->times->count() }} Days</li>
									</ul>
									<p>{{ $market->description }}</p>
									<div class="text-center">
										<a href="{{ route('market.show', $market->slug) }}" class="btn btn-primary btn-sm">More Details</a>
									</div>
								</article>
							</div>
						</div>
					@endforeach
				</section>
			@endforeach
			<div class="text-center"> 
				{!! $markets->links() !!}
			</div>
		</section>
		<aside class="hidden-xs hidden-sm col-md-3 col-lg-3">
			<div class="panel panel-primary">
  				<header class="panel-heading text-center">
    				<h3 class="panel-title">Market Types</h3>
  				</header>
  				<div class="panel-body">
    				@foreach($types as $type)
						<div class="media">
  							<div class="media-left media-middle">
					    		<a href="{{ route('market.type', $type->slug) }}">
					      			<img class="media-object" style="height:50px;width:;" src="{{ $type->image }}" alt="{{ $type->title }}">
					    		</a>
					  		</div>
					  		<div class="media-body">
					    		<h4 class="media-heading">{{ $type->title }}</h4>
					    		<p>{{ $type->description }}</p>
					  		</div>
						</div>
    				@endforeach
  				</div>
			</div>
		</aside>
	</div>
@endsection