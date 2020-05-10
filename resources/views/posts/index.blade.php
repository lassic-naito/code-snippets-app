@extends('layouts.app')

@section('content')
    <div class="row">
        <div clas="col-sm-2">
            <ul class="list-group list-group-flush" style="max-width: 400px;">
                @foreach($categories as $category)
                    @if($category -> parent_category_id === 0)
                        <li class="list-group-item">{{ $category -> name}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-sm-10">
            <h2>投稿一覧</h2>
            
                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="card"  style="width: 36rem;">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                    <li class="nav-item">{{ $post->category->name }}</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <a href="#" class="btn btn-primary">詳細</a>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    </div>
@endsection