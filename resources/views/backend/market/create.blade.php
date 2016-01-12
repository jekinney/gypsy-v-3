@extends('backend.theme.main')

@section('content')
<section class="content-header">
    <h1>
        Add New Market
        <small>Add a new market event</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Markets</a></li>
        <li class="active"><i class="fa fa-location-arrow"></i> Create</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
    </div>
</section>
@endsection