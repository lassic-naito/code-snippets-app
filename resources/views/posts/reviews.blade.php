 <h2 class="h5 mb-4">コメント一覧</h2>
            
@forelse($post->review as $review)
    <div class="border-top p-4">
        <i class="fas fa-user"></i>:
        @if (!App\User::onlyTrashed()->where('id', $review->user_id)->exists())
            {{ $review->user->name }} <br>
        @else
            退会済みユーザ <br>
        @endif
        <time class="text-secondary">
            <i class="far fa-clock"></i>:{{ $review->created_at->format('Y.m.d H:i') }}
        </time>
        <p class="mt-2">
            {!! $review->mark_body !!}
        </p>
    </div> 
    @empty
    <p>コメントはありません。</p>
@endforelse
    
@if (Auth::check())
    @if(!$d_user)
        <form class="mb-4" method="POST" action="{{ route('reviews.store') }}">
            <input type="hidden" name="post_id", value="{{ $post->id }}">
            <input type="hidden" name="user_id", value="{{ $user->id }}">
        
            <div class="form-group">
                <label for="content">
                    コメント投稿フォーム
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
    @else
        <font color="red"><i class="fas fa-lock"></i>：投稿者が退会しているためコメントできません。</font>
    @endif
@endif 