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

    USER MAX CHECKLISTS COUNT {{$user->max_check_lists_count}} <br>

    <br>

    USER MAX CHECKLISTS ITEM COUNT {{$user->max_check_list_items_count}} <br>

    <br>

    USER REGISTRATED : {{$user->created_at}} <br>

    <br>

    USER LAST UPDATE : {{$user->updated_at}} <br>

    <br>

    <a href="/users_checklists/{{$user->id}}">
        <button>VIEW CHECKLISTS</button>
    </a>
@endsection
