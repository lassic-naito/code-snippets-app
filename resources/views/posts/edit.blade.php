@extends('layouts.app')

@section('content')

<h1>投稿編集</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
        
                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    <p>{!! Form::text('title', null, ['class' => 'form-control']) !!}</p>
                    
                    {!! Form::label('category_id', 'カテゴリ:') !!}
                    {!! Form::select('category_id', $categories, $post->category_id,  ['class' => 'form ', 'id' => 'category_id']) !!} <br>

                    @foreach ($tag_list as $tags => $tag)
                    <label class="checkbox">
                        <input type="checkbox" name="tags[]" id="tags{{ $loop->iteration }}" value="{{ $tags }}" {{ $tag === (int)old("tag") ? "checked" : '' }}>
                        {{ $tag }}
                    </label>
                    @endforeach
                    <br>
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}

                </div>
        
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>

@endsection