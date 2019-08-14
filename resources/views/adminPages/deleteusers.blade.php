@extends('layouts.app')]

@section('content')

    @foreach($users as $user)
        {{$user->name}}    {{$user->name}}

        <form action="" method="post">
            <button>DELETE</button>
        </form>
    @endforeach

@endsection
