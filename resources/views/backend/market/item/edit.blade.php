@extends('backend.theme.main')

@section('content')
    <section class="content-header">
        <h1>
            Manage Market Items
            <small>Create, Update or Remove</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.market.index') }}"><i class="fa fa-globe"></i> Markets</a></li>
            <li><a href="{{ route('admin.market.item.index') }}"><i class="fa fa-shopping-cart"></i> Manage Items</a></li>
            <li class="active"><i class="fa fa-location-arrow"></i> Item Editor</li>
        </ol>
    </section>
    <section class="content">
         <div class="row">
            <section id="createItem" class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">
                            Create New Market Items
                        </h3>
                        <div class="pull-right box-tools">
                            <a role="button" class="text-danger" data-toggle="modal" data-target="#marketItemHelp">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body pad">
                        <form 
                            action="{{ route('admin.market.item.update') }}" 
                            id="form" 
                            method="post" 
                            onsubmit="event.preventDefault(); newItemForm()"
                        >
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            {{ csrf_field() }}
                            <div class="row"> 
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="title">Name or Title</label>
                                        <input type="text" name="title" id="title" value="{{ $item->title }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ $item->description }}</textarea>
                                    </div>
                                    <div id="actions">
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add Photos</span>
                                        </span>
                                        <div class="pull-right">
                                            <button type="reset" class="btn btn-default">Reset</button>
                                            <button type="submit" class="btn btn-success">Update Item</button>
                                        </div>
                                        <div id="previews" class="row" style="margin-top:20px;">
                                            <div id="template">
                                                <div class="col-sm-4 col-md-2">
                                                    <div class="thumbnail text-center">
                                                        <span class="preview"><img data-dz-thumbnail></span>
                                                        <div class="caption text-center">
                                                            <button data-dz-remove class="btn btn-danger btn-sm delete">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row"> 
                                        @foreach($item->images as $image)
                                            <div class="col-sm-4 col-md-2">
                                                <div class="thumbnail text-center">
                                                    <img src="{{ asset($image->thumbnail) }}"></span>
                                                    <div class="caption text-center">
                                                        <button data-dz-remove class="btn btn-danger btn-sm delete">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection