@extends('layouts.app')

@section('content')

    USER NAME : {{$user->name}} <br>

    <br>

    USER EMAIL : {{$user->email}} <br>

    <br>

    USER STATUS :
    @foreach($user->roles()->get() as $role)
        {{$role->name}}
    @endforeach <br>
    <br>

    USER REGISTRATED : {{$user->created_at}} <br>

    <br>

    USER LAST UPDATE : {{$user->updated_at}} <br>

    <br>
@endsection
