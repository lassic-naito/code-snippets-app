@extends('layouts.app')

@section('content')
    
    {!! Form::open(['route' => 'posts.index', 'method' => 'get']) !!}
        <div class="form-group">
            {!! Form::label('keyword', '検索') !!}
            {!! Form::text('keyword' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
        </div>
    {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
    
    <div class="row">
        <div clas="col-sm-2">
            @include('commons.category_list')
        </div>
        <div class="col-sm-10">
        <h2>
            投稿一覧
        </h2>
            
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="card mb-5"  style="width: 36rem;">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    {{ $post->category->name }}
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">@markdown($post->content)</p>
                            {!! link_to_route('posts.show','詳細',  ['id' => $post->id]) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection