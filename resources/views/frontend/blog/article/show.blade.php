@extends('frontend.theme.main')

@section('content')
	<div class="well">
		<header>
			<img src="{{ asset($article->header_image) }}" class="img-responsive">
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

	<section class="well">
		<header>
			<h3>Comments</h3>
		</header>
		@if(auth()->guest())
			<h5>Sorry, you must be logged in to leave a comment</h5>
		@endif
		<div class="media well">
		  	<div class="media-left">
		      	<img class="media-object img-circle" 
		      		src="https://scontent-ord1-1.xx.fbcdn.net/hprofile-xlf1/v/t1.0-1/c49.0.160.160/p160x160/11047924_1549777385289716_6985770533271351625_n.jpg?oh=9ff9c83baa64b416a051fa96398703c5&oe=56FE43C2" 
		      		alt="..."
		      		height="75px" 
		      	>
		  	</div>
		  	<div class="media-body">
		    	<h4 class="media-heading">Jason said on January 15th, 2016</h4>
		    	<p>Some random Comment</p>
		  	</div>
		</div>
		<div class="media well">
		  	<div class="media-left">
		      	<img class="media-object img-circle" 
		      		src="https://scontent-ord1-1.xx.fbcdn.net/hprofile-xlf1/v/t1.0-1/c49.0.160.160/p160x160/11047924_1549777385289716_6985770533271351625_n.jpg?oh=9ff9c83baa64b416a051fa96398703c5&oe=56FE43C2" 
		      		alt="..."
		      		height="75px" 
		      	>
		  	</div>
		  	<div class="media-body">
		    	<h4 class="media-heading">Jason said on January 15th, 2016</h4>
		    	<p>Some random Comment</p>
		    	<p>
			    	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo blanditiis quas deserunt molestiae illum nobis, 
			    	reiciendis temporibus voluptates dolorum sapiente nemo consectetur nam velit, voluptatibus similique nulla odit 
			    	deleniti laborum!
		    	</p>
		    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, obcaecati blanditiis voluptate fuga porro 
		    	similique dolorem doloribus tenetur deleniti ducimus aliquid eum eos ipsum sapiente non ea voluptates laudantium eligendi.
		    	</p>
		    	<p>
			    	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo blanditiis quas deserunt molestiae illum nobis, 
			    	reiciendis temporibus voluptates dolorum sapiente nemo consectetur nam velit, voluptatibus similique nulla odit 
			    	deleniti laborum!
		    	</p>
		    	<p>
			    	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo blanditiis quas deserunt molestiae illum nobis, 
			    	reiciendis temporibus voluptates dolorum sapiente nemo consectetur nam velit, voluptatibus similique nulla odit 
			    	deleniti laborum!
		    	</p>
		  	</div>
		</div>
	</section>
@endsection