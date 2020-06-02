{!! Form::open(['route' => 'posts.index', 'method' => 'get']) !!}
    <select name="sort">
        <option value="title_sort_asc">タイトル（昇順）</option>
        <option value="title_sort_desc">タイトル（降順）</option>
        <option value="created_sort_asc">投稿日時（昇順）</option>
        <option value="cerated_sort_desc" selected>投稿日時（降順）</option>
    </select>
    <input type="submit" value="並び替える">
{!! Form::close() !!}

        