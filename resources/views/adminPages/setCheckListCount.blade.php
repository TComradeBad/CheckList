@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        @foreach($user->roles()->get() as $role)
            {{$role->name}}
        @endforeach
        {{$user->name}} {{$user->email}}

        @if(!$user->hasAnyRole("super-admin")and
        (Auth::user()->roles()->get()->first()->name != $user->roles()->get()->first()->name) or Auth::user()->name == $user->name)
            <a href="/set_user_cl_count/{{$user->id}}">
                <button>MANAGE CHECK LIST COUNT</button>
            </a>
        @endif
        <br><br>

    @endforeach


@endsection
