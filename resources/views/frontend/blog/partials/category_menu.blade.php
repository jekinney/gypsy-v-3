<aside class="col-md-3 col-lg-3 hidden-xs hidden-sm">
	<div class="panel panel-primary">
  		<div class="panel-heading text-center">
    		<h3 class="panel-title">Categories</h3>
  		</div>
  		<div class="panel-body">
			<ul class="list-group">
				@foreach($categories as $category)
		  		<li class="list-group-item">
		    		<a href="{{ route('blog.category.show', $category->slug) }}" class="btn btn-link">{{ $category->title }}</a>
		  		</li>
		  		@endforeach
		  		<li class="list-group-item">
		    		<a href="{{ route('blog.category.index') }}" class="btn btn-link">All Categories</a>
		  		</li>
			</ul>
		</div>
	</div>
	<div class="panel panel-primary">
  		<div class="panel-heading text-center">
    		<h3 class="panel-title">Newest Articles</h3>
  		</div>
  		<div class="panel-body">
			<ul class="list-group">
				@foreach($tenRecentArticles as $article)
		  		<li class="list-group-item">
		  			<a href="{{ route('blog.article.show', $article->slug) }}">
		  				<span class="badge pull-right">{{ $article->reads }}</span>
		    			{{ $article->title }}
		    		</a>
		  		</li>
		  		@endforeach
			</ul>
		</div>
	</div>
	<div class="panel panel-primary">
  		<div class="panel-heading text-center">
    		<h3 class="panel-title">Top Ten Articles</h3>
  		</div>
  		<div class="panel-body">
			<ul class="list-group">
				@foreach($topTenArticles as $article)
		  		<li class="list-group-item">
		  			<a href="{{ route('blog.article.show', $article->slug) }}">
		    			<span class="badge text-primary pull-right">{{ $article->reads }}</span>
		    			{{ $article->title }}
		    		</a>
		  		</li>
		  		@endforeach
			</ul>
		</div>
	</div>
</aside>