@extends('layouts.admin')

@section('content')
<h2>@lang('admin/users.title_users')</h2>

        <table class="table table-light">
            <thead>
                <tr>
                    <th scope="col">@lang('general.name')</th>
                    <th scope="col">@lang('general.email')</th>
                    <th scope="col">@lang('general.role')</th>
                    <th scope="col">@lang('general.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a class="btn btn-outline-primary" href="{{ route('admin.users.edit', ['user' => $user]) }}">Editer</a>
                        <a class="btn btn-outline-danger" href="{{ route('admin.users.index') }}">Supprimer</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links('vendor.pagination.bootstrap-4') }}

@endsection
