@extends('backend.theme.main')

@section('content')
  <section class="content-header">
    <h1>
      Gallery
      <small>album and photo management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('admin.gallery.album.index') }}"><i class="fa fa-camera"></i> Gallery</a></li>
      <li class="active"><i class="fa fa-picture-o"></i> Photos</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <section class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">
              Add Photos for {{ $album->name }}
            </h3>
            <div class="pull-right box-tools">
              <a href="{{ route('admin.gallery.album.index') }}" class="text-primary">
                <i class="fa fa-chevron-circle-left fa-2x"></i>
              </a>
              <a role="button" class="text-primary" data-toggle="modal" data-target="#album-help">
                <i class="fa fa-question-circle fa-2x"></i>
              </a>
            </div>
          </div>
          <div class="box-body pad">
            <div class="row">
              <div class="col-sm-6 hidden-xs">
                <div id="actions" class="row">
                  <div class="col-lg-7">
                    <span class="btn btn-success fileinput-button">
                      <i class="glyphicon glyphicon-plus"></i>
                      <span>Add Photos</span>
                    </span>
                    <button type="submit" class="btn btn-primary start">
                      <span><i class="fa fa-upload"></i></span>
                    </button>
                    <button type="reset" class="btn btn-warning cancel">
                      <span><i class="fa fa-ban"></i></span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-md-4 col-lg-3">
                    <div class="table table-striped files" id="previews">
                      <div id="template" class="file-row">
                        <input type="hidden" value="{{ $album->id }}" class="album-id">
                        <div style="margin-top: 10px;">
                          <span class="preview"><img data-dz-thumbnail class="img-responsive"></span>
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <input type="text" class="form-control description">
                        </div>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                        <div class="text-center">
                          <button class="btn btn-primary start">
                            <i class="fa fa-upload"></i>
                          </button>
                          <button data-dz-remove class="btn btn-warning cancel">
                            <i class="fa fa-ban"></i>
                          </button>
                          <button data-dz-remove class="btn btn-danger delete">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">
              Current Photos for {{ $album->name }}
            </h3>
          </div>
          <div class="box-body pad">
            @foreach($album->photos->chunk(6) as $chunk)
              <div class="row">
                @foreach($chunk as $photo)
                  <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="thumbnail">
                      <img src="{{ $photo->thumbnail }}">
                      <div class="caption text-center">
                        <p id="photo{{ $photo->id }}">{{ $photo->description }}</p>
                        <form action="{{ route('admin.gallery.photo.update') }}" method="post" class="hidden" id="photoForm{{ $photo->id }}">
                          <input type="hidden" name="_method" value="put">
                          <input type="hidden" name="id" value="{{ $photo->id }}">
                          {{ csrf_field() }}
                          <div class="form-group">
                              <input type="text" name="description" value="{{ $photo->description }}" class="form-control">
                          </div>
                          <div class="btn-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-wrench"></i></button>
                            <button type="button" class="btn btn-warning" onclick="cancelEditDescription({{ $photo->id }})">
                              <i class="fa fa-ban"></i>
                            </button>
                          </div>
                        </form>
                        <form action="{{ route('admin.gallery.photo.remove') }}" method="post">
                          <input type="hidden" name="_method" value="delete">
                          <input type="hidden" name="id" value="{{ $photo->id }}">
                          {{ csrf_field() }}
                          <div id="btns{{ $photo->id }}" class="btn-group">
                            <a href="#" class="btn btn-primary" role="button" onclick="editDescription({{ $photo->id }})"><i class="fa fa-gear"></i></a> 
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      </section>
    <div>
  </section>
  @include('backend.gallery.modals.album_help')
@endsection

@section('scripts')
  <script>
    // Get the template HTML and remove it from the doument
    var previewNode = document.querySelector('#template');
    previewNode.id = '';
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, {
        url: '/admin/gallery/photo/store',
        thumbnailWidth: 200,
        thumbnailHeight: 200,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: '#previews', // Define the container to display the previews
        clickable: '.fileinput-button' // Define the element that should be used as click trigger to select files.
    });

    myDropzone.on('addedfile', function(file) {
        // Hookup the start button
        file.previewElement.querySelector('.start').onclick = function() { 
          myDropzone.enqueueFile(file); 
        };
    });

    myDropzone.on('sending', function(file, xhr, formData) {
        // And disable the start button
        file.previewElement.querySelector('.start').setAttribute('disabled', 'disabled');
        formData.append('album_id', file.previewElement.querySelector('.album-id').value);
        formData.append('description', file.previewElement.querySelector('.description').value);
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on('queuecomplete', function(progress) {
      window.location.reload();
    });

    // Setup the buttons for all transfers
    // The 'add files' button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector('#actions .start').onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector('#actions .cancel').onclick = function() {
        myDropzone.removeAllFiles(true);
    };

    function editDescription(id) {
        document.getElementById('photo'+id).className = 'hidden';
        document.getElementById('btns'+id).className = 'hidden';
        document.getElementById('photoForm'+id).className = '';
    };

    function cancelEditDescription(id) {
        document.getElementById('photo'+id).className = '';
        document.getElementById('btns'+id).className = 'btn-group';
        document.getElementById('photoForm'+id).className = 'hidden';
    };
  </script>
@endsection
