<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'idea_id',
        'user_id'
    ];

    protected $with = [
        'users:id,name,image'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
