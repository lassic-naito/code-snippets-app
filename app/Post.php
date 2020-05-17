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
