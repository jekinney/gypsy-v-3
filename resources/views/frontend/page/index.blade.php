@extends('frontend.theme.main')

@section('page-title')
	Home Page
@endsection

@section('content')
	<header class="well text-center text-white">
		<h2>Follow The Sentimental Gypsy</h2>
	</header>
	<div class="container-fluid">
		<section class="row">
			@foreach($markets as $market)
				<div class="col-xs-12 col-sm-4">
					<div class="thumbnail">
						<header>
							<img src="{{ asset($market->type->image) }}" class="img-responsive">
						</header>
						<article class="caption">
							<h2 class="text-center">{{ $market->type->title }}</h2>
							<hr>
							<ul class="list-inline">
								<li>Starts: {{ $market->start_at->format('l jS \\of F Y') }}</li>
								<li>Ends: {{ $market->end_at->format('l jS \\of F Y') }}</li>
								<li>For {{ $market->times->count() }} Days</li>
							</ul>
							{!! $market->description !!}
							<hr>
							<div class="text-center">
								<a href="{{ route('market.show', $market->slug) }}" class="btn btn-primary btn-sm">More Details</a>
							</div>
						</article>
					</div>
				</div>
			@endforeach
		</section>
	</div>
	<header class="well text-center text-white">
		<h2>Latest Blog Articles</h2>
	</header>
	<div class="container-fluid">
		<section class="row">
				@foreach($articles as $article)
					<div class="col-xs-12 col-sm-6">
						<div class="thumbnail">
							<header>
								<img src="{{ asset($article->header_image) }}" class="img-responsive" alt="{{ $article->title }}">
								<h2>{{ $article->title }}</h2>
							</header>
							<article class="caption">
								<footer>
									<ul class="list-inline">
										<li>Author: {{ $article->author->username }}</li>
										<li>Category: {{ $article->category->title }}</li>
										<li>Published on: {{ $article->publish_at->toFormattedDateString() }}</li>
										<li>Reads: {{ $article->reads }}</li>
									</ul>
								</footer>
								<hr>
								<p>{{ $article->snippet }}</p>
								<hr>
								<div class="text-right">
									<a href="{{ route('blog.article.show', $article->slug) }}" class="btn btn-primary btn-sm">Read More</a>
								</div>
							</article>
						</div>
					</div>
				@endforeach
		</section>
	</div>
@endsection
