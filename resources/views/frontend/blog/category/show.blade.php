@extends('frontend.theme.main')

@section('content')
	<div class="row well text-white">
		<header class="col-xs-12">
			<div class="pull-left">
				<h1>{{ $category['category']->title }}</h1>
			</div>
			<div class="pull-right">
				<h2>Total Articles: {{ count($category['articles']) }}</h2>
		</header>
	</div>
	<div class="row">
		<section class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			@foreach($category['articles'] as $article)
				<div class="thumbnail">
					<img src="{{ $article->header_image }}" class="img-responsive" alt="{{ $article->title }}">
					<div class="caption">
						<header>
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
				</div>
			@endforeach
			<div class="text-center">
				{!! $category['articles']->render() !!}
			</div>
		</section>
		@include('frontend.blog.partials.category_menu')
	</div>
@endsection