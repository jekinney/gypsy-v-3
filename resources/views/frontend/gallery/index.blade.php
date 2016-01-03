@extends('frontend.theme.main')

@section('content')
	<div id="gallery" class="row">
		<section class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
			<div class="well">
				<div v-for="image in images">
					<div class="col-xs-6 col-md-3">
	    				<a role="button" class="thumbnail">
	      					<img v-bind:src="image.thumbnail" alt="@{{image.name}}">
	    				</a>
	    				@{{ image.description }}
	  				</div>
	  			</div>
			</div>
		</section>
		<aside class="hidden-xs col-sm-2 col-md-3 col-lg-3">
			<div class="panel panel-primary">
		  		<div class="panel-heading text-center">
		    		<h3 class="panel-title">Image Categories</h3>
		  		</div>
		  		<div class="panel-body">
					<ul class="list-unstyled">
					</ul>
				</div>
			</div>
		</aside>
	</div>
@endsection

@section('scripts')
	<script>
		new Vue({
			el: '#gallery',
			data: {
				images: [],
			},
			ready: function() {

			},
		})
	</script>
@endsection