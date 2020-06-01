<form id="login-form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
        {{-- <span class="glyphicon glyphicon-envelope form-control-feedback email-icon"></span> --}}
         @if ($errors->has('username'))
        <span class="help-block">
            <strong>{{ $errors->first('username') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        {{-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
    </div>
    <div class="row">
        <div class="col-xs-8">
            <!--    <div class="checkbox icheck">
                        <label>
                          <input type="checkbox"> Remember Me
                        </label>
                    </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>