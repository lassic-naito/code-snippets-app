<ul class="list-group list-group-flush" style="max-width: 400px;">
    @foreach($categories as $category)
        <li class="list-group-item list-group-item-action">
            {!! link_to_route('categories.index',  $category -> name, ['id' => $category->id]) !!}
        </li>
    @endforeach
</ul>