@extends("layouts.app")

@section('content')
    @if(isset($error))
        <a href="" class="text-danger">{{$error}}</a><br>
    @endif
    CheckLists of User : {{$user->name}}<br>
    <table>
        @foreach($checkLists as $item)
            <tr>
                <td><a href="check_list/{{$item->id}}">{{$item->name}}</a></td>
                <td>@if($item->done)
                        TASK DONE
                @endif</td>
                <td>
                    <form action="/check_list_delete/{{$item->id}}" method="post">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
