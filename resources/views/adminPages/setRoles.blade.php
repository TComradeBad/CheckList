@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        @foreach($user->roles()->get() as $role)
            {{$role->name}}
        @endforeach
        {{$user->name}} {{$user->email}}

        @if(!$user->hasrole("super-admin"))
        <a href="/set_user_role/{{$user->id}}">
            <button>SET ROLES</button>
        </a>
        @endif
        <br><br>

    @endforeach


@endsection
