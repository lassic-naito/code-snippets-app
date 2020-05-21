<h2 class="border-bottom">
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
                <p>
                    @foreach($post->tags as $tag)
                        <button class="btn d-inline-flex bg-info text-white rounded-pill p-2">                                
                            <font size="2">
                                <i class="fas fa-tag"></i>  {{ $tag->name }}
                            </font>
                        </button>
                    @endforeach
                </p>
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

{{ $posts->links('pagination::bootstrap-4') }}