<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;

class CategoriesController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = [];
        
        //クエリの取得
        $query = Post::query();
        
        //検索ワードの取得
        $keyword = $request->input('keyword');
        
        //検索ワードがある場合はタイトルとコンテンツで部分一致検索
        if(!empty($keyword)) 
        {
            $query->where('title','like', "%$keyword%")
                ->orWhere('content','like', "%$keyword%");
        }
        
        //表示カテゴリの絞り込み
        $query->where('category_id', $id);
        
        //カテゴリ情報の取得
        $categories = Category::orderBy('id','asc')->get();
        
        //カテゴリ名の取得
        $category = new Category();
        $category_name = $category->where('id', $id)->value('name');
        
        //タグリストの取得
        $tag_list = Tag::get()->pluck("name", "id");

        //投稿の取得
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'posts' => $posts,
            'categories' => $categories,
            'keyword' => $keyword,
            'category_name' => $category_name,
            'tag_list' => $tag_list,
        ];

        return view('categories.index', $data);
    }
}