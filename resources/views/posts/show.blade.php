@extends('layouts.app')

@section('content')
    
    <h2>投稿詳細ページ</h2>

    <div class="container mt-4">
        <div class="border p-4">

            <h1>{{ $post->title }}</h1>
            <h4>{{ $post->category->name}}</h4>
            <i class="fas fa-user"></i>:{{ $post->user->name }} <br>
            <i class="far fa-clock"></i>:{{ $post->created_at->format('Y.m.d H:i') }}
            <h3>
                {!! $post->mark_body !!}
            </h3>
        
            @if (Auth::id() == $post->user_id)
                {!! link_to_route('posts.edit', 'このタスクを編集', ['id' => $post->id], ['class' => 'btn btn-light']) !!}
    
                {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endif
    
            <section>
                <h2 class="h5 mb-4">
                    コメント欄
                </h2>
            
                @forelse($post->review as $review)
                    <div class="border-top p-4">
                        <i class="fas fa-user"></i>:{{ $review->user->name }} <br>
                        <time class="text-secondary">
                            <i class="far fa-clock"></i>:{{ $review->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! $review->mark_body !!}
                        </p>
                    </div> 
                    @empty
                        <p>コメントはまだありません。</p>
                @endforelse
                
            @if (Auth::check())
                <form class="mb-4" method="POST" action="{{ route('reviews.store') }}">
                    <input type="hidden" name="post_id", value="{{ $post->id }}">
                    <input type="hidden" name="user_id", value="{{ $user->id }}">
                    
                    <div class="form-group">
                        <label for="content">
                            コメント
                        </label>
                        
                        {{ csrf_field() }}
                        <textarea 
                            id="content"
                            name="content"
                            class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                            rows="4"
                            onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"
                        >{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->first('content') }}
                            </div> 
                        @endif
                    </div> 
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            コメントする
                        </button>
                    </div>
                </form>
            @endif 
            </section>
        </div>
    </div>
    
@endsection