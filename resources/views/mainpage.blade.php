@extends('layouts.app')

@section('content')
    @if(Auth::check())
    <a href="/my_checklists">
        <button>Mои чеклисты</button>
    </a>
    @endif
@endsection
