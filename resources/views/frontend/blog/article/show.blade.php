@extends('frontend.theme.main')

@section('content')
	<div class="well">
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
		<hr>
		<article>
			{!! $article->body !!}
		</article>
	</div>
@endsection