@foreach($categories as $category)
	<h2><a href="">{{ $category->title }}</a></h2>
	<p><a href="">Articles: {{ $category->count }}</a></p>
@endforeach