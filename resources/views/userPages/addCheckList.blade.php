@extends('layouts.app')

@section("content")
    You got : {{$user->max_check_lists_count}} checklists with {{$user->max_check_list_items_count}} items.
    <br><br>

    <form method="post" action="/add_checklist/{{$user->id}}">
        @csrf
        Checklist name: <input type="text" name="check_list_name"><br><br>
        Items:<br>
        <table>

            @for($i=0;$i<$user->max_check_list_items_count;$i++)
                <tr>
                    <td>{{$i+1}}:</td>
                    <td><input type="text" name="items[{{$i}}]"></td>
                </tr>
            @endfor
            <tr>
                <td>Add</td>
                <td>
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>


    </form>
@endsection
