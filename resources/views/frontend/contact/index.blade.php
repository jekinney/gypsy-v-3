@extends('frontend.theme.main')

@section('content')
	<section class="container">
		<div class="well">
			<header class="text-center">
				<h2>Contact The Sentimental Gypsy</h2>
			</header>
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="username">Name:</label>
					<input 
						type="text" 
						name="username" 
						id="username" 
						value="@if(auth()->check()) {{ auth()->user()->username }} @else {{ old('username') }} @endif"
						class="form-control"
					>
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input 
						type="text" 
						name="email" 
						id="email" 
						value="@if(auth()->check()) {{ auth()->user()->email }} @else {{ old('email') }} @endif"
						class="form-control"
					>
				</div>
				<div class="form-group">
					<label for="subject">Subject:</label>
					<input 
						type="text" 
						name="subject" 
						id="subject" 
						value="{{ old('subject') }}"
						class="form-control"
					>
				</div>
				<div class="form-group">
					<label for="message">Message:</label>
					<textarea 
						name="message" 
						id="message" 
						class="form-control"
						rows="10" 
					>
						{{ old('message') }}
					</textarea>
				</div>
				<div class="text-right">
					<button type="reset" class="btn btn-default">Cancel</button>
					<button type="submit" class="btn btn-primary">Send</button>
			</form>
		</div>
	</section>
@endsection