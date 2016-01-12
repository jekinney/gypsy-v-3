@extends('backend.theme.main')

@section('content')
<section class="content-header">
    <h1>
        Market Event Editor
        <small>Edit an excisting Market Event</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Markets</a></li>
        <li class="active"><i class="fa fa-pencil-square-o"></i> Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <section class="col-xs-12 col-md-9">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        Edit {{ $market->title }}
                    </h3>
                    <div class="pull-right box-tools">
                        <a role="button" class="text-primary" data-toggle="modal" data-target="#market-form-help">
                            <i class="fa fa-question-circle fa-2x"></i>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                    <form action="{{ route('admin.market.update') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="title">Title</label>
                                <input 
                                    type="text" 
                                    name="title" 
                                    id="title" 
                                    value="{{ $market->title }}" 
                                    class="form-control" 
                                    placeholder="Title for your market event"
                                    required
                                    maxlength="120" 
                                >
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="type">Type:</label>
                                <select name="type_id" id="type" class="form-control">
                                    <option value="">Select A Market Type</option>
                                    @foreach($types as $type)
                                        <option 
                                            value="{{ $type->id }}" 
                                            @if($type->id == $market->type_id) selected @endif 
                                        >
                                            {{ $type->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">
                                {{ $market->description }}
                            </textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="start_at">Start Date</label>
                                <input 
                                    type="text" 
                                    name="start_at" 
                                    id="start_at" 
                                    value="{{ $market->start_at }}" 
                                    class="form-control" 
                                    required 
                                >
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="end_at">End Date</label>
                                <input 
                                    type="text" 
                                    name="end_at" 
                                    id="end_at" 
                                    value="{{ $market->end_at }}" 
                                    class="form-control" 
                                    required 
                                >
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Submit Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <aside class="hidden-xs col-sm-3">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        Images for this Market Event
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                        Add Images for this Market Event
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                </div>
            </div>
        </aside>
    </div>
</section>
@include('backend.market.modals.form-help')
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace('description');
        });
    </script>
@endsection