@extends('backend.theme.main')

@section('content')
	<section class="content-header">
	    <h1>
	        Article Editor
	        <small>Edit a article</small>
	    </h1>
	    <ol class="breadcrumb">
	        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	        <li><i class="fa fa-th-large"></i> Blog</li>
	        <li class="active"><i class="fa fa-location-arrow"></i> Article Editor</li>
	    </ol>
	</section>

@endsection