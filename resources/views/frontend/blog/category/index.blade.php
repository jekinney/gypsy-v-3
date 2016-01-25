@extends('frontend.theme.main')

@section('content')
	<div class="well text-white">
		<header class="container">
			<div class="pull-left">
				<h1>All Blog Categories</h1>
			</div>
			<div class="pull-right">
				<h2>Total Articles: {{ $articles }}</h2>
			</div>
		</header>
	</div>
	<main class="row">
		<section class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			<div class="panel panel-default">
				<div class="panel-body">
					@foreach($categories as $category)
						<h2>
							<a href="{{ route('blog.category.show', $category->slug) }}">{{ $category->title }}</a>
							<span class="pull-right">Articles: {{ $category->articles()->count() }}</span>
						</h2>
					@endforeach
				</div>
			</div>
		</section>
		@include('frontend.blog.partials.category_menu')
	</main>
@endsection