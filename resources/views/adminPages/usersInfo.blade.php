@extends('layouts.app')

@section('content')

    @foreach($users as $user)

        <a href="/user_info/{{$user->id}}">
            {{$user->name}} {{$user->email}}
        </a>
        <br><br>

    @endforeach


@endsection
