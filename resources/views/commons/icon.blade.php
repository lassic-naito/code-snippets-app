 @switch($tag->name)
    @case('AWS')
        <i class="fab fa-aws"></i>
        @break
    @case('ネイティブアプリ')
        <i class="fas fa-mobile-alt"></i>
        @break
    @default
@endswitch