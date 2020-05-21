@extends('layouts.app')

@section('content')
    @if (!Auth::check())
        <div class="center jumbotron">
            <div class="text-center">
                <p>Let's share Code Snippet!</p>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
    @include('posts.index', ['posts' => $posts])
@endsection