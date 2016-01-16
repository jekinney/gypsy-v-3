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
                            <a role="button" class="text-danger" data-toggle="modal" data-target="#editItemHelp">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body pad">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <span class="fileupload-process">
                                    <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                    </div>
                                </span>
                                <form 
                                    action="{{ route('admin.market.item.update') }}" 
                                    id="form" 
                                    method="post" 
                                    onsubmit="event.preventDefault(); newItemForm()"
                                >
                                    <input type="hidden" name="_method" value="put">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    {{ csrf_field() }} 
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
                                            <button type="submit" class="btn btn-success start">Update Item</button>
                                        </div>
                                        <div id="previews" class="row" style="margin-top:20px;">
                                            <div id="template">
                                                <div class="col-sm-6 col-md-4">
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
                                </form>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                @foreach($item->images->chunk(4) as $chunk)
                                    <div class="row"> 
                                        @foreach($chunk as $image)
                                            <div class="col-xs-6 col-sm-4 col-md-3">
                                                <div class="thumbnail text-center">
                                                    <img src="{{ asset($image->thumbnail) }}">
                                                    <div class="caption text-center">
                                                        <div class="row">
                                                            <div class="col-xs-6 text-right">
                                                                @if($image->main == 1)
                                                                    <button type="button" class="btn btn-success btn-sm">
                                                                        <i class="fa fa-thumbs-up"></i>
                                                                    </button>
                                                                @else
                                                                    <form action="{{ route('admin.market.image.main') }}" method="post">
                                                                        <input type="hidden" name="id" value="{{ $image->id }}">
                                                                        {{ csrf_field() }}
                                                                        <button type="submit" class="btn btn-default btn-sm">
                                                                            <i class="fa fa-thumbs-o-up"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <form action="{{ route('admin.market.image.remove') }}" method="post">
                                                                    <input type="hidden" name="_method" value="delete">
                                                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger btn-sm delete">
                                                                        <i class="glyphicon glyphicon-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    @include('backend.market.modals.item_edit_form_help')
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/marketItem.js') }}"></script>
@endsection