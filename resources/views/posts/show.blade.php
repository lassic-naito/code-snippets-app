@extends('layouts.app')

@section('content')
    
    <h2>投稿詳細ページ</h2>

    <h1>{{ $post->title }}</h1>
    <h2>カテゴリ：{{ $post->category->name}}</h2>
    <h3>{{ $post->content }}</h3>
        
    {!! link_to_route('posts.edit', 'このタスクを編集', ['id' => $post->id], ['class' => 'btn btn-light']) !!}

    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    
    {!! Form::close() !!}
    
@endsection