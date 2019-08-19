@extends('layouts.app')

@section("content")
    <table>
        <tr>
            <td>CheckList Name :</td>
            <td>{{$checkList->name}}</td>
        </tr>

        @foreach($checkList->items as $item)
            <tr>

                <td>{{$item->name}}</td>
                <td>
                    <form method="post" action="/check_lists/{{$checkList->id}}/item/{{$item->id}}">
                        @csrf
                        <button type="submit">
                            @if(!$item->done)
                                Done
                            @else
                                Doesnt done
                            @endif
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
