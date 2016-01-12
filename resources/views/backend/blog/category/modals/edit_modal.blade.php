<div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.blog.category.update') }}" method="post">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="id" value="{{ $category->id }}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit {{ $category->title }} Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title{{ $category->id }}">Title</label>
                        <input type="text" name="title" id="title{{ $category->id }}" value="{{ $category->title }}" class="form-control">
                    </div>
                    <div class="form-input">
                        <label for="description{{ $category->id }}">Description</label>
                        <textarea name="description" id="description{{ $category->id }}" class="form-control">
                            {{ $category->description }}
                        </textarea>
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