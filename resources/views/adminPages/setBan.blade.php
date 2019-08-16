@extends('layouts.app')

@section('content')
    <table>
        @foreach($users as $user)
            <tr>
                <td> {{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> @if(!$user->hasAnyRole(["admin","super-admin"]) and Auth::user()->id != $user->id
                and Auth::user()->roles()->get()->first()->name != $user->roles()->get()->first()->name)
                        @if(!$user->banned)

                            <form action="/ban_user/{{$user->id}}" method="post">
                                @csrf
                                <button>BAN</button>
                            </form>
                        @else
                            <form action="/unban_user/{{$user->id}}" method="post">
                                @csrf
                                <button>MERCY</button>
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
