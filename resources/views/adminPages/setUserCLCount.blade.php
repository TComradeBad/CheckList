@extends('layouts.app')

@section('content')
    USER NAME : {{$user->name}} <br>

    <br>

    USER EMAIL : {{$user->email}} <br>

    <br>

    USER MAX CHECKLISTS COUNT {{$user->max_check_lists_count}} <br>

    <br>

    USER MAX CHECKLISTS ITEM COUNT {{$user->max_check_list_items_count}} <br>

    <br>

    <form method="post" action="/set_user_cl_count/{{$user->id}}">
        @csrf
        SET CHECKLISTS COUNT : <input type="number" name="max_cl" value="max_cl" placeholder="10"><br>
        SET ITEMS COUNT : <input type="number" name="max_item" value="max_item" placeholder="10"><br>
        <button type="submit">SET</button>
    </form>
@endsection
