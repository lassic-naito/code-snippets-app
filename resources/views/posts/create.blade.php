@extends('layouts.app')

@section('content')

    <h1>新規投稿</h1>

    <div class="container mt-4">
        <div class="border p-4">

    <div class="row">
        <div class="col-6">
            {!! Form::model($post, ['route' => 'posts.store']) !!}
                <div class="form-groupm mb-3">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!} <br>
                    {!! Form::label('category_id', 'カテゴリ:') !!}
                    {!! Form::select('category_id', $categories, ['class' => 'form'], ['placeholder' => '選択してください']) !!} <br>
                    
                    @foreach ($tag_list as $tags => $tag)
                    <label class="checkbox">
                        <input type="checkbox" name="tags[]" value="{{$tags}}">
                        {{ $tag }}
                    </label>
                    @endforeach
                    <br>
                    {!! Form::label('content', '内容:') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                </div>
        
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
        <div class ="col-6">
            
        </div>    
    </div>
    
    </div>
    </div>
@endsection