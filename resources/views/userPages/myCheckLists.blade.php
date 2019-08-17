@extends("layouts.app")

@section('content')
    CheckLists of User : {{$user->name}}<br>
    @foreach($checkLists as $item)
        <a href="check_list/{{$item->id}}">{{$item->name}}</a><br>
    @endforeach
@endsection
