<ul class="list-group list-group-flush" style="max-width: 400px;">
    @foreach($categories as $category)
        @if($category -> parent_category_id === 0)
            <li class="list-group-item list-group-item-action">
                {!! link_to_route('posts.index',  $category -> name, ['key_category' => $category->id]) !!}
            </li>
        @endif
    @endforeach
</ul>