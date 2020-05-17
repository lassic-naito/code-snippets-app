@extends('layouts.app')

@section('content')
    
    <div class="container mt-4">
    
    {!! Form::open(['route' => 'posts.index', 'method' => 'get']) !!}
        <div class="form-group">
            {!! Form::label('keyword', '検索') !!}
            {!! Form::text('keyword' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
            <button type="submit" class="btn btn-primary">
		        <i class="fas fa-search"></i> 
		    </button>
        </div>
	{!! Form::close() !!}
    
    <div class="row">
        <div clas="col-sm-2">
            @include('commons.category_list')
        </div>
        <div class="col-sm-10">
        <h2>
            @if($category_name)
                {{ $category_name }}
            @else
                投稿一覧
            @endif
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
                            {!! link_to_route('posts.show','詳細',  ['id' => $post->id]) !!}
                        </div>
                        <div class="card-footer">
                            <span class"mr-2">
                                <i class="far fa-clock"></i>：{{ $post->created_at->format('Y.m.d H:i') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <h3 class="mt-5">該当の投稿はありません。</h3>
            @endif
        </div>
    </div>
@endsection