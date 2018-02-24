@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Créer un utilisateur</h2>
    </div>
    <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('admin.users.store') }}">
            {{ csrf_field() }}
            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-sm-2 col-form-label">Name : </label>
                <div class="col-sm-4">
                    <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-sm-2 col-form-label">E-Mail Address : </label>
                <div class="col-sm-4">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row{{ $errors->has('role') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-sm-2 col-form-label">Rôles</label>

                <div class="col-sm-4">
                    <select class="form-control" name="role" id="role">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
