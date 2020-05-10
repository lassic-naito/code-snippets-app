@extends('layouts.app')

@section('content')
    @include('posts.index', ['posts' => $posts])
    @if (!Auth::check())
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Let's share Code Snippet!</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection