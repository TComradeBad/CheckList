@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        @foreach($user->roles()->get() as $role)
            {{$role->name}}
        @endforeach
        {{$user->name}} {{$user->email}}

        <a href="/set_user_role/{{$user->id}}">
            <button>SET ROLES</button>
        </a>
        <br><br>

    @endforeach


@endsection
