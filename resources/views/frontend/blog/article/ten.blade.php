@extends('frontend.theme.main')

@section('content')
	<div class="row">
		<section class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			@foreach($articles as $article)
				<header>
					<img src="{{ $article->header_image }}" class="img-responsive">
					<h2>{{ $article->title }}</h2>
				</header>
				<footer>
					<ul class="list-inline">
						<li>Author: {{ $article->author->username }}</li>
						<li>Category: {{ $article->category->title }}</li>
						<li>Published on: {{ $article->publish_at->diffForHumans() }}</li>
						<li>Reads: {{ $article->reads }}</li>
					</ul>
				</footer>
				<article>
					<hr>
					<p>{{ $article->snippet }}</p>
					<hr>
					<div class="text-right">
						<a href="{{ route('blog.article.show', $article->slug) }}" class="btn btn-primary btn-sm">Read More</a>
					</div>
					<hr>
				</article>
			@endforeach
		</section>
		@include('frontend.blog.partials.category_menu')
	</div>
@endsection