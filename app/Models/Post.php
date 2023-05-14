<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'body',
        'user_id',
    ];

    // 一つの投稿（Post）は一人のユーザーに紐づくためbelongsTo
    public function user(){
        return $this->belongsTo(User::class);
    }
}
