@extends('layouts.app')

@section('content')
    <table>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> @if(!$user->hasAnyRole(["admin","super-admin"]))

                        <form action="/delete_user/{{$user->id}}" method="post">
                            @csrf
                            <button>DELETE</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
