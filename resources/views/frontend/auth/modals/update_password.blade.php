<div class="modal @if($errors->has('password') || $errors->has('current_password')) show @else fade @endif" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="UpdateMyPassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('auth.password.update') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="UpdateMyPassword">Update Password</h4>
                </div>
                <div class="modal-body">
                    @include('errors.validation')
                    @if(auth()->user()->password)
                        <div class="form-group @if($errors->has('current_password')) has-error @endif">
                            <label for="current_password">Current Password:</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                        </div>
                    @endif
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Again:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>