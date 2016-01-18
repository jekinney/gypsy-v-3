@extends('frontend.theme.main')

@section('content')
	<section class="container-fluid">
		<div class="row">
			<section class="well col-xs-12 col-sm-8 col-md-9">
				<header class="text-center">
					<h2>{{ auth()->user()->username }}'s Account</h2>
				</header>
			</section>
			<aside class="col-xs-12 col-sm-4 col-md-3">
				<div class="panel panel-primary">
			  		<div class="panel-heading text-center">
			    		<h3 class="panel-title">Settings</h3>
			  		</div>
			  		<div class="panel-body">
			  			<img src="{{ auth()->user()->avatar }}" class="img-responsive center-block" style="margin-bottom:15px;">	
			  			<ul class="list-group">
			  				<li class="list-group-item">
			  					<a role="button" data-toggle="modal" data-target="#updatePassword">
				  					@if(auth()->user()->password)
				  						Update Password
					  				@else
						  				<span class="text-danger">Set A Password</span>
					  				@endif
					  			</a>
				  			</li>
				  			<li class="list-group-item">
				  				@if(auth()->user()->social->where('provider', 'facebook')->first())
				  					<span class="text-info">Facebook Linked</span>
				  				@else 
				  					<a href="{{ route('facebook.provider') }}" class="text-danger">Link Facebook Account</a>
				  				@endif
				  			</li>
				  			<li class="list-group-item">
				  				@if(auth()->user()->social->where('provider', 'google')->first())
				  					<span class="text-info">Google Linked</span>
				  				@else 
				  					<a href="{{ route('facebook.provider') }}" class="text-danger">Link Google Account</a>
				  				@endif
				  			</li>
  							<li class="list-group-item">
  								<a href="{{ route('account.newsletter') }}">
  									@if(auth()->user()->newsletter)
  										Recieving Newsletter
  									@else
  										<span class="text-danger">Not Recieveing Newsleter</span>
  									@endif
  								</a>
  							</li>
						  	<li class="list-group-item">Article Comments Authored: {{ auth()->user()->comments->count() }}</li>
						  	<li class="list-group-item">Forum Topics: 0</li>
						  	<li class="list-group-item">Forum Replies: 0</li>
						</ul>
					</div>
				</div>
				<div class="panel panel-primary">
			  		<div class="panel-heading text-center">
			    		<h3 class="panel-title">Notifications</h3>
			  		</div>
			  		<div class="panel-body">

					</div>
				</div>
			</aside>
		</div>
	</section>
	@include('frontend.auth.modals.update_password')
@endsection