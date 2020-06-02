@extends('layouts.app')

@section('content')
    
    <div class="container mt-4">
        @include('commons.search')
        <br>
        
        @include('button.post_sort')
        <br>    
    
        <div class="row">
            <div clas="col-sm-2">
                @include('commons.category_list')
            </div>
        
            <div class="col-sm-8">
                @include('commons.posts_list')
            </div>
            <div class="col-sm-2">
            
            </div>
        </div>
    </div>

@endsection