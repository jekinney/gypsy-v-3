@extends('frontend.theme.main')

@section('content')
	<div class="well text-white">
		<header class="container">
			<h1>Albums and Photos</h1>
		</header>
	</div>
	<section class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		@foreach($albums as $album)
			<div class="panel panel-default">
    			<div class="panel-heading" role="tab" id="{{ $album->slug }}">
      				<h4 class="panel-title">
        				<a role="button" 
        					data-toggle="collapse" 
        					data-parent="#accordion" 
        					href="#{{ $album->id }}" 
        					aria-expanded="{{ ($albums->first()->id == $album->id? 'true':'false') }}" 
        					aria-controls="{{ $album->id }}" 
        				>
          					{{ $album->name }}
        				</a>
      				</h4>
    			</div>
    			<div id="{{ $album->id }}" 
    				class="panel-collapse collapse {{ ($albums->first()->id == $album->id? 'in':'') }}" 
    				role="tabpanel" 
    				aria-labelledby="{{ $album->slug }}"
    			>
	    			<div class="panel-body text-center">
				 		@foreach($album->photos as $photo)
			      			<img 
			      				src="{{ $photo->thumbnail }}" 
			      				class="jslghtbx-thmb" 
			      				alt="..." 
			      				data-jslghtbx="{{ $photo->image }}"
			      				data-jslghtbx-group="{{ $album->id }}"
			      				data-jslghtbx-caption="{{ $photo->description }}"
			      			>
						@endforeach 
					</div>
				</div>
			</div>
		@endforeach
	</section>
@endsection


@section('scripts')
	<script>
    	var lightbox = new Lightbox();
    	lightbox.load();
	</script>
@endsection