{!! Form::open(['route' => 'posts.index', 'method' => 'get']) !!}
    <div class="d-flex form-group">
        {!! Form::text('keyword' ,'', ['class' => 'form-control', 'placeholder' => '指定なし'] ) !!}
        <button type="submit" class="btn btn-primary">
	        <i class="fas fa-search"></i> 
	    </button>
    </div>  
   
    @foreach ($tag_list as $tags => $tag)
        <button type="submit" name="tag" value="{{$tags}}" class="btn d-inline-flex bg-info text-white rounded-pill p-2">
            <font size="2">
                <i class="fas fa-tag"></i>  {{ $tag }}
            </font>
        </button>
    @endforeach
{!! Form::close() !!}