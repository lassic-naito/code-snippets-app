@extends('layouts.app')

@section('content')
    @if (Auth::id() == $post->user_id)
        <div class="d-flex justify-content-start-around">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">
                <i class="fas fa-edit"></i>:編集
            </a>
            {!! Form::model($post, ['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                <button type="submit" class="btn btn-danger btn-dell">
	               <i class="fas fa-trash-alt"></i>:削除
	            </button>
            {!! Form::close() !!}
        </div>
    @endif

    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-8 showcard">
                <i class="fas fa-user"></i>:{{ $post->user->name }}<br>
                <i class="far fa-clock"></i>:{{ $post->created_at->format('Y.m.d H:i') }} 投稿
    
                <h1>{{ $post->title }}</h1>
                <p class="d-inline-flex text-black pr-3 pl-3 catebadge rounded">{{ $post->category->name}}</p>  
                <br>
                @foreach($post->tags as $tag)
                    <p class="d-inline-flex bg-info text-white rounded-pill p-2">
                        <font size="2">
                            <i class="fas fa-tag"></i>  {{ $tag->name }}
                        </font>
                    </p>
                @endforeach
                
                @if($post->updated_at !== $post->created_at)
                    <p><i class="fas fa-sync-alt"></i>:{{ $post->updated_at->format('Y.m.d H:i') }} 更新</p>
                @endif
                
                <p>{!! $post->mark_body !!}</p>
            </div>
            
            <div class="col-sm-4">
                <section>
                   @include('posts.reviews')
                </section>
            </div>
        </div>
    </div>
    
    
@endsection

@section('script')
    <script>
        $(function(){
            $(".btn-dell").click(function(){
                if(confirm("本当に削除しますか？")){
                //そのままsubmit（削除）
                }else{
                //cancel
                    return false;
                }
            });
        });
    </script>
@endsection