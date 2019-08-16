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
    <form method="post" action="/set_user_role/{{$user->id}}">
        @csrf
    <p>
        <select size="3" name="role" >
            <option value="user">USER</option>
            <option value="moderator">MODERATOR</option>
            <option value="admin">ADMIN</option>
        </select>
    </p>
        <button type="submit">SET ROLE</button>
    </form>
@endsection
