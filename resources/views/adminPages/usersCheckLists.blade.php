@extends('layouts.app')

@section('content')

    @foreach($check_lists as $item)
        <a href="">{{$item->name}}</a><br>
    @endforeach

@endsection
