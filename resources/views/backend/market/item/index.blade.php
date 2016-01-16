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
            <li class="active"><i class="fa fa-shopping-cart"></i> Manage Items</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section id="createItem" class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Create New Market Items
                        </h3>
                        <div class="pull-right box-tools">
                            <a role="button" class="btn text-success" data-toggle="modal" data-target="#itemFormHelp">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
                            <button type="button" class="btn btn-success btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body pad">
                        <span class="fileupload-process">
                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                            </div>
                        </span>
                        <form action="{{ route('admin.market.item.store') }}" id="form" method="post" onsubmit="event.preventDefault(); newItemForm()">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label for="title">Name or Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div id="actions">
                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add Photos</span>
                                </span>
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <button type="submit" class="btn btn-success start">Add Item</button>
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
                        </form>
                    </div>
                </div>
            </section>
            <section id="listItems" class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">
                            Current Market Items
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        @foreach($items->chunk(3) as $chunk)
                            <div class="row">
                                @foreach($chunk as $item)
                                    <div class="col-sm-4 col-md-2">
                                        <div class="thumbnail">
                                            <a href="{{ route('admin.market.item.edit', $item->id) }}">
                                                @if($item->images->count())
                                                    @if($item->images()->where('main', 1)->first())
                                                        <img 
                                                            class="media-object" 
                                                            src="{{ asset($item->images()->where('main', 1)->first()->thumbnail) }}" 
                                                            alt="{{ $item->title }}" height="200px" width="200px"
                                                        >
                                                    @else
                                                        <img 
                                                            class="media-object" 
                                                            src="{{ asset($item->images()->first()->thumbnail) }}" 
                                                            alt="{{ $item->title }}" height="200px" width="200px"
                                                        >
                                                    @endif
                                                @else
                                                    <img class="media-object" src="http://dummyimage.com/100/000/fff.png&text=No+Image" >
                                                @endif
                                            </a>
                                            <div class="caption text-center">
                                                <h4>{{ $item->title }}</h4>
                                                <p>Photo Count: {{ $item->images->count() }}</p>
                                                <form action="{{ route('admin.market.item.remove') }}" method="post">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    {{ csrf_field() }}
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.market.item.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-gear"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        {!! $items->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </section>
    @include('backend.market.modals.item_new_form_help')
@endsection

@section('scripts')
    <script src="{{ asset('backend/js/marketItem.js') }}"></script>
@endsection