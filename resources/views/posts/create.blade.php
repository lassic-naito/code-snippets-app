@extends('layouts.app')

@section('content')

    <h1>新規投稿</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => 'posts.store']) !!}
        
                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    {!! Form::label('category_id', 'カテゴリ:') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form', 'id' => 'id']) !!}
                    {!! Form::label('content', 'メッセージ:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>
        
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>
@endsection