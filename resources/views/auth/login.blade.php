@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3 font-weight-normal" style="text-align:center">Hệ thống quản lý sinh viên</h1>

<div class="container">

    <div class="row">
        <?php if (isset($_REQUEST['error'])) { ?>
            <div class="col-lg-12">
                <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <img class="mb-4" src="https://lh3.googleusercontent.com/proxy/8G_i-UxmV9WDGY7CrOYjDvLre5tEMy0p8MN7se1COc8K7RQGKYgUKYdUsQ9HPfGZvuWNFkgAv4KWBr7WXeoP0Mep4EWEl8dUNMighbVr8UE" alt="" width="400" height="100">
            <form class="form-signin" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <h2 class="form-signin-heading text-center">Đăng nhập</h2>
                </div>
                <div class="form-group">
                    <label for="username" class="sr-only">
                        {{ __('Username') }}
                    </label>


                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="form-group">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        {{ __('Login') }}
                    </button>

                    <!-- @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif -->
                </div>
            </form>
        </div>
        <div class="col-lg-4">
        </div>
    </div>
</div>

@endsection