@extends('layouts.app')

@section('content')

    <h1>投稿詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>タイトル</th>
            <td>{{ $post->title }}</td>
        </tr>
        <tr>
            <th>カテゴリー</th>
            <td>{{ $post->category_id}}</td>
        </tr>
        <tr>
            <th>投稿内容</th>
            <td>{{ $post->content }}</td>
        </tr>
        
    </table>
    
    @if(\Auth::id() == user_id)
    {!! link_to_route('tasks.edit', 'このタスクを編集', ['id' => $task->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($task, ['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection