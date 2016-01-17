@extends('frontend.theme.main')

@section('content')
	<section class="container-fluid">
		<div class="row">
			<div class="well col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<header class="text-center">
					<h2>Register with Facebook</h2>
					<a href="{{ route('facebook.provider') }}" class="btn btn-primary">
						<i class="fa fa-facebook-official"></i> Facebook
					</a>
				</header>
				<header class="text-center">
					<h2>Create a new account</h2>
				</header>
				<form action="" method="post">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="username">Your Name:</label>
						<input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Your Email:</label>
						<input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="text" name="password" id="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Password Again:</label>
						<input type="text" name="password_confirmation" id="password_confirmation" class="form-control" required>
					</div>
					<div class="checkbox">
						<label for="tos">
							<input type="checkbox" name="tos" id="tos" value="1" required>
							I have read and accept the <a href="" target="_blank">Terms of Service</a>.
						</label>
					</div>
					<div class="checkbox">
						<label for="pp">
							<input type="checkbox" name="pp" id="pp" value="1" required>
							I have read and accept the <a href="" target="_blank">Privacy Policy</a>.
						</label>
					</div>
					<div class="checkbox">
						<label for="newsletter">
							<input type="checkbox" name="newsletter" id="newsletter" value="1" checked="true">
							Monthly newsletter (You can unsubscribe anytime from your account setting page).
						</label>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Create My Account</button>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection