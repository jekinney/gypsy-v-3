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
            <li class="active"><i class="fa fa-location-arrow"></i> Manage Items</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-xs-12 col-sm-6">
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
                        <form action="{{ route('admin.market.item.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div id="itemForm">
                                <div class="form-group">
                                    <label for="title">Name or Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div id="photoForm" class="hidden">
                                <div id="photo-preview"></div>
                                <div id="photo-zone" class="photo-dropzone">
                                    Drag and drop or click here to add photos
                                    <input type="file" id="photo-upload" class="hidden">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="button" id="addPhotoBtn" onclick="showPhotoForm()" hidden="false" class="btn btn-warning">Add Photos</button>
                                <button type="button" id="addItemBtn" onclick="showItemForm()" hidden="true" class="hidden">Back To Item</button>
                                <button type="submit" class="btn btn-success">Add Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="col-xs-12 col-sm-6">
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

                </div>
            </div>
        </section>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var photoZone = document.getElementById('photo-zone');
        var photoUpload = document.getElementById('photo-upload');
        var photoPreview = document.getElementById('photo-preview');
        var that = this;
        photoZone.addEventListener('click', function() {
            photoUpload.click();
        });
        photoZone.addEventListener('mouseover', function() {
            photoZone.className = 'photo-dropzone dragover';
        });
        photoZone.addEventListener('mouseleave', function() {
            photoZone.className = 'photo-dropzone';
        });
        photoZone.addEventListener('dragover', function(event) {
            event.preventDefault();
            photoZone.className = 'photo-dropzone dragover';
        });
        photoZone.addEventListener('dragleave', function() {
            photoZone.className = 'photo-dropzone';
        });
        photoZone.addEventListener('drop', function(event) {
            event.preventDefault();
            if (event.dataTransfer.files) {
                console.log(event.dataTransfer.files[0]);
                for(i = 0; i < event.dataTransfer.files.length; ++i) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var img = document.createElement('img');
                        img.src = reader.result;
                        photoPreview.appendChild(img);
                    }
                    reader.readAsDataURL(event.dataTransfer.files[0]);
                }
            }
        });
        function showPhotoForm() {
            document.getElementById('itemForm').className = 'hidden';
            document.getElementById('photoForm').className = '';
            document.getElementById('addPhotoBtn').className = 'hidden';
            document.getElementById('addItemBtn').className = 'btn btn-danger';
        };
        function showItemForm() {
            document.getElementById('itemForm').className = '';
            document.getElementById('photoForm').className = 'hidden';
            document.getElementById('addPhotoBtn').className = 'btn btn-warning';
            document.getElementById('addItemBtn').className = 'hidden';
        };
        function readURL(input) {
            if (input.files && input.files[0]) {
                var photoPreview = document.getElementById('photo-preview');
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    photoPreview.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection