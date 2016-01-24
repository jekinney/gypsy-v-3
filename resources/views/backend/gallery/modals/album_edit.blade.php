<div class="modal @if($errors->has('id') && $errors->first()->id == $album->id) show @else fade @endif" id="editAlbum{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="EditAlbum{{$album->id}}">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.gallery.album.update') }}" method="post">
        <input type="hidden" name="id" value="{{ $album->id }}">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="EditAlbum{{$album->id}}">Edit {{ $album->name }}</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name\Title</label>
            <input type="text" name="name" id="name" value="{{ $album->name }}" class="form-control">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{{ $album->description }}" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
