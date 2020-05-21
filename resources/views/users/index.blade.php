@extends('layouts.app')

@section('content')

<p>ユーザ名：{{ $user->name }}</p>

<p>登録日：{{ $user->created_at }}</p>

<p>メールアドレス:{{ $user->email }}</p>

<a href="/users/delete/{{ $user->id }}" class=" btn-dell">退会</a>


<h2>投稿履歴</h2>

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
    <h3 class="mt-5">投稿はありません。</h3>
@endif

@endsection

@section('script')
    <script>
        $(function(){
            $(".btn-dell").click(function(){
                if(confirm("本当に退会しますか？")){
                //そのままsubmit（削除）
                }else{
                //cancel
                    return false;
                }
            });
        });
    </script>
@endsection