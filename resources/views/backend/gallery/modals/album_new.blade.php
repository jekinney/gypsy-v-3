<div class="modal @if(count($errors) > 0 && !$errors->has('id')) show @else fade @endif" id="album-new" tabindex="-1" role="dialog" aria-labelledby="albumCreate">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.gallery.album.store') }}" method="post">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="albumCreate">New Album</h4>
        </div>
        <div class="modal-body">
          @include('errors.validation')
          <div class="form-group @if($errors->has('name')) has-error @endif">
            <label for="name">Name\Title</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
          </div>
          <div class="form-group @if($errors->has('description')) has-error @endif">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description') }}" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
