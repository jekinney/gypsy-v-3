<div class="modal fade" id="categoryHelp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit {{ $category->title }} Category</h4>
            </div>
            <div class="modal-body">
                <h3>Create Category</h3>
                <p>
                    Simply fill out a title and description. The title will be public and used to group articles together
                    where the description will not. The description is for your use to describe/remind yourself of the 
                    purpose of the category.
                </p>
                <h3>Current Categories</h3>
                <p>
                    List of all your categories, article count assigned that category. Under options you can
                    edit the category. Becareful as this will change the identifiying slug accosiated with 
                    your category. If a user has a category saved as a favorited url this will break the url.
                </p>
                <ul class="list-unstyled">
                    <li>
                        <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-cog"></i></button> 
                        will show the edit category form.
                    </li>
                    <li>
                         <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                         Will allow removal of a category. 
                    </li>
                </ul>
                <p class="text-danger"><b>You can not remove a category if you have articles assigned (count must be zero).</b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>