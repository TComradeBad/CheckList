@extends('layouts.app')

@section('content')

    @if(Auth::check() && Auth::user()->can('view users info'))
        <a href="/users_info">
            <button class="btn btn-primary">Users information</button>
        </a>
        <br>
        <br>
    @endif
    @if(Auth::check() && Auth::user()->can('view users checklists'))
        <a href="/users_checklists">
            <button class="btn btn-primary">Users checklists</button>
        </a>
        <br>
        <br>
    @endif
    @if(Auth::check() && Auth::user()->can('delete users'))
        <a href="/delete_users">
            <button class="btn btn-danger">Delete Users</button>
        </a>
        <br>
        <br>
    @endif
    @if(Auth::check() && Auth::user()->can('set permissions'))
        <a href="/set_users_roles">
            <button class="btn btn-warning">Set users roles</button>
        </a>
        <br>
        <br>
    @endif
    @if(Auth::check() && Auth::user()->can('ban users'))
        <a href="/ban_users">
            <button class="btn btn-warning">Ban users</button>
        </a>
        <br>
        <br>
    @endif
    @if(Auth::check() && Auth::user()->can('set users checklist count'))
        <a href="/set_check_list_count">
            <button class="btn btn-warning">Set users checklist count</button>
        </a>
        <br>
        <br>
    @endif

@endsection
