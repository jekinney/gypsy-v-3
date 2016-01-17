@extends('backend.theme.main')

@section('content')
	  <section class="content-header">
	      <h1>
	          Manage Article Images
	          <small>Add, update or delete article images</small>
	      </h1>
	      <ol class="breadcrumb">
	          <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	          <li><i class="fa fa-th-large"></i> Blog</li>
	          <li class="active"><i class="fa fa-picture-o"></i> Manage Article Images</li>
	      </ol>
	  </section>
	  <section class="content">
		    <div class="row">
              <section id="createItem" class="col-xs-12">
                  <div class="box box-success">
                      <div class="box-header">
                          <h3 class="box-title">Article Images</h3>
                          <div class="pull-right box-tools">
                              <a role="button" class="btn text-success" data-toggle="modal" data-target="#itemFormHelp">
                                  <i class="fa fa-question-circle fa-2x"></i>
                              </a>
                          </div>
                      </div>
                      <div class="box-body pad">
                          <div id="actions" class="row">
  					     	    <div class="col-lg-7">
      						        <span class="btn btn-success fileinput-button">
      						            <i class="glyphicon glyphicon-plus"></i>
      						            <span>Add Images</span>
      						        </span>
      						        <button type="submit" class="btn btn-primary start">
      						            <span><i class="fa fa-upload"></i></span>
      						        </button>
      						        <button type="reset" class="btn btn-warning cancel">
      						            <span><i class="fa fa-ban"></i></span>
      						        </button>
    					      	</div>
        						  <div class="col-lg-5">
              						<span class="fileupload-process">
                							<div 
                								id="total-progress" 
                								class="progress progress-striped active" 
                								role="progressbar" 
                								aria-valuemin="0" 
                								aria-valuemax="100" 
                								aria-valuenow="0"
                							>
                  							<div 
                  								class="progress-bar progress-bar-success" 
                  								style="width:0%;" 
                  								data-dz-uploadprogress
                  							></div>
                							</div>
          						    </span>
        						  </div>
      					  </div>
      					  <div class="table table-striped files" id="previews">
    					      	<div id="template" class="file-row">
    					        	<div>
    					            	<span class="preview"><img data-dz-thumbnail /></span>
    					        	</div>
    					        	<div>
    					            	<p class="name" data-dz-name></p>
    					            	<strong class="error text-danger" data-dz-errormessage></strong>
    					        	</div>
    					        	<div>
    					            	<p class="size" data-dz-size></p>
    					            	<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
    					              		<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
    					            	</div>
    					        	</div>
    					        	<div>
    						          	<button class="btn btn-primary start">
    						              	<i class="glyphicon glyphicon-upload"></i>
    						              	<span><i class="fa fa-upload"></i></span>
    						          	</button>
    						          	<button data-dz-remove class="btn btn-warning cancel">
    						              	<span>Cancel</span>
    						          	</button>
    						          	<button data-dz-remove class="btn btn-danger delete">
    						            	  <span>Delete</span>
    						          	</button>
    					       		</div>
  					      	</div>
     						</div>
     					</div>
          </section>
            <section id="createItem" class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Current Article Images</h3>
                      <div class="pull-right box-tools">
                          <a role="button" class="btn text-success" data-toggle="modal" data-target="#itemFormHelp">
                              <i class="fa fa-question-circle fa-2x"></i>
                          </a>
                      </div>
                  </div>
                  <div class="box-body pad">
   						        @foreach($images->chunk(4) as $chunk)
             							<div class="row">
             								@foreach($chunk as $image)
          									<div class="col-sm-4 col-md-2">
          									    <div class="thumbnail">
          									      	<img src="{{ asset($image->thumbnail) }}" alt="{{ $image->title }}">
          									      	<div class="caption text-center">
          									      		<h4 id="image{{ $image->id }}">{{ $image->title }}</h4>
          									      		<form action="{{ route('admin.blog.image.update') }}" method="post" class="hidden" id="imageForm{{ $image->id }}">
          									      			  <input type="hidden" name="_method" value="put">
          									      			  <input type="hidden" name="id" value="{{ $image->id }}">
          									      			  {{ csrf_field() }}
          									      			  <div class="row">
          										      			    <div class="form-group col-xs-9">
          															          <input type="text" name="title" value="{{ $image->title }}" class="form-control">
          														        </div>
          														        <button type="submit" class="btn btn-primary col-xs-2"><i class="fa fa-wrench"></i></button>
          													      </div>
          												    </form>
          								        		<form action="{{ route('admin.blog.image.remove') }}" method="post">
          								        			<input type="hidden" name="_method" value="delete">
          								        			<input type="hidden" name="id" value="{{ $image->id }}">
          								        			{{ csrf_field() }}
          								        			<div class="btn-group">
          									        			<button type="button" onclick="editImage({{$image->id}})" class="btn btn-primary btn-sm">
          									        				<i class="fa fa-gear"></i>
          									        			</button>
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
                  </div>
              </div>
          </section>
      </div>
	</section>
@endsection

@section('scripts')
<script>
      // Get the template HTML and remove it from the doument
      var previewNode = document.querySelector('#template');
      previewNode.id = '';
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

      var myDropzone = new Dropzone(document.body, {
          url: '/admin/blog/image/store',
          thumbnailWidth: 100,
          thumbnailHeight: 100,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: '#previews', // Define the container to display the previews
          clickable: '.fileinput-button' // Define the element that should be used as click trigger to select files.
      });

      myDropzone.on('addedfile', function(file) {
          // Hookup the start button
          file.previewElement.querySelector('.start').onclick = function() { myDropzone.enqueueFile(file); };
      });

      // Update the total progress bar
      myDropzone.on('totaluploadprogress', function(progress) {
          document.querySelector('#total-progress .progress-bar').style.width = progress + '%';
      });

      myDropzone.on('sending', function(file) {
          // Show the total progress bar when upload starts
          document.querySelector('#total-progress').style.opacity = '1';
          // And disable the start button
          file.previewElement.querySelector('.start').setAttribute('disabled', 'disabled');
      });

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on('queuecomplete', function(progress) {
          document.querySelector('#total-progress').style.opacity = '0';
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

      function editImage(id) {
      	  document.getElementById('image'+id).className = 'hidden';
      	  document.getElementById('imageForm'+id).className = 'form-inline';
      };
</script>
@endsection