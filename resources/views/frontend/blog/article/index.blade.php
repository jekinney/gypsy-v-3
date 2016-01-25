@extends('frontend.theme.main')

@section('page-title')
	Articles
@endsection

@section('content')
	<div class="well text-white">
		<header class="container">
			<h1>All Articles</h1>
		</header>
	</div>
	<main class="row">
		<section class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			@foreach($articles as $article)
				<div class="thumbnail">
					<img src="{{ $article->header_image }}" alt="{{ $article->title }}">
					<div class="caption">
						<header class="text-center">
							<h2>{{ $article->title }}</h2>
						</header>
						<footer class="text-center">
							<ul class="list-inline">
								<li>Author: {{ $article->author->username }}</li>
								<li>Category: {{ $article->category->title }}</li>
								<li>Published on: {{ $article->publish_at->toFormattedDateString() }}</li>
								<li>Reads: {{ $article->reads }}</li>
							</ul>
						</footer>
						<hr>
						<article class="container">
							<p>{{ $article->snippet }}</p>
							<div class="text-right">
								<a href="{{ route('blog.article.show', $article->slug) }}" class="btn btn-primary btn-sm">Read More</a>
							</div>
						</article>
					</div>
				</div>
			@endforeach
			<div class="text-center">
				{!! $articles->links() !!}
			</div>
		</section>
		@include('frontend.blog.partials.category_menu')
	</main>
@endsection