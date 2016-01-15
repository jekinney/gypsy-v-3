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
            <section id="createItem" class="col-xs-12 col-sm-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">
                            Create New Market Items
                        </h3>
                        <div class="pull-right box-tools">
                            <a role="button" class="text-success" data-toggle="modal" data-target="#marketItemHelp">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
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
                            <div class="form-group">
                                <label for="title">Name or Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
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
            <section id="listItems" class="col-xs-12 col-sm-6">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">
                            Current Market Items
                        </h3>
                        <div class="pull-right box-tools">
                            <a role="button" class="text-primary" data-toggle="modal" data-target="#marketItemHelp">
                                <i class="fa fa-question-circle fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        @foreach($items as $item)
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ route('admin.market.item.edit', $item->id) }}">
                                        @if($item->images->count())
                                            @if($item->images()->where('main', 1)->first())
                                                <img 
                                                    class="media-object" 
                                                    src="{{ asset($item->images()->where('main', 1)->first()->thumbnail) }}" 
                                                    alt="{{ $item->title }}" height="100px" width="100px"
                                                >
                                            @else
                                                <img 
                                                    class="media-object" 
                                                    src="{{ asset($item->images()->first()->thumbnail) }}" 
                                                    alt="{{ $item->title }}" height="100px" width="100px"
                                                >
                                            @endif
                                        @else
                                            <img class="media-object" src="http://dummyimage.com/100/000/fff.png&text=No+Image" >
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        {{ $item->title }}
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('admin.market.item.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-gear"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </h4>
                                    {!! $item->description !!}
                                    <p>Photo Count: {{ $item->images->count() }}</p>
                                </div>
                            </div>
                        @endforeach
                        {!! $items->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
    <script>
        var previewNode = document.querySelector("#template");
        previewNode.id = '';
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        var myDropzone = new Dropzone(document.body, {
          url: '/admin/market/item/image/store', 
          thumbnailWidth: 80,
          thumbnailHeight: 80,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, 
          previewsContainer: '#previews', 
          clickable: '.fileinput-button' 
        });
        function newItemForm() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
            myDropzone.on('sending', function(file) {
                document.querySelector('#total-progress').style.opacity = '1';
                document.querySelector(".start").setAttribute('disabled', 'disabled');
            });
             myDropzone.on('totaluploadprogress', function(progress) {
                document.querySelector('#total-progress .progress-bar').style.width = progress + '%';
            });
            myDropzone.on('queuecomplete', function(progress) {
                document.querySelector('#total-progress').style.opacity = '0';
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                document.getElementById('form').submit();
            });
        };
    </script>
@endsection