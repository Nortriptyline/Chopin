@extends('layouts.blank')

@section('content')


    <div class="card col-md-4 offset-md-4">
        <div class="card-body">
            <h2 class="card-title text-center">@lang('init_password.first_login')</h2>
            <p><strong>{{ $user->name }},</strong><br/> @lang('init_password.description')</p>

            <form class="" method="POST" action="{{ route('password.init') }}">
                {{ csrf_field() }}

                @if ($errors->has('token'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('token') }}
                    </div>
                @endif
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Créer mon compte
                </button>
            </form>
        </div>
    </div>
@endsection
