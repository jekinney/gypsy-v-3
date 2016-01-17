<div class="modal @if(count($errors) > 0) show @else fade @endif" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('auth.login') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
                    @include('errors.validation')
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                    <div class="form-group @if($errors->has('password')) has-error @endif">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="checkbox">
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember" value="1" @if(old('remember')) checked="true" @endif>
                            Remember Me
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-default pull-left">Forgot Password?</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>