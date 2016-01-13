<div class="modal fade" id="editMarketType{{ $type->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.market.type.update') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="id" value="{{ $type->id }}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit {{ $type->title }} Market Type</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Market Image</label>
                        <input type="file" name="image"  id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title{{ $type->id }}">Title</label>
                        <input type="text" name="title" id="title{{ $type->id }}" value="{{ $type->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description{{ $type->id }}">Description</label>
                        <textarea name="description" id="description{{ $type->id }}" class="form-control" rows="10">{{ $type->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="location{{ $type->id }}">Location</label>
                        <input type="text" name="location" id="location{{ $type->id }}" value="{{ $type->location }}" class="form-control">
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