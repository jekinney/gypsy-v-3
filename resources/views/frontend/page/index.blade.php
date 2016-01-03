@extends('frontend.theme.main')

@section('content')
	<section>
		<header class="well text-center">
			<h2>Follow The Sentimental Gypsy</h2>
		</header>
		<div class="container">
			<div class="row">
				@foreach($markets as $market)
					<div class="col-xs-12 col-sm-6">
						<div class="thumbnail">
							<header>
								<img src="{{ $market->type->image }}" class="img-responsive">
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
			</div>
		</div>
	</section>
	<section>
		<header class="well text-center">
			<h2>Latest Blog Articles</h2>
		</header>
		<section class="well">
			<div class="row">
				@foreach($articles as $article)
					<div class="col-xs-12 col-sm-6">
						<header>
							<img src="{{ $article->header_image }}" class="img-responsive" alt="{{ $article->title }}">
							<h2>{{ $article->title }}</h2>
						</header>
						<footer>
							<ul class="list-inline">
								<li>Author: {{ $article->author->username }}</li>
								<li>Category: {{ $article->category->title }}</li>
								<li>Published on: {{ $article->publish_at->toFormattedDateString() }}</li>
								<li>Reads: {{ $article->reads }}</li>
							</ul>
						</footer>
						<article>
							<p>{{ $article->snippet }}</p>
							<div class="text-right">
								<a href="{{ route('blog.article.show', $article->slug) }}" class="btn btn-primary btn-sm">Read More</a>
							</div>
						</article>
					</div>
				@endforeach
			</div>
		</section>
	</section>
@endsection