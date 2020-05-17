<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use cebe\markdown\GithubMarkdown as Markdown;

class Review extends Model
{
    protected $fillable = [
        'content', 'post_id', 'user_id',
    ];
    
    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
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

