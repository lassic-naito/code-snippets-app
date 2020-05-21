<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use cebe\markdown\GithubMarkdown as Markdown;
// use cebe\markdown\GithubMarkdown;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category_id'];
     
    public function user()
    {
        return $this->belongsTo(User::class);   
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');  
    }
    
    public function post_tag()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'post_id', 'tag_id');
    }
    
    public function put_tag($postId)
    {
        $exist = $this->is_tag_putting($postId);
        
        if($exist){
            return false;    
        }else{
            $this->post_tag()->attach($postId);
            return true;
        }
    }
    
    public function out_tag($postId)
    {
        $exist = $this->is_tag_putting($postId);
        
        if($exist){
            $this->post_tag()->detach($postId);
            return true;    
        }else{
            return false;
        }
    }
    
    public function is_tag_putting($postId)
    {
        return $this->post_tag()->where('post_id', $postId)->exists();
    }
    
    
    public function scopeCategory($query, ?string $category)
    {
        if(!is_null($category))
        {
            return $query->where('category', $category);    
        }
        return $query;
    }
    
    public function parse() {
        //newでインスタンスを作る
        $parser = new Markdown();
        return $parser->parse($this->content);
    }
    
    public function getMarkBodyAttribute() {
        return $this->parse();
    }
}
